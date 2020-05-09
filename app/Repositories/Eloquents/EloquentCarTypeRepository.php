<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\CarTypeRepository;
use App\Models\CarType;

class EloquentCarTypeRepository extends EloquentBaseRepository implements CarTypeRepository
{
    protected $model;

    public function __construct(
        CarType $model
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
}
