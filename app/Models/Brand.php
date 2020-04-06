<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";

    protected $fillable = [
        'name',
        'description',
        'phone',
        'notice',
        'bank',
        'image'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
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
}
