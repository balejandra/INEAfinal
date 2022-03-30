@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('permisosestadia.index') }}">Permisos de Estadia</a>
            </li>
            <li class="breadcrumb-item ">Consulta</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Consultar Permiso de Estadia</strong>
                                 <div class="card-header-actions">
                                     <a href= "{{route('permisosestadia.index')}} " class="btn btn-primary btn-sm">Listado de Permisos de Estadia</a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 @include('zarpes.permiso_estadias.show_fields')
                                 <strong>Historial de revisiones</strong>
                                 <table class="table">
                                     <tbody>
                                     <thead>
                                     <tr>
                                         <th>Nombre y Apellido</th>
                                         <th>Acción</th>
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
                                 @can('asignar-visita-estadia')
                                     @if ($permisoEstadia->status_id===3)
                                     <!-- Button trigger modal -->
                                         <a class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#visitamodal{{$permisoEstadia->id}}" data-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-whatever="{{$permisoEstadia->id}}"
                                            title="Asignar Visitador"> Asignar Visita
                                             <i class="fas fa-user-clock"></i>
                                         </a>

                                         <!-- Modal -->
                                         <div class="modal fade" id="visitamodal{{$permisoEstadia->id}}"
                                              data-bs-backdrop="static" data-bs-keyboard="false"
                                              tabindex="-1" aria-labelledby="staticBackdropLabel"
                                              aria-hidden="true">
                                             <form action="{{route('statusEstadia',[$permisoEstadia->id,9])}}">
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
                                         <a class="btn btn-info"
                                            href=" {{route('statusEstadia',[$permisoEstadia->id,10])}}" data-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            title="Aprobar Visita"> Aprobar Visita
                                             <i class="fas fa-user-check"></i>
                                         </a>
                                     @endif
                                 @endcan

                                 @can('recaudos-estadia')
                                     @if ($permisoEstadia->status_id===10)
                                         <a class="btn" style="background-color: #fd7e14"
                                            href=" {{ route('permisosestadia.edit', [$permisoEstadia->id]) }}" data-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            title="Subir Recaudos Faltantes">Subir Recaudos
                                             <i class="fas fa-book"></i>
                                         </a>
                                     @endif
                                 @endcan
                                 @can('aprobar-estadia')
                                     @if ($permisoEstadia->status_id===11)
                                         <a class="btn btn-primary"
                                            href="{{route('statusEstadia',[$permisoEstadia->id,1])}}">Aprobar
                                             <i class="fa fa-check"></i>
                                         </a>
                                     @endif
                                 @endcan

                                 @can('rechazar-estadia')
                                     @if (($permisoEstadia->status_id===3) || ($permisoEstadia->status_id===9) || ($permisoEstadia->status_id===11)  )
                                     <!-- Button trigger modal -->
                                         <a class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#rechazarmodal{{$permisoEstadia->id}}">Rechazar
                                             <i class="fa fa-ban"></i>
                                         </a>

                                         <!-- Modal -->
                                         <div class="modal fade" id="rechazarmodal{{$permisoEstadia->id}}"
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
                                     <a class="btn btn-dark"
                                        href="{{route('estadiapdf',$permisoEstadia->id)}}" target="_blank">Descargar PDF
                                         <i class="fas fa-file-pdf"></i>
                                     </a>

                                     @if ((date_format($permisoEstadia->vencimiento->subDay(15),'Y-m-d')<=date('Y-m-d')) and ($permisoEstadia->vencimiento>date('Y-m-d')) )
                                        @can('renovar-estadia')
                                             <a class="btn" style="background-color: #bf0063"
                                                href="{{route('createrenovacion',$permisoEstadia->id)}}" data-toggle="tooltip"
                                                data-bs-placement="bottom"
                                                title="Renovar Permiso de Estadia"> Renovación
                                                 <i class="fas fa-file-import"></i>
                                             </a>
                                         @endcan
                                     @endif
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
