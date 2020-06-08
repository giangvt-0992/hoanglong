<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Builder;
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
        'code',
        'trip_info',
        'status',
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

    public function getPassengerInfoAttribute($value)
    {
        $passengerInfo = json_decode($value, true);
        return $passengerInfo;
    }

    public function getTripInfoAttribute($value)
    {
        $tripInfo = json_decode($value, true);
        return $tripInfo;
    }

    public function getStatusAttribute($value)
    {
        return __($value);
    }

    public function getStatusColor()
    {
        $colorList = [
            TicketStatus::Unpaid => 'warning',
            TicketStatus::Paid => 'success',
            TicketStatus::Cancel => 'danger',
        ];
        $color = $colorList[$this->getOriginal('status')];
        return $color;
    }

    public function scopeBrand(Builder $builder) {
        $brandId = getAuthAdminBrandId();
        
        $builder->where('brand_id', '=', $brandId);
    }

    public function scopeIsNotCancel(Builder $builder)
    {
        $builder->where('status', '!=', TicketStatus::getValue('Cancel'));
    }

    public function getListSeatString()
    {
        $list = json_decode($this->list_seat, true);
        return join(", ", $list);
    }
}
