<?php

namespace App\Contracts\Repositories;

interface TripRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
}
