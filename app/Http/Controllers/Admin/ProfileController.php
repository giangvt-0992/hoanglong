<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository) {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $admin = getAuthAdmin();
        return view('admin.profile.index', [
            'admin'=> $admin
        ]);
    }

    public function update(ProfileRequest $request)
    {
        try {
            $data = $request->only(['name']);

            $this->adminRepository->update(getAuthAdmin()->id, $data);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('fail', 'Cập nhật tài khoản thất bại');
        }

        return redirect()->route('admin.index')->with('success', 'Cập nhật tài khoản thành công');
    }

    public function getChangePasswordForm()
    {
        return view('admin.profile.change_password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $admin = getAuthAdmin();
        if (!Hash::check($request->old_password, $admin->password)) {
            return redirect()->back()->with('error', 'Mật khẩu cũ không chính xác.');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        auth()->logout();
        return redirect()->route('admin.login')->with('success', 'Đổi mật khẩu thành công. Vui lòng đăng nhập lại với mật khẩu mới');
        // echo 'a';
    }
}
