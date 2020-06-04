<?php

namespace App\Contracts\Repositories;

interface BrandRepository extends BaseRepository
{
    public function all();
    public function allActive();
    public function paginate($items = null);
    public function find($id);
}
