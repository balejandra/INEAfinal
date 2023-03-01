<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TipoZarpesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.tipo_zarpes')->insert([
            [
                'id'=>1,
                'nombre'=>'Navegación Deportiva',
                'created_at'=>now()
            ],
            [
                'id'=>2,
                'nombre'=>'Navegación Recreativa',
                'created_at'=>now()
            ],
        ]);


    }
}
