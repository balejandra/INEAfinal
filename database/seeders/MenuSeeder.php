<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menu = Menu::create([
            'name' => 'Menu',
            'url' => 'menus',
            'order' => '0',
            'parent' => '0',
            'icono'=>'icon-cursor',
        ]);

        $menuRols = [
            array('role_id' => '1', 'menu_id' => '1'),
        ];
        DB::table('menus_roles')->insert($menuRols);


    }
}
