<?php

namespace App\Http\Controllers\Web;

use App\Contracts\Repositories\BrandRepository;
use App\Contracts\Repositories\ProvinceRepository;
use App\Contracts\Repositories\RouteRepository;
use App\Contracts\Repositories\TicketRepository;
use App\Contracts\Repositories\TripDepartDateRepository;
use App\Contracts\Repositories\UserRepository;
use App\Events\NewTicketEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use App\Models\Brand;
use App\Models\Route;
use App\Models\Ticket;
use App\Notifications\NewTicketNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Pusher\Pusher;

class BookingController extends Controller
{
    protected $routeRepository;
    protected $provinceRepository;
    protected $userRepository;
    protected $ticketRepository;
    protected $tripDepartDateRepository;
    protected $brandRepository;

    public function __construct(
        RouteRepository $routeRepository,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
        TicketRepository $ticketRepository,
        TripDepartDateRepository $tripDepartDateRepository,
        BrandRepository $brandRepository
    ) {
        $this->routeRepository = $routeRepository;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
        $this->tripDepartDateRepository = $tripDepartDateRepository;
        $this->brandRepository = $brandRepository;
    }

    public function index(Request $request)
    {
        if ($request->has('departure_id') && $request->has('destination_id') && $request->has('depart_date') && $request->has('quantity')) {
            $departProvince = $this->provinceRepository->find($request->departure_id);
            $desProvince = $this->provinceRepository->find($request->destination_id);

            $data = [
                'departProvince' => $departProvince,
                'desProvince' => $desProvince,
                'quantity'  => $request->quantity,
                'departDate' => $request->depart_date
            ];
            $routes = $this->routeRepository->findTrips($data);
            \Session::put('step', config('constants.step.STEP1'));
            return view(
                'web.booking.index',
                [
                'routes' => $routes,
                'departProvince' => $departProvince,
                'desProvince' => $desProvince,
            ]
            );
        }
        \Session::put('step', config('constants.step.STEP0'));
        return view('web.booking.index');
    }

    public function search(Request $request)
    {
        $data = [
            'depart_province_id' => $request->departure_id,
            'des_province_id' => $request->destination_id,
            'quantity'  => $request->quantity,
            'depart_date' => $request->depart_date
        ];
        $routes = $this->routeRepository->findTrips($data);

        return $routes;
    }

    public function bookRoute(Request $request)
    {
        // $formData = $request->formData;
        $formData = "passengerName=a&passengerPhone=a&passengerEmail=a%40gmail.com&passengerAddress=a&price=80000&quantity=2&date=30-05-2020&paymenttype=1&tddId=19&brandId=11&departName=B%E1%BA%BFn+xe+H%C3%A0+N%E1%BB%99i&departTime=08%3A30%3A00&desName=B%E1%BA%BFn+xe+Th%C3%A1i+B%C3%ACnh&desTime=11%3A00%3A00&routeName=Tuy%E1%BA%BFn+H%C3%A0+N%E1%BB%99i+-+Th%C3%A1i+B%C3%ACnh+(B%E1%BA%BFn+xe+H%C3%A0+N%E1%BB%99i+-+B%E1%BA%BFn+xe+Th%C3%A1i+B%C3%ACnh)&depProvinceName=H%C3%A0+N%E1%BB%99i&desProvinceName=Th%C3%A1i+B%C3%ACnh&selectedSeats=10%2C11&pickupPlace=101&pickupPlaceName=B%E1%BA%BFn+xe+H%C3%A0+N%E1%BB%99i&pickupTime=08%3A30&tripName=H%C3%A0+N%E1%BB%99i+-+Th%C3%A1i+B%C3%ACnh++8h30";
        $ticketData = [];
        parse_str($formData, $ticketData);

        $ticketData['userId'] = 0;
        if (auth('web')->check()) {
            $ticketData['userId'] = auth('web')->user()->id;
        } else {
            $passenger = $this->userRepository->findByEmail($ticketData['passengerEmail']);

            $ticketData['userId'] = ($passenger != null) ?? $passenger->id;
        }

        $trip = $this->tripDepartDateRepository->find($ticketData['tddId']);
        if (!isset($trip)) {
            return null;
        }

        $selectedSeats = explode(',', $ticketData['selectedSeats']);

        $seatMap = $trip->seatMap();
        foreach ($selectedSeats as $index) {
            if ($seatMap[$index] == 1) {
                return response()->json([
                    'status' => "error",
                    'data' => null,
                    "message" => __("Seat :index has been booked", ['index' => $index])
                ]);
            } else {
                $seatMap[$index] = 1;
            }
        }

        DB::beginTransaction();
        try {
            $ticket = $this->ticketRepository->createTicket($ticketData);
            $trip->available_seats = $trip->available_seats - $ticketData['quantity'];
            $trip->seat_map = json_encode($seatMap);
            $trip->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $view = view('web.booking.step4', ['ticketData' => null])->render();
            return response()->json([
                    'status' => "error",
                    'data' => $view,
                    "message" => 'Add ticket fail'
                ]);
        }
        $ticketData['ticketCode'] = $ticket->code;
        $view = view('web.booking.step4', ['ticketData' => $ticketData])->render();
        SendMailJob::dispatch($ticketData);
        $brand = $ticket->brand;
        $routeName = $ticketData['routeName'];
        $this->newTicketNotification($brand, $ticket, $routeName);

        return response()->json([
                'status' => "success",
                'data' => [
                    'view' => $view
                ],
                "message" => __('Book ticket successfully')
            ]);
    }

    public function newTicketNotification(Brand $brand,Ticket $ticket, $routeName)
    {
        $data = [
            'type' => 'ticket',
            'message' => "Tuyến xe $routeName có 1 vé xe mới ",
            'code' => $ticket->code,
            'time' => date('H:i:s d-m-Y', strtotime($ticket->created_at))
        ];
        if ($brand) {
            
            $brand->notify(new NewTicketNotification($data));
        }

        $data1 = [
            'type' => 'ticket',
            'message' => "Tuyến xe $routeName có 1 vé xe mới ",
            'route' => route('admin.ticket.show', [
                'code' => $ticket->code
            ]),
            'time' => date('H:i:s d-m-Y', strtotime($ticket->created_at))
        ];

        $options = [
            'cluster' => 'ap1',
            'useTLS' => true
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('my-channel', 'my-event', $data1);
        // event(new NewTicketEvent($data));
    }

    public function test()
    {
        $brand = $this->brandRepository->find(9);
        $ticket = Ticket::find(10);
        $this->newTicketNotification($brand, $ticket, 'Hà Nội - Thái Bình');
    }
}
