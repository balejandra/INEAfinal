<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Models\Publico\DependenciaFederal;
use Illuminate\Http\Request;
use Flash;
use Response;

class DependenciaFederalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependenciaFederals = DependenciaFederal::all();

        return view('publico.dependencias_federales.index')
            ->with('dependenciaFederals', $dependenciaFederals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publico.dependencias_federales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $dependenciaFederal = DependenciaFederal::create($input);

        Flash::success('Dependencia Federal guardado satisfactoriamente.');

        return redirect(route('dependenciasfederales.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependenciaFederal = DependenciaFederal::find($id);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }

        return view('publico.dependencias_federales.show')->with('dependenciaFederal', $dependenciaFederal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dependenciaFederal = DependenciaFederal::find($id);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }

        return view('publico.dependencias_federales.edit')->with('dependenciaFederal', $dependenciaFederal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $dependenciaFederal = DependenciaFederal::find($id);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }

        $dependenciaFederal->nombre=$request->input('nombre');
        $dependenciaFederal->capitania_id=$request->input('capitania_id');
        $dependenciaFederal->save();

        Flash::success('Dependencia Federal actualizada satisfactoriamente.');

        return redirect(route('dependenciasfederales.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dependenciaFederal = DependenciaFederal::find($id);

        if (empty($dependenciaFederal)) {
            Flash::error('Dependencia Federal no encontrada');

            return redirect(route('dependenciasfederales.index'));
        }

        $dependenciaFederal->delete($id);

        Flash::success('Dependencia Federal eliminada.');

        return redirect(route('dependenciasfederales.index'));
    }
}
