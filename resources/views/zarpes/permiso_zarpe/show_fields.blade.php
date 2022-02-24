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
