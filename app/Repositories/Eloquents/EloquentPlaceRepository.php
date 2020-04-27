<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\PlaceRepository;
use App\Models\Place;

class EloquentPlaceRepository extends EloquentBaseRepository implements PlaceRepository
{
    protected $model;

    public function __construct(
        Place $model
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
