@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos de Zarpe</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de Zarpe | Paso {{$paso}}</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('permisoszarpes.index')}}">Cancelar</a>

                            </div>

                        </div>
                     
                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.permiso_zarpe.stepsIndicator')


                            <form action="#" method="POST">
                                @csrf

                                <div class="card">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div id="ErrorsFlash" class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (isset($msj))
                                            <div class="alert alert-danger">
                                                {{$msj}}
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="row px-5" id="msjMarino"  data-asset="{{asset('images')}}">

                                            </div>
                                            <div class="col-md-3">

                                                <div class="form-group form-check form-switch ">
                                                     <label>Función del tripulante:</label>
                                                    <select id="funcion" name="funcion" class="form-control custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Capitán">Capitán</option>
                                                        <option value="Motorista">Motorista</option>
                                                        <option value="Marino">Marino</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="title">Cédula:</label>
                                                    <input type="text" class="form-control" id="cedula" name="cedula"
                                                           maxlength="10" onKeyDown="return soloNumeros(event)">
                                                </div>
                                            </div>

                                             


                                            <div class="col-md-3 mt-4">
                                                <button type="button" class="btn btn-primary" onclick="validacionMarino()">
                                                    Agregar
                                                </button>
                                            </div>

                                        </div>

                                        <div class="col-md-12 my-2">
                                            <b>
                                            Cantidad mínima de tripulantes: <span id="cantTripulantes">{{$validacion['cant_tripulantes']}}</span> 
                                            </b>
                                        </div>
                                        <div class="row px-3">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="tableTripulantes">
                                                    <thead>
                                                    <tr>
                                                        <th>Función</th>
                                                        <th>Cédula</th>
                                                        <th>Nombres y Apellidos</th>
                                                        <th>fecha emisión</th>
                                                        <th>Tipo Doc.</th>
                                                        <th>Documento</th>
                                                        <th  class="text-center">Eliminar</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id="marinos">

                                                    @if(isset($tripulantes))


                                                        @if(!is_array($tripulantes))
                                                            @php

                                                                $cant=0;

                                                            @endphp
                                                            <tr>
                                                                <td colspan="7" class="text-center" id="nodata">Sin
                                                                    registros para mostrar
                                                                </td>
                                                            </tr>
                                                        @else

                                                            @php
                                                                $cant=count($tripulantes);
                                                            @endphp

                                                            @foreach($tripulantes as $key => $trip)

                                                                <tr id="trip{{$trip['cedula']}}">
                                                                    <td>{{$trip["funcion"]}}</td>
                                                                    <td>{{$trip["cedula"]}}</td>
                                                                    <td>{{$trip["nombre"]}}</td>
                                                                    <td>{{$trip["fecha_emision"]}}</td>
                                                                    <td>{{$trip["solicitud"]}}</td>
                                                                    <td>{{$trip["documento"]}}</td>
                                                                    <td class="text-center"><a href="#" onclick="eliminarTrip({{$trip['cedula']}})"><i class="fa fa-trash" title="Eliminar"></i></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('permisoszarpes.permissionCreateStepFive') }}" method="POST">
                                        @csrf

                                        <div id="dataMarinos" data-cantMar="{{$cant ?? 0}}"
                                             data-cantMaxima="{{$validacion['cant_pasajeros']}}" data-cantMinima="$validacion['cant_tripulantes']}}">
                                            @if(isset($cant) && $cant!=0)
                                                @php  $count=0; @endphp
                                                @foreach($tripulantes as $trip)
                                                    @php $count++; $id="contentMar".$count; @endphp
                                                    <div id="{{$id}}">
                                                        <input type="hidden" name="ids[]"
                                                               value="{{$trip['ctrl_documento_id']}}"><input
                                                            type="hidden" name="capitan[]" value="SI">
                                                        <input type="hidden" name="cedula[]"
                                                               value="{{$trip['cedula']}}">
                                                        <input type="hidden" name="nombre[]"
                                                               value="{{$trip['nombre']}}">
                                                        <input type="hidden" name="fechaVence[]"
                                                               value="{{$trip['fecha_vencimiento']}}">
                                                        <input type="hidden" name="fechaEmision[]"
                                                               value="{{$trip['fecha_emision']}}">

                                                        <input type="hidden" name="documento[]"
                                                               value="{{$trip['documento']}}">
                                                    </div>

                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="card-footer text-right">
                                            <div class="row">
                                                <div class="col text-left">
                                                    <a href="{{ route('permisoszarpes.createStepFour') }}"
                                                       class="btn btn-primary pull-right">Anterior</a>
                                                </div>
                                                <div class="col text-right">
                                                    <button type="submit" class="btn btn-primary">Siguiente</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
