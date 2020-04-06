<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = "districts";

    protected $fillable = [
        'name',
        'slug',
        'province_id',
    ];

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
