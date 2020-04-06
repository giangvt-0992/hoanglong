<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";

    protected $fillable = [
        'name',
        'slug'
    ];

    public function roles()
    {
        // n - n
        return $this->belongsToMany(Role::class);
    }
}
