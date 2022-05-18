@php
    function coordenadasGrad($coordenada){
        $gcoordenada=intval($coordenada);
        $mcoordenada1=number_format(($coordenada-$gcoordenada)*60, 4, '.', '');
        $mcoordenada2=intval($mcoordenada1);
        $scoordenada1=number_format(($mcoordenada1-$mcoordenada2)*60, 4, '.', '');
        $scoordenada2=number_format($scoordenada1,1,'.','');
        $scoordenada2= abs($scoordenada2);
        if($scoordenada2 < 10 ){
            $scoordenada2='0'.$scoordenada2;
        }
         return abs($gcoordenada).'°'.abs($mcoordenada2).'\''.$scoordenada2.'"';

    }
@endphp


<div class="table-responsive px-3">
    <strong>Detalle del Zarpe</strong>
    <table class="table">
        <tbody>
        <tr>
            <th class="bg-light col-md-2">Nro de Solicitud</th>
            <td>{{ $permisoZarpe->nro_solicitud }}</td>
            <th class="bg-light col-md-2">Fecha de Solicitud</th>
            <td>{{ $permisoZarpe->created_at}}</td>
        </tr>
        <tr>
            <th class="bg-light col-md-2">Nombre Solicitante</th>
            <td>{{ $permisoZarpe->user->nombres}} {{ $permisoZarpe->user->apellidos}}</td>
            <th class="bg-light">Bandera</th>
            <td>{{ $permisoZarpe->bandera }}</td>
        </tr>
        <tr>
            <th class="bg-light">Matricula Buque</th>
            <td>{{ $permisoZarpe->matricula }}</td>
            <th class="bg-light">Nombre Buque</th>
            @if($permisoZarpe->bandera=='extranjera')
                <td>{{ $buque->nombre_buque }}</td>
            @else
                <td>{{ $buque->nombrebuque_actual }}</td>
            @endif
        </tr>

        <tr>
            <th class="bg-light">Tipo de Navegacion</th>
            <td>{{ $permisoZarpe->tipo_zarpe->nombre }}</td>
            <th class="bg-light">Descripcion de Navegación</th>
            <td>{{$descripcionNavegacion->descripcion}}</td>

        </tr>
        <tr>
            <th class="bg-light">Origen</th>
            <td>{{$capitaniaOrigen->nombre}} <br> {{ $permisoZarpe->establecimiento_nautico->nombre }}</td>
            <th class="bg-light">Coordenadas (escala)</th>
            @php $coords=json_decode($permisoZarpe->coordenadas); @endphp
            <td>Latitud: @php echo coordenadasGrad($coords[0]); @endphp N <br>
                Longitud: @php echo coordenadasGrad($coords[1]); @endphp W
            </td>
        </tr>
        <tr>
            <th class="bg-light">Destino</th>
            <td>{{ $permisoZarpe->capitania->nombre }} <br> {{$establecimientoDestino->nombre}}</td>
            <th class="bg-light">Fecha y Hora Salida</th>
            <td>{{$permisoZarpe->fecha_hora_salida }}</td>
        </tr>
        <tr>
            <th class="bg-light">Fecha y Hora Regreso</th>
            <td>{{$permisoZarpe->fecha_hora_regreso }}</td>
            <th class="bg-light">Status</th>
            <td>{{ $permisoZarpe->status->nombre }}</td>
        </tr>
        </tbody>
    </table>
    <br>

    <div class="table-responsive">
        <strong>Certificados de Seguridad Marítima</strong>

        <table class="table table-bordered">
            <tbody>
            <thead>
            <th class="bg-light col-md-2">Tipo de Certificado</th>
            <th class="bg-light col-md-2">Fecha de Expedición</th>
            </thead>

            @forelse($certificados as $certificado)
                <tr>
                    <td>{{ $certificado->nombre_certificado }}</td>
                    <td>{{ $certificado->fecha_expedicion}}</td>
                    @empty
                        <span class="badge badge-danger">Sin Tripulantes</span>
                </tr>
            @endforelse
        </table>

        <div class="table-responsive">
            <strong>Tripulantes</strong>

            <table class="table table-bordered">
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
                            <span class="badge badge-danger">Sin Tripulantes</span>
                    </tr>
                @endforelse
            </table>
        </div>


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
                    @if($pasajero->menor_edad==true)
                        <td>SI</td>
                    @else
                        <td>NO</td>
                    @endif
                    @empty
                        <span class="badge badge-danger">Sin Pasajeros</span>
                </tr>
            @endforelse
        </table>
        <br>
        <strong>Equipos de Seguridad</strong>
        <table class="table">
            <tbody>
            <thead>
            <tr>
                <th>Equipo</th>
                <th>Cantidad</th>
                <th>Otros</th>
            </tr>
            </thead>
            @forelse($equipos as $equipo)
                <tr>
                    <td>
                        {{$equipo->equipo->equipo}}
                    </td>

                    <td>
                    {{$equipo->cantidad}}

                    <td>
                        @if($equipo->otros=="fecha_ultima_inspeccion")
                            Fecha de última inspección {{$equipo->valores_otros}}
                        @else
                            {{$equipo->otros}} {{$equipo->valores_otros}}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center"> No existen registros para mostrar</td>
                </tr>
                @endforelse
                </tbody>
        </table>
        <br>
        <strong>Historial de revisiones</strong>
        <table class="table">
            <tbody>
            <thead>
            <tr>
                <th>Nombre y Apellido</th>
                <th>Accion</th>
                <th>Motivo</th>
                <th>Fecha</th>
            </tr>
            </thead>
            @forelse($revisiones as $revision)
                <tr>
                    <td>{{$revision->user->nombres}} {{$revision->user->apellidos}}</td>
                    <td>{{$revision->accion}}</td>
                    <td>{{$revision->motivo}}</td>
                    <td>{{$revision->created_at}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center"> No existen registros para mostrar</td>
                </tr>
                @endforelse
                </tbody>
        </table>
    </div>
    <br>
    <!-- Submit Field -->
    <div class="form-group col-sm-12 text-center">
        @can('aprobar-zarpe')
            @if(($permisoZarpe->status->id==3))
                <a data-route="{{route('status',[$permisoZarpe->id,'aprobado',$permisoZarpe->establecimiento_nautico_id])}}"
                   class="btn btn-success confirmation" title="Aprobar" data-action="APROBAR">
                    Aprobar <i class="fa fa-check"></i>
                </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
        @endcan
        @can('rechazar-zarpe')
            @if ($permisoZarpe->status->id==3)
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-rechazo"
                   onclick="modalrechazarzarpe({{$permisoZarpe->id}},'{{$permisoZarpe->nro_solicitud}}')">
                    Rechazar <i class="fa fa-ban"></i>
                </a>

                <!-- Modal Rechazar -->
                <div class="modal fade" id="modal-rechazo" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form id="rechazar-zarpe" action="" class="modal-form">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Rechazar Solicitud Zarpe</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Por favor indique el motivo del rechazo de la Solicitud Nro. <span
                                            id="solicitudzarpe"></span></p>
                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <select class="form-select" aria-label="motivo" id="motivo1" name="motivo"
                                                    onchange="motivoRechazo();" required>
                                                <option value="">Seleccione un motivo</option>
                                                <option value="Disposiciones del Ejecutivo Nacional">Disposiciones del
                                                    Ejecutivo Nacional.
                                                </option>
                                                <option value="Instrucciones especiales de la autoridad acuática">
                                                    Instrucciones especiales de la autoridad acuática.
                                                </option>
                                                <option value="Condiciones meteorológicas adversas">Condiciones
                                                    meteorológicas adversas.
                                                </option>
                                                <option value="Observaciones en los documentos">Observaciones en los
                                                    documentos
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group" style="display: none" id="inputmotivo">
                                        <input type="text" class="form-control" name="motivo" id="motivo2">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar
                                    </button>
                                    <button type="submit" class="btn btn-primary" data-action="RECHAZAR">Rechazar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endcan
        @if(($permisoZarpe->status->id==1))
            @can('informar-navegacion')
                <a class="btn btn-warning confirmation"
                   data-route=" {{route('status',[$permisoZarpe->id,'navegando',$permisoZarpe->establecimiento_nautico_id])}}"
                   data-action="INFORMAR NAVEGACION de" data-toggle="tooltip">
                    Navegando <i class="fas fa-water"></i>
                </a>
            @endcan
        @endif
        @can('informar-arribo')
            @if ($permisoZarpe->status->id==5)
                <a class="btn btn-warning confirmation"
                   data-route="{{route('status',[$permisoZarpe->id,'cerrado',0])}}" data-toggle="tooltip"
                   data-bs-placement="bottom" title="Informar Arribo" data-action="INFORMAR ARRIBO de">
                    Informar Arribo <i class="fas fa-anchor"></i>
                </a>
            @endif
        @endcan
        @if(($permisoZarpe->status->id==5))
            @can('anular-sar')
                <a class="btn btn-outline-danger confirmation"
                   data-route=" {{route('status',[$permisoZarpe->id,'anulado_sar',$permisoZarpe->establecimiento_nautico_id])}}"
                   data-toggle="tooltip" data-action="ANULAR">
                    Anular por SAR <i class="fas fa-window-close"></i>
                </a>
            @endcan
        @endif
        @if (($permisoZarpe->status->id==1)||($permisoZarpe->status->id==4) ||($permisoZarpe->status->id==5))
            <a class="btn btn-dark"
               href="{{route('zarpepdf',$permisoZarpe->id)}}"
               target="_blank" data-toggle="tooltip"
               data-bs-placement="bottom"
               title="Descargar PDF">Descargar PDF
                <i class="fas fa-file-pdf"></i>
            </a>
        @endif
    </div>
