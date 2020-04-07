<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = "routes";

    protected $fillable = [
        'name',
        'depart_place_id',
        'des_place_id',
        'distance',
        'duration',
        'brand_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function departPlace()
    {
        return $this->belongsTo(Place::class, 'depart_place_id');
    }

    public function desPlace()
    {
        return $this->belongsTo(Place::class, 'des_place_id');
    }
}