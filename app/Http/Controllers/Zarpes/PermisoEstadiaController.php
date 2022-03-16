<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Zarpes\CreatePermisoEstadiaRequest;
use App\Http\Requests\Zarpes\UpdatePermisoEstadiaRequest;
use App\Models\Publico\Capitania;
use App\Models\Publico\CapitaniaUser;
use App\Models\Zarpes\DocumentoPermisoEstadia;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\PermisoEstadia;
use App\Repositories\Zarpes\PermisoEstadiaRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;

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
        if (auth()->user()->hasPermissionTo('listar-estadia-todos')) {
            $permisoEstadias = $this->permisoEstadiaRepository->all();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
        } else if (auth()->user()->hasPermissionTo('listar-estadia-generados')) {
            $user = auth()->id();
            $permisoEstadias = PermisoEstadia::where('user_id', $user)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
        } else if (auth()->user()->hasPermissionTo('listar-estadia-capitania-destino')) {
            $user = auth()->id();
            $capitania = CapitaniaUser::select('capitania_id')->where('user_id', $user)->get();
            $permisoEstadias = PermisoEstadia::whereIn('capitania_id', $capitania)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);
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
    public function store(CreatePermisoEstadiaRequest $request)
    {
        $estadia = new PermisoEstadia();
        $estadia->nro_solicitud = $this->codigo($request->capitania_id);
        $estadia->user_id = auth()->user()->id;
        $estadia->nombre_buque = $request->nombre_buque;
        $estadia->nro_registro = $request->nro_registro;
        $estadia->tipo_buque = $request->tipo_buque;
        $estadia->nacionalidad_buque = $request->nacionalidad_buque;
        $estadia->nombre_propietario = $request->nombre_propietario;
        $estadia->pasaporte_capitan = $request->pasaporte_capitan;
        $estadia->nombre_capitan = $request->nombre_capitan;
        $estadia->cant_tripulantes = $request->cant_tripulantes;
        $estadia->arqueo_bruto = $request->arqueo_bruto;
        $estadia->actividades = $request->actividades;
        $estadia->puerto_origen = $request->puerto_origen;
        $estadia->capitania_id = $request->capitania_id;
        $estadia->tiempo_estadia = $request->tiempo_estadia;
        $estadia->status_permiso_estadia_id = 1;
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

        Flash::success('Solicitud de Permiso Estadia guardada satisfactoriamente.');

        return redirect(route('permisosestadia.index'));
    }

    private function codigo($capitania_id)
    {

        $cantidadActual = PermisoEstadia::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud,4,4) = '" . date('Y') . "')"), '=', true)
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

        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        return view('permiso_estadias.edit')->with('permisoEstadia', $permisoEstadia);
    }

    /**
     * Update the specified PermisoEstadia in storage.
     *
     * @param int $id
     * @param UpdatePermisoEstadiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermisoEstadiaRequest $request)
    {
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);

        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        $permisoEstadia = $this->permisoEstadiaRepository->update($request->all(), $id);

        Flash::success('Permiso Estadia updated successfully.');

        return redirect(route('permisoEstadias.index'));
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
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);

        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        $this->permisoEstadiaRepository->delete($id);

        Flash::success('Permiso Estadia deleted successfully.');

        return redirect(route('permisoEstadias.index'));
    }
}
