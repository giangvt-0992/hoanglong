<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // $admin = getAuthAdmin();
        //     $brand = $admin->brand;
        //     $notifications = $brand->unreadNotifications()->where('data->type', 'ticket')->get();
        //     echo('<pre>');
        //     print_r($notifications);
        //     echo('<pre>');
        //     exit();
        return view('admin.home.index');
    }
}
