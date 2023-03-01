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
            'Usuario Web',
            'Admin',
            'Capitán',
            'Comodoro Aprobador',
            'Comodoro',
            'Coordinador de Operaciones',
            'Agencia Naviera',
            'Jefe de Delegación',
            'Operaciones Capitanía',
            'Operaciones Sede Central'
        ];

        foreach($roles as $role){
            Role::create([
                    'name'=>$role
                ]);
        }
    }
}
