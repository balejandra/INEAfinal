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
use App\Models\Zarpes\TripulanteInternacionals;
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
use App\Models\Publico\Paise;


use Flash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ZarpeInternacionalController extends Controller
{
    private $step;

    public function __construct()
    {
        $this->step = 1;
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('listar-zarpes-todos')) {
            $data = PermisoZarpe::where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-generados')) {
            $user = auth()->id();
            $data = PermisoZarpe::where('user_id', $user)->where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-capitania-origen')) {
            $user = auth()->id();
            $capitania = CapitaniaUser::select('capitania_id')->where('user_id', $user)->get();
            $datazarpedestino = PermisoZarpe::whereIn('destino_capitania_id', $capitania)->where('descripcion_navegacion_id', 4)->get();
            $establecimiento = EstablecimientoNautico::select('id')->whereIn('capitania_id', $capitania)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->where('descripcion_navegacion_id', 4)->get();
            return view('zarpes.zarpe_internacional.indexcapitan')
                ->with('permisoOrigenZarpes', $datazarpeorigen)
                ->with('permisoDestinoZarpes', $datazarpedestino);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-establecimiento-origen')) {
            $user = auth()->id();
            $establecimiento = EstablecimientoNauticoUser::select('establecimiento_nautico_id')->where('user_id', $user)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->where('descripcion_navegacion_id', 4)->get();

            return view('zarpes.zarpe_internacional.indexcomodoro')
                ->with('permisoOrigenZarpes', $datazarpeorigen);
        } else {
            return redirect(route('home'));
        }
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('stepName', "Matrícula");
        $request->session()->put('matriculasPermisadas', ['']);

        $request->session()->put('pasajeros',  '');
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
            "descripcion_navegacion_id" => 4,
            "establecimiento_nautico_id" => '',
            "origen_capitania_id" => '',
            "fecha_hora_salida" => '',
            "fecha_hora_regreso" => '',
            "status_id" => 3,
            "permiso_estadia_id" => '',
            "paises_id" => '',

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
        
        return view('zarpes.zarpe_internacional.create-step-one')->with('paso', $this->step);
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
            return redirect()->route('zarpeInternacional.CreateStepTwo')->with('paso', $this->step);
        } else {
            return redirect()->route('zarpeInternacional.CreateStepTwoE')->with('paso', $this->step);

        }

    }


    public function createStepTwo(Request $request)
    {

        $this->step = 2;
        $solicitud= json_decode(session('solicitud'));
        $siglas=Capitania::all();
        if($solicitud->matricula==""){
            $matriculaActual=['','',''];
        }else{
            $matriculaActual=explode('-',$solicitud->matricula);
        }
        
        return view('zarpes.zarpe_internacional.nacional.create-step-two')->with('paso', $this->step)->with('stepName', "Matrícula")->with("siglas", $siglas)->with("matriculaActual", $matriculaActual);

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
            return view('zarpes.zarpe_internacional.nacional.create-step-two')->with('paso', 2);
        }

        $tabla = new TablaMando();
        $mando = $tabla->where([
            ['UAB_minimo', '<', $UAB],
            ['UAB_maximo', '>=', $UAB]
        ])->get()->toArray();
        if(count($mando)==0){
            Flash::error('No se ha podido comparar las especificaciones de la embarcación ('.$matricula.') respecto a la tabla de mandos actual, comuniquese con el administrador del sitema.');
            return view('zarpes.zarpe_internacional.nacional.create-step-two')->with('paso', 2);
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
            return redirect()->route('zarpeInternacional.createStepThree');
        }
        

    }


    public function createStepTwoE(Request $request)
    {
        // $this->SendMail(42,1);

        $this->step = 2;

        return view('zarpes.zarpe_internacional.extranjera.create-step-two')->with('paso', $this->step);

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

        return redirect()->route('zarpeInternacional.createStepThree');

    }


    public function createStepThree(Request $request)
    {
        $solicitud= json_decode(session('solicitud'));
         
        $capitania = Capitania::all();

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $bandera = $solicitud['bandera'];
        $TipoZarpes = TipoZarpe::all();
        //$capitania = Capitania::all();
       // $descripcionNavegacion = DescripcionNavegacion::all();

        $this->step = 3;

        return view('zarpes.zarpe_internacional.create-step-three')->with('paso', $this->step)->with('TipoZarpes', $TipoZarpes)->with('capitanias', $capitania)->with('bandera', $bandera);

    }

    public function permissionCreateStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_de_navegacion' => 'required',
            'capitania' => 'required',

        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['tipo_zarpe_id'] = $request->input('tipo_de_navegacion', []);
        $solicitud['origen_capitania_id'] = $request->input('capitania', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        // print_r($solicitud);
        $this->step = 4;

        return redirect()->route('zarpeInternacional.createStepFour');

    }

    public function createStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $EstNauticos = EstablecimientoNautico::where('capitania_id', $solicitud['origen_capitania_id'])->get();
        $paises= Paise::all();
        
        $this->step = 4;
        return view('zarpes.zarpe_internacional.create-step-four')->with('paso', $this->step)->with('EstNauticos', $EstNauticos)->with('paises', $paises);

    }

    public function permissionCreateStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);

         
            $validatedData = $request->validate([
                'establecimientoNáuticoOrigen' => 'required',
                'salida' => 'required',
                'llegada' => 'required',
                'país_de_destino' => 'required'
                
            ]);
         

        $solicitud['establecimiento_nautico_id'] = $request->input('establecimientoNáuticoOrigen');
        $solicitud['fecha_hora_salida'] = $request->input('salida');
        $solicitud['fecha_hora_regreso'] = $request->input('llegada');
        $solicitud['paises_id'] = intval($request->input('país_de_destino'));
        
        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step = 5;
        return redirect()->route('zarpeInternacional.createStepFive');
    }


    public function createStepFive(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
      
        $codigo = $this->codigo($solicitud);

        $validation = json_decode($request->session()->get('validacion'), true);
        $tripulantes = $request->session()->get('tripulantes');

        $this->step = 5;
        return view('zarpes.zarpe_internacional.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('codigo', $codigo);

    }

    public function permissionCreateStepFive(Request $request)
    {

        $request->session()->put('tripulantes', [0]);
        $trip = [
            "permiso_zarpes_id" => '',
            "nombres" => '',
            "apellidos" => '',
            "tipo_doc" => '',
            "nro_doc" => '',
            "rango" => '',
            "funcion" => '',
            "doc" => ''
        ];
        $ctrldocumento = $request->input('ids', []);
        $cap = $request->input('capitan', []);
        $nombre = $request->input('nombre', []);
        $cedula = $request->input('cedula', []);
        $fecha_vencimiento = $request->input('fechaVence', []);
        $fecha_emision = $request->input('fechaEmision', []);
        $documento = $request->input('documento', []);


        $tripulantes = $request->session()->get('tripulantes');
        $validation = json_decode($request->session()->get('validacion'), true);

        if (isset($ctrldocumento) && count($ctrldocumento) == $validation['cant_tripulantes']) {

            for ($i = 0; $i < count($ctrldocumento); $i++) {
                $trip["ctrl_documento_id"] = $ctrldocumento[$i];

                if ($cap[$i] == "SI") {
                    $trip["capitan"] = true;
                } else {
                    $trip["capitan"] = false;
                }

                $trip["nombre"] = $nombre[$i];
                $trip["cedula"] = $cedula[$i];
                $trip["fecha_vencimiento"] = $fecha_vencimiento[$i];
                $trip["fecha_emision"] = $fecha_emision[$i];
                $trip["documento"] = $documento[$i];

                $tripulantes[$i] = $trip;
            }

            $request->session()->put('tripulantes', $tripulantes);
            //$tr = json_decode($request->session()->get('tripulantes'), true);
            $this->step = 6;
            return redirect()->route('zarpeInternacional.createStepSix');
        } else {
            $this->step = 5;

            $mensj = "Los tripulantes de la embarcación son requeridos (cantidad de tripulantes " . $validation['cant_tripulantes'] . "), por favor verifique.";

            return view('zarpes.zarpe_internacional.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj);

        }
    }

    public function createStepSix(Request $request)
    {
        
        $passengers = $request->session()->get('pasajeros');
        $validation = json_decode($request->session()->get('validacion'), true);
        $cantPasajeros = $validation['cant_pasajeros'] - $validation['cant_tripulantes'];
        $this->step = 6;
        return view('zarpes.zarpe_internacional.create-step-six')->with('paso', $this->step)->with('passengers', $passengers)->with('cantPasajeros', $cantPasajeros);

    }

    public function permissionCreateStepSix(Request $request)
    {
        $request->session()->put('pasajeros', [0]);
        $pass = [
            "nombres" => '',
            "apellidos" => '',
            "tipo_doc" => '',
            "nro_doc" => '',
            "sexo" => '',
            "fecha_nacimiento" => '',
            "menor_edad" => '',
            "zarpe_internacional_id" => '',
        ];
        // $request->session()->put('pasajeros', {[]});
        $passengers = $request->session()->get('pasajeros');

        $nombres = $request->input('nombres', []);
        $apellidos = $request->input('apellidos', []);
        $tipodoc = $request->input('tipodoc', []);
        $sexo = $request->input('sexo', []);
        $menor = $request->input('menor', []);
        $fechanac = $request->input('fechanac', []);
        $nrodoc = $request->input('nrodoc', []);

        for ($i = 0; $i < count($nrodoc); $i++) {
            $pass["nombres"] = $nombres[$i];
            $pass["apellidos"] = $apellidos[$i];
            $pass["tipo_doc"] = $tipodoc[$i];
            $pass["sexo"] = $sexo[$i];
            $pass["fecha_nacimiento"] = $fechanac[$i];
            $pass["nro_doc"] = $nrodoc[$i];
            if ($menor[$i] == "SI") {
                $pass["menor_edad"] = true;
            } else {
                $pass["menor_edad"] = false;
            }
            $passengers[$i] = $pass;
        }

        $request->session()->put('pasajeros', $passengers);
        $this->step = 7;
        return redirect()->route('zarpeInternacional.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $equipos = Equipo::all();
        //  dd($equipos);
        $this->step = 7;
        return view('zarpes.zarpe_internacional.create-step-seven')
            ->with('paso', $this->step)
            ->with('equipos', $equipos);

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
            

            $codigo = $this->codigo($solicitud);

            $solicitud['nro_solicitud'] = $codigo;
            
            $saveSolicitud = PermisoZarpe::create($solicitud);
            
            $tripulantes = $request->session()->get('tripulantes');
            for ($i = 0; $i < count($tripulantes); $i++) {
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
            return redirect()->route('zarpeInternacional.index');
        }


    }

    public function consulta2(Request $request)
    {
        $cedula = $_REQUEST['cedula'];
        $fecha = $_REQUEST['fecha'];
        $sexo = $_REQUEST['sexo'];

        $newDate = date("d/m/Y", strtotime($fecha));
        $newDate2 = date("d-m-Y", strtotime($fecha));
        $newDate3 = date("Y-d-m", strtotime($fecha));
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

                    $marinoAsignado = PermisoZarpe::select('zarpe_internacionals.status_id', 'ctrl_documento_id')
                        ->Join('tripulantes', 'zarpe_internacionals.id', '=', 'tripulantes.zarpe_internacional_id')
                        ->where('tripulantes.ctrl_documento_id', '=', $data2[0]->id)
                        ->whereIn('zarpe_internacionals.status_id', [1, 3, 5])
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

     public function validacionMarinoZI(Request $request){
        $cedula=$_REQUEST['nrodoc'];
        $funcion=$_REQUEST['funcion'];
        $doc=$_REQUEST['doc'];

        $vj = [];
        $indice=false;
        $tripulantes = $request->session()->get('tripulantes');
        $capitanExiste=false;
         dd($tripulantes);
        switch ($funcion) {
            case 'Capitán':
                 $cap="SI";
                 if(is_array($tripulantes) && count($tripulantes)>0){
                    foreach ($tripulantes as $value) {
                        print_r($value);
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
            /*$trip = [
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
            ];*/

            $trip=[
                "permiso_zarpe_id" => '',
                "nombres" => $InfoMarino[0]->nombre,
                "apellidos" =>  $InfoMarino[0]->apellido,
                "tipo_doc" => 'V',
                "nro_doc" => $InfoMarino[0]->ci,
                "funcion" => $funcion,
                "rango" =>$InfoMarino[0]->documento,
                "doc" => $doc,
                 
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


    public function marinoExtranjeroZI(Request $request){
        $cedula=$_REQUEST['nrodoc'];
        $funcion=$_REQUEST['funcion'];
        $vj = [];
        $indice=false;
        $tripulantes = $request->session()->get('tripulantes');
        $validation = json_decode($request->session()->get('validacion'), true);
        $capitanExiste=false;
        switch ($funcion) {
            case 'Capitán':
                 $cap="SI";
                 if(is_array($tripulantes) && count($tripulantes)>0){
                    foreach ($tripulantes as $value) {
                     //   print_r($value);
                        if($value['funcion']=='Capitán'){
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

            $nrodoc=$_REQUEST['nrodoc'];
            $tipodoc=$_REQUEST['tipodoc'];
            $nombres=$_REQUEST['nombres'];
            $apellidos=$_REQUEST['apellidos'];
            $funcion=$_REQUEST['funcion'];
            $rango=$_REQUEST['rango'];
            $doc=$_REQUEST['doc'];

                $trip=[
                "permiso_zarpe_id" => '',
                "nombres" =>$nombres,
                "apellidos" =>$apellidos,
                "tipo_doc" => 'P',
                "nro_doc" =>  $nrodoc,
                "funcion" => $funcion,
                "rango" =>$rango,
                "doc" => $doc,
                 
                ];

            $tripExiste=false;

            if(is_array($tripulantes)){
                foreach ($tripulantes as $value) {
                    
                    if($value['nro_doc']==$nrodoc){
                       $tripExiste=true;
                    }
                }
                if ($tripExiste) {
                    $InfoMarino = "TripulanteExiste";
                }else{
                        if(count($tripulantes) <= $validation['cant_pasajeros']-1){
                            array_push($tripulantes, $trip);
                            $request->session()->put('tripulantes', $tripulantes);
                             $InfoMarino = "OK";
                        }else{
                            $InfoMarino = "FoundButMaxTripulationLimit";
                        }

                }
                
            }else{
                $tripulantes=[];
                array_push($tripulantes, $trip);
                $request->session()->put('tripulantes', $tripulantes);
                 $InfoMarino = "OK";
            }
            

             $return = [$tripulantes, '', '',$InfoMarino, $validation['cant_pasajeros']];
            echo json_encode($return);

        }


    }

    public function deleteTripulanteZI(Request $request){
        $cedula=$_REQUEST['index'];
        $borrado=false;
        $tripulantes = $request->session()->get('tripulantes');
        if(is_array($tripulantes)){
            for ($i=0; $i < count($tripulantes); $i++) {
                $indice=array_search($cedula,$tripulantes[$i],false);
                if($indice!=false){
                    array_splice($tripulantes, $i, $i);
                    $request->session()->put('tripulantes', $tripulantes);
                    $borrado =true;
                }
            }
        }
        echo $borrado;
    }

    private function codigo($solicitud)
    {
        $ano = date('Y');
        $mes = date('m');
        $internacional="I";
        $estNautico = EstablecimientoNautico::find($solicitud['establecimiento_nautico_id']);
        $capitania = Capitania::find($estNautico->capitania_id);
        $idcap=$capitania->id;
    
        $cantidadActual = PermisoZarpe::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud, 8, 4) = '" . $ano . "')"), '=', true)
            ->where("permiso_zarpes.descripcion_navegacion_id", '=', 4)
            ->Join('establecimiento_nauticos', function ($join) use ($idcap) {
                $join->on('permiso_zarpes.establecimiento_nautico_id', '=', 'establecimiento_nauticos.id')
                    ->where('establecimiento_nauticos.capitania_id', '=',  $idcap);
            })
            ->get();
        
        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" .$internacional. "-" . $ano . $mes . "-" . $correlativo;

        return $codigo;
    }


    public function updateStatus($id, $status, $establecimiento)
    {
        $transaccion = PermisoZarpe::find($id);
        $capitania= Capitania::where('id',$transaccion->establecimiento_nautico->capitania_id)->first();
        //$estnauticoDestino=EstablecimientoNautico::find($transaccion->establecimiento_nautico_destino_id);
        $pais=Paise::find($transaccion->paises_id);
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
                'destino' => $pais->name,
                'matricula' => $transaccion->matricula,
                'mensaje'=>$mensaje,
            ];
            $view = 'emails.zarpes.revision';
            $subject = 'Solicitud de permiso de Zarpe ' . $transaccion->nro_solicitud;
            $email->mailZarpePDFZI($solicitante->email, $subject, $data, $view);

            Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
            return redirect(route('zarpeInternacional.index'));

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
                'destino' => $pais->name,
                'matricula' => $transaccion->matricula,
                'motivo'=>$motivo,
                'mensaje'=>$mensaje
            ];
            $view = 'emails.zarpes.revision';
            $subject = 'Solicitud de Zarpe Internacional ' . $transaccion->nro_solicitud;
            $email->mailZarpe($solicitante->email, $subject, $data, $view);

            Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
            return redirect(route('zarpeInternacional.index'));

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
            return redirect(route('zarpeInternacional.index'));

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
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'cerrado') {
            $transaccion = PermisoZarpe::find($id);
            $idstatus = Status::find(4);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();

            Flash::info('Solicitud de Zarpe Cerrada.');
            return redirect(route('zarpeInternacional.index'));

        } elseif ($status === 'anular-usuario') {
            $zarpe = PermisoZarpe::find($id);
            $idstatus = Status::find(6);
            $zarpe->status_id = $idstatus->id;
            $zarpe->update();

            ZarpeRevision::create([
                'user_id' => auth()->user()->id,
                'permiso_zarpe_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Anulada por el Usuario Solicitante'
            ]);
            Flash::error('Solicitud Anulada.');
            return redirect(route('zarpeInternacional.index'));
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
        $tripulantes = Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id', $id)->get();
        $pasajeros = $permisoZarpe->pasajeros()->where('permiso_zarpe_id', $id)->get();
        $tripulantes2 = LicenciasTitulosGmar::whereIn('id', $tripulantes)->get();
        $equipos = EquipoPermisoZarpe::where('permiso_zarpe_id', $id)->get();
        $revisiones = ZarpeRevision::where('permiso_zarpe_id', $id)->get();
        $paises= Paise::where('id', $permisoZarpe->paises_id)->get();

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
            return redirect(route('zarpeInternacional.index'));
        }

        return view('zarpes.zarpe_internacional.show')
            ->with('permisoZarpe', $permisoZarpe)
            ->with('tripulantes', $tripulantes2)
            ->with('pasajeros', $pasajeros)
            ->with('equipos', $equipos)
            ->with('revisiones', $revisiones)
            ->with('capitania', $capitania_user)
            ->with('comodoro', $establecimiento_user)
            ->with('descripcionNavegacion', $descipcionNavegacion)
            ->with('establecimientoDestino', $establecimiento_destino)
            ->with('capitaniaOrigen', $capitaniaOrigen[0])
            ->with('pais',$paises);
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
            $subject = 'Nueva solicitud de permiso de Zarpe Internacional ' . $solicitud->nro_solicitud;

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


}