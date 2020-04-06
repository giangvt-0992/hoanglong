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
        'trip_id'
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
}
