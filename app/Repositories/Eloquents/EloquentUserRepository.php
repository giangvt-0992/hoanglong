<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\UserRepository;
use App\Models\User;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    protected $model;

    public function __construct(
        User $model
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

    public function findByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
        # code...
    }
}
