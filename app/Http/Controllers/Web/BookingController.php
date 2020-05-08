<?php

namespace App\Http\Controllers\Web;

use App\Contracts\Repositories\ProvinceRepository;
use App\Contracts\Repositories\RouteRepository;
use App\Contracts\Repositories\TicketRepository;
use App\Contracts\Repositories\TripDepartDateRepository;
use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    protected $routeRepository;
    protected $provinceRepository;
    protected $userRepository;
    protected $ticketRepository;
    protected $tripDepartDateRepository;

    public function __construct(
        RouteRepository $routeRepository,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository,
        TicketRepository $ticketRepository,
        TripDepartDateRepository $tripDepartDateRepository
    ) {
        $this->routeRepository = $routeRepository;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
        $this->tripDepartDateRepository = $tripDepartDateRepository;
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
        $formData = $request->formData;
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

        return response()->json([
                'status' => "success",
                'data' => [
                    'view' => $view
                ],
                "message" => __('Book ticket successfully')
            ]);
    }
}
