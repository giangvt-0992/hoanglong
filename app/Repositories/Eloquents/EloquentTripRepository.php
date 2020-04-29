<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\TripRepository;
use App\Models\Trip;

class EloquentTripRepository extends EloquentBaseRepository implements TripRepository
{
    protected $model;

    public function __construct(
        Trip $model
    ) {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function allByAdmin()
    {
        $admin = getAuthAdmin();

        return $this->model->with('car:id,name')->where('brand_id', $admin->brand_id)->get();
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
