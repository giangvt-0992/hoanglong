<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";

    protected $fillable = [
        'url',
        'admin_id',
        'title'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function brands()
    {
        return $this->morphedByMany(Brand::class, 'imageable');
    }
}
