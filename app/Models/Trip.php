<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Trip extends Model
{
    protected $table = "trips";

    protected $fillable = [
        'name',
        'depart_time',
        'arrive_time',
        'pick_up_schedule',
        'brand_id',
        'route_id',
        'car_type_id',
        'is_active'
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

    public function getPickupPlace()
    {
        $pickup = $this->pick_up_schedule;
        
        $pickupArr = json_decode($pickup);
        $locations = Arr::pluck($pickupArr, 'location');
        $pickupPlace = Place::whereIn('id', $locations)->get();

        $newArr = [];
        
        foreach ($pickupArr as $p) {
            $place = $pickupPlace->find($p->location);
            $place && $newArr[] = [
                'time' => $p->time,
                'location' => $place
            ];
        }
        return $newArr;
    }
    
    public function getPickUpScheduleAttribute($value)
    {
        return json_decode($value, TRUE) ?? [];
    }

    public function getIsActiveAttribute($value)
    {
        return $value ? 'Kích hoạt' : 'Ngưng kích hoạt';
    }
}
