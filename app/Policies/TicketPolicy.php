<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the Admin can view any tickets.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.view_ticket.slug'));
    }

    /**
     * Determine whether the Admin can view the ticket.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function view(Admin $admin, Ticket $ticket)
    {
        return $admin->hasAccess(config('permissions.view_ticket.slug')) && $admin->brand_id == $ticket->brand_id;
    }

    /**
     * Determine whether the Admin can create tickets.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        return $admin->hasAccess(config('permissions.create_ticket.slug'));
    }

    /**
     * Determine whether the Admin can update the ticket.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function update(Admin $admin, Ticket $ticket)
    {
        return $admin->brand_id === $ticket->brand_id && $admin->hasAccess(config('permissions.update_ticket.slug'));
    }

    /**
     * Determine whether the Admin can delete the ticket.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function delete(Admin $admin, Ticket $ticket)
    {
        return $admin->brand_id === $ticket->brand_id && $admin->hasAccess(config('permissions.delete_ticket.slug'));
    }

    /**
     * Determine whether the Admin can restore the ticket.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function restore(Admin $admin, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the Admin can permanently delete the ticket.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Ticket  $ticket
     * @return mixed
     */
    public function forceDelete(Admin $admin, Ticket $ticket)
    {
        //
    }
}
