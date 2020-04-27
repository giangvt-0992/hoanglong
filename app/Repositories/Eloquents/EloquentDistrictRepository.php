<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\DistrictRepository;
use App\Models\District;

class EloquentDistrictRepository extends EloquentBaseRepository implements DistrictRepository
{
    protected $model;

    public function __construct(
        District $model
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
