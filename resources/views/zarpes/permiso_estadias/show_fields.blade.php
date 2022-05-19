<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr>
            <th class="bg-light">Nro Solicitud:</th>
            <td>{{ $permisoEstadia->nro_solicitud }}</td>
            <th class="bg-light">Solicitante</th>
            <td>{{ $permisoEstadia->user->nombres}} {{ $permisoEstadia->user->apellidos}}</td>
        </tr>
        <tr>
            <th class="bg-light">Nombre Buque</th>
            <td>{{ $permisoEstadia->nombre_buque }}</td>
            <th class="bg-light">Numero Registro</th>
            <td>{{ $permisoEstadia->nro_registro }}</td>
        </tr>
        <tr>
            <th class="bg-light">Tipo Buque</th>
            <td>{{ $permisoEstadia->tipo_buque }}</td>
            <th class="bg-light">Nacionalidad Buque</th>
            <td>{{ $permisoEstadia->nacionalidad_buque }}</td>
        </tr>
        <tr>
            <th class="bg-light">Propietario</th>
            <td>{{ $permisoEstadia->nombre_propietario }}</td>
            <th class="bg-light">Pasaporte del Capitán</th>
            <td>{{ $permisoEstadia->pasaporte_capitan }}</td>
        </tr>
        <tr>
            <th class="bg-light">Nombres completos del Capitán</th>
            <td>{{ $permisoEstadia->nombre_capitan }}</td>
            <th class="bg-light">Numero Tripulantes</th>
            <td>{{ $permisoEstadia->cant_tripulantes }}</td>
        </tr>
        <tr>
            <th class="bg-light">Numero Pasajeros</th>
            <td>{{ $permisoEstadia->cant_pasajeros }}</td>
            <th class="bg-light">Arqueo Bruto</th>
            <td>{{ $permisoEstadia->arqueo_bruto }}</td>
        </tr>
        <tr>
            <th class="bg-light">Eslora</th>
            <td>{{ $permisoEstadia->eslora }}</td>
            <th class="bg-light">Potencia KW</th>
            <td>{{ $permisoEstadia->potencia_kw }}</td>
        </tr>
        <tr>
            <th class="bg-light">Actividades que realizará</th>
            <td>{{ $permisoEstadia->actividades }}</td>
            <th class="bg-light">Puerto de Origen / País</th>
            <td>{{ $permisoEstadia->puerto_origen }}</td>
        </tr>

        <tr>
            <th class="bg-light">Circunscripción Acuática de Arribo</th>
            <td>{{ $permisoEstadia->capitania->nombre }}</td>
            <th class="bg-light">Tiempo Estadia</th>
            <td>{{ $permisoEstadia->tiempo_estadia }}</td>
        </tr>

        <tr>
            <th class="bg-light">Fecha de Vencimiento</th>
            <td>{{ $permisoEstadia->vencimiento }}</td>
            <th class="bg-light">Cantidad de Solicitudes</th>
            <td>{{ $permisoEstadia->cantidad_solicitud }} vez</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="container">
<div class="row">
    @foreach($documentos as $documento)
        <div class="col-sm-6">
            <a class="document-link" href="{{asset('documentos/permisoestadia/'.$documento->documento)}}" target="_blank">
                {{$documento->recaudo }}</a>
        </div>
    @endforeach
</div>
</div>
<br>
