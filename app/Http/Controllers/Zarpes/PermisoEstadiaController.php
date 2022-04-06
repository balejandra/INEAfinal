<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Zarpes\CreatePermisoEstadiaRequest;
use App\Models\Publico\Capitania;
use App\Models\Publico\CapitaniaUser;
use App\Models\User;
use App\Models\Zarpes\DocumentoPermisoEstadia;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\EstadiaRevision;
use App\Models\Zarpes\PermisoEstadia;
use App\Models\Zarpes\Status;
use App\Models\Zarpes\VisitaPermisoEstadia;
use App\Repositories\Zarpes\PermisoEstadiaRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class PermisoEstadiaController extends AppBaseController
{
    /** @var  PermisoEstadiaRepository */
    private $permisoEstadiaRepository;

    public function __construct(PermisoEstadiaRepository $permisoEstadiaRepo)
    {
        $this->permisoEstadiaRepository = $permisoEstadiaRepo;
    }

    /**
     * Display a listing of the PermisoEstadia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->id();
        if (auth()->user()->hasPermissionTo('listar-estadia-todos')) {
            $permisoEstadias = $this->permisoEstadiaRepository->all();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
        } else if (auth()->user()->hasPermissionTo('listar-estadia-generados')) {
            $permisoEstadias = PermisoEstadia::where('user_id', $user)->get();

            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
        } else if (auth()->user()->hasPermissionTo('listar-estadia-coordinador')) {
            $coordinador = CapitaniaUser::select('capitania_id')->where('user_id', $user)->get();
            $permisoEstadias = PermisoEstadia::whereIn('capitania_id', $coordinador)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
        } else if (auth()->user()->hasPermissionTo('listar-estadia-capitania-destino')) {
            $capitania = CapitaniaUser::select('capitania_id')->where('user_id', $user)->get();
            $permisoEstadias = PermisoEstadia::whereIn('capitania_id', $capitania)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for creating a new PermisoEstadia.
     *
     * @return Response
     */
    public function create()
    {
        $Establecimientos = EstablecimientoNautico::all();
        $capitanias = Capitania::all();
        return view('zarpes.permiso_estadias.create')
            ->with('establecimientos', $Establecimientos)
            ->with('capitanias', $capitanias);
    }

    /**
     * Store a newly created PermisoEstadia in storage.
     *
     * @param CreatePermisoEstadiaRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'nombre_buque' => ['required', 'string', 'max:255'],
            'nro_registro' => ['required', 'string', 'max:255'],
            'tipo_buque' => ['required', 'string', 'max:255'],
            'nacionalidad_buque' => ['required', 'string', 'max:255'],
            'nombre_propietario' => ['required', 'string', 'max:255'],
            'pasaporte_capitan' => ['required', 'string', 'max:255'],
            'nombre_capitan' => ['required', 'string', 'max:255'],
            'cant_tripulantes' => ['required', 'integer', 'max:255'],
            'cant_pasajeros' => ['required', 'integer', 'max:255'],
            'arqueo_bruto' => ['required', 'string', 'max:255'],
            'eslora' => ['required', 'string', 'max:255'],
            'potencia_kw' => ['required', 'string', 'max:255'],
            'actividades' => ['required', 'string', 'max:255'],
            'puerto_origen' => ['required', 'string', 'max:255'],
            'capitania_id' => ['required', 'string', 'max:255'],
            'tiempo_estadia' => ['required', 'string', 'max:255'],
            [
                'capitania_id.required'=>'El campo Circunscripcion Acuatica es requerido',]

            ]);

        $matriculaexis=PermisoEstadia::where('nro_registro',$request->nro_registro)
            ->where('status_id',1)
            ->first();
        if ($matriculaexis) {
            Flash::error('Este Nro de Registro del Buque ya tiene una solicitud aprobada.');

            return redirect()->back();
        }else {

            $estadia = new PermisoEstadia();
            $estadia->nro_solicitud = $this->codigo($request->capitania_id);
            $estadia->cantidad_solicitud = '1';
            $estadia->user_id = auth()->user()->id;
            $estadia->nombre_buque = $request->nombre_buque;
            $estadia->nro_registro = $request->nro_registro;
            $estadia->tipo_buque = $request->tipo_buque;
            $estadia->nacionalidad_buque = $request->nacionalidad_buque;
            $estadia->nombre_propietario = $request->nombre_propietario;
            $estadia->pasaporte_capitan = $request->pasaporte_capitan;
            $estadia->nombre_capitan = $request->nombre_capitan;
            $estadia->cant_tripulantes = $request->cant_tripulantes;
            $estadia->cant_pasajeros = $request->cant_pasajeros;
            $estadia->arqueo_bruto = $request->arqueo_bruto;
            $estadia->eslora = $request->eslora;
            $estadia->potencia_kw = $request->potencia_kw;
            $estadia->actividades = $request->actividades;
            $estadia->puerto_origen = $request->puerto_origen;
            $estadia->capitania_id = $request->capitania_id;
            $estadia->tiempo_estadia = $request->tiempo_estadia;
            $estadia->status_id = 3;
            $estadia->save();


            if ($request->hasFile('zarpe_procedencia')) {
                $documento1 = new DocumentoPermisoEstadia();
                $procedencia = $request->file('zarpe_procedencia');
                $filenamepro = date('dmYGi') . $procedencia->getClientOriginalName();
                $avatar1 = $procedencia->move(public_path() . '/permisoestadia/documentos', $filenamepro);
                $documento1->permiso_estadia_id = $estadia->id;
                $documento1->documento = $filenamepro;
                $documento1->recaudo = 'Zarpe de Procedencia';
                $documento1->save();
            }
            if ($request->hasFile('registro_embarcacion')) {
                $documento2 = new DocumentoPermisoEstadia();
                $registro = $request->file('registro_embarcacion');
                $filenamereg = date('dmYGi') . $registro->getClientOriginalName();
                $avatar2 = $registro->move(public_path() . '/permisoestadia/documentos', $filenamereg);
                $documento2->permiso_estadia_id = $estadia->id;
                $documento2->documento = $filenamereg;
                $documento2->recaudo = 'Registro de Embarcacion';
                $documento2->save();
            }
            if ($request->hasFile('despacho_aduana_procedencia')) {
                $documento3 = new DocumentoPermisoEstadia();
                $migracion = $request->file('despacho_aduana_procedencia');
                $filenamemig = date('dmYGi') . $migracion->getClientOriginalName();
                $avatar3 = $migracion->move(public_path() . '/permisoestadia/documentos', $filenamemig);
                $documento3->permiso_estadia_id = $estadia->id;
                $documento3->documento = $filenamemig;
                $documento3->recaudo = 'Despacho de Aduana de Procedencia';
                $documento3->save();
            }
            if ($request->hasFile('pasaportes_tripulantes')) {
                $documento4 = new DocumentoPermisoEstadia();
                $pasaportes = $request->file('pasaportes_tripulantes');
                $filenamepas = date('dmYGi') . $pasaportes->getClientOriginalName();
                $avatar4 = $pasaportes->move(public_path() . '/permisoestadia/documentos', $filenamepas);
                $documento4->permiso_estadia_id = $estadia->id;
                $documento4->documento = $filenamepas;
                $documento4->recaudo = 'Pasaportes de Tripulantes';
                $documento4->save();
            }

            $this->SendMail($estadia->id, 1);
            $this->SendMail($estadia->id, 0);
            Flash::success('Solicitud de Permiso Estadia guardada satisfactoriamente.');

            return redirect(route('permisosestadia.index'));
        }
    }

    private function codigo($capitania_id)
    {
        $cantidadActual = PermisoEstadia::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where('cantidad_solicitud',1)
            ->where(DB::raw("(SUBSTR(nro_solicitud,6,4) = '" . date('Y') . "')"), '=', true)
            ->get();

        $capitania = Capitania::find($capitania_id);

        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" . date('Y') . date('m') . "-" . $correlativo;
       // dd($codigo);
        return $codigo;
    }

    /**
     * Display the specified PermisoEstadia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);
        $documentos = DocumentoPermisoEstadia::where('permiso_estadia_id', $id)->get();
        $revisiones=EstadiaRevision::where('permiso_estadia_id',$id)->get();
        $visita=VisitaPermisoEstadia::where('permiso_estadia_id',$id)->get();
        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        return view('zarpes.permiso_estadias.show')
            ->with('permisoEstadia', $permisoEstadia)
            ->with('documentos', $documentos)
            ->with('revisiones',$revisiones)
            ->with('visitas',$visita);
    }

    /**
     * Show the form for editing the specified PermisoEstadia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);
        $documentos = DocumentoPermisoEstadia::where('permiso_estadia_id', $id)->get();
        $capitanias = Capitania::all();
        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        return view('zarpes.permiso_estadias.edit')
            ->with('permisoEstadia', $permisoEstadia)
            ->with('documentos',$documentos)
            ->with('capitanias',$capitanias);
    }

    /**
     * Update the specified PermisoEstadia in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);

        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia no encontrado');

            return redirect(route('permisoEstadias.index'));
        }

        if ($request->hasFile('permiso_seniat')) {
            $documento1 = new DocumentoPermisoEstadia();
            $seniat = $request->file('permiso_seniat');
            $filenamesen = date('dmYGi') . $seniat->getClientOriginalName();
            $avatar1 = $seniat->move(public_path() . '/permisoestadia/documentos', $filenamesen);
            $documento1->permiso_estadia_id = $id;
            $documento1->documento = $filenamesen;
            $documento1->recaudo = 'Permiso de Admisión Temporal emitida por el SENIAT';
            $documento1->save();
        }
        if ($request->hasFile('comprobante_alicuota')) {
            $documento2 = new DocumentoPermisoEstadia();
            $alicuota = $request->file('comprobante_alicuota');
            $filenamealic = date('dmYGi') . $alicuota->getClientOriginalName();
            $avatar2 = $alicuota->move(public_path() . '/permisoestadia/documentos', $filenamealic);
            $documento2->permiso_estadia_id = $id;
            $documento2->documento = $filenamealic;
            $documento2->recaudo = 'Comprobante de pago de Alícuota';
            $documento2->save();
        }
        if ($request->hasFile('inspeccion_visita')) {
            $documento3 = new DocumentoPermisoEstadia();
            $inspeccion = $request->file('inspeccion_visita');
            $filenameinsp = date('dmYGi') . $inspeccion->getClientOriginalName();
            $avatar3 = $inspeccion->move(public_path() . '/permisoestadia/documentos', $filenameinsp);
            $documento3->permiso_estadia_id = $id;
            $documento3->documento = $filenameinsp;
            $documento3->recaudo = 'Inspección por el Visitador';
            $documento3->save();
        }
        if ($request->hasFile('comprobante_saime')) {
            $documento4 = new DocumentoPermisoEstadia();
            $saime = $request->file('comprobante_saime');
            $filenamesai = date('dmYGi') . $saime->getClientOriginalName();
            $avatar4 = $saime->move(public_path() . '/permisoestadia/documentos', $filenamesai);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenamesai;
            $documento4->recaudo = 'Comprobante de visita SAIME';
            $documento4->save();
        }
        if ($request->hasFile('comprobante_insai')) {
            $documento4 = new DocumentoPermisoEstadia();
            $insai = $request->file('comprobante_insai');
            $filenameins = date('dmYGi') . $insai->getClientOriginalName();
            $avatar4 = $insai->move(public_path() . '/permisoestadia/documentos', $filenameins);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenameins;
            $documento4->recaudo = 'Comprobante de visita INSAI';
            $documento4->save();
        }
        if ($request->hasFile('pago_permisoEstadia')) {
            $documento4 = new DocumentoPermisoEstadia();
            $pestadia = $request->file('pago_permisoEstadia');
            $filenameest = date('dmYGi') . $pestadia->getClientOriginalName();
            $avatar4 = $pestadia->move(public_path() . '/permisoestadia/documentos', $filenameest);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenameest;
            $documento4->recaudo = 'Pago del Permiso Especial de Estadía';
            $documento4->save();
        }
        if ($request->hasFile('comprobante_ochina')) {
            $documento4 = new DocumentoPermisoEstadia();
            $ochina = $request->file('comprobante_ochina');
            $filenameoch = date('dmYGi') . $ochina->getClientOriginalName();
            $avatar4 = $ochina->move(public_path() . '/permisoestadia/documentos', $filenameoch);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenameoch;
            $documento4->recaudo = 'Comprobante de pago a OCHINA';
            $documento4->save();
        }
        $estadia= PermisoEstadia::find($id);
        $idstatus = Status::find(11);
        $estadia->status_id = $idstatus->id;
        $estadia->update();

        EstadiaRevision::create([
            'user_id' => auth()->user()->id,
            'permiso_estadia_id' => $id,
            'accion' => $idstatus->nombre,
            'motivo' => 'Pendiente para aprobacion'
        ]);

        Flash::success('Permiso Estadia actualizado satisfactoriamente.');

        return redirect(route('permisosestadia.index'));
    }

    public function updateStatus($id, $status)
    {
        $email = new MailController();
           if ($status=== "9") {
               $visitador = $_GET['visitador'];
               $fecha_visita = $_GET['fecha_visita'];

               $estadia= PermisoEstadia::find($id);
               $idstatus = Status::find(9);
               $solicitante = User::find($estadia->user_id);
               $estadia->status_id = $idstatus->id;
               $estadia->update();

               EstadiaRevision::create([
                   'user_id' => auth()->user()->id,
                   'permiso_estadia_id' => $id,
                   'accion' => $idstatus->nombre,
                   'motivo' => 'Visitador asignado'
               ]);

               VisitaPermisoEstadia::create([
                   'permiso_estadia_id' => $id,
                   'nombre_visitador' => $visitador,
                   'fecha_visita' => $fecha_visita,
               ]);
               $data = [
                   'solicitud' => $estadia->nro_solicitud,
                   'id'=>$id,
                   'nombres_solic' => $solicitante->nombres,
                   'apellidos_solic' => $solicitante->apellidos,
                   'matricula' => $estadia->nro_registro,
                   'visitador' => $visitador,
                   'fecha_visita'=>$fecha_visita,
               ];
               $view = 'emails.estadias.visita';
               $subject = 'Solicitud de Estadia ' . $estadia->nro_solicitud;
               $email->mailZarpe($solicitante->email, $subject, $data, $view);

               Flash::success('Visitador asignado y notificacion enviada al solicitante.');
               return redirect(route('permisosestadia.index'));
           } if ($status==='10') {
                $estadia= PermisoEstadia::find($id);
                $idstatus = Status::find(10);
                $estadia->status_id = $idstatus->id;
                $estadia->update();

                EstadiaRevision::create([
                    'user_id' => auth()->user()->id,
                    'permiso_estadia_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => 'Visita aprobada, por favor suba los recaudos faltantes'
                ]);
                Flash::success('Visita aprobada.');
                return redirect(route('permisosestadia.index'));
           } if ($status==='1') {

                $estadia= PermisoEstadia::find($id);
                if ($estadia->cantidad_solicitud>1) {
                   // dd($estadia->cantidad_solicitud);
                    $ant=($estadia->cantidad_solicitud-1);
                    $nro=substr($estadia->nro_solicitud,0,13);
                    //dd($nro);
                    $status = Status::find(12);
                    $anterior=PermisoEstadia::where('cantidad_solicitud',$ant)
                        ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)
                        ->update(['status_id' => $status->id]);
                    $query=PermisoEstadia::where('cantidad_solicitud',$ant)
                        ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)->get()->last();
                   // dd($query->id);
                    EstadiaRevision::create([
                        'user_id' => auth()->user()->id,
                        'permiso_estadia_id' => $query->id,
                        'accion' => $status->nombre,
                        'motivo' => 'Renovacion'
                    ]);

                }
                $idstatus = Status::find(1);
                $estadia->status_id = $idstatus->id;
                $date = date("d-m-Y");

                $vencimiento = strtotime($date."+ 90 days");
                $vencimiento= date("Y-m-d",$vencimiento);
                $estadia->vencimiento = $vencimiento;
                $estadia->update();
                EstadiaRevision::create([
                    'user_id' => auth()->user()->id,
                    'permiso_estadia_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => 'Estadia Aprobada'
                ]);

        if ($estadia->cantidad_solicitud==4) {
            $subject = 'Solicitud de Estadia Ultima Renovacion ' . $estadia->nro_solicitud;

            $mensaje="Su solicitud de Permiso de Estadia N°: ".$estadia->nro_solicitud." registrada ha sido ". $idstatus->nombre. ". Puede verificar
    su documento de autorización de estadia en el archivo adjunto a este correo.
    Se le recuerda que esta es su ultima renovacion.";

        }else {
            $subject = 'Solicitud de Estadia ' . $estadia->nro_solicitud;
            $mensaje = "Su solicitud de Permiso de Estadia N°: " . $estadia->nro_solicitud . " registrada ha sido" . $idstatus->nombre . ". Puede verificar
    su documento de autorización de estadia en el archivo adjunto a este correo.";
        }

        $this->SendMailAprobacion($estadia->id, $mensaje,$subject);


                Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
                return redirect(route('permisosestadia.index'));
           } if ($status==='2') {
                $motivo = $_GET['motivo'];
                $estadia= PermisoEstadia::find($id);
                $idstatus = Status::find(2);
                $estadia->status_id = $idstatus->id;
                if ($estadia->cantidad_solicitud==1) {
                    $estadia->cantidad_solicitud = 1;
                } else{
                    $estadia->cantidad_solicitud = 0;
                }
                $estadia->update();
                $solicitante = User::find($estadia->user_id);
                EstadiaRevision::create([
                    'user_id' => auth()->user()->id,
                    'permiso_estadia_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => $motivo
                ]);
        $mensaje = "Su solicitud de Permiso de Estadia N°: " . $estadia->nro_solicitud . " registrada ha sido " . $idstatus->nombre;
                $data = [
                    'solicitud' => $estadia->nro_solicitud,
                    'id'=>$id,
                    'idstatus' => $idstatus->id,
                    'status' => $idstatus->nombre,
                    'matricula' => $estadia->nro_registro,
                    'nombre_buque' => $estadia->nombre_buque,
                    'motivo' => $motivo,
                    'mensaje' =>$mensaje,
                ];
                $view = 'emails.estadias.revision';
                $subject = 'Solicitud de Estadia ' . $estadia->nro_solicitud;
                $email->mailZarpe($solicitante->email, $subject, $data, $view);

                Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
                return redirect(route('permisosestadia.index'));
           }
    }

    public function SendMail($idsolicitud, $tipo)
    {
        $solicitud = PermisoEstadia::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);
        $rolecapitan=Role::find(4);
        $rolecoordinador=Role::find(7);
        $capitanDestino = CapitaniaUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecapitan->name)
            ->get();
        //dd($capitanDestino);-

        $coordinador = CapitaniaUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecoordinador->name)
            ->get();
        //dd($coordinador);
        $mensaje = "";
        $mailTo="";
        $subject="";
        if ($tipo == 1) {
          if ( isset($coordinador[0]->email)) {
              $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que ha recibido una nueva solicitud de permiso
    de Estadia en su jurisdicción que espera por su asignación de visita.";
              $mailTo = $coordinador[0]->email;
              $subject = 'Nueva solicitud de permiso de Zarpe ' . $solicitud->nro_solicitud;
          }else{
          }

        } else {
            if ( isset($capitanDestino[0]->email)) {
                $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que
    la siguiente embarcación Internacional tiene una solicitud para arribar a su jurisdicción.";
                $mailTo = $capitanDestino[0]->email;
                $subject = 'Notificación de arribo Internacional ' . $solicitud->nro_solicitud;
            }else {

            }
        }

        $data = [
            'solicitud' => $solicitud->nro_solicitud,
            'matricula' => $solicitud->nro_registro,
            'nombre_buque' => $solicitud->nombre_buque,
            'nombres_solic' => $solicitante->nombres,
            'apellidos_solic' => $solicitante->apellidos,
            'mensaje' => $mensaje,
        ];

        $email=new MailController();
        $view = 'emails.estadias.solicitud';

        $email->mailZarpe($mailTo, $subject, $data, $view);
    }

    public function SendMailAprobacion($idsolicitud, $mensaje,$subject)
    {
        $solicitud = PermisoEstadia::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);
        $idstatus = Status::find(1);
        $data = [
            'solicitud' => $solicitud->nro_solicitud,
            'id'=>$idsolicitud,
            'idstatus' => $idstatus->id,
            'status' => $idstatus->nombre,
            'matricula' => $solicitud->nro_registro,
            'nombre_buque' => $solicitud->nombre_buque,
            'mensaje'=>$mensaje,
        ];

        $email=new MailController();
        $view = 'emails.estadias.revision';

        $email->mailEstadiaPDF($solicitante->email, $subject, $data, $view);
    }

    /**
     * Remove the specified PermisoEstadia from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {

    }
}
