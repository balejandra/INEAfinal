<table class="table table-striped table-bordered" id="permisoZarpes-table">
    <thead>
    <tr>
        <th>Nro Solicitud</th>
        <th>Solicitante</th>
        <th>Bandera</th>
        <th>Matricula</th>
        <th>Tipo Navegacion</th>
        <th>Status</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permisoZarpes as $permisoZarpe)
        <tr>
            <td>{{ $permisoZarpe->nro_solicitud }}</td>
            <td>{{ $permisoZarpe->user->nombres }} {{ $permisoZarpe->user->apellidos }}</td>
            <td>{{ $permisoZarpe->bandera }}</td>
            <td>{{ $permisoZarpe->matricula }}</td>
            <td>{{ $permisoZarpe->tipo_zarpe->nombre }}</td>
            <td>{{ $permisoZarpe->status->nombre}} </td>
            <td>
                @can('consultar-zarpe')
                    <a class="btn btn-sm btn-success"
                       href=" {{route('permisoszarpes.show',$permisoZarpe->id)}}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
