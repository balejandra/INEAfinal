<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\Renave\Renave_data;
use App\Models\Zarpes\CargoTablaMando;
use App\Models\Zarpes\Equipo;
use App\Models\Zarpes\PermisoZarpe;
use App\Models\Zarpes\TablaMando;
use App\Repositories\Zarpes\PermisoZarpeRepository;
use Illuminate\Http\Request;
use App\Models\Publico\Saime_cedula;
use App\Models\Gmar\LicenciasTitulosGmar;
use Flash;


class PermisoZarpeController extends Controller
{
    /** @var  PermisoZarpeRepository */
    private $permisoZarpeRepository;

    public function __construct(PermisoZarpeRepository $permisoZarpeRepo)
    {
        $this->permisoZarpeRepository = $permisoZarpeRepo;
    }
    public function index()
    {

        $data = PermisoZarpe::all();

        return view('zarpes.permiso_zarpe.index')->with('permisoZarpes',$data);
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('pasajeros', ['']);
        $request->session()->put('tripulantes', ['']);
        $request->session()->put('validaciones', '');

        $solicitud=json_encode([
            "user_id"=> '',
            "nro_solicitud"=> '',
            "bandera"=> '',
            "matricula"=> '',
            "tipo_zarpes_id"=> '',
            "establecimiento_nauticos_id"=> '',
            "coordenadas"=> '',
            "origen_capitanias_id"=> '',
            "destino_capitanias_id"=> '',
            "fecha_hora_salida"=> '',
            "fecha_hora_regreso"=> '',
            "status_id"=> '',
            "permiso_estadias_id"=> '',

        ]);

        $request->session()->put('solicitud', $solicitud);

        $request->session()->put('solicitud', $solicitud);


        return view('zarpes.permiso_zarpe.create-step-one')->with('paso', 1);
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

        if ($solicitud['bandera'] == 'nacional') {
            return redirect()->route('permisoszarpes.CreateStepTwo')->with('paso', 2);
        } else {
            return redirect()->route('permisoszarpes.CreateStepTwoE')->with('paso', 2);

        }

    }


    public function createStepTwo(Request $request)
    {

        /*$product = $request->session()->get('product');

        return view('products.create-step-two',compact('product'));*/


        return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', 2);

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
        return view('zarpes.permiso_zarpe.extranjera.create-step-two')->with('paso', 2);

    }


    public function permissionCreateStepTwoE(Request $request)
    {
        /* $validatedData = $request->validate([
             'stock' => 'required',
             'status' => 'required',
         ]);

         $product = $request->session()->get('product');
         $product->fill($validatedData);
         $request->session()->put('product', $product);

         return redirect()->route('products.create.step.three');*/
        return redirect()->route('permisoszarpes.createStepThree');

    }


    public function createStepThree(Request $request)
    {
        /*   $product = $request->session()->get('product');

           return view('products.create-step-three',compact('product'));*/
        return view('zarpes.permiso_zarpe.create-step-three')->with('paso', 3);

    }

    public function permissionCreateStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'tipozarpe' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['tipo_zarpes_id'] = $request->input('tipozarpe', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        // print_r($solicitud);

        return redirect()->route('permisoszarpes.createStepFour');

    }

    public function createStepFour(Request $request)
    {

        return view('zarpes.permiso_zarpe.create-step-four')->with('paso', 4);

    }

    public function permissionCreateStepFour(Request $request)
    {

        $validatedData = $request->validate([
            'origen' => 'required',
            'salida' => 'required',
            'regreso' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['origen_capitanias_id'] = $request->input('origen', []);
        $solicitud['fecha_hora_salida'] = $request->input('salida', []);
        $solicitud['fecha_hora_regreso'] = $request->input('regreso', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        return redirect()->route('permisoszarpes.createStepFive');

    }


    public function createStepFive(Request $request)
    {

        $tripulantes=$request->session()->get('tripulantes');

        return view('zarpes.permiso_zarpe.create-step-five')->with('paso', 5)->with('tripulantes', $tripulantes);

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
                 return redirect()->route('permisoszarpes.createStepSix');
            }else{
                $mensj="Los tripulantes de la embarcación son requeridos, por favor verifique.";
                return view('zarpes.permiso_zarpe.create-step-five')->with('paso', 5)->with('msj', $mensj);
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

        return view('zarpes.permiso_zarpe.create-step-six')->with('paso', 6)->with('passengers', $passengers);

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

         return redirect()->route('permisoszarpes.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {
        $equipos = Equipo::all();
        //  dd($equipos);
        return view('zarpes.permiso_zarpe.create-step-seven')
            ->with('paso', 7)
            ->with('equipos', $equipos);

    }

    public function store(Request $request)
    {

        //return redirect()->route('permisoszarpes.createStepSeven');
        echo "  Guardar en BD y redireccionar";

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

    /**
     * Remove the specified PermisoZarpe from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permisoZarpe = $this->permisoZarpeRepository->find($id);

        if (empty($permisoZarpe)) {
            Flash::error('Permiso Zarpe not found');

            return redirect(route('permisoZarpes.index'));
        }

        $this->permisoZarpeRepository->delete($id);

        Flash::success('Permiso Zarpe deleted successfully.');

        return redirect(route('permisoZarpes.index'));
    }
}
