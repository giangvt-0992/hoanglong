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
        return $this->model->orderBy('created_at', 'DESC')->get();
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
