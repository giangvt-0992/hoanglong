<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Config::get('permissions');
        $admin = Role::whereSlug('admin')->first();
        $superAdmin = Role::whereSlug('super-admin')->first();

        $arrayPermission = [];
        foreach ($permissions as $p) {
            $permission = [
                'name' => $p['title'],
                'slug' => $p['slug'],
            ];
            $arrayPermission[] = $permission;
        }

        DB::table('permissions')->insert($arrayPermission);

        if ($admin) {
            $arrayPerId = Permission::whereNotIn(
                'slug', [
                    'xem-hang-xe',
                    'them-hang-xe',
                    'sua-hang-xe',
                    'xoa-hang-xe',
                    ]
            )->pluck('id')->toArray();
            $admin->permissions()->attach($arrayPerId);
        }

        if ($superAdmin) {
            $superAdminPermisionId = Permission::whereIn(
                'slug', [
                    'xem-nguoi-dung',
                    'them-nguoi-dung',
                    'sua-nguoi-dung',
                    'xoa-nguoi-dung',
                    'xem-quyen',
                    'them-quyen',
                    'sua-quyen',
                    'xoa-quyen',
                    'xem-hang-xe',
                    'them-hang-xe',
                    'sua-hang-xe',
                    'xoa-hang-xe',
                    'xem-tinh',
                    'sua-tinh',
                    'xoa-tinh',
                    'them-tinh',
                    'xem-khu-vuc',
                    'them-khu-vuc',
                    'sua-khu-vuc',
                    'xoa-khu-vuc',
                    ]
            )->pluck('id')->toArray();
            $superAdmin->permissions()->attach($superAdminPermisionId);
        }
    }
}
