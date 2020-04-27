<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $redirectTo = '/admin';
    public function showLoginForm()
    {
        if (auth('admin')->check()) {
            return redirect($this->redirectTo);
        }
        return view('admin.auth.login');
    }

    public function logout()
    {
        if (auth('admin')->check()) {
            auth('admin')->logout();
        }
        return redirect()->route('admin.login');
    }

    public function login(Request $request)
    {
        $remember = isset(request()->remember_me) ? true : false;
        $credential = $request->only(['email', 'password']);
        $credential['is_active'] = true;
        if (Auth::guard('admin')->attempt($credential, $remember)) {
            return redirect($this->redirectTo);
        }
        return redirect()->back()->with('status', 'Tên đăng nhập hoặc mật khẩu không đúng!')->withInput();
    }
}
