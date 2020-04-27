<?php

namespace App\Contracts\Repositories;

interface PlaceRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
}
