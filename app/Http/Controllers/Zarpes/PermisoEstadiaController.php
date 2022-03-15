<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Flash;
use Faker\Factory as Faker;
class PermisoEstadiaController extends Controller
{
 public   $data=[
     ['id' => 1,
         'nombre_buque' => 'Camila',
         'numero_registro' => 'VPEFMCZH',
         'tipo_buque' => 'carga general',
         'puerto_matricula' => 89583402,
         'nacionalidad_buque' => 'Colombia',
         'propietario' => 'Eli Smith',
         'pasaporte_capitan' => '9610608684',
         'nombrescompletos_capitan' => 'Seth Wintheiser',
         'eslora' => 554,
         'manga' => 186,
         'puntal' => 228,
         'arqueo_bruto' => 595,
         'arqueo_neto' => 902,
         'actividades' => 'recreativa',
         'numero_tripulantes' => 99,
         'puerto_origen' => 'Corkeryhaven',
         'ultimo_puertovisitado' => 'South Hilbertfurt',
         'tiempo_estadia' => '2 semanas',
         'vigencia' => '',
     ],
     ['id' => 2,
         'nombre_buque' => 'Trent',
         'numero_registro' => 'WJBZNN9S',
         'tipo_buque' => 'carga general',
         'puerto_matricula' => 63901732,
         'nacionalidad_buque' => 'Anguilla',
         'propietario' => 'Sandrine Schowalter',
         'pasaporte_capitan' => 9181091627,
         'nombrescompletos_capitan' => 'Claude Pollich',
         'eslora' => 753,
         'manga' => 631,
         'puntal' => 573,
         'arqueo_bruto' => 781,
         'arqueo_neto' => 856,
         'actividades' => 'deportiva',
         'numero_tripulantes' => 87,
         'puerto_origen' => 'Lake Eldora',
         'ultimo_puertovisitado' => 'South Leila',
         'tiempo_estadia' => 8,
         'vigencia' => '',
     ],
     [
         'id' => 3,
         'nombre_buque' => 'Clyde',
         'numero_registro' => 'DVUOKF5W7SH',
         'tipo_buque' => 'carga general',
         'puerto_matricula' => 8489191,
         'nacionalidad_buque' => 'Macao',
         'propietario' => 'Sierra Johns',
         'pasaporte_capitan' => '7279824321',
         'nombrescompletos_capitan' => 'Sienna Heaney',
         'eslora' => 161,
         'manga' => 608,
         'puntal' => 837,
         'arqueo_bruto' => 326,
         'arqueo_neto' => 194,
         'actividades' => 'recreativa',
         'numero_tripulantes' => '19',
         'puerto_origen' => 'New Cynthia',
         'ultimo_puertovisitado' => 'Jerdechester',
         'tiempo_estadia' => '2',
         'vigencia' => '',
     ],
     [
         'id' => 4,
         'nombre_buque' => 'Lavada',
         'numero_registro' => 'QFSQKIXI',
         'tipo_buque' => 'carga general',
         'puerto_matricula' => 78418616,
         'nacionalidad_buque' => 'Tonga',
         'propietario' => 'Scotty Rutherford',
         'pasaporte_capitan' => '3767787725',
         'nombrescompletos_capitan' => 'Tomas Sauer',
         'eslora' => 264,
         'manga' => 965,
         'puntal' => 834,
         'arqueo_bruto' => 995,
         'arqueo_neto' => 573,
         'actividades' => 'recreativa',
         'numero_tripulantes' => '30',
         'puerto_origen' => 'Magalihaven',
         'ultimo_puertovisitado' => 'East Breanamouth',
         'tiempo_estadia' => '5',
         'vigencia' => '',
     ],
     [
         'id' => 5,
         'nombre_buque' => 'Emmitt',
         'numero_registro' => 'JUMLECX1',
         'tipo_buque' => 'carga general',
         'puerto_matricula' => '90775640',
         'nacionalidad_buque' => 'Cuba',
         'propietario' => 'Tanya Haag',
         'pasaporte_capitan' => '4239617903',
         'nombrescompletos_capitan' => 'Theresia Effertz',
         'eslora' => 974,
         'manga' => 062,
         'puntal' => 728,
         'arqueo_bruto' => 348,
         'arqueo_neto' => 367,
         'actividades' => 'deportiva',
         'numero_tripulantes' => '52',
         'puerto_origen' => 'Bechtelarfort',
         'ultimo_puertovisitado' => 'Lake Vernie',
         'tiempo_estadia' => '2',
         'vigencia' => '',
     ]
 ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   $average=Collection::make($this->data);

        $permisoEstadias = $average;

        return view('zarpes.permiso_estadias.index')
            ->with('permisoEstadias', $permisoEstadias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zarpes.permiso_estadias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $average=Collection::make($this->data);

        $input = $request->all();
        $concatenated = $average->concat([$input]);
       // dd($concatenated);
        Flash::success('Permiso Estadia Guardado Satisfactoriamente.');

        return view('zarpes.permiso_estadias.index')
            ->with('permisoEstadias', $concatenated);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $average=Collection::make($this->data);
        $data=$average->firstWhere('id', $id);

        if (empty($data)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisoEstadias.index'));
        }

        return view('zarpes.permiso_estadias.show')->with('permisoEstadia', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $average=Collection::make($this->data);
        $permisoEstadia=$average->firstWhere('id', $id);

        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estadia not found');

            return redirect(route('permisosestadia.index'));
        }

        return view('zarpes.permiso_estadias.edit')->with('permisoEstadia', $permisoEstadia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
