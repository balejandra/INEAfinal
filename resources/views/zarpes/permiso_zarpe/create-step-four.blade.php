@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Permisos de Zarpe</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
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


                            <form action="{{ route('permisoszarpes.permissionCreateStepFour') }}" id="formStepFour"
                                  method="POST">
                                @csrf

                                
                                <div class="card">

                                    <div class="card-body">

                                        

                                        <div id="msjRuta">

                                        </div>

                                        <div class="row px-1">

                                            <div class="col-9 px-0">
                                                <div class="row">
                                                    <div class="col-md-12 text-center">
                                                        <label>Coordenadas del punto de escala:</label>
                                                        @include('zarpes.permiso_zarpe.map')
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-3 px-0 bg-light rounded">
                                               

                                            <div class="col-md-12 px-0 py-2">


                                                <div class="form-group col-sm-12">
                                                    {!! Form::label('', 'Establecimiento náutico origen:') !!}

                                                    <select id="origen" name="establecimientoNáuticoOrigen"
                                                            class="form-control custom-select">
                                                        <option value="0">Seleccione</option>
                                                        @foreach ($EstNauticos as $en)
                                                            <option value="{{$en->id}}">{{$en->nombre}} </option>
                                                        @endforeach
                                                    </select>


                                                </div>

                                            </div>

                                            <div class="col-md-12 py-2"> 
                                                @php
                                                $fechaActual=new DateTime();
                                                $fechaActual->setTimeZone(new DateTimeZone('America/Caracas'));
                                                $fechaActual=$fechaActual->format('Y-m-d')."T".$fechaActual->format('h:i');
                                                @endphp
                                                {!! Form::label('salida', 'Fecha/hora salida:') !!}
                                                <input type="datetime-local" id="salida" name="salida"
                                                       min="{{$fechaActual}}" class="form-control"
                                                       onblur="compararFechas()">

                                            </div>

                                            <div class="col-md-12 py-2"> 
                                                @php
                                                $fechaActual=new DateTime();
                                                $fechaActual->setTimeZone(new DateTimeZone('America/Caracas'));
                                                $fechaActual=$fechaActual->format('Y-m-d')."T".$fechaActual->format('h:i');
                                                @endphp
                                                {!! Form::label('llegada_escala', 'Fecha/hora llegada a punto de escala:') !!}
                                                <input type="datetime-local" id="llegada_escala" name="fecha_llegada_escala"
                                                       min="{{$fechaActual}}" class="form-control"
                                                       onblur="compararFechasEscala()">

                                            </div>

                                            <div class="col-md-12 py-2">

                                                {!! Form::label('regreso', 'Fecha/hora llegada a destino:') !!}
                                                <input type="datetime-local" id="regreso" name="regreso"
                                                       class="form-control" onblur="compararFechas()">

                                            </div>

                                            <div class="col-md-12 px-0">
                                                <div class="form-group col-sm-12 py-2">
                                                    {!! Form::label('0', 'Establecimiento náutico de retorno final:') !!}

                                                    <select id="estNautioDestino" name="establecimientoNáuticoDestino" title="Selección el punto de escala en el mapa para visualizar los establecimientos náuticos de la circunscripción de destino" 
                                                            class="form-control custom-select">
                                                        <option value="">Seleccione</option>
                                                         
                                                    </select>
                                                </div>

                                            </div>

                                            <div  class="col-md-12 py-2">
                                                {!! Form::label('0', 'Circunscripción acuática de destino:') !!}
                                                <div class="col-md-12 p-0 text-center" id="capiDestino"></div>

                                            </div>                         

                                         
                                            <div class="col-md-12 py-2">

                                                <div class="form-group">
                                                    <label for="title">Latitud punto de escala:</label>
                                                    <input type="text" class="form-control" id="latitud" readonly
                                                           name="latitud" data-lat="">

                                                </div>

                                            </div>
                                            <div class="col-md-12 py-2">

                                                <div class="form-group">
                                                    <label for="title">Longitud punto de escala:</label>
                                                    <input type="text" class="form-control" id="longitud" readonly
                                                           name="longitud" data-long="">

                                                </div>

                                            </div>
                                            <input type="hidden" class="form-control" id="capitaniaDestino"  name="coordenadasDestino">

 

                                            
                                         

                                            </div>
                                            
                                        </div>

                                        

                                        


                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('permisoszarpes.createStepThree') }}"
                                                   class="btn btn-primary pull-right">Anterior</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                            </div>
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
