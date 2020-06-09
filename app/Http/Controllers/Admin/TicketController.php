<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\RouteRepository;
use App\Contracts\Repositories\TicketRepository;
use App\Enums\TicketStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    protected $ticketRepository;
    protected $routeRepository;

    public function __construct(
        TicketRepository $ticketRepository,
        RouteRepository $routeRepository
    ) {
        // magic function
        // service container + dependency injection
        $this->ticketRepository = $ticketRepository;
        $this->routeRepository = $routeRepository;
    }

    public function index()
    {
        $this->authorize('ticket.viewAny');

        getAuthAdmin()->brand->unreadNotifications->markAsRead();

        $fromDate = date('Y-m-d');
        // $data = [
        //     'from_date' => $fromDate
        // ];
        // $tickets = $this->ticketRepository->searchByAdmin($data);
        // $routes = $this->routeRepository->allByAdmin();
        // $listTicketStatus = TicketStatus::getValues();
        
        // return view('admin.ticket.index', [
        //     'tickets' => $tickets,
        //     'routes' => $routes,
        //     'fromDate' => $fromDate,
        //     'listTicketStatus' => $listTicketStatus,
        // ]);
        return redirect()->route('admin.ticket.search', ['from_date' => $fromDate]);
    }

    public function show(Request $request, Ticket $ticket)
    {
        $this->authorize('ticket.view', $ticket);

        $hours = 6;
        $isExpired = $ticket->isExpiredInHours($hours);
        
        $ticket->brand->unreadNotifications()->where('data->code', $ticket->code)->get()->markAsRead();

        return view('admin.ticket.detail', [
            'ticket' => $ticket,
            'isExpired' => $isExpired
        ]);
    }

    public function search(Request $request)
    {
        $this->authorize('ticket.viewAny');

        $data = $request->all();
        $data['from_date'] = $request->from_date ? date('Y-m-d', strtotime($request->from_date)) : null;
        $data['to_date'] = $request->to_date ? date('Y-m-d', strtotime($request->to_date)) : null;

        $tickets = $this->ticketRepository->searchByAdmin($data);
        $routes = $this->routeRepository->allByAdmin();
        $tripsByRoute = request('route_id') ? $this->routeRepository->find(request('route_id'))->trips : null;
        $listTicketStatus = TicketStatus::getValues();

        return view('admin.ticket.index', [
            'tickets' => $tickets,
            'routes' => $routes,
            'listTicketStatus' => $listTicketStatus,
            'tripsByRoute' => $tripsByRoute,
        ]);
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $this->authorize('ticket.update', $ticket);
        $nextStatus = $request->status;

        $isExpired = $ticket->isExpiredInHours(Ticket::$defaultExpiredHours);
        if ($isExpired) {
            return redirect()->back()->with('error', 'Thời gian hủy vé đã hết hạn.');
        }

        if ($nextStatus != $ticket->getNextStatus()) {
            return redirect()->back()->with('error', 'Trạng thái vé không hợp lệ');
        }
        
        $ticket->status = $nextStatus;

        try {
            if ($nextStatus == TicketStatus::getValue('Paid') || $nextStatus == TicketStatus::getValue('Unpaid')) {
                DB::transaction(function () use ($ticket) {
                    $this->ticketRepository->rollback($ticket->code);
                    $ticket->save();
                });
            } else {
                $ticket->save();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật trạng thái vé thất bại');
        }
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái vé thành công');
    }
}
