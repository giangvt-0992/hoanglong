<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";

    public function getDataAttribute()
    {
        $data = json_decode($this->data);
        return $data;

    }
}
