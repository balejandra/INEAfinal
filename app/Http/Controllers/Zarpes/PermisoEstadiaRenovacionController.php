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

class PermisoEstadiaRenovacionController extends AppBaseController
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

    }

    /**
     * Show the form for creating a new PermisoEstadia.
     *
     * @return Response
     */
    public function create($id)
    {
        $permiso= PermisoEstadia::find($id);

        $count=PermisoEstadia::where('nro_registro',$permiso->nro_registro)
            ->where('status_id',1)
            ->count();
        //dd($count);
        $cantidadpermisos=$count+1;
        if ($cantidadpermisos==5) {
            Flash::error('Usted ha alcanzado el limite de sus renovaciones');

            return redirect(route('permisosestadia.index'));
        }

        $capitanias = Capitania::all();
        $permiso= PermisoEstadia::find($id);
        return view('zarpes.permiso_estadias.renovacion.create')
            ->with('capitanias', $capitanias)
            ->with('permiso',$permiso)
            ->with('count',$cantidadpermisos);
    }

    /**
     * Store a newly created PermisoEstadia in storage.
     *
     * @param CreatePermisoEstadiaRequest $request
     *
     * @return Response
     */
    public function store($id, Request $request)
    {
        $permiso=PermisoEstadia::find($id);

        $count=PermisoEstadia::where('nro_registro',$permiso->nro_registro)
            ->count();
        $cantidadpermisos=$count+1;
        //dd($permiso->id);
//dd($permiso->nro_solicitud.".".$cantidadpermisos);
        $estadia = new PermisoEstadia();
        $estadia->nro_solicitud = $permiso->nro_solicitud.".$cantidadpermisos";
        $estadia->cantidad_solicitud=$cantidadpermisos;
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

    private function codigo($capitania_id)
    {
        $cantidadActual = PermisoEstadia::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud,6,4) = '" . date('Y') . "')"), '=', true)
            ->get();

        $capitania = Capitania::find($capitania_id);

        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" . date('Y') . date('m') . "-" . $correlativo;
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
        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        return view('zarpes.permiso_estadias.show')
            ->with('permisoEstadia', $permisoEstadia)
            ->with('documentos', $documentos);
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


        $coordinador = CapitaniaUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecoordinador->name)
            ->get();
        //  dd($coordinador);

        if ($tipo == 1) {
            //mensaje para capitania origen
            $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que ha recibido una nueva solicitud de permiso
    de Estadia en su jurisdicción que espera por su asignación de visita.";
            $mailTo = $coordinador[0]->email;
            $subject = 'Nueva solicitud de permiso de Zarpe ' . $solicitud->nro_solicitud;
        } else {
            //mensaje para capitania destino
            $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que
    la siguiente embarcación Internacional tiene una solicitud para arribar a su jurisdicción.";
            $mailTo = $capitanDestino[0]->email;
            $subject = 'Notificación de arribo Internacional ' . $solicitud->nro_solicitud;
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
