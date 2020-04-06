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
        $superadmin = Role::whereSlug('super-admin')->first();

        $arrayPermission = [];
        foreach ($permissions as $key => $value) {
            $permission = [
                'name' => $key,
                'slug' => $value,
            ];
            $arrayPermission[] = $permission;
        }

        DB::table('permissions')->insert($arrayPermission);

        if ($superadmin) {
            $arrayPerId = Permission::all()->pluck('id')->toArray();
            $superadmin->permissions()->attach($arrayPerId);
        }
    }
}
