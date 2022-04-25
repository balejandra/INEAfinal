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
            @elseif($permisoZarpe->status->id==5)
                <td class="text-primary">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==7)
                <td><span class="text-danger bg-dark">{{$permisoZarpe->status->nombre}}</span></td>
            @elseif($permisoZarpe->status->id==6)
                <td style="color: #fd7e14">{{$permisoZarpe->status->nombre}}</td>
            @else
                <td>{{ $permisoZarpe->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-zarpe')
                    <a class="btn btn-sm btn-primary"
                       href=" {{route('zarpeInternacional.show',$permisoZarpe->id)}}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                    @if(($permisoZarpe->status->id=='1'))
                        @can('informar-navegacion')
                            <a class="btn btn-sm btn-warning"
                               href=" {{route('statusInt',[$permisoZarpe->id,'navegando',$permisoZarpe->establecimiento_nautico_id])}}" data-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Informar Navegacion">
                                <i class="fas fa-water"></i>
                            </a>
                        @endcan
                    @endif
                    @can('informar-arribo')
                        @if ($permisoZarpe->status->id==5)
                            <a class="btn btn-sm btn-warning"
                               href="{{route('statusInt',[$permisoZarpe->id,'cerrado',0])}}" data-toggle="tooltip"
                               data-bs-placement="bottom" title="Informar Arribo">
                                <i class="fas fa-anchor"></i>
                            </a>
                        @endif
                    @endcan
                    @can('anular-zarpeUsuario')
                        @if ($permisoZarpe->status->id==1)
                            <a class="btn btn-sm btn-danger"
                               href="{{route('status',[$permisoZarpe->id,'anular-usuario',0])}}" data-toggle="tooltip"
                               data-bs-placement="bottom" title="Anular Solicitud">
                                <i class="fas fa-window-close"></i>
                            </a>
                            @endif
                        @endcan
                    @if (($permisoZarpe->status->id==1)||($permisoZarpe->status->id==4)||($permisoZarpe->status->id==5))
                        <a class="btn btn-sm btn-dark"
                           href="{{route('zarpepdf',$permisoZarpe->id)}}" target="_blank" data-toggle="tooltip"
                           data-bs-placement="bottom" title="Descargar PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
