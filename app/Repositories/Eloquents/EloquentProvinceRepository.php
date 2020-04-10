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
        return $this->model->with('images')->orderBy('index', 'ASC')->get();
    }
    
    public function paginate($items = null)
    {
        return $this->model->orderBy('index', 'ASC')->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
