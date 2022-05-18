<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\Publico\CapitaniaUser;
use App\Models\Renave\Renave_data;
use App\Models\User;
use App\Models\Zarpes\CargoTablaMando;
use App\Models\Zarpes\Equipo;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\EstablecimientoNauticoUser;
use App\Models\Zarpes\PermisoZarpe;
use App\Models\Zarpes\Status;
use App\Models\Zarpes\TablaMando;
use App\Models\Zarpes\Tripulante;
use App\Models\Zarpes\Pasajero;
use App\Models\Zarpes\TipoZarpe;
use App\Models\Zarpes\EquipoPermisoZarpe;

use App\Models\Zarpes\ZarpeRevision;
use Illuminate\Http\Request;
use App\Models\Publico\Saime_cedula;
use App\Models\Gmar\LicenciasTitulosGmar;
use App\Models\Publico\CoordenadasCapitania;
use App\Models\Publico\Capitania;
use App\Models\Sgm\TiposCertificado;
use App\Models\Zarpes\PermisoEstadia;
use App\Models\Zarpes\CoordenadasDependenciasFederales;
use App\Models\Publico\DependenciaFederal;
use App\Models\Zarpes\DescripcionNavegacion;


use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class PermisoZarpeController extends Controller
{
    private $step;

    public function __construct()
    {
        $this->step = 1;
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('listar-zarpes-todos')) {
            $data = PermisoZarpe::whereIn('descripcion_navegacion_id', [1,2,3])->get();
            return view('zarpes.permiso_zarpe.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-generados')) {
            $user = auth()->id();
            $data = PermisoZarpe::where('user_id', $user)->whereIn('descripcion_navegacion_id', [1,2,3])->get();
            return view('zarpes.permiso_zarpe.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-capitania-origen')) {
            $user = auth()->id();
            $capitania = CapitaniaUser::select('capitania_id')->where('user_id', $user)->get();
            $datazarpedestino = PermisoZarpe::whereIn('destino_capitania_id', $capitania)->whereIn('descripcion_navegacion_id', [1,2,3])->get();
            $establecimiento = EstablecimientoNautico::select('id')->whereIn('capitania_id', $capitania)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->whereIn('descripcion_navegacion_id', [1,2,3])->get();
            return view('zarpes.permiso_zarpe.indexcapitan')
                ->with('permisoOrigenZarpes', $datazarpeorigen)
                ->with('permisoDestinoZarpes', $datazarpedestino);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-establecimiento-origen')) {
            $user = auth()->id();
            $establecimiento = EstablecimientoNauticoUser::select('establecimiento_nautico_id')->where('user_id', $user)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->whereIn('descripcion_navegacion_id', [1,2,3])->get();

            return view('zarpes.permiso_zarpe.indexcomodoro')
                ->with('permisoOrigenZarpes', $datazarpeorigen);
        } else {
            return redirect(route('home'));
        }
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('stepName', "Matrícula");
        $request->session()->put('matriculasPermisadas', ['']);

        $request->session()->put('pasajeros', '');
        $request->session()->put('tripulantes', '');
        $request->session()->put('validacion', '');
        $request->session()->put('validacionesSgm', '');
        $request->session()->put('coordGadriales', '');

        $solicitud = json_encode([
            "user_id" => auth()->id(),
            "nro_solicitud" => '',
            "bandera" => '',
            "matricula" => '',
            "tipo_zarpe_id" => '',
            "descripcion_navegacion_id" => '',
            "establecimiento_nautico_id" => '',
            "establecimiento_nautico_destino_id" => '',
            "coordenadas" => '',
            "destino_capitania_id" => '',
            "origen_capitania_id" => '',
            "fecha_hora_salida" => '',
            "fecha_hora_regreso" => '',
            "status_id" => 3,
            "permiso_estadia_id" => '',
            "fecha_llegada_escala" => '',

        ]);

        $valida = [
            "UAB" => '',
            "cant_tripulantes" => 0,
            "cant_pasajeros" => 0,
            "cantPassAbordo"=> 0,
            "potencia_kw" => '',
            "cargos" => [
                "cargo_desempena" => '',
                "titulacion_aceptada_minima" => '',
                "titulacion_aceptada_maxima" => ''
            ]
        ];

        $request->session()->put('validacion', json_encode($valida));

        $this->step = 1;

        $request->session()->put('solicitud', $solicitud);

        return view('zarpes.permiso_zarpe.create-step-one')->with('paso', $this->step);
    }


    public function permissionCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'bandera' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['bandera'] = $request->input('bandera', []);

        if ($solicitud['bandera'] == 'nacional') {
            $request->session()->put('stepName', "Matrícula");
        } else {
            $request->session()->put('stepName', "Permiso de estadía");
        }

        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step = 2;
        if ($solicitud['bandera'] == 'nacional') {
            return redirect()->route('permisoszarpes.CreateStepTwo')->with('paso', $this->step);
        } else {
            return redirect()->route('permisoszarpes.CreateStepTwoE')->with('paso', $this->step);

        }

    }


    public function createStepTwo(Request $request)
    {


        $solicitud= json_decode(session('solicitud'));
        if ((isset($solicitud->bandera)))  {
            $this->step = 2;
            $siglas=Capitania::all();
            if($solicitud->matricula==""){
                $matriculaActual=['','',''];
            }else{
                $matriculaActual=explode('-',$solicitud->matricula);
            }



            return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', $this->step)->with('stepName', "Matrícula")->with("siglas", $siglas)->with("matriculaActual", $matriculaActual);


        }else{
            return redirect(route('permisoszarpes.createStepOne'));
        }

    }

    public function validationStepTwo(Request $request)
    {
        $matricula = $_REQUEST['matricula'];

        $valida=explode('-',$matricula);
        if($valida[1]!='RE' && $valida[1]!='DE'){
            echo "NoDeportivaNorecreativa";
        }else{

                $user = User::find(auth()->id());
                $permisoZ = PermisoZarpe::select("matricula")->where('user_id', auth()->id())->where('matricula', $matricula)->whereIn('status_id', [1, 3, 5])->get();

                $data0 = Renave_data::where('matricula_actual', $matricula)->get();
                $data = Renave_data::where('matricula_actual', $matricula)->where('numero_identificacion', $user->numero_identificacion)->get();
                if(is_null($data0->first())){
                    echo "sinCoincidenciasMatricula";
                }else if (is_null($data->first())) {
                    echo "sinCoincidencias";
                } else {

                    if (count($permisoZ) > 0) {
                        echo 'permisoPorCerrar';
                    } else {


                        $validacionSgm = TiposCertificado::where('matricula', $matricula)->get();
                        $val1 = "LICENCIA DE NAVEGACIÓN no encontrada";
                        $val2 = "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA no encontrado";
                        $val3 = "ASIGNACIÓN DE NÚMERO ISMM no encontrado";


                        $nroCorrelativos=["licenciaNavegacion" => '',
                                            "certificadoRadio"  => '',
                                            "numeroIsmm" => '',
                                            ];
                        $data2 = [
                            "data" => $data,
                            "validacionSgm" => [$val1, $val2, $val3],
                        ];

                        if (count($validacionSgm) > 0) {

                            $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
                            for ($i = 0; $i < count($validacionSgm); $i++) {

                                switch ($validacionSgm[$i]->nombre_certificado) {
                                    case "LICENCIA DE NAVEGACIÓN":
                                        $fecha = $validacionSgm[$i]->fecha_vencimiento;
                                        list($dia, $mes, $ano) = explode("/", $fecha);
                                        $fecha_vence = $ano . "-" . $mes . "-" . $dia . " 00:00:00";
                                        $fecha_vence1 = strtotime($fecha_vence);
                                        if (($fecha_actual > $fecha_vence1)) {
                                            $val1 = "LICENCIA DE NAVEGACIÓN vencida"; //encontrado pero vencido
                                        } else {
                                            $val1 = true;

                                            $valida = json_decode($request->session()->get('validacion'), true);
                                            // dd($valida);
                                            $valida['potencia_kw'] = $validacionSgm[$i]->potencia_kw;
                                            $valida["cant_pasajeros"] = $validacionSgm[$i]->capacidad_personas;
                                            $nroCorrelativos["licenciaNavegacion"]=$validacionSgm[$i]->nro_correlativo;
                                            $request->session()->put('validacion', json_encode($valida));
                                        }
                                        break;
                                    case "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA":
                                        $fecha = $validacionSgm[$i]->fecha_vencimiento;
                                        list($dia, $mes, $ano) = explode("/", $fecha);
                                        $fecha_vence = $ano . "-" . $mes . "-" . $dia . " 00:00:00";
                                        $fecha_vence1 = strtotime($fecha_vence);

                                        if (($fecha_actual > $fecha_vence1)) {
                                            $val2 = "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA vencido."; //encontrado pero vencido
                                        } else {
                                            $val2 = true;
                                            $nroCorrelativos["certificadoRadio"]=$validacionSgm[$i]->nro_correlativo;
                                        }
                                        break;
                                    case "ASIGNACIÓN DE NÚMERO ISMM":
                                        $val3 = true;
                                        $nroCorrelativos["numeroIsmm"]=$validacionSgm[$i]->nro_correlativo;

                                    break;
                                }
                            }

                            $data2 = [
                                "data" => $data,
                                "validacionSgm" => [$val1, $val2, $val3,$nroCorrelativos],
                            ];
                            echo json_encode($data2);
                        } else {
                            echo "noEncontradoSgm";
                        }

                    }
                }


        }

    }



    public function permissionCreateStepTwo(Request $request)
    {

        $validatedData = $request->validate([
            'matricula' => 'required',
            //  'UAB' => 'required',
        ]);
        $validation = json_decode($request->session()->get('validacion'), true);
        $UAB = $request->input('UAB');
        $matricula = $request->input('matricula');
        $identificacion = $request->input('numero_identificacion');
        if ($identificacion != auth()->user()->numero_identificacion) {
            Flash::error('Su usuario no puede realizar solicitudes a nombre del Buque Matricula ' . $matricula);
            return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', 2);
        }

        $tabla = new TablaMando();
        $mando = $tabla->where([
            ['UAB_minimo', '<', $UAB],
            ['UAB_maximo', '>=', $UAB]
        ])->get()->toArray();
        if(count($mando)==0){
            Flash::error('No se ha podido comparar las especificaciones de la embarcación ('.$matricula.') respecto a la tabla de mandos actual, comuniquese con el administrador del sitema.');
            return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', 2);
        }else{
            $validation['UAB'] = $request->input('UAB', []);
            $validation['eslora'] = $request->input('eslora', []);
            $validation['cant_tripulantes'] = $mando[0]["cant_tripulantes"];

            $idtablamando = $mando[0]["id"];
            $cargos = CargoTablaMando::where('tabla_mando_id', $idtablamando)->get()->toArray();
            foreach ($cargos as $clave => $valor) {
                $cargo["cargo_desempena"] = $valor['cargo_desempena'];
                $cargo["titulacion_aceptada_minima"] = $valor['titulacion_aceptada_minima'];
                $cargo["titulacion_aceptada_maxima"] = $valor['titulacion_aceptada_maxima'];
                $validation[$clave] = $cargo;
            }


            $request->session()->put('validacion', json_encode($validation));
            // dd($request->session()->get('validacion'));

            $solicitud = json_decode($request->session()->get('solicitud'), true);
            $solicitud['matricula'] = $request->input('matricula', []);
            $solicitud['permiso_estadia_id'] = null;
            $request->session()->put('solicitud', json_encode($solicitud));
            // dd($solicitud);
            return redirect()->route('permisoszarpes.createStepThree');
        }


    }


    public function createStepTwoE(Request $request)
    {
        // $this->SendMail(42,1);

        $this->step = 2;

        return view('zarpes.permiso_zarpe.extranjera.create-step-two')->with('paso', $this->step);

    }

    public function validationStepTwoE(Request $request)
    {
        $permiso = $_REQUEST['permiso'];

        $permisoEstadia = PermisoEstadia::where('user_id', auth()->id())->where('nro_solicitud', $permiso)->where('status_id', 1)->get();

        if (is_null($permisoEstadia->first())) {

            echo json_encode("sinCoincidencias");
        } else {
            $permisoZ = PermisoZarpe::select("matricula")->where('user_id', auth()->id())->where('matricula', $permisoEstadia[0]->nro_registro)->whereIn('status_id', [1, 3, 5])->get();

            if (count($permisoZ) > 0) {
                echo json_encode('permisoPorCerrar');
            } else {
                echo json_encode($permisoEstadia);
            }

        }

    }


    public function permissionCreateSteptwoE(Request $request)
    {

        $permiso = $request->input('permiso');
        $validatedData = $request->validate([
            'permiso' => 'required',
            'permiso_de_estadia' => 'required',
            'numero_de_registro' => 'required',
        ]);
        $idpermiso = $_REQUEST['permiso_de_estadia'];
        $matricula = $_REQUEST['numero_de_registro'];

        $permisoEstadia = PermisoEstadia::where('user_id', auth()->id())->where('nro_solicitud', $permiso)->where('status_id', 1)->get();

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['matricula'] = $matricula;
        $solicitud['permiso_estadia_id'] = $idpermiso;
        $request->session()->put('solicitud', json_encode($solicitud));

        $valida = json_decode($request->session()->get('validacion'), true);


        $valida["cant_tripulantes"] = $permisoEstadia[0]->cant_tripulantes;
        $valida["cant_pasajeros"] = $permisoEstadia[0]->cant_pasajeros;
        $valida["potencia_kw"] = $permisoEstadia[0]->potencia_kw;
        $valida["UAB"] = $permisoEstadia[0]->arqueo_bruto;
        $request->session()->put('validacion', json_encode($valida));

        return redirect()->route('permisoszarpes.createStepThree');

    }


    public function createStepThree(Request $request)
    {
        $solicitud= json_decode(session('solicitud'));
        if ((isset($solicitud->bandera) || ((isset($solicitud->matricula)))))  {
            $descripcionNav=$solicitud->descripcion_navegacion_id;
            if ($descripcionNav == 2) {
                $CapDependencias = DependenciaFederal::selectRaw('distinct(capitania_id)')->get();
                $capitania = Capitania::whereIn('id', $CapDependencias)->get();
            } else {
                $capitania = Capitania::all();
            }

            $solicitud = json_decode($request->session()->get('solicitud'), true);
            $bandera = $solicitud['bandera'];
            $TipoZarpes = TipoZarpe::all();
            //$capitania = Capitania::all();
            $descripcionNavegacion = DescripcionNavegacion::all();

            $this->step = 3;

            return view('zarpes.permiso_zarpe.create-step-three')->with('paso', $this->step)->with('TipoZarpes', $TipoZarpes)->with('capitanias', $capitania)->with('descripcionNavegacion', $descripcionNavegacion)->with('bandera', $bandera);


        }else{
            return redirect(route('permisoszarpes.createStepOne'));
        }

    }

    public function permissionCreateStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_de_navegacion' => 'required',
            'descripcion_de_navegacion' => 'required',
            'capitania' => 'required',

        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['tipo_zarpe_id'] = $request->input('tipo_de_navegacion', []);
        $solicitud['descripcion_navegacion_id'] = $request->input('descripcion_de_navegacion', []);
        $solicitud['origen_capitania_id'] = $request->input('capitania', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        // print_r($solicitud);
        $this->step = 4;

        return redirect()->route('permisoszarpes.createStepFour');

    }



    public function createStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        if ((isset($solicitud['bandera'])) || ((isset($solicitud['descripcion_navegacion_id']))))  {
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $solicitud['origen_capitania_id'])->get();
        if($solicitud['destino_capitania_id']!=''){
            $EstNauticosDestino = EstablecimientoNautico::where('capitania_id', $solicitud['destino_capitania_id'])->get();
            $CapDestinoFinal=Capitania::find($solicitud['destino_capitania_id']);
        }else{
            $EstNauticosDestino = "";
            $CapDestinoFinal='';
        }
        $capitaniasDestinoList = Capitania::all();
        $coordenadas = [];
        $coordenadasDep = [];
        $arr = ["capitania" => 0, "coords" => []];
        $arrDep = ["capitania" => 0, "coords" => []];
        $activaDependencias = false;

        switch ($solicitud['descripcion_navegacion_id']) {
            case 1: //dentro de una circunscripción
                $coordCaps = CoordenadasCapitania::where('capitania_id', $solicitud['origen_capitania_id'])->get();
                $coordsDependencias = [];
                break;
            case 2://Dentro de una circunscripcion pero a una dependencia federal
                $coordCaps = CoordenadasCapitania::where('capitania_id', $solicitud['origen_capitania_id'])->get();
                $coordsDependencias = DependenciaFederal::select('latitud', 'longitud', 'capitania_id', 'dependencias_federales.id', 'dependencias_federales.nombre')->join('coordenadas_dependencias_federales', 'coordenadas_dependencias_federales.dependencias_federales_id', '=', 'dependencias_federales.id')->where('capitania_id', $solicitud['origen_capitania_id'])->get();

                $activaDependencias = true;
                break;
            case 3: // entre circunsctipciones
                //$coordCaps=CoordenadasCapitania::all();
                $coordCaps = CoordenadasCapitania::where('capitania_id', '!=', $solicitud['origen_capitania_id'])->get();
                $coordsDependencias = [];
                break;
            case 4: // internacional
                $coordCaps = [];
                $coordsDependencias = [];

                break;
            case 5://Hacia una dependencia federal de otra circunscripcion
                    $coordCaps = CoordenadasCapitania::where('capitania_id', $solicitud['origen_capitania_id'])->get();
                    $coordsDependencias = DependenciaFederal::select('latitud', 'longitud', 'capitania_id', 'dependencias_federales.id', 'dependencias_federales.nombre')->join('coordenadas_dependencias_federales', 'coordenadas_dependencias_federales.dependencias_federales_id', '=', 'dependencias_federales.id')->where('capitania_id', '!=',$solicitud['origen_capitania_id'])->get();

                    $activaDependencias = true;
            break;
        }

        if (count($coordCaps) > 0) {
            $capi = "";
            foreach ($coordCaps as $coord) {
                if ($capi == "" || $capi != $coord->capitania_id) {
                    if ($capi != "") {
                        array_push($coordenadas, $arr);
                        $arr = ["capitania" => 0, "coords" => []];
                    }
                    $capi = $coord->capitania_id;
                    $arr["capitania"] = $coord->capitania_id;
                }
                array_push($arr["coords"], [$coord->latitud, $coord->longitud]);

            }

            if ($arr["capitania"] != 0) {
                array_push($coordenadas, $arr);
            }
        }

        if (count($coordsDependencias) > 0) {
            $capi2 = "";
            foreach ($coordsDependencias as $coordDep) {
                if ($capi2 == "" || $capi2 != $coordDep->id) {
                    if ($capi2 != "") {
                        array_push($coordenadasDep, $arrDep);
                        $arrDep = ["capitania" => 0, "coords" => []];
                    }
                    $capi2 = $coordDep->capitania_id;
                    $arrDep["capitania"] = $coordDep->capitania_id;
                }
                array_push($arrDep["coords"], [$coordDep->latitud, $coordDep->longitud]);
            }

            if ($arrDep["capitania"] != 0) {
                array_push($coordenadasDep, $arrDep);
                // print_r($coordenadasDep);

            }
        }
        $this->step = 4;
        return view('zarpes.permiso_zarpe.create-step-four')->with('paso', $this->step)->with('EstNauticos', $EstNauticos)->with('coordCaps', json_encode($coordenadas))->with('coordsDependencias', json_encode($coordenadasDep))->with('activaDependencias', $activaDependencias)->with('EstNauticosDestino', $EstNauticosDestino)->with('CapDestinoFinal', $CapDestinoFinal)->with('capitaniasDestinoList', $capitaniasDestinoList);
        }else{
            return redirect(route('permisoszarpes.createStepOne'));
        }
    }

    public function permissionCreateStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);

        if ($solicitud['descripcion_navegacion_id'] == 4) {
            $validatedData = $request->validate([
                'establecimientoNáuticoOrigen' => 'required',
                'salida' => 'required',
                'fecha_llegada_escala' => 'required',
                'regreso' => 'required',
                'latitud' => 'required',
                'longitud' => 'required',
            ]);
        } else {
            $validatedData = $request->validate([
                'establecimientoNáuticoOrigen' => 'required',
                'salida' => 'required',
                'regreso' => 'required',
                'fecha_llegada_escala' => 'required',
                'latitud' => 'required',
                'longitud' => 'required',
                'capitaniaDestino' => 'required',
                'establecimientoNáuticoDestino' => 'required',

            ]);
        }


        $solicitud['establecimiento_nautico_id'] = $request->input('establecimientoNáuticoOrigen');
        $solicitud['establecimiento_nautico_destino_id'] = $request->input('establecimientoNáuticoDestino');
        $solicitud['fecha_hora_salida'] = $request->input('salida');
        $solicitud['fecha_hora_regreso'] = $request->input('regreso');
        $solicitud['coordenadas'] = json_encode([$request->input('latitud'), $request->input('longitud')]);
        $solicitud['destino_capitania_id'] = $request->input('capitaniaDestino');
        $solicitud['fecha_llegada_escala'] = $request->input('fecha_llegada_escala');

        $request->session()->put('coordGadriales',  [$request->input('latitudGrad'),$request->input('longitudGrad')]);
        $request->session()->put('solicitud', json_encode($solicitud));



        $this->step = 5;
        return redirect()->route('permisoszarpes.createStepFive');
    }


    public function createStepFive(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        if ((isset($solicitud['bandera'])) || ((isset($solicitud['fecha_hora_salida']))) )  {
        $validation = json_decode($request->session()->get('validacion'), true);
        $tripulantes = $request->session()->get('tripulantes');

        $this->step = 5;
        return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation);
        }else{
            return redirect(route('permisoszarpes.createStepOne'));
        }
    }

    public function permissionCreateStepFive(Request $request)
    {

        $validation = json_decode($request->session()->get('validacion'), true);
       $tripulantes = $request->session()->get('tripulantes');
       $validation['cantPassAbordo']=$validation['cant_pasajeros']-$validation['cant_tripulantes'];
       $request->session()->put('validacion', json_encode($validation));
        if (is_array($tripulantes) && (count($tripulantes) >= $validation['cant_tripulantes'] && count($tripulantes) <= $validation['cant_pasajeros'])) {
             $capitan=0;
            for ($i=0; $i < count($tripulantes); $i++) {
                $indice=array_search("Capitán",$tripulantes[$i],false);

                if($indice!=false){
                    $capitan++;
                }
            }

            if($capitan==1){
                $this->step = 6;
                return redirect()->route('permisoszarpes.createStepSix');

            }elseif($capitan< 1){
                $mensj ="Debe asignar un capitán para esta embarcación, por favor verifique";
                return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj);
            }else{
                $mensj ="No puede asignar más de un capitán para la embarcación";
                return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj);
            }

        } else {
            $this->step = 5;
            if(!is_array($tripulantes)){
                $mensj = "El listado de tripulantes es requerido, por favor verifique.";
            }else if(count($tripulantes) < $validation['cant_tripulantes']){
                $mensj = "La embarcación requiere un mínimo de ".$validation['cant_tripulantes']." tripulantes para navegar, por favor verifique.";
            }else if(count($tripulantes) > $validation['cant_pasajeros']){
                $mensj = "La embarcación requiere un máximo de ".$validation['cant_pasajeros']." personas a bordo que no debe ser excedido para navegar, por favor verifique.";
            }else{
                 $mensj ="Ha ocurrido un error al agregar a los tripulantes, contacte al administrador del sistema";
            }


            return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj);


        }
    }

    public function createStepSix(Request $request)
    {
        $solicitud= json_decode(session('solicitud'));
        if ((isset($solicitud->fecha_hora_salida)))  {
        $passengers = $request->session()->get('pasajeros');
        $validation = json_decode($request->session()->get('validacion'), true);

        $tripulantes=$request->session()->get('tripulantes');
        $cantPasajeros = $validation['cantPassAbordo'];
        $this->step = 6;

        return view('zarpes.permiso_zarpe.create-step-six')->with('paso', $this->step)->with('passengers', $passengers)->with('cantPasajeros', $cantPasajeros);
        }else{
            return redirect(route('permisoszarpes.createStepOne'));
        }
    }

    public function permissionCreateStepSix(Request $request)
    {



        $this->step = 7;
        return redirect()->route('permisoszarpes.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        if ((isset($solicitud['fecha_hora_salida'])))  {
        $equipos = Equipo::all();
        //  dd($equipos);
        $this->step = 7;
        return view('zarpes.permiso_zarpe.create-step-seven')
            ->with('paso', $this->step)
            ->with('equipos', $equipos);
        }else{
            return redirect(route('permisoszarpes.createStepOne'));
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'equipo' => 'required',
        ]);
        $equipos = Equipo::all();
        $equipo = $request->input('equipo', []);

        if (count($equipo) == 0) {
            Flash::error('Debe indicar los equipos que posee a bordo, por favor verifique.');
            return redirect()->route('permisoszarpes.createStepSeven');
        } else {
            $solicitud = json_decode($request->session()->get('solicitud'), true);
            //print_r($solicitud);

            $codigo = $this->codigo($solicitud);

            $solicitud['nro_solicitud'] = $codigo;
            $saveSolicitud = PermisoZarpe::create($solicitud);

            $tripulantes = $request->session()->get('tripulantes');
            for ($i = 0; $i < count($tripulantes); $i++) {
                if($tripulantes[$i]["capitan"]=='SI'){
                    $tripulantes[$i]["capitan"]=true;
                }else{
                    $tripulantes[$i]["capitan"]=false;
                }
                $tripulantes[$i]["permiso_zarpe_id"] = $saveSolicitud->id;
                $trip = Tripulante::create($tripulantes[$i]);

            }

            $pasajeros = $request->session()->get('pasajeros');
           // print_r($pasajeros);

            if ($pasajeros[0] != 0) {
                for ($i = 0; $i < count($pasajeros); $i++) {
                    $pasajeros[$i]["permiso_zarpe_id"] = $saveSolicitud->id;
                    $pass = Pasajero::create($pasajeros[$i]);
                    // print_r($pasajeros[$i]); echo "<br>";
                }
            }

            $listadoEquipos = ["permiso_zarpe_id" => '', "equipo_id" => '', "cantidad" => '', "otros" => '', "valores_otros" => ''];

            $otros = [];
            $valoresOtros = [];

            $listEq = [];
            $i = 0;
            $j = 0;

            foreach ($equipos as $equipoX) {
                foreach ($equipo as $equip) {
                    if ($equipoX->id == $equip) {

                        if ($request->input($equip . 'selected') == true) {
                            $listadoEquipos["permiso_zarpe_id"] = $saveSolicitud->id;
                            $listadoEquipos["equipo_id"] = $equip;
                            if ($equipoX->cantidad == true) {
                                $listadoEquipos["cantidad"] = $request->input($equip . 'cantidad');

                            } else {
                                $listadoEquipos["cantidad"] = '';
                            }

                            if ($equipoX->otros != 'ninguno') {
                                $listadoEquipos["otros"] = $request->input($equip . 'otros');
                                $listadoEquipos["valores_otros"] = $request->input($equip . 'valores_otros');
                            } else {
                                $listadoEquipos["otros"] = "";
                                $listadoEquipos["valores_otros"] = "";

                            }

                            $listEq[$i] = $listadoEquipos;
                            $i++;
                            EquipoPermisoZarpe::create($listadoEquipos);

                            $listadoEquipos = ["permiso_zarpe_id" => '', "equipo_id" => '', "cantidad" => '', "otros" => '', "valores_otros" => ''];
                        }

                    }
                }
            }


            $capOrigin = $this->SendMail($saveSolicitud->id, 1);
            $caopDestino = $this->SendMail($saveSolicitud->id, 0);

            if ($capOrigin == true || $caopDestino == true) {
                Flash::success('Se ha generado la solocitud <b>
            ' . $codigo . '</b> exitosamente y se han enviado los correos de notificación correspondientes');
            } else {
                Flash::success('Se ha generado la solocitud <b> ' . $codigo . '</b> exitosamente.');

            }

            $this->limpiarVariablesSession();
            return redirect()->route('permisoszarpes.index');
        }


    }

    public function consulta2(Request $request)
    {
        $cedula = $_REQUEST['cedula'];
        $fecha = $_REQUEST['fecha'];
        $sexo = $_REQUEST['sexo'];

        $newDate = date("d/m/Y", strtotime($fecha));
        $newDate2 = date("d-m-Y", strtotime($fecha));
        $newDate3 = date("Y-m-d", strtotime($fecha));
        $data = Saime_cedula::where('cedula', $cedula)
            ->whereIn('fecha_nacimiento', [$newDate,$newDate2,$newDate3])
           // ->where('sexo', $sexo)
            ->get();
        if (is_null($data->first())) {
            dd('error');
            $data = response()->json([
                'status' => 3,
                'msg' => $exception->getMessage(),
                'errors' => [],
            ], 200);
        }

        echo json_encode($data);
    }

    public function deleteTripulante(Request $request){
        $cedula=$_REQUEST['index'];
        $borrado=false;
        $tripulantes = $request->session()->get('tripulantes');
        $validation = json_decode($request->session()->get('validacion'), true);

       if(count($tripulantes)==1){
                $tripulantes=[];
                $request->session()->put('tripulantes', $tripulantes);
                $validation['cantPassAbordo']++;
                $request->session()->put('validacion', json_encode($validation));
                $borrado =true;
        }else{
            if(is_array($tripulantes)){
                for ($i=0; $i < count($tripulantes); $i++) {
                    $indice=array_search($cedula,$tripulantes[$i],false);
                    if($indice!=false){
                        array_splice($tripulantes, $i, $i);
                        $request->session()->put('tripulantes', $tripulantes);
                        $validation['cantPassAbordo']++;
                         $request->session()->put('validacion', json_encode($validation));
                        $borrado =true;
                    }
                }
            }
        }

        echo $borrado;
    }

    public function deletePassenger(Request $request){
        $cedula=$_REQUEST['index'];
        $borrado=false;
        $pasajeros = $request->session()->get('pasajeros');
        $validation = json_decode($request->session()->get('validacion'), true);

        if(is_array($pasajeros)){
            if(count($pasajeros)==1){
                $pasajeros=[];
                $request->session()->put('pasajeros', $pasajeros);
                $validation['cantPassAbordo']++;
                $request->session()->put('validacion', json_encode($validation));
                $borrado =true;
            }else{
                for ($i=0; $i < count($pasajeros); $i++) {
                    $indice=array_search($cedula,$pasajeros[$i],false);
                    if($indice!=false){
                        array_splice($pasajeros, $i, $i);
                        $request->session()->put('pasajeros', $pasajeros);
                        $validation['cantPassAbordo']++;
                        $request->session()->put('validacion', json_encode($validation));
                        $borrado =true;
                    }
                }
            }

        }
        echo $borrado;
    }

    public function validacionMarino(Request $request){
        $cedula=$_REQUEST['cedula'];
        $funcion=$_REQUEST['funcion'];
        $vj = [];
        $indice=false;
        $tripulantes = $request->session()->get('tripulantes');
        $capitanExiste=false;
        switch ($funcion) {
            case 'Capitán':
                 $cap="SI";
                 if(is_array($tripulantes) && count($tripulantes)>0){
                    foreach ($tripulantes as $value) {
                     //   print_r($value);
                        if($value['capitan']=='SI'){
                           $capitanExiste=true;
                        }
                    }
                 }

            break;
            case 'Motorista':
                 $cap="NO";
            break;
            case 'Marino':
                 $cap="NO";
            break;
        }

        if($capitanExiste){
            $return = [$tripulantes, "", "",'capitanExiste',""];
            echo json_encode($return);
        }else{
            $validation = json_decode($request->session()->get('validacion'), true);
        $fechav = LicenciasTitulosGmar::select(DB::raw('MAX(fecha_vencimiento) as fechav'))->where('ci', $cedula)->get();
         $InfoMarino = LicenciasTitulosGmar::where('fecha_vencimiento', $fechav[0]->fechav)->where('ci', $cedula)->get();

       //  $request->session()->put('tripulantes', '');
        if (is_null($InfoMarino->first())) {
            $InfoMarino = "gmarNotFound"; // no encontrado en Gmar
        } else {
            $emision=explode(' ',$InfoMarino[0]->fecha_emision);
            $trip = [
            "permiso_zarpe_id" => '',
            "ctrl_documento_id" => $InfoMarino[0]->id,
            "capitan" => $cap,
            "nombre" => $InfoMarino[0]->nombre." ".$InfoMarino[0]->apellido,
            "cedula" => $InfoMarino[0]->ci,
            "fecha_vencimiento" => $InfoMarino[0]->fecha_vencimiento,
            "fecha_emision" =>$emision[0],
            "documento" => $InfoMarino[0]->documento,
            "funcion"  => $funcion,
            "solicitud"  => $InfoMarino[0]->solicitud,
            ];

            if(is_array($tripulantes)){
                for ($i=0; $i < count($tripulantes); $i++) {
                     $indice=array_search($cedula,$tripulantes[$i],false);

                        if($indice!=false){
                            $indice=true;
                        }
                }

            }else{
                $indice=false;
                $tripulantes=[];
            }

            $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
            $fecha_vence = strtotime($InfoMarino[0]->fecha_vencimiento);

            if ($InfoMarino[0]->solicitud == 'Licencia' && ($fecha_actual > $fecha_vence)) {
                    $InfoMarino = "FoundButDefeated"; //encontrado pero documento vencido
                } else {

                    $marinoAsignado = PermisoZarpe::select('permiso_zarpes.status_id', 'ctrl_documento_id')
                        ->Join('tripulantes', 'permiso_zarpes.id', '=', 'tripulantes.permiso_zarpe_id')
                        ->where('tripulantes.ctrl_documento_id', '=', $InfoMarino[0]->id)
                        ->whereIn('permiso_zarpes.status_id', [1, 3, 5])
                        ->get();

                    if (count($marinoAsignado) > 0) {
                        $InfoMarino = "FoundButAssigned"; //encontrado pero asignado a otro barco
                    } else {
                        $vj = $this->validacionJerarquizacion($InfoMarino[0]->documento, $cap);

                        if($indice==false && $vj[0]==true){
                            if(count($tripulantes) <= $validation['cant_pasajeros']-1){
                                array_push($tripulantes, $trip);
                                $request->session()->put('tripulantes', $tripulantes);
                                $validation['cantPassAbordo']=$validation['cant_pasajeros']-count($tripulantes);
                                $request->session()->put('validacion', json_encode($validation));
                            }else{
                                $InfoMarino = "FoundButMaxTripulationLimit";
                            }

                        }

                    }
                }
        }
        $return = [$tripulantes, $vj, $indice,$InfoMarino,$validation['cant_pasajeros']];
        echo json_encode($return);
        }

    }

    public function validarMarino(Request $request)
    {
        $cedula = $_REQUEST['cedula'];
       // $fecha = $_REQUEST['fecha'];
        $cap = $_REQUEST['cap'];

        $vj = [];
        /*$newDate = date("d/m/Y", strtotime($fecha));
        $newDate2 = date("d-m-Y", strtotime($fecha));
        $newDate3 = date("Y-d-m", strtotime($fecha));
        $data = Saime_cedula::where('cedula', $cedula)
            ->whereIn('fecha_nacimiento', [$newDate,$newDate2,$newDate3])
            ->get();

        if (is_null($data->first())) {
            $data2 = "saimeNotFound"; // no encontrado en saime
        } else {*/
            $fechav = LicenciasTitulosGmar::select(DB::raw('MAX(fecha_vencimiento) as fechav'))->where('ci', $cedula)->get();

            $data2 = LicenciasTitulosGmar::where('fecha_vencimiento', $fechav[0]->fechav)->where('ci', $cedula)->get();
            if (is_null($data2->first())) {
                $data2 = "gmarNotFound"; // no encontrado en Gmar
            } else {

                $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
                $fecha_vence = strtotime($data2[0]->fecha_vencimiento);

                if ($data2[0]->solicitud == 'Licencia' && ($fecha_actual > $fecha_vence)) {
                    $data2 = "FoundButDefeated"; //encontrado pero documento vencido
                } else {

                    $marinoAsignado = PermisoZarpe::select('permiso_zarpes.status_id', 'ctrl_documento_id')
                        ->Join('tripulantes', 'permiso_zarpes.id', '=', 'tripulantes.permiso_zarpe_id')
                        ->where('tripulantes.ctrl_documento_id', '=', $data2[0]->id)
                        ->whereIn('permiso_zarpes.status_id', [1, 3, 5])
                        ->get();

                    if (count($marinoAsignado) > 0) {
                        $data2 = "FoundButAssigned";
                    } else {
                        $vj = $this->validacionJerarquizacion($data2[0]->documento, $cap);

                    }
                }
            }

//        }
        $return = [$data2, $vj];
        echo json_encode($return);
    }

    private function codigo($solicitud)
    {
        $ano = date('Y');
        $mes = date('m');
        $estNautico = EstablecimientoNautico::find($solicitud['establecimiento_nautico_id']);
        $capitania = Capitania::find($estNautico->capitania_id);
        $idcap=$capitania->id;

        $cantidadActual = PermisoZarpe::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud, 6, 4) = '" . $ano . "')"), '=', true)
            ->Join('establecimiento_nauticos', function ($join) use ($idcap) {
                $join->on('permiso_zarpes.establecimiento_nautico_id', '=', 'establecimiento_nauticos.id')
                    ->where('establecimiento_nauticos.capitania_id', '=',  $idcap);
            })
            ->get();

        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" . $ano . $mes . "-" . $correlativo;

        return $codigo;
    }


    public function updateStatus($id, $status, $establecimiento)
    {
        $transaccion = PermisoZarpe::find($id);
        $capitania= Capitania::where('id',$transaccion->establecimiento_nautico->capitania_id)->first();
        $estnauticoDestino=EstablecimientoNautico::find($transaccion->establecimiento_nautico_destino_id);
        if ($status === 'aprobado') {
            if ($transaccion->bandera=='extranjera') {
                $buqueconsex=PermisoEstadia::where('id',$transaccion->permiso_estadia_id)->first();
                $buque=$buqueconsex->nombre_buque;
            }else {
                $buqueconsnac= Renave_data::where('matricula_actual',$transaccion->matricula)->first();
                $buque=$buqueconsnac->nombrebuque_actual;
            }
            $idstatus = Status::find(1);
            $solicitante = User::find($transaccion->user_id);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Aprobado'
            ]);
            $email = new MailController();
            $mensaje='Estimado ciudadano, La notificación de zarpe N°:'. $transaccion->nro_solicitud.' registrada en el Sistema para el Control de Zarpes
    para Embarcaciones Recreativas ha sido Aprobada. Puede verificar su documento de autorización de zarpe en el
    archivo adjunto a este correo.

    Por favor realice la notificación de arribo en el sistema cuando llegue a su destino para cerrar el ciclo de la
    solicitud.';
            $data = [
                'id' => $id,
                'idstatus' => $idstatus->id,
                'status' => $idstatus->nombre,
                'nombre_buque' => $buque,
                'origen' => $capitania->nombre,
                'destino' => $estnauticoDestino->nombre,
                'matricula' => $transaccion->matricula,
                'mensaje'=>$mensaje,
            ];
            $view = 'emails.zarpes.revision';
            $subject = 'Solicitud de permiso de Zarpe ' . $transaccion->nro_solicitud;
            $email->mailZarpePDF($solicitante->email, $subject, $data, $view);

            Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
            return redirect(route('permisoszarpes.index'));

        } elseif ($status === 'rechazado') {
            $motivo = $_GET['motivo'];
            if ($transaccion->bandera=='extranjera') {
                $buqueconsex=PermisoEstadia::where('id',$transaccion->permiso_estadia_id)->first();
                $buque=$buqueconsex->nombre_buque;
            }else {
                $buqueconsnac= Renave_data::where('matricula_actual',$transaccion->matricula)->first();
                $buque=$buqueconsnac->nombrebuque_actual;
            }
            $idstatus = Status::find(2);
            $solicitante = User::find($transaccion->user_id);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();
            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => $motivo
            ]);
            $email = new MailController();
            $mensaje='Estimado ciudadano, La notificación de zarpe N°:'. $transaccion->nro_solicitud.' registrada en el Sistema para el Control de Zarpes
    para Embarcaciones Recreativas ha sido Rechazada.';
            $data = [
                'id' => $id,
                'idstatus' => $idstatus->id,
                'status' => $idstatus->nombre,
                'nombre_buque' => $buque,
                'origen' => $capitania->nombre,
                'destino' => $estnauticoDestino->nombre,
                'matricula' => $transaccion->matricula,
                'motivo'=>$motivo,
                'mensaje'=>$mensaje
            ];
            $view = 'emails.zarpes.revision';
            $subject = 'Solicitud de Zarpe ' . $transaccion->nro_solicitud;
            $email->mailZarpe($solicitante->email, $subject, $data, $view);

            Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
            return redirect(route('permisoszarpes.index'));

        } elseif ($status === 'navegando') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(5);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Navegando'
            ]);
            Flash::warning('Solicitud informada con el estatus de Navegando.');
            return redirect(route('permisoszarpes.index'));

        } elseif ($status === 'anulado_sar') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(8);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Anulado por SAR'
            ]);
            Flash::error('Solicitud Anulada por SAR.');
            return redirect(route('permisoszarpes.index'));

        } elseif ($status === 'cerrado') {
            $transaccion = PermisoZarpe::find($id);
            $idstatus = Status::find(4);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();

            Flash::info('Solicitud de Zarpe Cerrada.');
            return redirect(route('permisoszarpes.index'));

        } elseif ($status === 'anular-usuario') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(6);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();
            if (isset($_GET['motivo'])) {
                $motivo=$_GET['motivo'];
                ZarpeRevision::create([
                    'user_id' => auth()->user()->id,
                    'permiso_zarpe_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => $motivo
                ]);
            }else {
                ZarpeRevision::create([
                    'user_id' => auth()->user()->id,
                    'permiso_zarpe_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => 'Anulada por el Usuario Solicitante'
                ]);
            }
            Flash::error('Solicitud Anulada.');
            return redirect(route('permisoszarpes.index'));
        }
    }

    /**
     * Display the specified PermisoZarpe.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permisoZarpe = PermisoZarpe::find($id);
        if ($permisoZarpe->bandera=='extranjera') {
            $buque=PermisoEstadia::where('id',$permisoZarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$permisoZarpe->matricula)->first();
        }
        $validacionSgm = TiposCertificado::where('matricula', $permisoZarpe->matricula)->get();
//dd($validacionSgm);
        $tripulantes = Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id', $id)->get();
        $tripulacion= Tripulante::where('permiso_zarpe_id', $id)->get();
       // dd($tripulacion);
        $pasajeros = $permisoZarpe->pasajeros()->where('permiso_zarpe_id', $id)->get();

        $tripulantes2 = DB::table('zarpes.tripulantes')
            ->join('gmar.licencias_titulos_gmar', DB::raw('CAST(licencias_titulos_gmar.id AS TEXT)'), '=', 'tripulantes.ctrl_documento_id')
            ->where('permiso_zarpe_id', $id)
            ->select('licencias_titulos_gmar.*', 'tripulantes.funcion')
            ->get();

       // $tripulantes2 = LicenciasTitulosGmar::whereIn('id', $tripulantes)->get();
        $equipos = EquipoPermisoZarpe::where('permiso_zarpe_id', $id)->get();
        $revisiones = ZarpeRevision::where('permiso_zarpe_id', $id)->get();

        $establecimiento = EstablecimientoNautico::select('capitania_id')->where('id', $permisoZarpe->establecimiento_nautico_id)->get();
        $establecimiento_user = EstablecimientoNauticoUser::select('user_id')
            ->where('establecimiento_nautico_id', $permisoZarpe->establecimiento_nautico_id)
            ->get();
        $establecimiento_destino = EstablecimientoNautico::find($permisoZarpe->establecimiento_nautico_destino_id);
        $capitania_user = CapitaniaUser::select('user_id')->whereIn('capitania_id', $establecimiento)->get();
        $descipcionNavegacion=DescripcionNavegacion::find($permisoZarpe->descripcion_navegacion_id);
        $capitaniaOrigen=Capitania::find($establecimiento);
        if (empty($permisoZarpe)) {
            Flash::error('Permiso Zarpe not found');

            return redirect(route('permisoZarpes.index'));
        }

        return view('zarpes.permiso_zarpe.show')
            ->with('permisoZarpe', $permisoZarpe)
            ->with('buque',$buque)
            ->with('certificados', $validacionSgm)
            ->with('tripulantes', $tripulantes2)
            ->with('pasajeros', $pasajeros)
            ->with('equipos', $equipos)
            ->with('revisiones', $revisiones)
            ->with('capitania', $capitania_user)
            ->with('comodoro', $establecimiento_user)
            ->with('descripcionNavegacion', $descipcionNavegacion)
            ->with('establecimientoDestino', $establecimiento_destino)
            ->with('capitaniaOrigen', $capitaniaOrigen[0]);
    }

    public function SendMail($idsolicitud, $tipo)
    {
        $solicitud = PermisoZarpe::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);

        $capitanDestino = CapitaniaUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->destino_capitania_id)
            ->get();

        $estNautico = EstablecimientoNautico::find($solicitud->establecimiento_nautico_id);


        $capitanOrigen = CapitaniaUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $estNautico->capitania_id)
            ->get();

        if ($tipo == 1 && count($capitanOrigen) > 0) {
            //mensaje para caitania origen
            $mensaje = "El Sistema de control y Gestión de Zarpes del INEA le notifica que ha recibido una
    nueva solicitud de permiso de zarpe en su jurisdicción que espera por su aprobación.";
            $mailTo = $capitanOrigen[0]->email;
            $subject = 'Nueva solicitud de permiso de Zarpe ' . $solicitud->nro_solicitud;

            $email = new MailController();
            $data = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->matricula,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'fecha_salida' => $solicitud->fecha_hora_salida,
                'fecha_regreso' => $solicitud->fecha_hora_regreso,
                'mensaje' => $mensaje,

            ];
            $view = 'emails.zarpes.solicitudPermisoZarpe';

            $email->mailZarpe($mailTo, $subject, $data, $view);
            $return = true;

        } else if (count($capitanDestino) > 0) {
            //mensaje para capitania destino
            $mensaje = "El Sistema de Control y Gestión de Zarpes del INEA le notifica que
    la siguiente embarcación está próxima a arribar a su jurisdicción.";
            $mailTo = $capitanDestino[0]->email;
            $subject = 'Notificación de arribo de embarcación ' . $solicitud->matricula;

            $email = new MailController();
            $data = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->matricula,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'fecha_salida' => $solicitud->fecha_hora_salida,
                'fecha_regreso' => $solicitud->fecha_hora_regreso,
                'mensaje' => $mensaje,

            ];
            $view = 'emails.zarpes.solicitudPermisoZarpe';

            $email->mailZarpe($mailTo, $subject, $data, $view);
            $return = true;
        } else {
            $return = false;

        }
        return $return;
    }


    public function validacionJerarquizacion($doc, $cap)
    {
        $capitan = $cap;
        $documento = $doc;
        $return = false;
        $validacion = json_decode(session('validacion'), true);

        switch ($documento) {
            case 'Capitán de Altura':
                $return = [true, $documento];

                break;
            case 'Primer Oficial de Navegación':
                if ($validacion['UAB'] <= 3000) {
                    $return = [true];
                } else {
                    $return = [false];
                }

                break;
            case 'Segundo Oficial de Navegación':
                if ($validacion['UAB'] <= 500) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Capitán de Yate':
                if ($validacion['UAB'] <= 300) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Capitán Costanero':
                $coordenadas = [];
                if ($validacion['UAB'] <= 3000) {
                    $return = [true, $coordenadas];
                } else {
                    $return = [false, $coordenadas];
                }
                break;
            case 'Patrón de Primera':
                $coordenadas = [];
                if ($validacion['UAB'] <= 500) {
                    $return = [true, $coordenadas];
                } else {
                    $return = [false, $coordenadas];
                }
                break;
            case 'Patrón Deportivo de Primera':
                $coordenadas = [];
                if ($validacion['UAB'] <= 150) {
                    $return = [true, $coordenadas];
                } else {
                    $return = [false, $coordenadas];
                }
                break;
            case 'Patrón de Segunda':
                $coordenadas = [];
                if ($validacion['UAB'] <= 500 && $validacion['eslora'] < 24) {
                    $return = [true, $coordenadas, 1];//validacion, coordenadas, cantidad de jurisdicciones que puede visitar
                } else {
                    $return = [false, $coordenadas, 1];
                }
                break;
            case 'Patrón Deportivo de Segunda':
                if ($validacion['UAB'] <= 40) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Patrón Deportivo de Tercera':
                if ($validacion['UAB'] <= 10) {
                    $return = [true];
                } else {
                    $return = [false];
                }
                break;
            case 'Tercer Oficial de Navegación':

                if ($capitan == "SI") {
                    $return = [false];
                } else {

                    $return = [true];

                }

                break;
            case 'Capitán de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {

                    $return = [true];

                }
                break;
            case 'Oficial de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    $return = [true];
                }
                break;
            case 'Patrón Artesanal':
                if ($capitan == "NO") {
                    if ($validacion['eslora'] <= 24) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                } else {
                    $return = [false];
                }


                break;
            case 'Jefe de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    $return = [true];
                }

                break;
            case 'Primer Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 3000) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Segundo Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 3000) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Motorista de Primera':
                $coordenadas = [];
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 2237) {
                        $return = [true, $coordenadas];
                    } else {
                        $return = [false, $coordenadas];
                    }
                    $return = [true];

                }

                break;
            case 'Motorista de Segunda':
                $coordenadas = [];
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 560) {
                        $return = [true, $coordenadas];
                    } else {
                        $return = [false, $coordenadas];
                    }
                    $return = [true];

                }

                break;
            case 'Jefe de Máquinas de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 560) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Tercer Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 350) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;
            case 'Oficial de Máquinas de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if ($validacion['potencia_kw'] <= 560) {
                        $return = [true];
                    } else {
                        $return = [false];
                    }
                    $return = [true];

                }

                break;

            default:
                $return = [false];
                break;
        }
        return $return;
    }


    public function limpiarVariablesSession()
    {
        Session::forget('pasajeros');
        Session::forget('tripulantes');
        Session::forget('validacion');
        Session::forget('solicitud');
        $this->step = 1;
    }


    public function BuscaEstablecimientosNauticos(Request $request)
    {
        $idcap = $_REQUEST['idcap'];
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $idcap)->get();
        $cap = Capitania::find($idcap);
        $resp = [$cap, $EstNauticos];
        echo json_encode($resp);
    }

    public function FindCapitania(Request $request)
    {
        $descripcion = $_REQUEST['descripcion_de_navegacion'];

        if ($descripcion == 2) {
            $CapDependencias = DependenciaFederal::selectRaw('distinct(capitania_id)')->get();
            $capitania = Capitania::whereIn('id', $CapDependencias)->get();
        } else {
            $capitania = Capitania::all();
        }
        echo json_encode($capitania);
    }


public function AddDocumentos(Request $request){
    $file = $request->file('partida_nacimiento');
  // dd($file);
    $partida_nacimiento='';
        if ($request->hasFile('partida_nacimiento')) {

                $partida = $request->file('partida_nacimiento');
                $filename = date('dmYGi') . $partida->getClientOriginalName();
                $avatar1 = $partida->move(public_path() . '/documentos/permisozarpe', $filename);
                 $partida_nacimiento=$filename;


        }

        $autorizacion='';
        if ($request->hasFile('autorizacion')) {

                $autorizacion = $request->file('autorizacion');
                $filenameaut= date('dmYGi') . $autorizacion->getClientOriginalName();
                $avatar1 = $autorizacion->move(public_path() . '/documentos/permisozarpe', $filenameaut);
                $autorizacion=$filenameaut;
        }

    $pasaporte_menor='';
    if ($request->hasFile('pasaporte_menor')) {

        $pasaporte_menor = $request->file('pasaporte_menor');
        $filenamepasp= date('dmYGi') . $pasaporte_menor->getClientOriginalName();
        $avatar1 = $pasaporte_menor->move(public_path() . '/documentos/permisozarpe', $filenamepasp);
        $pasaporte_menor=$filenamepasp;
    }

    $pasaporte_mayor='';
    if ($request->hasFile('pasaporte_mayor')) {

        $pasaporte_mayor = $request->file('pasaporte_mayor');
        $filenamepaspmay= date('dmYGi') . $pasaporte_mayor->getClientOriginalName();
        $avatar1 = $pasaporte_mayor->move(public_path() . '/documentos/permisozarpe', $filenamepaspmay);
        $pasaporte_mayor=$filenamepaspmay;
    }

         echo json_encode(['OK',$partida_nacimiento,$autorizacion,$pasaporte_menor,$pasaporte_mayor]);
}

    public function AddPassenger(Request $request){
        $pasajeros = $request->session()->get('pasajeros');
        $validation = json_decode($request->session()->get('validacion'), true);
         $tripulantes=$request->session()->get('tripulantes');
        $cantPasajeros = $validation['cant_pasajeros'] - count($tripulantes);
        $indice="";

           if ($_REQUEST['menor'] == "SI") {
                $menor = true;
            } else {
                $menor = false;
            }




            $HijoNumero=1;
            if(is_array($pasajeros)){
                for ($i=0; $i < count($pasajeros); $i++) {
                   // $indice=array_search($_REQUEST['nrodoc'], $pasajeros[$i], false)
                    if($pasajeros[$i]['nro_doc']==$_REQUEST['nrodoc'] && $_REQUEST['representante']!=$_REQUEST['nrodoc']){
                        $indice=true;
                    }

                    if($pasajeros[$i]['representante']==$_REQUEST['representante']){
                       $HijoNumero++;
                    }
                }

            }else{
                $indice=false;
                $pasajeros=[];
            }


            if($_REQUEST['representante']==''){
                $respresentante="N/A";
            }else{
                $respresentante=$_REQUEST['representante'];
            }

            if($_REQUEST['tipodoc']=="NC"){
                $nrodoc=$_REQUEST['nrodoc']."-".$HijoNumero;
            }else{
                $nrodoc=$_REQUEST['nrodoc'];
            }




        $pass = [
            "nombres" => $_REQUEST['nombres'],
            "apellidos" => $_REQUEST['apellidos'],
            "tipo_doc" => $_REQUEST['tipodoc'],
            "nro_doc" => $nrodoc,
            "sexo" =>$_REQUEST['sexo'],
            "fecha_nacimiento" =>$_REQUEST['fechanac'],
            "menor_edad" =>$menor,
            "representante" =>$respresentante,
            "permiso_zarpe_id" => '',
            "partida_nacimiento"=> $_REQUEST['partida_nacimiento'],
            "autorizacion"=> $_REQUEST['autorizacion'],
            "pasaporte_menor"=> $_REQUEST['pasaporte_menor'],
            "pasaporte_mayor"=> $_REQUEST['pasaporte_mayor']
        ];



        if($indice==false ){
            if(count($pasajeros) <= $cantPasajeros-1){
                array_push($pasajeros, $pass);
                $request->session()->put('pasajeros', $pasajeros);
                $info="OK";
                $cantPasajeros=$cantPasajeros-count($pasajeros);
                $validation['cantPassAbordo']=$cantPasajeros;
                $request->session()->put('validacion', json_encode($validation));
            }else{
                $info = "MaxPassengerLimit";
            }

        }else{
            $info="ExistInPassengerList";

        }

        $resp=[$info,$pass,$cantPasajeros,$HijoNumero, $nrodoc, $_REQUEST['nrodoc']];
        echo json_encode($resp);

    }



}
