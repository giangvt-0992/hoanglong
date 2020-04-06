<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'trip_depart_date_id',
        'quantity',
        'passenger_info',
        'brand_id'
    ];

    public function tripDepartDate()
    {
        return $this->belongsTo(TripDepartDate::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
