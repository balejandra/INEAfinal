<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Requests\Zarpes\CreateCertificadoObligatorioRequest;
use App\Http\Requests\Zarpes\UpdateCertificadoObligatorioRequest;
use App\Repositories\Zarpes\CertificadoObligatorioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CertificadoObligatorioController extends AppBaseController
{
    /** @var  CertificadoObligatorioRepository */
    private $certificadoObligatorioRepository;

    public function __construct(CertificadoObligatorioRepository $certificadoObligatorioRepo)
    {
        $this->certificadoObligatorioRepository = $certificadoObligatorioRepo;
    }

    /**
     * Display a listing of the CertificadoObligatorio.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $certificadoObligatorios = $this->certificadoObligatorioRepository->all();

        return view('zarpes.certificado_obligatorios.index')
            ->with('certificadoObligatorios', $certificadoObligatorios);
    }

    /**
     * Show the form for creating a new CertificadoObligatorio.
     *
     * @return Response
     */
    public function create()
    {
        return view('zarpes.certificado_obligatorios.create');
    }

    /**
     * Store a newly created CertificadoObligatorio in storage.
     *
     * @param CreateCertificadoObligatorioRequest $request
     *
     * @return Response
     */
    public function store(CreateCertificadoObligatorioRequest $request)
    {
        $input = $request->all();

        $certificadoObligatorio = $this->certificadoObligatorioRepository->create($input);

        Flash::success('Certificado Obligatorio guardado satisfactoriamente.');

        return redirect(route('certificadoObligatorios.index'));
    }

    /**
     * Display the specified CertificadoObligatorio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $certificadoObligatorio = $this->certificadoObligatorioRepository->find($id);

        if (empty($certificadoObligatorio)) {
            Flash::error('Certificado Obligatorio no encontrado');

            return redirect(route('certificadoObligatorios.index'));
        }

        return view('zarpes.certificado_obligatorios.show')->with('certificadoObligatorio', $certificadoObligatorio);
    }

    /**
     * Show the form for editing the specified CertificadoObligatorio.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $certificadoObligatorio = $this->certificadoObligatorioRepository->find($id);

        if (empty($certificadoObligatorio)) {
            Flash::error('Certificado Obligatorio no encontrado');

            return redirect(route('certificadoObligatorios.index'));
        }

        return view('zarpes.certificado_obligatorios.edit')->with('certificadoObligatorio', $certificadoObligatorio);
    }

    /**
     * Update the specified CertificadoObligatorio in storage.
     *
     * @param int $id
     * @param UpdateCertificadoObligatorioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCertificadoObligatorioRequest $request)
    {
        $certificadoObligatorio = $this->certificadoObligatorioRepository->find($id);

        if (empty($certificadoObligatorio)) {
            Flash::error('Certificado Obligatorio no encontrado');

            return redirect(route('certificadoObligatorios.index'));
        }

        $certificadoObligatorio = $this->certificadoObligatorioRepository->update($request->all(), $id);

        Flash::success('Certificado Obligatorio actualizado satisfactoriamente.');

        return redirect(route('certificadoObligatorios.index'));
    }

    /**
     * Remove the specified CertificadoObligatorio from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $certificadoObligatorio = $this->certificadoObligatorioRepository->find($id);

        if (empty($certificadoObligatorio)) {
            Flash::error('Certificado Obligatorio no encontrado');

            return redirect(route('certificadoObligatorios.index'));
        }

        $this->certificadoObligatorioRepository->delete($id);

        Flash::success('Certificado Obligatorio eliminado satisfactoriamente.');

        return redirect(route('certificadoObligatorios.index'));
    }
}
