<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class seederRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles=[
            'Super Admin',
            'Usuario web',
            'Admin',
            'Capitán',
            'comodoro_aprobador',
            'Comodoro',
            'Coordinador de operaciones',
            'Agencia naviera'
        ];

        foreach($roles as $role){
            Role::create([
                    'name'=>$role
                ]);
        }
    }
}
