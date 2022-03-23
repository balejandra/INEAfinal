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
            $data = PermisoZarpe::all();
            return view('zarpes.permiso_zarpe.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-generados')) {
            $user = auth()->id();
            $data = PermisoZarpe::where('user_id', $user)->get();
            return view('zarpes.permiso_zarpe.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-capitania-origen')) {
            $user = auth()->id();
            $capitania = CapitaniaUser::select('capitania_id')->where('user_id', $user)->get();
            $datazarpedestino = PermisoZarpe::whereIn('destino_capitania_id', $capitania)->get();

            $establecimiento = EstablecimientoNautico::select('id')->whereIn('capitania_id', $capitania)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->get();
            return view('zarpes.permiso_zarpe.indexcapitan')
                ->with('permisoOrigenZarpes', $datazarpeorigen)
                ->with('permisoDestinoZarpes', $datazarpedestino);
        } elseif (auth()->user()->hasPermissionTo('listar-zarpes-establecimiento-origen')) {
            $user = auth()->id();
            $establecimiento = EstablecimientoNauticoUser::select('establecimiento_nautico_id')->where('user_id', $user)->get();
            $datazarpeorigen = PermisoZarpe::whereIn('establecimiento_nautico_id', $establecimiento)->get();

            return view('zarpes.permiso_zarpe.indexcomodoro')
                ->with('permisoOrigenZarpes', $datazarpeorigen);
        } else{
            return redirect(route(home));
        }
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('stepName', "Matrícula");
        $request->session()->put('matriculasPermisadas', ['']);

        $request->session()->put('pasajeros', ['']);
        $request->session()->put('tripulantes', [0]);
        $request->session()->put('validacion', '');
        $request->session()->put('validacionesSgm', '');


        $solicitud=json_encode([
            "user_id"=> auth()->id(),
            "nro_solicitud"=> '',
            "bandera"=> '',
            "matricula"=> '',
            "tipo_zarpe_id"=> '',
            "descripcion_navegacion_id"=> '',
            "establecimiento_nautico_id"=> '',
            "establecimiento_nautico_destino_id"=> '',
            "coordenadas"=> '',
            "destino_capitania_id"=> '',
            "origen_capitania_id"=> '',
            "fecha_hora_salida"=> '',
            "fecha_hora_regreso"=> '',
            "status_id"=> 3,
            "permiso_estadias_id"=> '',
        ]);

        $valida = [
            "UAB" => ' ',
            "cant_tripulantes" => ' ',
            "cant_pasajeros" => ' ',
            "potencia_kw" => '',
            "cargos" => [
                "cargo_desempena" => '',
                "titulacion_aceptada_minima" => '',
                "titulacion_aceptada_maxima" => ''
            ]
        ];

        $request->session()->put('validacion', $valida);

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

        if($solicitud['bandera']=='nacional'){
            $request->session()->put('stepName', "Matrícula");
        }else{
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

        $this->step = 2;

        return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', $this->step)->with('stepName', "Matrícula");

    }

    public function validationStepTwo(Request $request)
    {
        $matricula = $_REQUEST['matricula'];
        $user = User::find(auth()->id());

        $permisoZ = PermisoZarpe::select("matricula")->where('user_id', auth()->id())->where('matricula', $matricula)->whereIn('status_id', [1, 3, 5])->get();

        $data = Renave_data::where('matricula_actual', $matricula)->where('numero_identificacion', $user->numero_identificacion)->get();


        if (is_null($data->first())) {
            /*$exception ='Error en consulta';
            $data = response()->json([
                'status' => 3,
                'msg' => $exception->getMessage(),
                'errors' => [],
            ], 200);*/
            echo "sinCoincidencias";
        } else {

            if (count($permisoZ) > 0) {
                echo 'permisoPorCerrar';
            } else {


            $validacionSgm=TiposCertificado::select('*')->where('matricula', $matricula)->get();
               $val1="LICENCIA DE NAVEGACIÓN no encontrada";
               $val2="CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA no encontrado";
               //$val3="ASIGNACIÓN DE NÚMERO ISMM no encontrado";
               $val3=true;
                $data2=[
                        "data"=>$data,
                        "validacionSgm"=>[$val1,$val2,$val3] ,
                    ];

                if(count($validacionSgm) > 0){

                    $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
                    for ($i=0; $i < count($validacionSgm); $i++) {

                        switch($validacionSgm[$i]->nombre_certificado){
                            case "LICENCIA DE NAVEGACIÓN":
                                $fecha=$validacionSgm[$i]->fecha_vencimiento;
                                list($dia, $mes, $ano) = explode("/", $fecha);
                                $fecha_vence=$ano."-".$mes."-".$dia." 00:00:00";
                                $fecha_vence1 = strtotime($fecha_vence);
                                if(($fecha_actual > $fecha_vence1)){
                                     $val1="LICENCIA DE NAVEGACIÓN vencida"; //encontrado pero vencido
                                }else{
                                    $val1=true;

                                    $valida=$request->session()->get('validacion');
                                    $valida["potencia_kw"]=$validacionSgm[$i]->potencia_kw;
                                    $valida["cant_pasajeros"]=$validacionSgm[$i]->capacidad_personas;
                                    $request->session()->put('validacion', $valida);


                                }
                            break;
                            case "CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA":
                                    $fecha=$validacionSgm[$i]->fecha_vencimiento;
                                    list($dia, $mes, $ano) = explode("/", $fecha);
                                    $fecha_vence=$ano."-".$mes."-".$dia." 00:00:00";
                                    $fecha_vence1 = strtotime($fecha_vence);

                                    if(($fecha_actual > $fecha_vence1)){
                                        $val2="CERTIFICADO NACIONAL DE SEGURIDAD RADIOTELEFONICA vencido."; //encontrado pero vencido
                                    }else{
                                        $val2=true;
                                    }
                            break;
                            case "ASIGNACIÓN DE NÚMERO ISMM":
                                $val3=true;
                            break;
                        }



                    }



                    $data2=[
                        "data"=>$data,
                        "validacionSgm"=>[$val1,$val2,$val3] ,
                    ];
                    echo json_encode($data2);
                }else{
                    echo "noEncontradoSgm";
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
        $validation = $request->session()->get('validacion');
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
            ['UAB_maximo', '>', $UAB]
        ])->get()->toArray();
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
        $request->session()->put('solicitud', json_encode($solicitud));
        // dd($solicitud);
        return redirect()->route('permisoszarpes.createStepThree');

    }


    public function createStepTwoE(Request $request)
    {
       // $this->SendMail(42,1);

        $this->step=2;

        return view('zarpes.permiso_zarpe.extranjera.create-step-two')->with('paso', $this->step);

    }

    public function validationStepTwoE(Request $request){
        $permiso = $_REQUEST['permiso'];
        
        $permisoEstadia= PermisoEstadia::where('user_id', auth()->id())->where('nro_solicitud', $permiso)->where('status_id', 1)->get();

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
        $permiso=$request->input('permiso');
        $validatedData = $request->validate([
            'permiso' => 'required',
            'permiso_de_estadia'=> 'required',
            'numero_de_registro'=> 'required',
        ]);
        $idpermiso = $_REQUEST['permiso_de_estadia'];
        $matricula = $_REQUEST['numero_de_registro'];

        $permisoEstadia= PermisoEstadia::where('user_id', auth()->id())->where('nro_solicitud', $permiso)->where('status_id', 1)->get();
         
        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['matricula'] = $matricula;
        $solicitud['permiso_estadias_id'] =$idpermiso;
        $request->session()->put('solicitud', json_encode($solicitud));
        $valida= $request->session()->get('validacion');

        $valida["cant_tripulantes"]=$permisoEstadia[0]->cant_tripulantes;
        $valida["cant_pasajeros"]=$permisoEstadia[0]->cant_pasajeros;
        $valida["potencia_kw"]=$permisoEstadia[0]->potencia_kw;


        $valida["UAB"]=$permisoEstadia[0]->arqueo_bruto;
        $request->session()->put('validacion', json_encode($valida));

        return redirect()->route('permisoszarpes.createStepThree');

    }


    public function createStepThree(Request $request)
    {

      
        $TipoZarpes = TipoZarpe::all();
        $capitania=Capitania::all();

        $this->step=3;

        return view('zarpes.permiso_zarpe.create-step-three')->with('paso', $this->step)->with('TipoZarpes', $TipoZarpes)->with('capitanias', $capitania);

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
        $EstNauticos = EstablecimientoNautico::where('capitania_id',$solicitud['origen_capitania_id'])->get();
         $coordenadas=[];
         $arr=["capitania"=> 0,"coords"=> [] ];

         switch ($solicitud['descripcion_navegacion_id']) {
            case 1: //dentro de una circunscripción
               $coordCaps=CoordenadasCapitania::where('capitania_id',$solicitud['origen_capitania_id'])->get();
            break;
            case 2://Dentro de una circunscripcion pero a una dependencia federal
                $coordCaps=CoordenadasCapitania::where('capitania_id',$solicitud['origen_capitania_id'])->get();
            break;
            case 3: // entre circunsctipciones
                //$coordCaps=CoordenadasCapitania::all();
                 $coordCaps=CoordenadasCapitania::where('capitania_id','!=',$solicitud['origen_capitania_id'])->get();
            break;
            case 4: // internacional
                $coordCaps=[];
            break;

        }

        if(count($coordCaps)>0){
            $capi="";
            foreach($coordCaps as $coord){
                if ($capi=="" || $capi!=$coord->capitania_id) {
                    if($capi!=""){
                       array_push($coordenadas,$arr);
                       $arr=["capitania"=> 0,"coords"=> [] ];
                    }
                    $capi = $coord->capitania_id;
                    $arr["capitania"] = $coord->capitania_id;
                }
                array_push($arr["coords"], [$coord->latitud, $coord->longitud]);

            }

            if($arr["capitania"]!=0){
                array_push($coordenadas,$arr);
            }

        }

        $this->step = 4;
        return view('zarpes.permiso_zarpe.create-step-four')->with('paso', $this->step)->with('EstNauticos', $EstNauticos)->with('coordCaps', json_encode($coordenadas));

 }

 public function permissionCreateStepFour(Request $request)
    {
        $solicitud = json_decode($request->session()->get('solicitud'), true);

        if($solicitud['descripcion_navegacion_id']==4){
            $validatedData = $request->validate([
                'establecimientoNáuticoOrigen' => 'required',
                'salida' => 'required',
                'regreso' => 'required',
                'latitud'=> 'required',
                'longitud'=> 'required',

            ]);
        }else{
            $validatedData = $request->validate([
                'establecimientoNáuticoOrigen' => 'required',
                'salida' => 'required',
                'regreso' => 'required',
                'latitud'=> 'required',
                'longitud'=> 'required',
                'coordenadasDestino'=> 'required',
                'establecimientoNáuticoDestino'=> 'required',

            ]);
        }

        $solicitud['establecimiento_nautico_id'] = $request->input('establecimientoNáuticoOrigen');
        $solicitud['establecimiento_nautico_destino_id'] = $request->input('establecimientoNáuticoDestino');
        $solicitud['fecha_hora_salida'] = $request->input('salida');
        $solicitud['fecha_hora_regreso'] = $request->input('regreso');
        $solicitud['coordenadas'] = json_encode([$request->input('latitud'), $request->input('longitud')]);
        $solicitud['destino_capitania_id'] = $request->input('coordenadasDestino');


        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step = 5;
        return redirect()->route('permisoszarpes.createStepFive');

    }


    public function createStepFive(Request $request)
    {
        
        $validation = json_decode($request->session()->get('validacion'), true);
        $tripulantes=$request->session()->get('tripulantes');

        $this->step = 5;
        return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation);

    }

    public function permissionCreateStepFive(Request $request)
    {

        $request->session()->put('tripulantes', [0]);
        $trip = [
            "permiso_zarpe_id" => '',
            "ctrl_documento_id" => '',
            "capitan" => '',
            "nombre" => '',
            "cedula" => '',
            "fecha_vencimiento" => '',
            "fecha_emision" => '',
            "documento" => ''
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
            return redirect()->route('permisoszarpes.createStepSix');
        } else {
            $this->step = 5;

            $mensj = "Los tripulantes de la embarcación son requeridos (cantidad de tripulantes " . $validation['cant_tripulantes'] . "), por favor verifique.";

            return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes)->with('validacion', $validation)->with('msj', $mensj);


        }

        /*
       */
        //

    }

    public function createStepSix(Request $request)
    {
        
        $passengers = $request->session()->get('pasajeros');
        $validation = json_decode($request->session()->get('validacion'), true);
        $cantPasajeros= $validation['cant_pasajeros'] - $validation['cant_tripulantes'];
        $this->step = 6;
        return view('zarpes.permiso_zarpe.create-step-six')->with('paso', $this->step)->with('passengers', $passengers)->with('cantPasajeros', $cantPasajeros);

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
            "permiso_zarpe_id" => '',
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
        return redirect()->route('permisoszarpes.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {

        $equipos = Equipo::all();
        //  dd($equipos);
        $this->step = 7;
        return view('zarpes.permiso_zarpe.create-step-seven')
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
            print_r($solicitud);

            $codigo = $this->codigo($solicitud);

            $solicitud['nro_solicitud'] = $codigo;
             $saveSolicitud = PermisoZarpe::create($solicitud);

           $tripulantes = $request->session()->get('tripulantes');
            for ($i = 0; $i < count($tripulantes); $i++) {
                $tripulantes[$i]["permiso_zarpe_id"] = $saveSolicitud->id;
                $trip = Tripulante::create($tripulantes[$i]);

            }



            $pasajeros = $request->session()->get('pasajeros');
            //print_r( $pasajeros);
            for ($i = 0; $i < count($pasajeros); $i++) {
                $pasajeros[$i]["permiso_zarpe_id"] = $saveSolicitud->id;
                $pass = Pasajero::create($pasajeros[$i]);
                // print_r($pasajeros[$i]); echo "<br>";
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

            Flash::success('Se ha generado la solocitud <b>
' . $codigo . '</b> exitosamente');
            $this->SendMail($saveSolicitud->id, 1);
            $this->SendMail($saveSolicitud->id, 0);
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
        $data = Saime_cedula::where('cedula', $cedula)
            ->where('fecha_nacimiento', $newDate)
            ->where('sexo', $sexo)
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
        $fecha = $_REQUEST['fecha'];
        $cap = $_REQUEST['cap'];

        $vj = [];
        $newDate = date("d/m/Y", strtotime($fecha));
        $data = Saime_cedula::where('cedula', $cedula)
            ->where('fecha_nacimiento', $newDate)
            ->get();

        if (is_null($data->first())) {
            $data2 = "saimeNotFound"; // no encontrado en saime
        } else {
            $fechav=LicenciasTitulosGmar::select(DB::raw('MAX(fecha_vencimiento) as fechav'))->where('ci', $cedula)->get();

            $data2 = LicenciasTitulosGmar::where('fecha_vencimiento', $fechav[0]->fechav)->where('ci', $cedula)->get();
            if (is_null($data2->first())) {
                $data2 = "gmarNotFound"; // no encontrado en Gmar
            } else {

                $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
                $fecha_vence = strtotime($data2[0]->fecha_vencimiento);

                if($data2[0]->solicitud =='Licencia' && ($fecha_actual > $fecha_vence))
                {
                    $data2="FoundButDefeated"; //encontrado pero documento vencido
                }else
                {

                    $marinoAsignado=PermisoZarpe::select('permiso_zarpes.status_id', 'ctrl_documento_id')
                    ->Join('tripulantes', 'permiso_zarpes.id', '=', 'tripulantes.permiso_zarpe_id')
                    ->where('tripulantes.ctrl_documento_id', '=', $data2[0]->id)
                    ->whereIn('permiso_zarpes.status_id', [1,3,5])
                    ->get();



                    if(count($marinoAsignado)>0){
                        $data2="FoundButAssigned";
                    }else{
                        $vj = $this->validacionJerarquizacion($data2[0]->documento, $cap);

                    }


                }
            }

        }
        $return = [$data2, $vj];

        echo json_encode($return);
    }

    private function codigo($solicitud)
    {
        $ano = date('Y');
        $mes = date('m');

        $cantidadActual = PermisoZarpe::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud, 6, 4) = '" . $ano . "')"), '=', true)
            ->get();

        $estNautico = EstablecimientoNautico::find($solicitud['establecimiento_nautico_id']);

        $capitania = Capitania::find($estNautico->capitania_id);
        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" . $ano . $mes . "-" . $correlativo;

        return $codigo;
    }


    public function updateStatus($id, $status, $establecimiento)
    {
            if ($status === 'aprobado') {
                $transaccion = PermisoZarpe::find($id);
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
                $data = [
                    'solicitud' => $transaccion->nro_solicitud,
                    'id'=>$id,
                    'idstatus' => $idstatus->id,
                    'status' => $idstatus->nombre,
                    'cedula_solic' => $solicitante->numero_identificacion,
                    'nombres_solic' => $solicitante->nombres,
                    'apellidos_solic' => $solicitante->apellidos,
                    'matricula' => $transaccion->matricula,
                ];
                $view = 'emails.zarpes.revision';
                $subject = 'Solicitud de Zarpe ' . $transaccion->nro_solicitud;
                $email->mailZarpePDF($solicitante->email, $subject, $data, $view);

                Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
                return redirect(route('permisoszarpes.index'));

            } elseif ($status === 'rechazado') {
                $motivo = $_GET['motivo'];
                $transaccion = PermisoZarpe::find($id);
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
                $data = [
                    'solicitud' => $transaccion->nro_solicitud,
                    'idstatus' => $idstatus->id,
                    'status' => $idstatus->nombre,
                    'nombres_solic' => $solicitante->nombres,
                    'apellidos_solic' => $solicitante->apellidos,
                    'matricula' => $transaccion->matricula,
                    'motivo' => $motivo
                ];
                $view = 'emails.zarpes.revision';
                $subject = 'Solicitud de Zarpe ' . $transaccion->nro_solicitud;
                $email->mailZarpe($solicitante->email, $subject, $data, $view);

                Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
                return redirect(route('permisoszarpes.index'));

            }elseif ($status === 'navegando'){
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

            }elseif ($status === 'anulado_sar'){
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

                ZarpeRevision::create([
                    'user_id' => auth()->user()->id,
                    'permiso_zarpe_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => 'Anulada por el Usuario Solicitante'
                ]);
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
        $tripulantes = Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id', $id)->get();
        $pasajeros = $permisoZarpe->pasajeros()->where('permiso_zarpe_id', $id)->get();
        $tripulantes2 = LicenciasTitulosGmar::whereIn('id', $tripulantes)->get();
        $equipos = EquipoPermisoZarpe::where('permiso_zarpe_id', $id)->get();
        $revisiones = ZarpeRevision::where('permiso_zarpe_id', $id)->get();

        $establecimiento = EstablecimientoNautico::select('capitania_id')->where('id', $permisoZarpe->establecimiento_nautico_id)->get();
        $establecimiento_user = EstablecimientoNauticoUser::select('user_id')
            ->where('establecimiento_nautico_id', $permisoZarpe->establecimiento_nautico_id)
            ->get();
        $capitania_user = CapitaniaUser::select('user_id')->whereIn('capitania_id', $establecimiento)->get();

        if (empty($permisoZarpe)) {
            Flash::error('Permiso Zarpe not found');

            return redirect(route('permisoZarpes.index'));
        }

        return view('zarpes.permiso_zarpe.show')
            ->with('permisoZarpe', $permisoZarpe)
            ->with('tripulantes', $tripulantes2)
            ->with('pasajeros', $pasajeros)
            ->with('equipos', $equipos)
            ->with('revisiones', $revisiones)
            ->with('capitania', $capitania_user)
            ->with('comodoro', $establecimiento_user);
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

        if ($tipo == 1) {
            //mensaje para caitania origen
            $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que ha recibido una
    nueva solicitud de permiso de zarpe en su jurisdicción que espera por su aprobación.";
            $mailTo = $capitanOrigen[0]->email;
            $subject = 'Nueva solicitud de permiso de Zarpe ' . $solicitud->nro_solicitud;
        } else {
            //mensaje para capitania destino
            $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que
    la siguiente embarcación está próxima a arribar a su jurisdicción.";
            $mailTo = $capitanDestino[0]->email;
            $subject = 'Notificación de arribo de embacación ' . $solicitud->matricula;
        }


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
                    if($validacion['potencia_kw']<=3000){
                        $return=[true];
                    }else{
                        $return=[false];
                    }
                    $return = [true];

                }

                break;
            case 'Segundo Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if($validacion['potencia_kw']<=3000){
                         $return=[true];
                     }else{
                         $return=[false];
                     }
                    $return = [true];

                }

                break;
            case 'Motorista de Primera':
                $coordenadas = [];
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if($validacion['potencia_kw']<=2237){
                        $return=[true,$coordenadas];
                    }else{
                        $return=[false,$coordenadas];
                    }
                    $return = [true];

                }


                break;
            case 'Motorista de Segunda':
                $coordenadas = [];
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if($validacion['potencia_kw']<=560){
                        $return=[true,$coordenadas];
                    }else{
                        $return=[false,$coordenadas];
                    }
                    $return = [true];

                }


                break;
            case 'Jefe de Máquinas de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if($validacion['potencia_kw']<=560){
                        $return=[true];
                    }else{
                        $return=[false];
                    }
                    $return = [true];

                }

                break;
            case 'Tercer Oficial de Máquinas':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if($validacion['potencia_kw']<=350){
                        $return=[true];
                    }else{
                        $return=[false];
                    }
                    $return = [true];

                }

                break;
            case 'Oficial de Máquinas de Pesca':
                if ($capitan == "SI") {
                    $return = [false];
                } else {
                    if($validacion['potencia_kw']<=560){
                        $return=[true];
                    }else{
                        $return=[false];
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


    public function BuscaEstablecimientosNauticos(Request $request){
        $idcap= $_REQUEST['idcap'];
         $EstNauticos = EstablecimientoNautico::where('capitania_id', $idcap)->get();
         $cap=Capitania::find($idcap);
         $resp=[$cap,$EstNauticos];
        echo json_encode($resp);
    }



}
