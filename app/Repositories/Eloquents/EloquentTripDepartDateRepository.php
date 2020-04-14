<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\TripDepartDateRepository;
use App\Models\TripDepartDate;

class EloquentTripDepartDateRepository extends EloquentBaseRepository implements TripDepartDateRepository
{
    protected $model;

    public function __construct(
        TripDepartDate $model
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
