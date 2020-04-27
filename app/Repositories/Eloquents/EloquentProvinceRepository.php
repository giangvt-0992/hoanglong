<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\ProvinceRepository;
use App\Models\Province;

class EloquentProvinceRepository extends EloquentBaseRepository implements ProvinceRepository
{
    protected $model;

    public function __construct(
        Province $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }
    
    public function paginate($items = null)
    {
        return $this->model->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function allWithDistrict()
    {
        return $this->model->with('districts')->get();
    }
}
