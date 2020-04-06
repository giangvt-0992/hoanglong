<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    protected $table = "social_users";

    protected $fillable = [
        'socialable_type',
        'socialable_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
