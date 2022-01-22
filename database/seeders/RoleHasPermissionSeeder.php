<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Admin
        $superadmin_permissions=Permission::all();
        Role::findOrFail(1)->permissions()->sync($superadmin_permissions->pluck('id'));

        //Usuario web
        /*
        $user_permissions=$superadmin_permissions->filter(function($permission){
            return substr($permission->name, -10) != '-capitania';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions->pluck('id'));
        */
        
         //Admin
        $admin_permissions=$superadmin_permissions->filter(function($permission){
            return substr($permission->name, -10) != '-usuario';
            return substr($permission->name, -10) != '-capitania';
            });
        Role::findOrFail(3)->permissions()->sync($admin_permissions->pluck('id'));

        //Capitan
        $capitan_permissions=$superadmin_permissions->filter(function($permission){
            return substr($permission->name, -10) != '-capitania';
            });
        Role::findOrFail(4)->permissions()->sync($capitan_permissions->pluck('id'));



    }
}
