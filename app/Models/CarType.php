<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $table = "car_types";

    protected $fillable = [
        'name',
        'total_seats',
        'seat_map'
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function getTotalSeatsAttribute($value)
    {
        return $value - 1;
    }
}
