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
        'brand_id',
        'price',
        'description',
        'is_active'
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

    public function tripDepartDates()
    {
        return $this->hasManyThrough(TripDepartDate::class, Trip::class);
    }

    public function getDurationAttribute($value)
    {
        $duration = json_decode($value);
        return $duration;
    }

    public function places()
    {
        return $this->belongsToMany(Place::class, 'passing_places', 'route_id', 'place_id');
    }
    
    public function getIsActiveAttribute($value)
    {
        return $value ? 'Kích hoạt' : 'Ngưng kích hoạt';
    }
}
