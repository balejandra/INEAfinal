<?php

namespace Database\Seeders;

use App\Models\Zarpes\Equipo;
use Illuminate\Database\Seeder;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipos =
            [
                'CHALECOS SALVAVIDAS',
                'SEÑALES PIROTÉCNICAS',
                'EQUIPO PARTÁTIL CONTRA INCENDIO',
                'EQUIPO FIJO CONTRA INCENDIO',
                'KIT DE PRIMEROS AUXILIOS',
                'COMPAS MAGNÉTICO',
                'GPS',
                'RADIOBALIZA DE SINIESTRO (EPIRB)',
                'RADAR',
                'AIS DEBIDAMENTE CONFIGURADO',
                'VHF FIJO',
                'VHF PORTÁTIL',
                'BALSA SALVAVIDAS',
                'CAJA DE HERRAMIENTAS:',
                'SPOT',
            ];
        foreach ($equipos as $equipo) {
            Equipo::create([
                'equipo'=>$equipo,
                'created_at'=>now()
            ]);
        }
    }
}
