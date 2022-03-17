<strong>Detalle del Zarpe</strong>
<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">Nro de Solicitud</th>
        <td>{{ $permisoZarpe->nro_solicitud }}</td>
        <th class="bg-light">Nombre Solicitante</th>
        <td>{{ $permisoZarpe->user->nombres}} {{ $permisoZarpe->user->apellidos}}</td>
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
        @php $coords=json_decode($permisoZarpe->coordenadas); @endphp
        <td>Latitud: {{ $coords[0]}} , Longitud: {{ $coords[1]}}</td>
        <th class="bg-light">Destino</th>
        <td>{{ $permisoZarpe->capitania->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Fecha y Hora Salida</th>
        <td>{{$permisoZarpe->fecha_hora_salida }}</td>
        <th class="bg-light">Fecha y Hora Regreso</th>
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
                <span class="badge badge-danger">Sin Tripulantes</span>
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

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    @if ($capitania[0]->user_id==auth()->user()->id or $comodoro)
        @can('aprobar-zarpe')
            @if(($permisoZarpe->status->id=='3'))
                <a href="{{route('status',[$permisoZarpe->id,'aprobado',$permisoZarpe->establecimiento_nautico_id])}}"
                   class="btn btn-success" title="Aprobar">
                    Aprobar
                </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            @endif
        @endcan
        @can('rechazar-zarpe')
            @if ($permisoZarpe->status->id=='3')
                <a class="btn btn-danger" title="Rechazar" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Rechazar
                </a>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop"
                     data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel"
                     aria-hidden="true">
                    <form
                        action="{{route('status',[$permisoZarpe->id,'rechazado',$permisoZarpe->establecimiento_nautico_id])}}">
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
                                            <select class="form-select" aria-label="motivo" id="motivo1" name="motivo" onchange="motivoRechazo();" required>
                                                <option value="">Seleccione un motivo</option>
                                                <option value="Disposiciones del Ejecutivo Nacional">Disposiciones del Ejecutivo Nacional.</option>
                                                <option value="Instrucciones especiales de la autoridad acuática">Instrucciones especiales de la autoridad acuática.</option>
                                                <option value="Condiciones meteorológicas adversas">Condiciones meteorológicas adversas.</option>
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
            @if(($permisoZarpe->status->id=='1'))
                @can('informar-navegacion')
                    <a class="btn btn-warning"
                       href=" {{route('status',[$permisoZarpe->id,'navegando',$permisoZarpe->establecimiento_nautico_id])}}" data-toggle="tooltip">
                        Navegando
                    </a>
                @endcan
            @endif
            @if(($permisoZarpe->status->id=='5'))
                @can('anular-sar')
                    <a class="btn btn-outline-danger"
                       href=" {{route('status',[$permisoZarpe->id,'anulado_sar',$permisoZarpe->establecimiento_nautico_id])}}" data-toggle="tooltip">
                        Anular por SAR
                    </a>
                @endcan
            @endif
    @endif
</div>
