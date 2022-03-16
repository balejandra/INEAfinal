<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">Nro Solicitud:</th>
        <td>{{ $permisoEstadia->nro_solicitud }}</td>
    </tr>
    <tr>
        <th class="bg-light">Solicitante</th>
        <td>{{ $permisoEstadia->user->nombres}} {{ $permisoEstadia->user->apellidos}}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre Buque</th>
        <td>{{ $permisoEstadia->nombre_buque }}</td>
    </tr>
    <tr>
        <th class="bg-light">Numero Registro</th>
        <td>{{ $permisoEstadia->nro_registro }}</td>
    </tr>
    <tr>
        <th class="bg-light">Tipo Buque</th>
        <td>{{ $permisoEstadia->tipo_buque }}</td>
    </tr>
    <tr>
        <th class="bg-light">Nacionalidad Buque</th>
        <td>{{ $permisoEstadia->nacionalidad_buque }}</td>
    </tr>

    <tr>
        <th class="bg-light">Propietario</th>
        <td>{{ $permisoEstadia->nombre_propietario }}</td>
    </tr>
    <tr>
        <th class="bg-light">Pasaporte Capitan</th>
        <td>{{ $permisoEstadia->pasaporte_capitan }}</td>
    </tr>

    <tr>
        <th class="bg-light">Nombres completos Capitan</th>
        <td>{{ $permisoEstadia->nombre_capitan }}</td>
    </tr>
    <tr>
        <th class="bg-light">Numero Tripulantes</th>
        <td>{{ $permisoEstadia->cant_tripulantes }}</td>
    </tr>
    <tr>
        <th class="bg-light">Arqueo Bruto</th>
        <td>{{ $permisoEstadia->arqueo_bruto }}</td>
    </tr>
    <tr>
        <th class="bg-light">Actividades</th>
        <td>{{ $permisoEstadia->actividades }}</td>
    </tr>

    <tr>
        <th class="bg-light">Puerto Origen</th>
        <td>{{ $permisoEstadia->puerto_origen }}</td>
    </tr>
    <tr>
        <th class="bg-light">Puerto Destino</th>
        <td>{{ $permisoEstadia->capitania->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Tiempo Estadia</th>
        <td>{{ $permisoEstadia->tiempo_estadia }}</td>
    </tr>
    </tbody>
</table>
@foreach($documentos as $documento)
    <div class="list-group">
        <a href="{{asset('permisoestadia/documentos/'.$documento->documento)}}" target="_blank">
            {{$documento->recaudo }}</a>
    </div>
@endforeach
