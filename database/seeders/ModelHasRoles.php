<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModelHasRoles extends Seeder
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

        $user_permissions=Permission::whereIn('name', [
            'consultar-zarpe',
            'informar-arribo',
            'informar-navegacion',
            'anular-zarpeUsuario',
            'listar-zarpesgenerados',
            'listar-notificaciones',
            'consultar-notificaciones',
            ])->get();
        Role::findOrFail(2)->permissions()->sync($user_permissions->pluck('id'));


         //Admin
        $admin_permissions=$superadmin_permissions->filter(function($permission){
            $name=explode('-', $permission->name);
            if($name[1] == 'usuario' ||  $name[1] == 'capitania'){
                return $permission->name;
            }
        });
        Role::findOrFail(3)->permissions()->sync($admin_permissions->pluck('id'));

        //Capitan
        $capitan_permissions= Permission::whereIn('name', [
            'listar-capitania',
            'consultar-capitania',
            'eliminar-capitania',
            'editar-capitania',
            'crear-capitania',

            'eliminar-usuarios-capitanias',
            'consultar-usuarios-capitanias',
            'editar-usuarios-capitanias',
            'crear-usuarios-capitanias',
            'listar-usuarios-capitanias',

            'consultar-zarpe',
            'aprobar-zarpe',
            'rechazar-zarpe',
            'anular-sar',
            'listar-zarpes-capitania-origen',
            'listar-zarpes-destino',
            'informar-navegacion',

            'asignar-visita-estadia',
            'rechazar-estadia',
            'aprobar-estadia',
            'consultar-estadia',
            'listar-estadia-capitania-destino',
            'visita-estadia-aprobada',

            'consultar-notificaciones',
            'listar-notificaciones',

     ])->get();
        Role::findOrFail(4)->permissions()->sync($capitan_permissions->pluck('id'));

        //comodoro_aprobador
        $comodoro_aprobador_permissions=Permission::whereIn('name', [
            'consultar-zarpe',
            'listar-zarpes-destino',
            'aprobar-zarpe',
            'rechazar-zarpe',
            'informar-navegacion',
            'anular-sar',
            'listar-zarpes-establecimiento-origen',
            'consultar-notificaciones',
            'listar-notificaciones',
            ])->get();
        Role::findOrFail(5)->permissions()->sync($comodoro_aprobador_permissions->pluck('id'));

        //comodoro
        $comodoro_permissions=Permission::whereIn('name', [
            'consultar-zarpe',
            'informar-navegacion',
            'anular-sar',
            'listar-zarpes-establecimiento-origen',
            'listar-zarpes-destino',
            'consultar-notificaciones',
            'listar-notificaciones',
            ])->get();
        Role::findOrFail(6)->permissions()->sync($comodoro_permissions->pluck('id'));

        //Coordinador de Operaciones
        $coordinador_permissions=Permission::whereIn('name', [
            'listar-zarpes-capitania-origen',
            'informar-navegacion','rechazar-zarpe',
            'informar-arribo',
            'aprobar-zarpe',
            'consultar-zarpe',
            'listar-zarpes-destino',
            'asignar-visita-estadia',
            'visita-estadia-aprobada',
            'consultar-estadia',
            'rechazar-estadia',
            'listar-estadia-coordinador',
            'consultar-notificaciones',
            'listar-notificaciones',
            ])->get();
        Role::findOrFail(7)->permissions()->sync($coordinador_permissions->pluck('id'));


        //agencia naviera
        $agencia_naviera=Permission::whereIn('name', [
            'consultar-zarpe',
            'informar-arribo',
            'informar-navegacion',
            'anular-zarpeUsuario',
            'listar-zarpes-generados',
            'crear-estadia',
            'recaudos-estadia',
            'listar-estadia-generados',
            'anular-estadia',
            'consultar-estadia',
            'renovar-estadia',
            'consultar-notificaciones',
            'listar-notificaciones'

        ])->get();
        Role::findOrFail(8)->permissions()->sync($agencia_naviera->pluck('id'));

        //Jefe de Delegación
        $jefe_delegacion=Permission::whereIn('name', [
            'consultar-zarpe',
            'aprobar-zarpe',
            'rechazar-zarpe',
            'listar-zarpes-capitania-origen',
            'listar-zarpes-destino',
            'listar-establecimientoNautico',
            'consultar-notificaciones',
            'listar-notificaciones'

        ])->get();
        Role::findOrFail(9)->permissions()->sync($jefe_delegacion->pluck('id'));

        //Operaciones Capitanía
        $operaciones_capitania=Permission::whereIn('name', [
            'consultar-zarpe',
            'listar-estadia-capitania-destino',
            'consultar-estadia',
            'listar-zarpes-capitania-origen',
            'listar-zarpes-destino',
            'consultar-notificaciones',
            'listar-notificaciones'

        ])->get();
        Role::findOrFail(10)->permissions()->sync($operaciones_capitania->pluck('id'));

        //Operaciones Sede Central
        $operaciones_sedecentral=Permission::whereIn('name', [
            'consultar-zarpe',
            'listar-zarpes-todos',
            'listar-estadia-todos',
            'consultar-estadia',
            'consultar-notificaciones',
            'listar-notificaciones'

        ])->get();
        Role::findOrFail(11)->permissions()->sync($operaciones_sedecentral->pluck('id'));

    }
}
