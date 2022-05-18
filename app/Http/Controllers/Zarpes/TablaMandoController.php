<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Zarpes\CreateTablaMandoRequest;
use App\Http\Requests\Zarpes\UpdateTablaMandoRequest;
use App\Models\Zarpes\CargoTablaMando;
use App\Repositories\Zarpes\TablaMandoRepository;
use Illuminate\Http\Request;

class TablaMandoController extends Controller
{
    /** @var  TablaMandoRepository */
    private $tablaMandoRepository;

    public function __construct(TablaMandoRepository $tablaMandoRepo)
    {
        $this->tablaMandoRepository = $tablaMandoRepo;
    }

    /**
     * Display a listing of the TablaMando.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tablaMandos = $this->tablaMandoRepository->all();

        return view('zarpes.tabla_mando.index')
            ->with('tablaMandos', $tablaMandos);
    }

    /**
     * Show the form for creating a new TablaMando.
     *
     * @return Response
     */
    public function create()
    {
        return view('zarpes.tabla_mando.create');
    }

    /**
     * Store a newly created TablaMando in storage.
     *
     * @param CreateTablaMandoRequest $request
     *
     * @return Response
     */
    public function store(CreateTablaMandoRequest $request)
    {
        $input = $request->all();

        $tablaMando = $this->tablaMandoRepository->create($input);

        Flash::success('Tabla Mando saved successfully.');

        return redirect(route('tablaMandos.index'));
    }

    /**
     * Display the specified TablaMando.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando not found');

            return redirect(route('tablaMandos.index'));
        }

        return view('zarpes.tabla_mando.show')->with('tablaMando', $tablaMando);
    }

    /**
     * Show the form for editing the specified TablaMando.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);
        $coords=CargoTablaMando::select(['id','tabla_mando_id', 'titulacion_aceptada_minima', 'cargo_desempena','titulacion_aceptada_maxima'])
            ->where('cargo_tabla_mandos.tabla_mando_id', '=', $id)->get();

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando not found');

            return redirect(route('tablaMandos.index'));
        }

        return view('zarpes.tabla_mando.edit')
            ->with('tablaMando', $tablaMando)
            ->with('coordenadas',$coords);
    }

    /**
     * Update the specified TablaMando in storage.
     *
     * @param int $id
     * @param UpdateTablaMandoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTablaMandoRequest $request)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando not found');

            return redirect(route('tablaMandos.index'));
        }

        $tablaMando = $this->tablaMandoRepository->update($request->all(), $id);

        Flash::success('Tabla Mando updated successfully.');

        return redirect(route('tablaMandos.index'));
    }

    /**
     * Remove the specified TablaMando from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tablaMando = $this->tablaMandoRepository->find($id);

        if (empty($tablaMando)) {
            Flash::error('Tabla Mando not found');

            return redirect(route('tablaMandos.index'));
        }

        $this->tablaMandoRepository->delete($id);

        Flash::success('Tabla Mando deleted successfully.');

        return redirect(route('tablaMandos.index'));
    }
}
