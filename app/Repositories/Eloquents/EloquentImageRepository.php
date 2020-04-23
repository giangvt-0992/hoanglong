<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\ImageRepository;
use App\Models\Image;

class EloquentImageRepository extends EloquentBaseRepository implements ImageRepository
{
    protected $model;

    public function __construct(
        Image $model
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

    public function unlink($images)
    {
        foreach ($images as $image) {
            if (isset($image) && file_exists(public_path($image->url))) {
                unlink(public_path($image->url));
                $image->delete();
            }
        }
    }
}
