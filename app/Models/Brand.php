<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Brand extends Model
{
    use Notifiable;
    
    protected $table = "brands";

    protected $fillable = [
        'name',
        'description',
        'phone',
        'notice',
        'bank',
        'image'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function offices()
    {
        return $this->hasMany(Office::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function tripDepartDates()
    {
        return $this->hasMany(TripDepartDate::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function getPhoneStringAttribute()
    {
        $phone = json_decode($this->phone, true);
        $phoneString = join(" - ", $phone);
        return $phoneString;
    }
}
