<?php

namespace Database\Seeders;

use App\Models\Publico\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /////CONFIG/////////
        $menuConfig = Menu::create([
            'name' => 'Configuracion',
            'url' => 'home',
            'order' => '0',
            'parent' => '0',
            'icono'=>'fas fa-cog',
        ]);


        $menu2 = Menu::create([
            'name' => 'Menus',
            'url' => 'menus',
            'order' => '2',
            'parent' => $menuConfig['id'],
            'icono'=>'fas fa-bars',
        ]);


        $permiso = Menu::create([
            'name' => 'Permisos',
            'url' => 'permissions',
            'order' => '0',
            'parent' => $menuConfig['id'],
            'icono'=>'fa fa-address-card',
        ]);


        $roles = Menu::create([
            'name' => 'Roles',
            'url' => 'roles',
            'order' => '1',
            'parent' => $menuConfig['id'],
            'icono'=>'fa fa-id-badge',
        ]);


        $auditoria = Menu::create([
            'name' => 'Auditorias',
            'url' => 'auditables',
            'order' => '3',
            'parent' => $menuConfig['id'],
            'icono'=>'fas fa-history',
        ]);


        //Equipos
        $equipo = Menu::create([
            'name' => 'Equipos',
            'url' => 'equipos',
            'order' => '4',
            'parent' => $menuConfig['id'],
            'icono'=>'fas fa-shield-alt',
            'enabled'=>true
        ]);


        //Estatus
        $estatus = Menu::create([
            'name' => 'Estatus',
            'url' => 'status',
            'order' => '5',
            'parent' => $menuConfig['id'],
            'icono'=>'fa fa-clipboard-check fa-lg',
            'enabled'=>true
        ]);


        //Tabla de Mandos
        $tabla_mando = Menu::create([
            'name' => 'Tabla de Mandos',
            'url' => 'tablaMandos',
            'order' => '6',
            'parent' => $menuConfig['id'],
            'icono'=>'fas fa-table',
            'enabled'=>true
        ]);


        //Certificados Obligatorios
        $certificadoObligatorios = Menu::create([
            'name' => 'Certificados Obligatorios',
            'url' => 'certificadoObligatorios',
            'order' => '7',
            'parent' => $menuConfig['id'],
            'icono'=>'fas fa-certificate',
            'enabled'=>true
        ]);


        $menuRols = [
            array('role_id' => '1', 'menu_id' => $menuConfig['id']),
            array('role_id' => '1', 'menu_id' => $permiso['id']),
            array('role_id' => '1', 'menu_id' => $roles['id']),
            array('role_id' => '1', 'menu_id' => $menu2['id']),
            array('role_id' => '1', 'menu_id' => $auditoria['id']),
            array('role_id' => '1', 'menu_id' => $equipo['id']),
            array('role_id' => '1', 'menu_id' => $estatus['id']),
            array('role_id' => '1', 'menu_id' => $tabla_mando['id']),
            array('role_id' => '1', 'menu_id' => $certificadoObligatorios['id']),
        ];
        DB::table('menus_roles')->insert($menuRols);


/////PUBLICO///////
        $menuPublico = Menu::create([
            'name' => 'Publico',
            'url' => '/',
            'order' => '1',
            'parent' => '0',
            'icono'=>'fas fa-globe',
        ]);

        //Usuarios
        $user = Menu::create([
            'name' => 'Usuarios',
            'url' => 'users',
            'order' => '0',
            'parent' => $menuPublico['id'],
            'icono'=>'fa fa-user',
        ]);

        //Capitanías
        $capitania = Menu::create([
            'name' => 'Capitanias',
            'url' => 'capitanias',
            'order' => '1',
            'parent' => $menuPublico['id'],
            'icono'=>'fa fa-building',
        ]);

        //Establecimientos Náuticos
        $establecimientosNauticos = Menu::create([
            'name' => 'Establecimientos Náuticos',
            'url' => '/establecimientosNauticos',
            'order' => '2',
            'parent' => $menuPublico['id'],
            'icono'=>'fa fa-building',
        ]);

        //Dependencias Federales
        $dependenciasfederales = Menu::create([
            'name' => 'Dependencias Federales',
            'url' => 'dependenciasfederales',
            'order' => '3',
            'parent' => $menuPublico['id'],
            'icono'=>'fa fa-map',
        ]);

        $menuRols1 = [
            array('role_id' => '1', 'menu_id' => $menuPublico['id']),
            array('role_id' => '3', 'menu_id' => $menuPublico['id']),
            array('role_id' => '4', 'menu_id' => $menuPublico['id']),
            array('role_id' => '1', 'menu_id' => $user['id']),
            array('role_id' => '3', 'menu_id' => $user['id']),
            array('role_id' => '1', 'menu_id' => $capitania['id']),
            array('role_id' => '3', 'menu_id' => $capitania['id']),
            array('role_id' => '4', 'menu_id' => $capitania['id']),
            array('role_id' => '1', 'menu_id' => $establecimientosNauticos['id']),
            array('role_id' => '1', 'menu_id' => $dependenciasfederales['id']),
        ];
        DB::table('menus_roles')->insert($menuRols1);


        /////Permisos de Zarpes y Estadía///////
        $menuZarpes = Menu::create([
            'name' => 'Permisos de Zarpes y Estadía',
            'url' => '/',
            'order' => '2',
            'parent' => '0',
            'icono'=>'far fa-compass',
        ]);

        //Zarpe Nacional
        $permisoszarpes = Menu::create([
            'name' => 'Zarpe Nacional',
            'url' => '/zarpes/permisoszarpes',
            'order' => '0',
            'parent' => $menuZarpes['id'],
            'icono'=>'fas fa-ship',
        ]);

        //Permiso de Estadía
        $permisosestadia = Menu::create([
            'name' => 'Permiso de Estadía',
            'url' => 'permisosestadia',
            'order' => '1',
            'parent' => $menuZarpes['id'],
            'icono'=>'fas fa-anchor',
        ]);

        //Zarpe Internacional
        $zarpeInternacional = Menu::create([
            'name' => 'Zarpe Internacional',
            'url' => '/zarpes/zarpeInternacional',
            'order' => '2',
            'parent' => $menuZarpes['id'],
            'icono'=>'fas fa-ship',
        ]);

        $menuRols2 = [
            array('role_id' => '1', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '2', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '3', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '4', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '5', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '6', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '7', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '8', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '9', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '10', 'menu_id' => $menuZarpes['id']),
            array('role_id' => '11', 'menu_id' => $menuZarpes['id']),

            array('role_id' => '1', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '2', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '3', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '4', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '5', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '6', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '7', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '8', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '9', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '10', 'menu_id' => $permisoszarpes['id']),
            array('role_id' => '11', 'menu_id' => $permisoszarpes['id']),

            array('role_id' => '1', 'menu_id' => $permisosestadia['id']),
            array('role_id' => '3', 'menu_id' => $permisosestadia['id']),
            array('role_id' => '4', 'menu_id' => $permisosestadia['id']),
            array('role_id' => '7', 'menu_id' => $permisosestadia['id']),
            array('role_id' => '8', 'menu_id' => $permisosestadia['id']),
            array('role_id' => '10', 'menu_id' => $permisosestadia['id']),
            array('role_id' => '11', 'menu_id' => $permisosestadia['id']),

            array('role_id' => '1', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '2', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '3', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '4', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '5', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '6', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '7', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '8', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '9', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '10', 'menu_id' => $zarpeInternacional['id']),
            array('role_id' => '11', 'menu_id' => $zarpeInternacional['id']),
        ];
        DB::table('menus_roles')->insert($menuRols2);
    }
}
