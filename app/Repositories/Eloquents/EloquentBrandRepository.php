<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\BrandRepository;
use App\Models\Brand;

class EloquentBrandRepository extends EloquentBaseRepository implements BrandRepository
{
    protected $model;

    public function __construct(
        Brand $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    // public function allAdmin()
    // {
    //     return $this->model->orderBy('created_at', 'DESC')->get();
    // }
    
    public function paginate($items = null)
    {
        return $this->model->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function allActive()
    {
        return $this->model->active()->get();
    }
}
