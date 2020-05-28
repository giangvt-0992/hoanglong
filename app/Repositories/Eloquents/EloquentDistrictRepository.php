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

    public function allWithProvince()
    {
        return $this->model->with('province:id,name')->get();
    }

    public function checkNameIsUse($province, $name, $currentId = -1)
    {
        return $this->model
        ->where('province_id', '=', $province->id)
        ->where('id', '!=', $currentId)
        ->whereRaw("name = CONVERT('$name' USING BINARY)")
        ->count() > 0;
    }

    public function createSlug($provinceSlug, $districtName)
    {
        $words = explode("-", $provinceSlug);
        $postfix = '';
        foreach ($words as $word) {
            $postfix .= $word[0];
        }

        return str_slug($districtName) . '-' . $postfix;
    }

    public function search($data = [])
    {
        $where = [];
        if (isset($data['province_id'])) {
            $where[] = ['province_id', '=', $data['province_id']];
        }
        if (isset($data['name'])) {
            $where[] = ['name', 'like', '%' . $data['name'] .'%'];
        }

        return $this->model->where($where)->get();
    }
}
