<?php

namespace App\Contracts\Repositories;

interface PermissionRepository extends BaseRepository
{
    public function all();
    public function paginate($items = null);
    public function find($id);
}
