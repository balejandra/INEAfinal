@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos de Zarpe INTERNACIONAL</li>
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
                        <div class="card-header bg-zarpes text-white">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de Zarpe INTERNACIONAL | Paso {{$paso}}</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('zarpeInternacional.index')}}">Listado</a>

                            </div>

                        </div>
                        <div class="card-body" style="min-height: 350px;">
                            @include('zarpes.zarpe_internacional.stepsIndicator')

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
                                        <div class="row px-5" id="msj"  data-asset="{{asset('images')}}">
                                        </div>
                                         
                                        <div class="row" id="VE">

                                            <div class="col-md-2 p-0">
                                                <div class="px-2 form-group form-check form-switch ">
                                                    <label>Menor:</label><br>
                                                    &nbsp;
                                                    <input class="form-check-input" type="checkbox" name="menor"
                                                           id='menor' style="margin-left: auto;"> &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp;<label id="textoMenor">NO</label>
                                                </div>
                                            </div>

                                            <div class="col-md-2 px-1">
                                                <div class="form-group">
                                                    <label for="title">Tipo doc..:</label>
                                                    {!! Form::select('tipodoc', ['V'=>'Cédula', 'P'=>'Pasaporte'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'tipodoc']) !!}
                                                </div>
                                            </div>

                                            <div class="col-md-2 px-1">
                                                <div class="form-group">
                                                    <label for="title">Cédula/Pasaporte:</label>
                                                    <input type="text" class="form-control" id="numero_identificacion"
                                                           name="numero_identificacion" maxlength="10"
                                                           title="En caso de ser menor venezolano no cedulado, agregue la cédula del representante.">
                                                </div>
                                            </div>

                                            <div class="col-md-2 px-1">
                                                <div class="form-group">
                                                    <label for="title">Fecha de nacimiento:</label>
                                                    <input type="date"
                                                           class="form-control "
                                                           name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                                           id="fecha_nacimiento"
                                                           placeholder="fecha_nacimiento" required
                                                           max='{{date("Y-m-d")}}'>
                                                </div>
                                            </div>

                                            <div class="col-md-2 px-1">
                                                <div class="form-group">
                                                    <label for="title">Sexo:</label>
                                                    {!! Form::select('sexo', ['F'=>'F', 'M'=>'M'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'sexo']) !!}
                                                </div>
                                            </div>

                                            <div class="col-md-2 mt-4">
                                                <button type="button" class="btn btn-primary" onclick="getDataZI()">
                                                    Agregar
                                                </button>
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-5 px-1 DatosRestantes" style="display:none">
                                                <div class="form-group">
                                                    <label for="title">Nombre:</label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres">
                                                </div>
                                            </div>

                                            <div class="col-md-5 px-1 DatosRestantes" style="display:none">
                                                <div class="form-group">
                                                    <label for="title">Apellidos:</label>
                                                    <input type="text" class="form-control" id="apellidos"
                                                           name="apellidos">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row px-3">


                                            <div class="col-md-12 py-2">
                                                <b>Cantidad de pasajeros disponible para esta embarcación:</b>
                                                <span id="cantPasajeros" data-cantPass='{{ $cantPasajeros }}'>
                                                    @if(count($passengers)>0 && ($passengers[0]!=""))
                                                        @php
                                                            echo $cantPasajeros-count($passengers);
                                                            $cant=$cantPasajeros-count($passengers);
                                                        @endphp
                                                       
                                                    @else
                                                        {{ $cantPasajeros ?? '' }}  
                                                        @php  $cant=0;  @endphp
                                                    @endif
                                                   
                                                </span>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th width="18%">Cédula</th>
                                                        <th>Nombres</th>
                                                        <th>Apellidos</th>
                                                        <th width="5%">sexo</th>
                                                        <th>Fecha nac.</th>
                                                        <th width="5%">Menor</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="pasajeros">
                                                    @if($passengers[0]==0 || $passengers[0]=="")
                                                       
                                                        <tr>
                                                            <td colspan="6" class="text-center">
                                                                Sin registros para mostrar
                                                            </td>
                                                        </tr>
                                                    @else
                                                        
                                                        @foreach($passengers as $position)
                                                            <tr>
                                                                <td>{{$position["tipo_doc"]}}
                                                                    -{{$position["nro_doc"]}} </td>
                                                                <td>{{$position["nombres"]}}</td>
                                                                <td>{{$position["apellidos"]}}</td>
                                                                <td class="text-center">{{$position["sexo"]}}</td>
                                                                <td>{{$position["fecha_nacimiento"]}}</td>
                                                                @if($position["menor_edad"]==1)
                                                                    <td class="text-center">SI</td>
                                                                @else
                                                                    <td class="text-center">NO</td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('zarpeInternacional.permissionCreateStepSix') }}" method="POST">
                                @csrf
                                <div id="dataPassengers" data-cant="{{$cant}}">
                                    @if($cant!=0)
                                        @php  $count=0; @endphp
                                        @foreach($passengers as $position)
                                            @php $count++; $id="content".$count; @endphp
                                            <div id="{{$id}}">
                                                @if($position["menor_edad"]==1)
                                                    <input type="hidden" name="menor[]" value="SI">
                                                @else
                                                    <input type="hidden" name="menor[]" value="NO">
                                                @endif
                                                <input type="hidden" name="tipodoc[]" value="{{$position['tipo_doc']}}">
                                                <input type="hidden" name="nrodoc[]" value='{{$position["nro_doc"]}}'>
                                                <input type="hidden" name="fechanac[]"
                                                       value='{{$position["fecha_nacimiento"]}}'>
                                                <input type="hidden" name="sexo[]" value='{{$position["sexo"]}}'>
                                                <input type="hidden" name="nombres[]" value='{{$position["nombres"]}}'>
                                                <input type="hidden" name="apellidos[]"
                                                       value='{{$position["apellidos"]}}'>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="card-footer text-right">
                                    <div class="row">
                                        <div class="col text-left">
                                            <a href="{{ route('zarpeInternacional.createStepFive') }}"
                                               class="btn btn-primary pull-right">Anterior</a>
                                        </div>
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary">Siguiente</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
