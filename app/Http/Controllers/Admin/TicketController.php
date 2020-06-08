<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\RouteRepository;
use App\Contracts\Repositories\TicketRepository;
use App\Enums\TicketStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;

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

        $ticket->brand->unreadNotifications()->where('data->code', $ticket->code)->get()->markAsRead();

        return view('admin.ticket.detail', [
            'ticket' => $ticket,
        ]);
    }

    public function search(Request $request)
    {
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
}
