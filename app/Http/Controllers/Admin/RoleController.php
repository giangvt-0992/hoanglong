<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\PermissionRepository;
use App\Contracts\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function create()
    {
        $this->authorize('role.create');
        $permissions = $this->permissionRepository->allByAdmin();
        return view('admin.role.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('role.create');

        $admin = getAuthAdmin();

        $role = $this->roleRepository->store([
            'name' => $request->name,
            'slug' => str_slug($request->name) . '-' . strtolower(str_random(2)),
            'brand_id' => $admin->brand_id
        ]);
        $role->permissions()->attach($request->permissions);
        return redirect()->route('admin.user.index', ['tab' => 'role'])->with('success', 'Thêm quyền thành công');
    }

    public function edit(Role $role)
    {
        $this->authorize('role.update', $role);
        $rolePermissions = $role->permissions()->pluck('id')->toArray();
        $permissions = $this->permissionRepository->allByAdmin();
        return view('admin.role.update', [
            'role' => $role,
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
        ]);
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->authorize('role.update', $role);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.user.index', ['tab' => 'role'])->with('success', 'Cập nhật quyền thành công');
    }

    public function destroy(Role $role)
    {
        $this->authorize('role.delete', $role);
        $checkAdmins = $role->admins()->count();
        if ($checkAdmins > 0) {
            return redirect()->route('admin.user.index', ['tab' => 'role'])->with('error', 'Xóa thất bại! Quyền này đã được gán cho người dùng');
        }

        $role->permissions()->detach();
        $role->delete();
        return redirect()->route('admin.user.index', ['tab' => 'role'])->with('success', 'Xóa quyền thành công');
    }
}
