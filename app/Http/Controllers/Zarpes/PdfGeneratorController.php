<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\Gmar\LicenciasTitulosGmar;
use App\Models\Publico\Capitania;
use App\Models\Publico\CapitaniaUser;
use App\Models\Renave\Renave_data;
use App\Models\Zarpes\EstadiaRevision;
use App\Models\Zarpes\Pasajero;
use App\Models\Zarpes\PermisoEstadia;
use App\Models\Zarpes\PermisoZarpe;
use App\Models\Zarpes\Tripulante;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\DescripcionNavegacion;
use App\Models\Publico\Paises;
use App\Models\Zarpes\TripulanteInternacional;

use App\Models\Zarpes\ZarpeRevision;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfGeneratorController extends Controller
{
    public function imprimir($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=PermisoEstadia::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Capitania::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=Tripulante::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();

        if($tripulantes[0]->ctrl_documento_id==0 || $tripulantes[0]->ctrl_documento_id=="0"){
            $tripulanteCap=Tripulante::select('*')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();
             $trip = [
            'id' => $tripulanteCap[0]->id,
            'permiso_zarpe_id' => $tripulanteCap[0]->permiso_zarpe_id,
            'ctrl_documento_id' => $tripulanteCap[0]->ctrl_documento_id,
            'capitan' => $tripulanteCap[0]->capitan,
            'funcion' => $tripulanteCap[0]->funcion,
            'nombre' => $tripulanteCap[0]->nombres,
            'apellido' => $tripulanteCap[0]->apellidos,
            'tipo_doc' => $tripulanteCap[0]->tipo_doc,
            'nro_doc'  => $tripulanteCap[0]->nro_doc,
            'doc'  => $tripulanteCap[0]->doc,
            'rango'  => $tripulanteCap[0]->rango,
            'documento_acreditacion'  => $tripulanteCap[0]->documento_acreditacion,
            'fecha_nacimiento'  => $tripulanteCap[0]->fecha_nacimiento,
            'sexo'  => $tripulanteCap[0]->sexo,
            ];
            $trip=(object)$trip;
        }else{
            $trip= LicenciasTitulosGmar::whereIn('id',$tripulantes)->first();
        }

        $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
        $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $aprobador= ZarpeRevision::where('permiso_zarpe_id',$id)->first();
        $cargo= CapitaniaUser::where('user_id',$aprobador->user_id)->first();
        $pdf= Pdf::loadView('PDF.zarpes.permiso',compact('zarpe','buque','trip','capitania','cantPas',
            'cantTrip','estnauticoDestino','DescripcionNavegacion','aprobador','cargo'));
        return $pdf->stream('zarpes.pdf');
    }
    public function imprimirEstadia($id){
        $estadia=PermisoEstadia::find($id);
        $capitania= Capitania::where('id',$estadia->capitania_id)->first();
        $aprobador= EstadiaRevision::where('permiso_estadia_id',$id)->first();
        $pdf= Pdf::loadView('PDF.estadias.permiso',compact('estadia','capitania','aprobador'));
        return $pdf->stream('estadia.pdf');
    }

    public function correo($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=PermisoEstadia::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Capitania::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=Tripulante::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();

        if($tripulantes[0]->ctrl_documento_id==0 || $tripulantes[0]->ctrl_documento_id=="0"){
            $tripulanteCap=Tripulante::select('*')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();
             $trip = [
            'id' => $tripulanteCap[0]->id,
            'permiso_zarpe_id' => $tripulanteCap[0]->permiso_zarpe_id,
            'ctrl_documento_id' => $tripulanteCap[0]->ctrl_documento_id,
            'capitan' => $tripulanteCap[0]->capitan,
            'funcion' => $tripulanteCap[0]->funcion,
            'nombre' => $tripulanteCap[0]->nombres,
            'apellido' => $tripulanteCap[0]->apellidos,
            'tipo_doc' => $tripulanteCap[0]->tipo_doc,
            'nro_doc'  => $tripulanteCap[0]->nro_doc,
            'doc'  => $tripulanteCap[0]->doc,
            'rango'  => $tripulanteCap[0]->rango,
            'documento_acreditacion'  => $tripulanteCap[0]->documento_acreditacion,
            'fecha_nacimiento'  => $tripulanteCap[0]->fecha_nacimiento,
            'sexo'  => $tripulanteCap[0]->sexo,
            ];
            $trip=(object)$trip;
        }else{
            $trip= LicenciasTitulosGmar::whereIn('id',$tripulantes)->first();
        }

        $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
        $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $aprobador= ZarpeRevision::where('permiso_zarpe_id',$id)->first();
        $cargo= CapitaniaUser::where('user_id',$aprobador->user_id)->first();
        $pdf1= Pdf::loadView('PDF.zarpes.permiso', compact('zarpe','buque','trip','capitania','cantPas',
            'cantTrip','estnauticoDestino','DescripcionNavegacion','aprobador','cargo'));
        return $pdf1->output();

    }

    public function correoEstadia($id){
       $estadia=PermisoEstadia::find($id);
        $capitania= Capitania::where('id',$estadia->capitania_id)->first();
        $aprobador= EstadiaRevision::where('permiso_estadia_id',$id)->first();
        $pdf= Pdf::loadView('PDF.estadias.permiso', compact('estadia','capitania','aprobador'));
        return $pdf->output();

    }

    public function imprimirInternacional($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=PermisoEstadia::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Capitania::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=TripulanteInternacional::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=TripulanteInternacional::select('*')->where('permiso_zarpe_id',$id)->get();
       // dd($tripulantes);
       // $trip= TripulanteInternacional::whereIn('id',$tripulantes)->first();
       // $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
       foreach($tripulantes as $tripulante){
            if($tripulante->funcion=="Capitán"){
                $trip=$tripulante;
            }
       }

       $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $pais= Paises::find($zarpe->paises_id);
        $aprobador= ZarpeRevision::where('permiso_zarpe_id',$id)->first();
        $cargo= CapitaniaUser::where('user_id',$aprobador->user_id)->first();
        $pdf= PDFAlias::loadView('PDF.zarpeInternacional.permiso',compact('zarpe','buque','trip','capitania',
            'cantPas','cantTrip','DescripcionNavegacion','pais','aprobador','cargo'));
        return $pdf->stream('zarpes.pdf');
    }

    public function correoZI($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=PermisoEstadia::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Capitania::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=TripulanteInternacional::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=TripulanteInternacional::select('*')->where('permiso_zarpe_id',$id)->get();
        // dd($tripulantes);
        // $trip= TripulanteInternacional::whereIn('id',$tripulantes)->first();
        // $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
        foreach($tripulantes as $tripulante){
            if($tripulante->funcion=="Capitán"){
                $trip=$tripulante;
            }
        }

        $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $pais= Paises::find($zarpe->paises_id);
        $aprobador= ZarpeRevision::where('permiso_zarpe_id',$id)->first();
        $cargo= CapitaniaUser::where('user_id',$aprobador->user_id)->first();
        $pdf= Pdf::loadView('PDF.zarpeInternacional.permiso',compact('zarpe','buque','trip','capitania',
            'cantPas','cantTrip','DescripcionNavegacion','pais','aprobador','cargo'));
        return $pdf->output();

    }
}
