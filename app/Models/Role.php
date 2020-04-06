<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "roles";

    protected $fillable = [
        'name',
        'slug'
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
