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
        $menuConfig = Menu::create([
            'name' => 'Configuracion',
            'url' => 'home',
            'order' => '0',
            'parent' => '0',
            'icono'=>'icon-settings',
        ]);

        $menuRols = [
            array('role_id' => '1', 'menu_id' => $menuConfig['id']),
        ];
        DB::table('menus_roles')->insert($menuRols);

        $menuPublico = Menu::create([
            'name' => 'Publico',
            'url' => 'home',
            'order' => '1',
            'parent' => '0',
            'icono'=>'icon-globe',
        ]);

        $menuRols1 = [
            array('role_id' => '1', 'menu_id' => $menuPublico['id']),
        ];
        DB::table('menus_roles')->insert($menuRols1);

        $menu1 = Menu::create([
            'name' => 'Usuarios',
            'url' => 'users',
            'order' => '0',
            'parent' => $menuPublico['id'],
            'icono'=>'icon-user',
        ]);

        $menuRols2 = [
            array('role_id' => '1', 'menu_id' => $menu1['id']),
        ];
        DB::table('menus_roles')->insert($menuRols2);

        $menu2 = Menu::create([
            'name' => 'Menus',
            'url' => 'menus',
            'order' => '0',
            'parent' => $menuConfig['id'],
            'icono'=>'icon-menu',
        ]);

        $menuRols3 = [
            array('role_id' => '1', 'menu_id' => $menu2['id']),
        ];
        DB::table('menus_roles')->insert($menuRols3);


    }
}
