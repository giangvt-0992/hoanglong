<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PermissionRepository;
use App\Models\Permission;

class EloquentPermissionRepository extends EloquentBaseRepository implements PermissionRepository
{
    protected $model;

    public function __construct(
        Permission $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('id', 'ASC')->get();
    }

    public function allByAdmin()
    {
        $admin = getAuthAdmin();
        if ($admin->isSuperAdmin()) {
            return $this->model->orderBy('id', 'ASC')->get();
        } else {
            return $admin->role->permissions;
        }
    }
    
    public function paginate($items = null)
    {
        return $this->model->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
