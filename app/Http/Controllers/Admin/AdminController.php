<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\AdminRepository;
use App\Contracts\Repositories\PermissionRepository;
use App\Contracts\Repositories\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $adminRepository;
    protected $permissionRepository;
    protected $roleRepository;

    public function __construct(
        AdminRepository $adminRepository,
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository
    ) {
        $this->adminRepository = $adminRepository;
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $permissions = $this->permissionRepository->all();
        $roles = $this->roleRepository->all();
        return view('admin.user.index', [
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }
}
