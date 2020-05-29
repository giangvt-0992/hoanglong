<?php

namespace App\Contracts\Repositories;

interface TicketRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function createTicket($data);
    public function allByAdmin();
}
