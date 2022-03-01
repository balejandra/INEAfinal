<?php

namespace Database\Seeders;

use App\Models\Zarpes\Equipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.equipos')->insert([
                [
                    'equipo'=>'CHALECOS SALVAVIDAS',
                    'cantidad'=>true,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'SEÑALES PIROTÉCNICAS',
                    'cantidad'=>true,
                    'otros'=>'colores',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'EQUIPO PORTÁTIL CONTRA INCENDIOS',
                    'cantidad'=>true,
                    'otros'=>'fecha_ultima_inspeccion',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'EQUIPO FIJO CONTRA INCENDIO',
                    'cantidad'=>false,
                    'otros'=>'fecha_ultima_inspeccion',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'KIT DE PRIMEROS AUXILIOS',
                    'cantidad'=>false,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'COMPAS MAGNÉTICO',
                    'cantidad'=>false,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'GPS',
                    'cantidad'=>false,
                    'otros'=>'tipo',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'RADIOBALIZA DE SINIESTRO (EPIRB)',
                    'cantidad'=>false,
                    'otros'=>'fecha_ultima_inspeccion',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'RADAR',
                    'cantidad'=>false,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'AIS DEBIDAMENTE CONFIGURADO',
                    'cantidad'=>false,
                    'otros'=>'MMSI',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'VHF FIJO',
                    'cantidad'=>false,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'VHF PORTÁTIL',
                    'cantidad'=>true,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'BALSA SALVAVIDAS',
                    'cantidad'=>true,
                    'otros'=>'tipo',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'CAJA DE HERRAMIENTAS',
                    'cantidad'=>false,
                    'otros'=>'ninguno',
                    'created_at'=>now()
                ],
                [
                    'equipo'=>'SPOT',
                    'cantidad'=>false,
                    'otros'=>'tipo',
                    'created_at'=>now()
                ]

            ]);

        }
}
