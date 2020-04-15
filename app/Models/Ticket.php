<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    protected $table = "tickets";

    protected $fillable = [
        'trip_depart_date_id',
        'quantity',
        'passenger_info',
        'brand_id',
        'list_seat',
        'total',
        'user_id',
        'unit_price',
        'code'
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
