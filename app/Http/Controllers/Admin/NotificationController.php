<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function markAsReadAll()
    {
        $admin = getAuthAdmin();
        $admin->brand->unreadNotifications->markAsRead();
        return response()->json([
            'status' => 200
        ]);
    }
}
