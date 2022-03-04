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
            @if ($permisoZarpe->status->id==1)
                <td class="text-success">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==2)
                <td class="text-danger">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==3)
                <td class="text-warning">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==4)
                <td class="text-muted">{{ $permisoZarpe->status->nombre}} </td>
            @else
                <td>{{ $permisoZarpe->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-zarpe')
                    <a class="btn btn-sm btn-success"
                       href=" {{route('permisoszarpes.show',$permisoZarpe->id)}}">
                        <i class="fa fa-search"></i>
                    </a>
                    @can('informar-arribo')
                        @if ($permisoZarpe->status->id==1)
                            <a class="btn btn-sm btn-primary"
                               href="{{route('status',[$permisoZarpe->id,'cerrado',0])}}" data-toggle="tooltip"
                               data-bs-placement="bottom" title="Informar Arribo">
                                <i class="fas fa-anchor"></i>
                            </a>
                        @endif
                    @endcan
                    @if (($permisoZarpe->status->id==1)||($permisoZarpe->status->id==4))
                        <a class="btn btn-sm btn-dark"
                           href="{{route('zarpepdf',$permisoZarpe->id)}}" target="_blank" data-toggle="tooltip"
                           data-bs-placement="bottom" title="Descargar PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    @endif
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
