<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditsController extends Controller
{
    /**
     * Display a listing of the Auditable.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $auditables =Audit::all();
//dd($auditables);
        return view('publico.audits.index')
            ->with('auditables', $auditables);
    }

    /**
     * Display the specified Auditable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $auditable = Audit::find($id);

        if (empty($auditable)) {
           // Flash::error('Auditable not found');

            return redirect(route('auditables.index'))->with('danger','Auditable not found');
        }

        return view('publico.audits.show')->with('auditable', $auditable);
    }
}
