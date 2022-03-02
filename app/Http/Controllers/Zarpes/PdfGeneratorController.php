<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use App\Models\Zarpes\PermisoZarpe;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
{
    public function imprimir($id){
        $trans= PermisoZarpe::all();
        $tran= $trans->find($id);
        $pdf=PDF::loadView('PDF.zarpes.permiso',compact('tran'));
        return $pdf->stream('factura.pdf');
    }
}
