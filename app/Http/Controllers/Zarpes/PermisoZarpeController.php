<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publico\Saime_cedula;


class PermisoZarpeController extends Controller
{

    public function index()
    {

        // $products = Product::all();

        return view('zarpes.permiso_zarpe.index');
    }

    public function createStepOne(Request $request)
    {
        $request->session()->put('pasajeros', ['']);
        $request->session()->put('tripulantes', '');

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



        return view('zarpes.permiso_zarpe.create-step-one')->with('paso', 1);
    }


    public function permissionCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'bandera' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['bandera']=$request->input('bandera', []);
        //       print_r($solicitud['bandera']);

        $request->session()->put('solicitud', json_encode($solicitud));

        if($solicitud['bandera']=='nacional'){
            return redirect()->route('permisoszarpes.CreateStepTwo')->with('paso', 2);
        }else{
            return redirect()->route('permisoszarpes.CreateStepTwoE')->with('paso', 2);

        }

    }


    public function createStepTwo(Request $request)
    {

        /*$product = $request->session()->get('product');

        return view('products.create-step-two',compact('product'));*/


        return view('zarpes.permiso_zarpe.nacional.create-step-two')->with('paso', 2);

    }


    public function permissionCreateStepTwo(Request $request)
    {


        $validatedData = $request->validate([
            'matricula' => 'required',
        ]);

        $solicitud = json_decode($request->session()->get('solicitud'), true);
        $solicitud['matricula']=$request->input('matricula', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        print_r($solicitud);
        return redirect()->route('permisoszarpes.createStepThree');

    }

    public function validationStepTwo(Request $request)
    {
        $matricula = $_REQUEST['matricula'];
        $data = Renave_data::where('matricula_actual', $matricula)->get();
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


    public function createStepTwoE(Request $request)
    {
        /*$product = $request->session()->get('product');

        return view('products.create-step-two',compact('product'));*/
        return view('zarpes.permiso_zarpe.extrangera.create-step-two')->with('paso', 2);

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
        $solicitud['tipo_zarpes_id']=$request->input('tipozarpe', []);
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
        $solicitud['origen_capitanias_id']=$request->input('origen', []);
        $solicitud['fecha_hora_salida']=$request->input('salida', []);
        $solicitud['fecha_hora_regreso']=$request->input('regreso', []);
        $request->session()->put('solicitud', json_encode($solicitud));
        return redirect()->route('permisoszarpes.createStepFive');

    }


    public function createStepFive(Request $request)
    {


        $tripulantes=4;

        return view('zarpes.permiso_zarpe.create-step-five')->with('paso', 5);

    }

    public function permissionCreateStepFive(Request $request)
    {

        return redirect()->route('permisoszarpes.createStepSix');

    }

    public function createStepSix(Request $request)
    {
        /*   $product = $request->session()->get('product');

           return view('products.create-step-three',compact('product'));*/



        return view('zarpes.permiso_zarpe.create-step-six')->with('paso', 6);

    }

    public function permissionCreateStepSix(Request $request)
    {
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
        print_r($request->session()->get('pasajeros'));
        return redirect()->route('permisoszarpes.createStepSeven');

    }


    public function createStepSeven(Request $request)
    {

        return view('zarpes.permiso_zarpe.create-step-seven')->with('paso', 7);

    }

    public function store(Request $request)
    {

        //return redirect()->route('permisoszarpes.createStepSeven');
        echo "  Guardar en BD y redireccionar";

    }

    public function consulta2(Request $request){
        $cedula=$_REQUEST['cedula'];
        $fecha=$_REQUEST['fecha'];
        $sexo=$_REQUEST['sexo'];

        $newDate = date("d/m/Y", strtotime($fecha));
        $data= Saime_cedula::where('cedula',$cedula)
            ->where('fecha_nacimiento',$newDate)
            ->where('sexo',$sexo)
            ->get();
        if (is_null($data->first())) {
            dd('error');
            $data=response()->json([
                'status'=>3,
                'msg' => $exception->getMessage(),
                'errors'=>[],
            ], 200);
        }

        echo json_encode($data);
    }



}
