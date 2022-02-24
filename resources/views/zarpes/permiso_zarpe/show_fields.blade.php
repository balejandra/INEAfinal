<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">Nro de Solicitud</th>
        <td>{{ $permisoZarpe->nro_solicitud }}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre Solicitante</th>
        <td>{{ $permisoZarpe->user->nombres}}</td>
    </tr>
    <tr>
        <th class="bg-light" style="width:25%">Cant Tripulantes</th>
        <td>{{ $permisoZarpe->bandera }}</td>
    </tr>

    <tr>
        <th class="bg-light">Created At</th>
        <td>{{ $permisoZarpe->matricula }}</td>
    </tr>
    <tr>
        <th class="bg-light">Created At</th>
        <td>{{ $permisoZarpe->tipo_zarpe->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Created At</th>
        <td>{{ $permisoZarpe->establecimiento_nautico->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Created At</th>
        <td>{{ $permisoZarpe->coordenadas }}</td>
    </tr>
    <tr>
        <th class="bg-light">Created At</th>
        <td>{{ $permisoZarpe->coordenadas }}</td>
    </tr>
    </tbody>
</table>


