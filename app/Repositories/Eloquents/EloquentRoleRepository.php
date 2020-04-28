<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\RoleRepository;
use App\Models\Role;

class EloquentRoleRepository extends EloquentBaseRepository implements RoleRepository
{
    protected $model;

    public function __construct(
        Role $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        $admin = getAuthAdmin();
        return $this->model->where([
            ['slug', '!=', config('constants.SUPER_ADMIN')],
            ['brand_id', '=', $admin->brand_id]
            ])->orderBy('id', 'DESC')->get();
    }
    
    public function paginate($items = null)
    {
        return $this->model->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByName($name)
    {
        return $this->model->whereName($name)->first();
    }
}
