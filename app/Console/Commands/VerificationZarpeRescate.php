<?php

namespace App\Console\Commands;

use App\Http\Controllers\Zarpes\MailController;
use App\Models\Publico\CapitaniaUser;
use App\Models\User;
use App\Models\Zarpes\PermisoZarpe;
use App\Models\Zarpes\ZarpeRevision;
use Illuminate\Console\Command;

class VerificationZarpeRescate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification:zarperescate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificacion tiempos de zarpes mayor a 2 horas notificacion email para rescate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $zarpeVencido=PermisoZarpe::whereRaw('fecha_hora_regreso::TIMESTAMP + \'2 hr\'::INTERVAL <= now() and
                                                  fecha_hora_regreso::TIMESTAMP + \'3 hr\'::INTERVAL >= now()')
            ->where('status_id',5)
            ->get();

        foreach($zarpeVencido as $record){
            $userc=CapitaniaUser::where('capitania_id',$record->destino_capitania_id)->get();

            foreach($userc as $record2) {
                $userEmail = User::find($record2->user_id);
                $email = new MailController();
                $data = [
                    'codigo'=>$record->nro_solicitud,
                    'buque'=>$record->matricula,
                    'hora_llegada'=>$record->fecha_hora_regreso,
                ];
                $view = 'emails.zarpes.rescate';
                $subject = 'Notificacion de Rescate ' . $record->nro_solicitud;
                $email->mailZarpe($userEmail->email, $subject, $data, $view);
            }

                ZarpeRevision::insert([
                    'user_id' => 1,
                    'permiso_zarpe_id' => $record->id,
                    'accion'=>'Informado Rescate',
                    'motivo'=>'Pasada 2 de navegacion sin informar arribo'
                ]);
        }
    }
}
