<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Admin;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPassword as NotificationsResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    protected $userRepository;
    
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function sendMail(Request $request)
    {
        $user = Admin::where('email', $request->email)->firstOrFail();
        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email
        ], [
            'token' => Str::random(60),
        ]);

        if ($passwordReset) {
            $user->notify(new NotificationsResetPassword($passwordReset->token));
        }
  
        return view('admin.abort.index', [
            'code' => '',
            'msg' => 'Vui lòng click vào link được gửi vào email của bạn!'
        ]);
    }

    public function showResetForm(Request $request)
    {
        $token = $request->input('token');
        
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            
            return view('admin.abort', [
                'code' => 419,
                'msg' => 'Phiên làm việc đã hết hạn.'
            ]);
        }
        return view('admin.auth.change-password', [
            'token' => $token
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $token = $request->token;
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return view('admin.abort', [
                'code' => 419,
                'msg' => 'Phiên làm việc đã hết hạn.'
            ]);
        }
        $user = Admin::where('email', $passwordReset->email)->firstOrFail();
        $user->update(['password' => Hash::make($request->password)]);
        $passwordReset->delete();

        return redirect()->route('admin.login')->with('success', 'Cập nhật mật khẩu thành công thành công');
    }
}
