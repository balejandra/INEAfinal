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
                                <a class="btn btn-primary btn-sm" href="{{route('permisoszarpes.index')}}">Listado</a>

                            </div>

                        </div>
                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.permiso_zarpe.stepsIndicator')


                            <form action="#" method="POST">
                                @csrf

                                <div class="card">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
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
                                            <div class="row px-5" id="msjMarino">

                                            </div>
                                            <div class="col-md-2">

                                                <div class="form-group form-check form-switch ">
                                                    <label for="title">Capitan?</label><br>
                                                    &nbsp;


                                                    @if(isset($tripulantes))
                                                        @php

                                                            $texto='NO'; $checked="";
                                                        @endphp
                                                        @if(is_int($tripulantes[0]) && $tripulantes[0]==0)
                                                            @php

                                                                $texto='SI';
                                                                $checked="checked";
                                                            @endphp
                                                        @endif
                                                    @else
                                                        @php
                                                            $texto='SI';
                                                            $checked="checked";
                                                        @endphp

                                                    @endif


                                                    <input class="form-check-input" type="checkbox" name="cap" id='cap'
                                                           style="margin-left: auto;" {{$checked}} disabled> &nbsp;
                                                    &nbsp; &nbsp; &nbsp; &nbsp;<label id="textoCap">{{$texto}}</label>
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="title">Cédula:</label>
                                                    <input type="number" class="form-control" id="cedula" name="cedula"
                                                           maxlength="10" onKeyDown="return soloNumeros(event)">
                                                </div>
                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label for="title">Fecha de nacimiento:</label>
                                                    @php
                                                        $ano=date('Y')-18;
                                                        $fechamin=$ano.'-'.date('m-d');
                                                    @endphp
                                                    <input type="date"
                                                           class="form-control "
                                                           name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                                           id="fecha_nacimiento"
                                                           placeholder="Fecha de nacimiento" max="{{$fechamin}}">
                                                </div>
                                            </div>


                                            <div class="col-md-3 mt-4">
                                                <button type="button" class="btn btn-primary" onclick="getMarinos()">
                                                    Agregar
                                                </button>
                                            </div>

                                        </div>


                                        <div class="row px-3">
                                            <div class="table-responsive">
                                                <table class="table" id="tableTripulantes">
                                                    <thead>
                                                    <tr>
                                                        <th>Capitan</th>
                                                        <th>Cédula</th>
                                                        <th>Nombres y Apellidos</th>
                                                        <th>fecha emisión</th>
                                                        <th>Documento</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody id="marinos">

                                                    @if(isset($tripulantes))


                                                        @if(is_int($tripulantes[0]))
                                                            @php

                                                                $cant=0;

                                                            @endphp
                                                            <tr>
                                                                <td colspan="5" class="text-center" id="nodata">Sin
                                                                    registros para mostrar
                                                                </td>
                                                            </tr>
                                                        @else

                                                            @php
                                                                $cant=count($tripulantes);
                                                            @endphp

                                                            @foreach($tripulantes as $trip)

                                                                <tr>
                                                                    @if($trip["capitan"]==1)
                                                                        <td>SI</td>
                                                                    @else
                                                                        <td>NO</td>
                                                                    @endif
                                                                    <td>{{$trip["cedula"]}}</td>
                                                                    <td>{{$trip["nombre"]}}</td>
                                                                    <td>{{$trip["fecha_emision"]}}</td>
                                                                    <td>{{$trip["documento"]}}</td>
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
                                             data-cantMaxima="{{$validacion['cant_tripulantes']}}">
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
