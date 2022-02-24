<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\Publico\CapitaniaUser;
use App\Models\Renave\Renave_data;
use App\Models\User;
use App\Models\Zarpes\CargoTablaMando;
use App\Models\Zarpes\Equipo;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\PermisoZarpe;
use App\Models\Zarpes\Status;
use App\Models\Zarpes\TablaMando;
use App\Models\Zarpes\Tripulante;
use App\Models\Zarpes\Pasajero;
use App\Models\Zarpes\TipoZarpe;
use App\Models\Zarpes\EquipoPermisoZarpe;

use Illuminate\Http\Request;
use App\Models\Publico\Saime_cedula;
use App\Models\Gmar\LicenciasTitulosGmar;
use App\Models\Publico\CoordenadasCapitania;

use Flash;


class PermisoZarpeController extends Controller
{
    private $step;

    public function __construct(){
        $this->step=1;
    }

    public function index()
    {
        if (auth()->user()->getRoleNames()[0]==="Super Admin") {
            $data = PermisoZarpe::all();
            return view('zarpes.permiso_zarpe.index')->with('permisoZarpes', $data);
        } elseif (auth()->user()->getRoleNames()[0]==="Usuario web") {
            $user = auth()->id();
            $data = PermisoZarpe::where('user_id', $user)->get();
            return view('zarpes.permiso_zarpe.index')->with('permisoZarpes', $data);
        } elseif  (auth()->user()->getRoleNames()[0]==="Capitán") {
            $user = auth()->id();
            $capitania=CapitaniaUser::where('user_id', $user)->first()->capitania_id;
            $establecimiento=EstablecimientoNautico::where('capitania_id',$capitania)->first()->id;
            $datazarpeorigen = PermisoZarpe::where('establecimiento_nautico_id',$establecimiento)->get();
            $datazarpedestino = PermisoZarpe::where('destino_capitania_id',$capitania)->get();
            return view('zarpes.permiso_zarpe.indexcapitan')
                ->with('permisoOrigenZarpes', $datazarpeorigen)
                ->with('permisoDestinoZarpes',$datazarpedestino);
        }
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('pasajeros', ['']);
        $request->session()->put('tripulantes', [0]);
        $request->session()->put('validaciones', '');

        $solicitud=json_encode([
            "user_id"=> auth()->id(),
            "nro_solicitud"=> '',
            "bandera"=> '',
            "matricula"=> '',
            "tipo_zarpe_id"=> '',
            "establecimiento_nautico_id"=> '',
            "coordenadas"=> '',
            "destino_capitania_id"=> '',
            "fecha_hora_salida"=> '',
            "fecha_hora_regreso"=> '',
            "status_id"=> 3,
            "permiso_estadias_id"=> '',

        ]);
        $this->step=1;

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
        //       print_r($solicitud['bandera']);

        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step=2;
        if ($solicitud['bandera'] == 'nacional') {
            return redirect()->route('permisoszarpes.CreateStepTwo')->with('paso', $this->step);
        } else {
            return redirect()->route('permisoszarpes.CreateStepTwoE')->with('paso', $this->step);

        }

    }


    public function createStepTwo(Request $request)
    {

        /*$product = $request->session()->get('product');

        return view('products.create-step-two',compact('product'));*/
        $this->step=2;

        return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', $this->step);

    }

    public function validationStepTwo(Request $request)
    {
        $matricula = $_REQUEST['matricula'];
        $data = Renave_data::where('matricula_actual', $matricula)->get();
        if (is_null($data->first())) {
            $exception ='Error en consulta';
            $data = response()->json([
                'status' => 3,
                'msg' => $exception->getMessage(),
                'errors' => [],
            ], 200);
        }
        echo json_encode($data);
    }

    public function permissionCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'matricula' => 'required',
            'UAB' => 'required',
        ]);
        $validation = json_decode($request->session()->get('validacion'), true);
        $UAB =  $request->input('UAB');
        $matricula =  $request->input('matricula');
        $identificacion =  $request->input('numero_identificacion');
        if ($identificacion!=auth()->user()->numero_identificacion) {
            Flash::error('Su usuario no puede realizar solicitudes a nombre del Buque Matricula '. $matricula);
            return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', 2);
        }

        $tabla= new TablaMando();
        $mando=$tabla->where([
            ['UAB_minimo','<',$UAB],
            ['UAB_maximo','>',$UAB]
        ])->get()->toArray();
        $validation['UAB'] = $request->input('UAB', []);
        $validation['cant_tripulantes'] = $mando[0]["cant_tripulantes"];

        $idtablamando=$mando[0]["id"];
        $cargos=CargoTablaMando::where('tabla_mando_id',$idtablamando)->get()->toArray();
        foreach ($cargos as $clave => $valor) {
            $cargo["cargo_desempena"]=$valor['cargo_desempena'];
            $cargo["titulacion_aceptada_minima"]=$valor['titulacion_aceptada_minima'];
            $cargo["titulacion_aceptada_maxima"]=$valor['titulacion_aceptada_maxima'];
            $validation[$clave]=$cargo;
        }
        $valida=[
            "UAB"=> '',
            "cant_tripulantes"=> '',
            "cargos"=>[
                "cargo_desempena"=>'',
                "titulacion_aceptada_minima"=>'',
                "titulacion_aceptada_maxima"=>''
            ]
        ];

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
        /*$product = $request->session()->get('product');

        return view('products.create-step-two',compact('product'));*/
        $this->step=2;

        return view('zarpes.permiso_zarpe.extranjera.create-step-two')->with('paso', $this->step);

    }


    public function permissionCreateStepTwoE(Request $request)
    {
         $this->step=3;
        return redirect()->route('permisoszarpes.createStepThree');

    }


    public function createStepThree(Request $request)
    {

        $TipoZarpes = TipoZarpe::all();

                $this->step=3;

        return view('zarpes.permiso_zarpe.create-step-three')->with('paso', $this->step)->with('TipoZarpes', $TipoZarpes);

    }

    public function permissionCreateStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'tipozarpe' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['tipo_zarpe_id'] = $request->input('tipozarpe', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        // print_r($solicitud);
        $this->step=4;

        return redirect()->route('permisoszarpes.createStepFour');

    }

    public function createStepFour(Request $request)
    {
        $EstNauticos = EstablecimientoNautico::all();
        $coordCaps=CoordenadasCapitania::all();
         $coordenadas=[];
        if(count($coordCaps)>0){
           
            $arr=["capitania"=> 0,"coords"=> [] ];
            

            $capi="";
            foreach($coordCaps as $coord){
                if ($capi=="" || $capi!=$coord->capitania_id) {
                    if($capi!=""){
                       array_push($coordenadas,$arr); 
                       $arr=["capitania"=> 0,"coords"=> [] ];
                    }
                    $capi=$coord->capitania_id;
                    $arr["capitania"]=$coord->capitania_id;
                }
                 array_push($arr["coords"], [$coord->latitud, $coord->longitud]);                 
            }

            
        } 

        $this->step=4;
        return view('zarpes.permiso_zarpe.create-step-four')->with('paso', $this->step)->with('EstNauticos', $EstNauticos)->with('coordCaps', json_encode($coordenadas));
    }

    public function permissionCreateStepFour(Request $request)
    {

        $validatedData = $request->validate([
            'origen' => 'required',
            'salida' => 'required',
            'regreso' => 'required',
            'latitud'=> 'required',
            'longitud'=> 'required',
            'coordenadasDestino'=> 'required',

        ]);


        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['establecimiento_nautico_id'] = $request->input('origen');
        $solicitud['fecha_hora_salida'] = $request->input('salida');
        $solicitud['fecha_hora_regreso'] = $request->input('regreso');
        $solicitud['coordenadas'] = json_encode([$request->input('latitud'),$request->input('longitud')]);
        $solicitud['destino_capitania_id'] = $request->input('coordenadasDestino');

       

        $request->session()->put('solicitud', json_encode($solicitud));
        $this->step=5;
        return redirect()->route('permisoszarpes.createStepFive');

    }


    public function createStepFive(Request $request)
    {
        //print_r(json_decode($request->session()->get('solicitud'), true));   
        $tripulantes=$request->session()->get('tripulantes');

        $this->step=5;
        return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('tripulantes', $tripulantes);

    }

    public function permissionCreateStepFive(Request $request)
    {

        $request->session()->put('tripulantes', [0]);
        $trip=[
            "permiso_zarpe_id"=> '',
            "ctrl_documento_id"=> '',
            "capitan"=> '',
            "nombre"=>'',
            "cedula"=>'',
            "fecha_vencimiento"=>'',
            "documento"=>''
        ];
        $ctrldocumento=$request->input('ids', []);
        $cap=$request->input('capitan', []);
        $nombre=$request->input('nombre', []);
        $cedula=$request->input('cedula', []);
        $fecha_vencimiento=$request->input('fechaVence', []);
        $documento=$request->input('documento', []);


        $tripulantes=$request->session()->get('tripulantes');

        if(isset($ctrldocumento)){


            for($i=0;$i<count($ctrldocumento);$i++){
                $trip["ctrl_documento_id"]=$ctrldocumento[$i];

                if($cap[$i]=="SI"){
                    $trip["capitan"]=true;
                }else{
                    $trip["capitan"]=false;
                }

                $trip["nombre"]=$nombre[$i];
                $trip["cedula"]=$cedula[$i];
                $trip["fecha_vencimiento"]=$fecha_vencimiento[$i];
                $trip["documento"]=$documento[$i];


                $tripulantes[$i]=$trip;
            }

            $request->session()->put('tripulantes', $tripulantes);
            //$tr = json_decode($request->session()->get('tripulantes'), true);
            $this->step=6;
            return redirect()->route('permisoszarpes.createStepSix');
        }else{
            $this->step=5;

            $mensj="Los tripulantes de la embarcación son requeridos, por favor verifique.";
            return view('zarpes.permiso_zarpe.create-step-five')->with('paso', $this->step)->with('msj', $mensj);
        }

        /*
       */
        //

    }

    public function createStepSix(Request $request)
    {
        /*   $product = $request->session()->get('product');

           return view('products.create-step-three',compact('product'));*/
        $passengers=$request->session()->get('pasajeros');
        $this->step=6;
        return view('zarpes.permiso_zarpe.create-step-six')->with('paso', $this->step)->with('passengers', $passengers);

    }

    public function permissionCreateStepSix(Request $request)
    {
        $request->session()->put('pasajeros', [0]);
        $pass=[
            "nombres"=> '',
            "apellidos"=> '',
            "tipo_doc"=> '',
            "nro_doc"=> '',
            "sexo"=> '',
            "fecha_nacimiento"=> '',
            "menor_edad"=> '',
            "permiso_zarpe_id"=> '',
        ];
        // $request->session()->put('pasajeros', {[]});
        $passengers=$request->session()->get('pasajeros');

        $nombres=$request->input('nombres', []);
        $apellidos=$request->input('apellidos', []);
        $tipodoc=$request->input('tipodoc', []);
        $sexo=$request->input('sexo', []);
        $menor=$request->input('menor', []);
        $fechanac=$request->input('fechanac', []);
        $nrodoc=$request->input('nrodoc', []);

        for($i=0;$i<count($nrodoc);$i++){
            $pass["nombres"]=$nombres[$i];
            $pass["apellidos"]=$apellidos[$i];
            $pass["tipo_doc"]=$tipodoc[$i];
            $pass["sexo"]=$sexo[$i];
            $pass["fecha_nacimiento"]=$fechanac[$i];
            $pass["nro_doc"]=$nrodoc[$i];
            if($menor[$i]=="SI"){
                $pass["menor_edad"]=true;
            }else{
                $pass["menor_edad"]=false;
            }
            $passengers[$i]=$pass;
        }

        $request->session()->put('pasajeros',  $passengers);
        $this->step=7;
        return redirect()->route('permisoszarpes.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {
    
        $equipos = Equipo::all();
        //  dd($equipos);
        $this->step=7;
        return view('zarpes.permiso_zarpe.create-step-seven')
            ->with('paso', $this->step)
            ->with('equipos', $equipos);

    }

    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'equipo' => 'required',

        ]);
        $equipo=$request->input('equipo', []);


        
        if(count($equipo)==0){
            Flash::error('Debe indicar los equipos que posee a bordo, por favor verifique.');
            return redirect()->route('permisoszarpes.createStepSeven');
        }else{
            $codigo=$this->codigo();
            

            $solicitud=json_decode($request->session()->get('solicitud'), true);
            $solicitud['nro_solicitud']=$codigo;
            $saveSolicitud = PermisoZarpe::create($solicitud); 

 
            $tripulantes=$request->session()->get('tripulantes');
            for($i=0;$i<count($tripulantes);$i++){
                $tripulantes[$i]["permiso_zarpe_id"]=$saveSolicitud->id;
                $trip=Tripulante::create($tripulantes[$i]); 
              //  print_r($tripulantes[$i]); echo "<br>";

            }

            $pasajeros=$request->session()->get('pasajeros');
            //print_r( $pasajeros);
            for($i=0;$i<count($pasajeros);$i++){
                $pasajeros[$i]["permiso_zarpe_id"]=$saveSolicitud->id;
                $pass=Pasajero::create($pasajeros[$i]); 
               // print_r($pasajeros[$i]); echo "<br>";
            }
             
             
            $eq=["permiso_zarpe_id"=>'',"equipo_id"=>''];
            for($i=0;$i<count($equipo);$i++){
                $eq["permiso_zarpe_id"]=$saveSolicitud->id;
                $eq["equipo_id"]=$equipo[$i];
                EquipoPermisoZarpe::create($eq); 
                 
            } 
            Flash::success('Se ha generado la solocitud <b>
'.$codigo.'</b> exitodamente');
            
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


        $newDate = date("d/m/Y", strtotime($fecha));
        $data = Saime_cedula::where('cedula', $cedula)
            ->where('fecha_nacimiento', $newDate)
            ->get();
        if (is_null($data->first())) {

            $data2="saimeNotFound";
        }else{
            $data2= LicenciasTitulosGmar::where('ci', $cedula)->get();
            if (is_null($data2->first())) {
                $data2="gmarNotFound";
            }

        }

        echo json_encode($data2);
    }

    private function codigo(){
        $ano=date('Y');
        $mes=date('m');

         $data = PermisoZarpe::count();

          $data++;
        $codigo="SCZ".$ano.$mes."000".$data;
        return $codigo;

    }

    
    public function show($id)
    {
        
    }

     


    public function updateStatus($id,$status)
    {
        if ($status==='aprobado') {
            $transaccion = PermisoZarpe::find($id);
            $idstatus= Status::find(1);
            $solicitante=User::find($transaccion->user_id);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();
            $email = new MailController();
            $data = [
                    'solicitud' => $transaccion->nro_solicitud,
                    'status' => $idstatus->nombre,
                    'cedula_solic' => $solicitante->numero_identificacion,
                    'nombres_solic'=>$solicitante->nombres,
                    'apellidos_solic' =>$solicitante->apellidos,
                    'matricula' => $transaccion->matricula,
            ];
            $view='emails.zarpes.revision';
            $subject='Solicitud de Zarpe '.$transaccion->nro_solicitud;
            $email->mailZarpe($solicitante->email,$subject,$data,$view);

            Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
            return redirect(route('permisoszarpes.index'));

        } elseif ($status==='rechazado'){
            $transaccion = PermisoZarpe::find($id);
            $idstatus= Status::find(2);
            $solicitante=User::find($transaccion->user_id);
            $transaccion->status_id = $idstatus->id;
            $transaccion->update();
            $email = new MailController();
            $data = [
                'solicitud' => $transaccion->nro_solicitud,
                'status' => $idstatus->nombre,
                'nombres_solic'=>$solicitante->nombres,
                'apellidos_solic' =>$solicitante->apellidos,
                'matricula' => $transaccion->matricula,
            ];
            $view='emails.zarpes.revision';
            $subject='Solicitud de Zarpe '.$transaccion->nro_solicitud;
            $email->mailZarpe($solicitante->email,$subject,$data,$view);

            Flash::success('Solicitud rechazada y correo enviado al usuario solicitante.');
            return redirect(route('permisoszarpes.index'));
        }

    }

}
