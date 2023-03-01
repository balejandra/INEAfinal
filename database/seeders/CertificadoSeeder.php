<?php

namespace Database\Seeders;

use App\Models\Zarpes\Equipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.certificados_obligatorios')->insert([
            [
                'id'=>1,
                'parametro_embarcacion'=>'UAB',
                'cantidad_comparacion'=>5,
                'nombre_certificado'=>'ASIGNACIÓN DE NÚMERO ISMM',
                'created_at'=>now()
            ],
            [
                'id'=>2,
                'parametro_embarcacion'=>'eslora',
                'cantidad_comparacion'=>10,
                'nombre_certificado'=>'ASIGNACIÓN DE NÚMERO ISMM',
                'created_at'=>now()
            ],

        ]);

    }
}
