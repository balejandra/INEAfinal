<strong>Detalle del Zarpe</strong>
<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr>
            <th width='25%' class="bg-light">Nro de Solicitud</th>
            <td width='25%'>{{ $permisoZarpe->nro_solicitud }}</td>
            <th width='25%' class="bg-light col-md-2">Fecha de Solicitud</th>
            <td width='25%'>{{ $permisoZarpe->created_at}}</td>
        </tr>
        <tr>
            <th class="bg-light">Bandera</th>
            <td>{{ $permisoZarpe->bandera }}</td>
            <th width='25%' class="bg-light">Nombre Solicitante</th>
            <td>{{ $permisoZarpe->user->nombres}} {{ $permisoZarpe->user->apellidos}}</td>
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
            <td><b>{{$descripcionNavegacion->descripcion}}</b></td>
        </tr>
        <tr>
            <th class="bg-light">Origen</th>
            <td>{{$capitaniaOrigen->nombre}} <br> {{ $permisoZarpe->establecimiento_nautico->nombre }}</td>

            <th class="bg-light">Destino</th>
            <td> {{ $pais[0]->name}} <br> {{$permisoZarpe->establecimiento_nautico_destino_zi}} </td>
        </tr>
        <tr>
            <th class="bg-light">Fecha y Hora Salida</th>
            <td>{{$permisoZarpe->fecha_hora_salida }}</td>
            <th class="bg-light">Fecha y Hora Regreso</th>
            <td>{{$permisoZarpe->fecha_hora_regreso }}</td>
        </tr>
        <tr>
            <th class="bg-light">Status</th>
            <td colspan="3">{{ $permisoZarpe->status->nombre }}</td>

        </tr>
        </tbody>
    </table>
    <br>
   <!-- <div class="table-responsive">
        <strong>Certificados de Seguridad Marítima</strong>

        <table class="table table-hover">
            <tbody>
            <thead>
            <th>Tipo de Certificado</th>
            <th>Fecha de Expedición</th>
            </thead>

            @forelse($certificados as $certificado)
                <tr>
                    <td>{{ $certificado->nombre_certificado }}</td>
                    <td>{{ $certificado->fecha_expedicion}}</td>
                    @empty
                        <span class="badge badge-danger">Sin información</span>
                </tr>
            @endforelse
        </table>
    </div>-->
    <br>
    <strong>Tripulantes</strong>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
            <thead>
            <th>Función</th>
            <th>Nombres y Apellidos</th>
            <th>Cédula</th>
            <th>rango</th>
            <th class="text-center">Pasaporte</th>
            </thead>
            @forelse($tripulantes as $tripulante)
                <tr>
                    <td>{{$tripulante->funcion}} </td>
                    <td>{{$tripulante->nombres}} {{$tripulante->apellidos}} </td>
                    <td>{{$tripulante->tipo_doc}}-{{$tripulante->nro_doc}}</td>
                    <td>{{$tripulante->rango}} </td>
                    <td class="text-center">
                        @if ($tripulante->doc)
                            <a class="document-link" title="Pasaporte"
                               href="{{asset('documentos/zarpeinternacional/'.$tripulante->doc)}}" target="_blank">
                                Pasaporte</a>
                        @endif
                    </td>
                    @empty
                        <span class="badge badge-danger">Sin Tripulantes</span>
                </tr>
            @endforelse
        </table>
    </div>

    <strong>Pasajeros</strong>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
            <thead>
            <th>Nombres y Apellidos</th>
            <th>Documentacion</th>
            <th>Sexo</th>
            <th>menor</th>
            <th>Documentos</th>

            </thead>
            @forelse($pasajeros as $pasajero)
                <tr>
                    <td> {{$pasajero->nombres}}  {{$pasajero->apellidos}}</td>
                    <td> {{$pasajero->tipo_doc}}  {{$pasajero->nro_doc}}</td>
                    <td>{{$pasajero->sexo}} </td>
                    @if($pasajero->menor_edad==true)
                        <td>SI</td>
                        <td>
                            @if ($pasajero->pasaporte_menor)
                                <a class="link-info"
                                   href="{{asset('documentos/permisozarpe/'.$pasajero->pasaporte_menor)}}"
                                   target="_blank">
                                    Pasaporte</a> <br>
                            @endif
                            @if ($pasajero->partida_nacimiento)
                                <a class="link-info"
                                   href="{{asset('documentos/permisozarpe/'.$pasajero->partida_nacimiento)}}"
                                   target="_blank">
                                    Partida de Nacimiento</a> <br>
                            @endif
                            @if ($pasajero->autorizacion)
                                <a class="link-info"
                                   href="{{asset('documentos/permisozarpe/'.$pasajero->autorizacion)}}" target="_blank">
                                    Autorización</a>
                            @endif

                        </td>
                    @else
                        <td>NO</td>
                        <td> @if ($pasajero->pasaporte_mayor)
                                <a class="link-info"
                                   href="{{asset('documentos/permisozarpe/'.$pasajero->pasaporte_mayor)}}"
                                   target="_blank">
                                    Pasaporte</a>
                            @endif
                        </td>
                    @endif
                    @empty
                        <span class="badge badge-danger">Sin Pasajeros</span>
                </tr>
            @endforelse
        </table>
    </div>
    <br>
    <strong>Equipos de Seguridad</strong>
    <div class="table-responsive">
        <table class="table table-hover">
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
    </div>
    <br>
    <strong>Historial de revisiones</strong>
    <div class="table-responsive">
        <table class="table table-hover">
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
                <a data-route="{{route('statusInt',[$permisoZarpe->id,'aprobado',$permisoZarpe->establecimiento_nautico_id])}}"
                   class="btn btn-success confirmation" title="Aprobar" data-action="APROBAR">
                    Aprobar <i class="fa fa-check"></i>
                </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
        @endcan
        @can('rechazar-zarpe')
            @if ($permisoZarpe->status->id==3)
                <a class="btn btn-danger" title="Rechazar" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Rechazar
                </a>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop"
                     data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel"
                     aria-hidden="true">
                    <form
                        action="{{route('statusInt',[$permisoZarpe->id,'rechazado',$permisoZarpe->establecimiento_nautico_id])}}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="staticBackdropLabel">Rechazar
                                        Solicitud
                                        Zarpe</h5>
                                    <button type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Por favor indique el motivo del
                                        rechado de la
                                        Solicitud
                                        Nro.{{ $permisoZarpe->nro_solicitud }}</p>
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
                                                <option value="4">Observaciones en los documentos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group"
                                         style="display: none"
                                         id="inputmotivo">
                                        <input type="text"
                                               class="form-control"
                                               name="motivo" id="motivo2">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar
                                    </button>
                                    <button type="submit"
                                            class="btn btn-primary">
                                        Rechazar
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
                <a class="btn btn-warning"
                   href=" {{route('statusInt',[$permisoZarpe->id,'navegando',$permisoZarpe->establecimiento_nautico_id])}}"
                   data-toggle="tooltip">
                    Navegando
                </a>
            @endcan
        @endif
        @if(($permisoZarpe->status->id==5))
            @can('anular-sar')
                <a class="btn btn-outline-danger"
                   href=" {{route('statusInt',[$permisoZarpe->id,'anulado_sar',$permisoZarpe->establecimiento_nautico_id])}}"
                   data-toggle="tooltip">
                    Anular por SAR
                </a>
            @endcan
        @endif
        @if (($permisoZarpe->status->id==1)||($permisoZarpe->status->id==4) ||($permisoZarpe->status->id==5))
            <a class="btn btn-dark"
               href="{{route('zarpeInternacionalpdf',$permisoZarpe->id)}}"
               target="_blank" data-toggle="tooltip"
               data-bs-placement="bottom"
               title="Descargar PDF">Descargar PDF
                <i class="fas fa-file-pdf"></i>
            </a>
        @endif
    </div>
