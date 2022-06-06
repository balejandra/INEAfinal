<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Publico\Capitania;
use Flash;
use Response;
use Spatie\Permission\Models\Role;


class EstablecimientosNauticosController extends Controller
{
    private $titulo="Establecimientos Náuticos";

    public function __construct()
    {

        $this->middleware('permission:listar-estableimientoNautico', ['only'=>['index'] ]);
        $this->middleware('permission:crear-establecimientoNautico', ['only'=>['create','store']]);
        $this->middleware('permission:editar-estableimientoNautico', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-estableimientoNautico', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-estableimientoNautico', ['only'=>['destroy'] ]);
    }

    public function index(Request $request)
    {
        
        $estNautico = EstablecimientoNautico::select('establecimiento_nauticos.*', 'capitanias.nombre as capitania')
        ->Join('public.capitanias', 'capitanias.id', '=', 'capitania_id')->get();

        return view('publico.establecimientos_nauticos.index')
            ->with('estNautico', $estNautico)
            ->with('titulo',  $this->titulo);
    }


    
    public function show($id)
    {
        $estNautico = EstablecimientoNautico::select('establecimiento_nauticos.*', 'capitanias.nombre as capitania')
        ->Join('public.capitanias', 'capitanias.id', '=', 'capitania_id')->where('establecimiento_nauticos.id', '=', $id)->get();
        
        if (empty($estNautico)) {
            //Flash::error('Capitania no encontrada');

            return redirect(route('publico.establecimientos_nauticos.index'))->with('danger','Establecimiento Náutico no encontrado')->with('titulo', $this->titulo);
        }


        return view('publico.establecimientos_nauticos.show')
            ->with('estNautico', $estNautico[0])
            ->with('titulo',  $this->titulo);

    }

    public function create()
    {
        $capitanias=Capitania::pluck('nombre','id');
        
        return view('publico.establecimientos_nauticos.create')->with('capitanias',$capitanias)->with('titulo', $this->titulo);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'rif' => 'required|string',
            'prefijo'=>'required',
            "capitania_id"    => "required",
        ],
        [
            'nombre.required' => 'El campo Nombre es obligatorio',
            'prefijo.required' => 'El prefijo de su RIF es obligatorio',
            'rif.required' => 'El campo RIF es obligatorio',
            'capitania_id.required'=>'El campo Capitanía es obligatorio'
        ]
        );

        $input = [
            "nombre"=>$request->input('nombre'),
            "capitania_id"=>$request->input('capitania_id'),
            "RIF"=>$request->input('prefijo')."-".$request->input('rif'),
        ];

        $rif=$request->input('prefijo')."-".$request->input('rif');

        $existe = EstablecimientoNautico::select('*')->where('establecimiento_nauticos.RIF', '=', $rif)->get();
        
        if(count($existe)>0){
            Flash::error('El RIF del establecimiento náutico ya existe, por favor verifique.');
            return redirect(route('establecimientosNauticos.create')) ->with('error','El RIF del establecimiento náutico ya existe, por favor verifique.');
        }else{
            $estNautico=EstablecimientoNautico::create($input);
            $estNautico->save();
            Flash::success('Establecimiento náutico guardado con éxito.');
            return redirect(route('establecimientosNauticos.index'))->with('success','El Establecimiento náutico se ha guardado con éxito.');
        }
    }


    public function destroy($id)
    {
        $estNautico = EstablecimientoNautico::where('id', $id)->first();
        if (empty($estNautico)) {
            Flash::error('Establecimiento náutico no encontrado.');

            return redirect(route('establecimientosNauticos.index'))->with('danger',' Establecimiento náutico no encontrado'); ;
        }
        $estNautico->delete();
        Flash::success('Establecimiento náutico eliminado con éxito.');

        return redirect(route('establecimientosNauticos.index'))->with('success',' Establecimiento náutico eliminado con éxito'); ;
    }



}
