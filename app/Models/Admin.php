<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admins";

    protected $fillable = [
        'name',
        'email',
        'password',
        'brand_id',
        'role_id',
        'parent_id',
    ];

    public function role()
    {
        //
        return $this->belongsTo(Role::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function isSuperAdmin()
    {
        return $this->role->slug === 'super-admin';
    }

    public function hasAccess($permissions) : bool
    {
        // check if the permission is available in any role
        $role = $this->role;
        foreach ($role->permissions as $permission) {
            if ($permission->slug == $permissions) {
                return true;
            }
        }
        return false;
    }
}
