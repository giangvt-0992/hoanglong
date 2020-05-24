<?php

namespace App\Contracts\Repositories;

use App\Models\Trip;

interface TripRepository extends BaseRepository
{
    public function all();
    public function allByAdmin();
    public function paginate($items = null);
    public function find($id);
    public function toggleIsActive(Trip $trip, $isActive);
}
