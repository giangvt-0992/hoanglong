<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = "provinces";

    protected $fillable = [
        'name',
        'slug',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function places()
    {
        return $this->hasManyThrough(
            Place::class,
            District::class,
            'province_id',
            'district_id',
            'id',
            'id'
        );
    }
}
