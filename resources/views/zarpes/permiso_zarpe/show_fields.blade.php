<strong>Detalle del Zarpe</strong>
<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">Nro de Solicitud</th>
        <td>{{ $permisoZarpe->nro_solicitud }}</td>
        <th class="bg-light">Nombre Solicitante</th>
        <td>{{ $permisoZarpe->user->nombres}}</td>
    </tr>
    <tr>
        <th class="bg-light">Bandera</th>
        <td>{{ $permisoZarpe->bandera }}</td>
        <th class="bg-light">Matricula Buque</th>
        <td>{{ $permisoZarpe->matricula }}</td>
    </tr>
    <tr>
        <th class="bg-light">Tipo de Navegacion</th>
        <td>{{ $permisoZarpe->tipo_zarpe->nombre }}</td>
        <th class="bg-light">Origen</th>
        <td>{{ $permisoZarpe->establecimiento_nautico->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Coordenadas</th>
        <td>{{ $permisoZarpe->coordenadas }}</td>
        <th class="bg-light">Destino</th>
        <td>{{ $permisoZarpe->capitania->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Fecha y Hora Salida</th>
        <td>{{$permisoZarpe->fecha_hora_salida }}</td>
        <th class="bg-light">fecha y Hora Regreso</th>
        <td>{{$permisoZarpe->fecha_hora_regreso }}</td>
    </tr>
    <tr>
        <th class="bg-light">Status</th>
        <td>{{ $permisoZarpe->status->nombre }}</td>
    </tr>
    </tbody>
</table>
<br>
<strong>Tripulantes</strong>

<table class="table">
    <tbody>
    <thead>


    <th>Nombres y Apellidos</th>
    <th>Cédula</th>
    <th>Documento</th>
    <th>Fecha vencimiento</th>

    </thead>
    @forelse($tripulantes as $tripulante)
        <tr>
           
           
            <td>{{$tripulante->nombre}} {{$tripulante->apellido}} </td>
            <td>{{$tripulante->ci}}</td>
            <td>{{$tripulante->documento}} </td>
            <td>{{$tripulante->fecha_vencimiento}} </td>

            
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
        </tr>
    @endforelse
</table>
<strong>Pasajeros</strong>

<table class="table">
    <tbody>
    <thead>
    <th>Nombres y Apellidos</th>
    <th>Documentacion</th>
    <th>Sexo</th>
    <th>menor</th>
     
    </thead>
    @forelse($pasajeros as $pasajero)
        <tr>
            <td> {{$pasajero->nombres}}  {{$pasajero->apellidos}}</td>
            <td> {{$pasajero->tipo_doc}}  {{$pasajero->nro_doc}}</td>
            <td>{{$pasajero->sexo}} </td>
            @if($pasajero->menor)
            <td>SI </td>
             @else
            <td>NO</td>
             @endif
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
        </tr>
    @endforelse
</table>

<!-- Submit Field -->

<div class="form-group col-sm-12">
    @if(($permisoZarpe->status->id=='2') || ($permisoZarpe->status->id=='3'))
    <a href="{{route('status',[$permisoZarpe->id,'aprobado'])}}" class="btn btn-primary" title="Aprobar">
      Aprobar
    </a>
    @endif
    @if ($permisoZarpe->status->id=='3')
    <a href="{{route('status',[$permisoZarpe->id,'rechazado'])}}" class="btn btn-danger" title="Rechazar">
     Rechazar
    </a>
        @endif
</div>

