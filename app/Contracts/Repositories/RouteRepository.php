<?php

namespace App\Contracts\Repositories;

use App\Models\Route;

interface RouteRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function allByAdmin();
    public function toggleIsActive(Route $route, $isActive);
    public function findTrips($data = []);
}
