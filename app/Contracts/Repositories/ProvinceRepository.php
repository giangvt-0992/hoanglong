<?php

namespace App\Contracts\Repositories;

interface ProvinceRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
    public function allWithDistrict();
}
