<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusEstadiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.status_permiso_estadias')->insert([
            [
                'id'=>1,
                'nombre'=>'Activa',
                'created_at'=>now()
            ],
            [
                'id'=>2,
                'nombre'=>'Visita asignada',
                'created_at'=>now()
            ],
            [
                'id'=>3,
                'nombre'=>'Visita aprobada, recaudos faltantes',
                'created_at'=>now()
            ],
            [
                'id'=>4,
                'nombre'=>'Aprobada',
                'created_at'=>now()
            ],
            [
                'id'=>5,
                'nombre'=>'Rechazada',
                'created_at'=>now()
            ],
            [
                'id'=>6,
                'nombre'=>'Anulada por Usuario',
                'created_at'=>now()
            ],
        ]);
    }
}
