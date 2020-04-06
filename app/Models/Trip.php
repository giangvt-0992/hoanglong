<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = "trips";

    protected $fillable = [
        'name',
        'depart_time',
        'arrive_time',
        'pick_up_schedule',
        'get_off_schedule',
        'brand_id',
        'route_id',
        'car_type_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    public function tripDepartDates()
    {
        return $this->hasMany(TripDepartDate::class);
    }
}
