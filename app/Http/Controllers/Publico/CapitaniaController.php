<?php

namespace App\Http\Controllers\Publico;


use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Publico\CreateCapitaniaRequest;
use App\Http\Requests\Publico\UpdateCapitaniaRequest;
use App\Models\Publico\Coordenas_capitania;
use App\Repositories\Publico\CapitaniaRepository;
use Illuminate\Http\Request;
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

        $roles = Coordenas_capitania::create([
            'capitania_id'=>$capitania['id'],
            'latitud'=>$input['latitud'],
            'longitud'=>$input['longitud']
        ]);

        Flash::success('Capitanía guardado con éxito.');

        return redirect(route('capitanias.index'));
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


        if (empty($capitania)) {
            Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'));
        }

        return view('publico.capitanias.show')->with('capitania', $capitania);
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
        $coordenadas= Coordenas_capitania::where('capitania_id',$id)->get()->toArray();

        if (empty($capitania)) {
            Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'));
        }

        return view('publico.capitanias.edit')
            ->with('capitania', $capitania)
            ->with('coordenadas',$coordenadas);
    }

    /**
     * Update the specified Capitania in storage.
     *
     * @param int $id
     * @param UpdateCapitaniaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCapitaniaRequest $request)
    {
        $capitania = $this->capitaniaRepository->find($id);

        if (empty($capitania)) {
            Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'));
        }

        $capitania = $this->capitaniaRepository->update($request->all(), $id);
        $coordenas= new Coordenas_capitania();
        $roles = $coordenas->where('capitania_id',$id)->update([
            'latitud'=>$request['latitud'],
            'longitud'=>$request['longitud']
        ]);
        Flash::success('Capitanía actualizada con éxito.');

        return redirect(route('capitanias.index'));
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
            Flash::error('Capitania no encontrada');

            return redirect(route('capitanias.index'));
        }

        $this->capitaniaRepository->delete($id);

        Flash::success('Capitania eliminada con éxito.');

        return redirect(route('capitanias.index'));
    }
}
