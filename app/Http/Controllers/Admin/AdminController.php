<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\AdminRepository;
use App\Contracts\Repositories\BrandRepository;
use App\Contracts\Repositories\PermissionRepository;
use App\Contracts\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminRepository;
    protected $permissionRepository;
    protected $roleRepository;
    protected $brandRepository;

    public function __construct(
        AdminRepository $adminRepository,
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository,
        BrandRepository $brandRepository
    ) {
        $this->adminRepository = $adminRepository;
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        $this->authorize('admin.viewAny');

        $admin = getAuthAdmin();
        if ($admin->isSuperAdmin()) {
            $permissions = $this->permissionRepository->all();
        } else {
            $permissions = $admin->role->permissions;
        }
        $roles = $this->roleRepository->all();
        $admins = $this->adminRepository->all();
        return view('admin.user.index', [
            'permissions' => $permissions,
            'roles' => $roles,
            'admins' => $admins
        ]);
    }

    public function create()
    {
        $this->authorize('admin.create');

        $admin = getAuthAdmin();
        if ($admin->isSuperAdmin()) {
            $brands = $this->brandRepository->all();
        } else {
            $brands = [$admin->brand];
        }
        $roles = $this->roleRepository->all();
        return view('admin.user.create', [
            'brands' => $brands,
            'roles' => $roles
        ]);
    }

    public function store(AdminRequest $request)
    {
        $this->authorize('admin.create');

        $checkRoleIsSuperAdmin = $this->roleRepository->findOrFail($request->roleId);
        if ($checkRoleIsSuperAdmin->slug === config('constants.SUPER_ADMIN')) {
            return redirect()->back()->with('error', 'Không thể tạo super admin')->withInput();
        }
        try {
            $this->adminRepository->store([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'brand_id' => $request->brandId,
                'role_id' => $request->roleId,
                'name' => $request->name,
                'parent_id' => auth('admin')->user()->id
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Thêm người dùng không thành công')->withInput();
        }
        
        return redirect()->route('admin.user.index', ['tab' => 'user'])->with('success', 'Thêm người dùng thành công');
    }

    public function edit(Admin $admin)
    {
        $this->authorize('admin.update', $admin);

        return view('admin.user.update', [
            'admin' => $admin
        ]);
    }

    public function destroy(Admin $admin)
    {
        $this->authorize('admin.delete', $admin);
        $admin->delete();
        return redirect()->route('admin.user.index', ['tab' => 'user'])->with('success', 'Xóa người dùng thành công');
    }

    public function active(Admin $admin)
    {
        $this->authorize('admin.delete', $admin);
        $admin->is_active = config('constants.IS_ACTIVE_STATUS.ACTIVE');
        $admin->save();

        return redirect()->route('admin.user.index', ['tab' => 'user'])->with('success', 'Kích hoạt người dùng thành công');
    }

    public function deactivate(Admin $admin)
    {
        $this->authorize('admin.delete', $admin);
        $admin->is_active = config('constants.IS_ACTIVE_STATUS.DEACTIVATE');;
        $admin->save();

        return redirect()->route('admin.user.index', ['tab' => 'user'])->with('success', 'Ngưng kích hoạt người dùng thành công');
    }
}
