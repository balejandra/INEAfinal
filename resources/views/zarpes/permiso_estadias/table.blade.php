<table class="table table-striped table-bordered" id="permisoEstadias-table">
    <thead>
    <tr>
        <th>Nro Solicitud</th>
        <th>Solicitante</th>
        <th>Nombre Buque</th>
        <th>Nacionalidad Buque</th>
        <th>Puerto Origen</th>
        <th>Puerto Destino</th>
        <th>Status</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permisoEstadias as $permisoEstadia)

        <tr>
            <td>{{ $permisoEstadia->nro_solicitud }}</td>
            <td>{{ $permisoEstadia->user->nombres }} {{ $permisoEstadia->user->apellidos }}</td>
            <td>{{ $permisoEstadia->nombre_buque }}</td>
            <td>{{ $permisoEstadia->nacionalidad_buque }}</td>
            <td>{{ $permisoEstadia->puerto_origen }}</td>
            <td>{{ $permisoEstadia->capitania->nombre }}</td>
            <td>{{ $permisoEstadia->status->nombre }}</td>
            <td>
                <a class="btn btn-sm btn-success" href="  {{ route('permisosestadia.show', $permisoEstadia['id']) }}">
                    <i class="fa fa-search"></i>
                </a>
                <a style="display: none" class="btn btn-sm btn-info"
                   href=" {{ route('permisosestadia.edit', $permisoEstadia['id'])  }}">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
