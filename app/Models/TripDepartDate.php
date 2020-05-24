<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripDepartDate extends Model
{
    protected $table = "trip_depart_dates";

    protected $fillable = [
        'depart_date',
        'available_seats',
        'seat_map',
        'brand_id',
        'trip_id',
        'is_active'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function seatMap() {
        $seatJson = $this->seat_map;
        $seatArray = json_decode($seatJson, true);
        return $seatArray;
    }

    public function getIsActiveAttribute($value)
    {
        return $value ? 'Kích hoạt' : 'Ngưng kích hoạt';
    }
}
