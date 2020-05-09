<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\TripRepository;
use App\Models\Trip;

class EloquentTripRepository extends EloquentBaseRepository implements TripRepository
{
    protected $model;
    protected $provinceRepository;

    public function __construct(
        Trip $model,
        EloquentProvinceRepository $eloquentProvinceRepository
    ) {
        $this->model = $model;
        $this->eloquentProvinceRepository = $eloquentProvinceRepository;
    }

    public function all()
    {
        return $this->model->with('departPlace:id,name', 'desPlace:id,name')->get();
    }

    public function allByAdmin()
    {
        $admin = getAuthAdmin();
        return $this->model->whereBrandId($admin->brand_id)->with('departPlace:id,name', 'desPlace:id,name')->get();
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
