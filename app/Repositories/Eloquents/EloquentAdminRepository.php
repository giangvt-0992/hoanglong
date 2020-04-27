<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\AdminRepository;
use App\Models\Admin;

class EloquentAdminRepository extends EloquentBaseRepository implements AdminRepository
{
    protected $model;

    public function __construct(
        Admin $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        $admin = getAuthAdmin();

        return $this->model
        ->where('id', '!=', $admin->id)
        ->where(function ($query) use ($admin) {
            $query->where('parent_id', $admin->id)
            ->orWhere('brand_id', $admin->brand_id);
        })
        ->with(['brand:id,name','role:id,name'])
        ->orderBy('created_at', 'DESC')->get();
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
