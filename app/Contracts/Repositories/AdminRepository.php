<?php

namespace App\Contracts\Repositories;

interface AdminRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
}
