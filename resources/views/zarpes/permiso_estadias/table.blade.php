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
            @if ($permisoEstadia->status->id==1)
                <td class="text-success">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==2)
                <td class="text-danger">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==3)
                <td class="text-warning">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==6)
                <td style="color: #fd7e14">{{$permisoEstadia->status->nombre}}</td>
            @elseif($permisoEstadia->status->id==9)
                <td><span class="text-warning bg-dark">{{$permisoEstadia->status->nombre}}</span></td>
            @elseif($permisoEstadia->status->id==10)
                <td class="text-primary">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==11)
                <td style="color: #770bba">{{ $permisoEstadia->status->nombre}} </td>
            @else
                <td>{{ $permisoOrigenZarpe->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-estadia')
                <a class="btn btn-sm btn-success" href="  {{ route('permisosestadia.show', $permisoEstadia['id']) }}">
                    <i class="fa fa-search"></i>
                </a>
                @endcan
                @can('asignar-visita-estadia')
                    @if ($permisoEstadia->status_id===3)
                            <!-- Button trigger modal -->
                                <a class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                   data-bs-target="#staticBackdrop" data-toggle="tooltip"
                                   data-bs-placement="bottom"
                                   title="Asignar Visitador">
                                    <i class="fas fa-user-clock"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop"
                                     data-bs-backdrop="static" data-bs-keyboard="false"
                                     tabindex="-1" aria-labelledby="staticBackdropLabel"
                                     aria-hidden="true">
                                    <form
                                        action="{{route('statusEstadia',[$permisoEstadia->id,9])}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="staticBackdropLabel">Asignar Visitador</h5>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Por favor llene los datos necesarios para la visita de la solicitud
                                                        Nro. {{ $permisoEstadia->nro_solicitud }}</p>
                                                    <div class="row">
                                                    <div class="form-group col-sm-6">
                                                            {!! Form::label('visitador', 'Nombres y Apellidos del Visitador:') !!}
                                                            {!! Form::text('visitador', null, ['class' => 'form-control', 'required']) !!}

                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        {!! Form::label('fecha_visita', 'Fecha de Visita:') !!}
                                                        {!! Form::date('fecha_visita', null, ['class' => 'form-control']) !!}

                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-primary">
                                                        Asignar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                    @endif
                    @endcan

                    @can('visita-estadia-aprobada')
                        @if ($permisoEstadia->status_id===9)
                            <a class="btn btn-sm btn-info"
                               href=" {{route('statusEstadia',[$permisoEstadia->id,10])}}" data-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Aprobar Visita">
                                <i class="fas fa-user-check"></i>
                            </a>
                        @endif
                    @endcan

                    @can('recaudos-estadia')
                        @if ($permisoEstadia->status_id===10)
                            <a class="btn btn-sm" style="background-color: #fd7e14"
                               href=" {{ route('permisosestadia.edit', [$permisoEstadia->id]) }}" data-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Subir Recaudos Faltantes">
                                <i class="fas fa-book"></i>
                            </a>
                        @endif
                    @endcan
                    @can('aprobar-estadia')
                        @if ($permisoEstadia->status_id===11)
                            <a class="btn btn-sm btn-primary"
                               href="{{route('statusEstadia',[$permisoEstadia->id,1])}}" data-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Aprobar">
                                <i class="fa fa-check"></i>
                            </a>
                        @endif
                    @endcan

                    @can('rechazar-estadia')
                        @if (($permisoEstadia->status_id===3) || ($permisoEstadia->status_id===9) || ($permisoEstadia->status_id===11)  )
                        <!-- Button trigger modal -->
                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                               data-bs-target="#staticBackdrop">
                                <i class="fa fa-ban"></i>
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop"
                                 data-bs-backdrop="static" data-bs-keyboard="false"
                                 tabindex="-1" aria-labelledby="staticBackdropLabel"
                                 aria-hidden="true">
                                <form
                                    action="{{route('statusEstadia',[$permisoEstadia->id,2])}}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="staticBackdropLabel">Rechazar Solicitud Estadia</h5>
                                                <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Por favor indique el motivo del rechazo de la Solicitud Nro. {{ $permisoEstadia->nro_solicitud }}</p>
                                                <div class="col-sm-12">
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" aria-label="motivo" id="motivo1" name="motivo" onchange="motivoRechazo();" required>
                                                            <option value="">Seleccione un motivo</option>
                                                            <option value="Disposiciones del Ejecutivo Nacional">Disposiciones del Ejecutivo Nacional.</option>
                                                            <option value="Instrucciones especiales de la autoridad acuática">Instrucciones especiales de la autoridad acuática.</option>
                                                            <option value="Condiciones meteorológicas adversas">Condiciones meteorológicas adversas.</option>
                                                            <option value="Observaciones en los documentos">Observaciones en los documentos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group" style="display: none" id="inputmotivo">
                                                    <input type="text" class="form-control" name="motivo" id="motivo2">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Rechazar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endcan

                    @if ($permisoEstadia->status_id===1)
                        <a class="btn btn-sm btn-dark"
                           href="{{route('estadiapdf',$permisoEstadia->id)}}"
                           target="_blank" data-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Descargar PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        @can('renovar-estadia')
                            <a class="btn btn-sm btn-ghost-info"
                               href="{{route('createrenovacion',$permisoEstadia->id)}}" data-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Descargar PDF">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        @endcan
                    @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
