<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = "admins";

    public function role()
    {
        //
        return $this->belongsTo(Role::class);
    }

    public function brand()
    {
        return $this->hasOne(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function isAdmin()
    {
        return $this->role_id === 'config.admin';
    }
}
