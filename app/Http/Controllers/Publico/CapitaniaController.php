<?php

namespace App\Http\Controllers\Publico;


use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Publico\CreateCapitaniaRequest;
use App\Http\Requests\Publico\UpdateCapitaniaRequest;
//use App\Models\Publico\Coordenas_capitania;
use App\Models\Publico\Capitania;
use App\Repositories\Publico\CapitaniaRepository;
use Illuminate\Http\Request;
use App\Models\Publico\CoordenadasCapitania;

use Flash;
use Response;

class CapitaniaController extends AppBaseController
{
    /** @var  CapitaniaRepository */
    private $capitaniaRepository;

    public function __construct(CapitaniaRepository $capitaniaRepo)
    {
        $this->capitaniaRepository = $capitaniaRepo;

        $this->middleware('permission:listar-capitania', ['only'=>['index'] ]);
        $this->middleware('permission:crear-capitania', ['only'=>['create','store']]);
        $this->middleware('permission:editar-capitania', ['only'=>['edit','update']]);
        $this->middleware('permission:consultar-capitania', ['only'=>['show'] ]);
        $this->middleware('permission:eliminar-capitania', ['only'=>['destroy'] ]);
    }

    /**
     * Display a listing of the Capitania.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $capitanias = $this->capitaniaRepository->all();

        return view('publico.capitanias.index')
            ->with('capitanias', $capitanias);
    }

    /**
     * Show the form for creating a new Capitania.
     *
     * @return Response
     */
    public function create()
    {
        return view('publico.capitanias.create');
    }

    /**
     * Store a newly created Capitania in storage.
     *
     * @param CreateCapitaniaRequest $request
     *
     * @return Response
     */
    public function store(CreateCapitaniaRequest $request)
    {
        $input = $request->all();

        $capitania = $this->capitaniaRepository->create($input);

        $lat=$request->input('latitud', []);
        $long=$request->input('longitud', []);
        $c = count($lat);
        $c2= count($long);

        if($c==$c2){
            for( $i=0;$i<$c;$i++ )
            {
                $coordenadas= [
                    'capitania_id' => $capitania['id'],
                    'latitud'      => $lat[$i],
                    'longitud'     => $long[$i],
                ];
                CoordenadasCapitania::create($coordenadas);
            }
        }

        //Flash::success('Capitanía guardado con éxito.');

        return redirect(route('capitanias.index'))->with('success','Capitanía guardado con éxito.');
    }

    /**
     * Display the specified Capitania.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $capitania = $this->capitaniaRepository->find($id);
       // $coords=Coordenas_capitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenas_capitania.capitania_id', '=', $id)->get();
       // $coords=CoordenadasCapitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenadas_capitanias.capitania_id', '=', $id)->get();
       $coords= $capitania->coordenadas_capitania();
        if (empty($capitania)) {
            //Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'))->with('danger','Capitania no encontrada');
        }



        return view('publico.capitanias.show')->with('capitania', $capitania)->with('coords', $coords);
    }

    /**
     * Show the form for editing the specified Capitania.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $capitania = $this->capitaniaRepository->find($id);
        //$coords=Coordenas_capitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenas_capitania.capitania_id', '=', $id)->get();
        $coords=CoordenadasCapitania::select(['id','capitania_id', 'latitud', 'longitud'])->where('coordenadas_capitanias.capitania_id', '=', $id)->get();
        if (empty($capitania)) {
            //Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'))->with('danger','Capitania no encontrada');
        }

        return view('publico.capitanias.edit')
            ->with('capitania', $capitania)
            ->with('coordenadas',$coords);
    }

    /**
     * Update the specified Capitania in storage.
     *
     * @param int $id
     * @param UpdateCapitaniaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCapitaniaRequest $request, Capitania $cap)
    {

         $capi = $this->capitaniaRepository->update($request->all(), $id);
        $lat=$request->input('latitud', []);
        $long=$request->input('longitud', []);
        $capi->update($request->only('name'));
        $capi->CoordenadasCapitania()->sync([$lat, $long]);

        return redirect(route('capitanias.index'))->with('success','Capitanía modificada con éxito.');

    }

    /**
     * Remove the specified Capitania from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $capitania = $this->capitaniaRepository->find($id);

        if (empty($capitania)) {
        //    Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'))->with('danger','Capitania no encontrada'); ;
        }

        $this->capitaniaRepository->delete($id);

        //Flash::success('Capitania eliminada con éxito.');

        return redirect(route('capitanias.index'))->with('success','Capitanía eliminada con éxito.'); ;
    }
}
