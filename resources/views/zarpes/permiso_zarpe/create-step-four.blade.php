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
                                <a class="btn btn-primary btn-sm" href="{{route('permisoszarpes.index')}}">Cancelar</a>
                            </div>
                        </div>

                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.permiso_zarpe.stepsIndicator')

                            <form action="{{ route('permisoszarpes.permissionCreateStepFour') }}" id="formStepFour"
                                  method="POST">
                                @csrf
@php
     $solicitud= json_decode(session('solicitud'));
     $coordGrad=  session('coordGadriales') ;
 
@endphp

                                <div class="card">
                                    <div class="card-body">
                                        <div id="msjRuta"></div>
                                        <div class="row">

                                            <div class="col-sm-9 text-center">
                                                <label>Coordenadas del punto de escala:</label>
                                                @include('zarpes.permiso_zarpe.map')
                                            </div>

                                            <div class="col-sm-3 bg-light rounded">
                                                <div class="col-md-12 px-0 py-2">
                                                    <div class="form-group col-sm-12">
                                                        {!! Form::label('', 'Establecimiento náutico origen:') !!}
                                                        <select id="origen"
                                                                name="establecimientoNáuticoOrigen"
                                                                class="form-control custom-select">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($EstNauticos as $en)
                                                                @if($solicitud->establecimiento_nautico_id==$en->id)
                                                                    @php
                                                                        $selecteden="selected='selected'";
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $selecteden='';
                                                                    @endphp
                                                                @endif
                                                                <option
                                                                    value="{{$en->id}}" {{$selecteden}} >{{$en->nombre}} </option>
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
                                                        @if($solicitud->fecha_hora_salida!='')
                                                            @php
                                                            $fechasal= $solicitud->fecha_hora_salida;
                                                            @endphp
                                                        @else
                                                            @php
                                                            $fechasal=old('salida');
                                                            @endphp
                                                        @endif

                                                    {!! Form::label('salida', 'Fecha/hora salida:') !!}
                                                    <input type="datetime-local" id="salida" name="salida"
                                                           min="{{$fechaActual}}" class="form-control"
                                                           onblur="compararFechas()" max="9999-12-31T23:59"   value="{{ $fechasal }}" >
                                                </div>

                                                <div class="col-md-12 py-2">
                                                    @php
                                                        $fechaActual=new DateTime();
                                                        $fechaActual->setTimeZone(new DateTimeZone('America/Caracas'));
                                                        $fechaActual=$fechaActual->format('Y-m-d')."T".$fechaActual->format('h:i');
                                                    @endphp

                                                    @if($solicitud->fecha_llegada_escala!='')
                                                            @php
                                                            $fechaesc= $solicitud->fecha_llegada_escala;
                                                             
                                                            @endphp
                                                    @else
                                                            @php
                                                            $fechaesc=old('llegada_escala');
                                                            @endphp
                                                    @endif

                                                    {!! Form::label('llegada_escala', 'Fecha/hora llegada a punto de escala:') !!}
                                                    <input type="datetime-local" id="llegada_escala"
                                                           name="fecha_llegada_escala"
                                                           min="{{$fechaActual}}" class="form-control"
                                                           onblur="compararFechasEscala()" max="9999-12-31T23:59" value="{{$fechaesc}}" >
                                                </div>

                                                <div class="col-md-12 py-2">
                                                    {!! Form::label('regreso', 'Fecha/hora llegada a destino:') !!}

                                                    @if($solicitud->fecha_hora_regreso!='')
                                                            @php
                                                            $fechareg= $solicitud->fecha_hora_regreso;
                                                             
                                                            @endphp
                                                    @else
                                                            @php
                                                            $fechareg=old('regreso');
                                                            @endphp
                                                    @endif

                                                    <input type="datetime-local" id="regreso" name="regreso"
                                                           class="form-control" max="9999-12-31T23:59" onblur="compararFechas()" value="{{$fechareg}}">
                                                </div>

                                                <div class="col-md-12 px-0">
                                                    <div class="form-group col-sm-12 ">
                                                        {!! Form::label('0', 'Capitanía de retorno final:') !!}


                                                        <select id="capitaniaDestino"
                                                                name="capitaniaDestino"
                                                                 onchange="estNauticoDestinoSelect('')"
                                                                class="form-control custom-select">

                                                            <option value="">Seleccione</option>
                                                           <!-- @if($capitaniasDestinoList!='')
                                                             @foreach ($capitaniasDestinoList as $capitania)
                                                            @if($CapDestinoFinal==$capitania->id)
                                                                @php
                                                                $selectedcap="selected='selected'";
                                                                @endphp
                                                            @else
                                                                @php
                                                                $selectedcap='';
                                                                @endphp
                                                            @endif -->
                                                            <option value="{{$capitania->id}}" {{$selectedcap}} >{{$capitania->nombre}} </option>
                                                        @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 px-0">
                                                    <div class="form-group col-sm-12 ">
                                                        {!! Form::label('0', 'Establecimiento náutico de retorno final:') !!}


                                                        <select id="estNautioDestino"
                                                                name="establecimientoNáuticoDestino"
                                                                title="Selección el punto de escala en el mapa para visualizar los establecimientos náuticos de la circunscripción de destino"
                                                                class="form-control custom-select">

                                                            <option value="">Seleccione</option>
                                                            @if($EstNauticosDestino!='')
                                                            @foreach ($EstNauticosDestino as $endestino)
                                                                @if($solicitud->establecimiento_nautico_destino_id==$endestino->id)
                                                                    @php
                                                                        $selectedendestino="selected='selected'";
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $selectedendestino='';
                                                                    @endphp
                                                                @endif
                                                                <option
                                                                    value="{{$endestino->id}}" {{$selectedendestino}} >{{$endestino->nombre}} </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 py-2">
                                                    {!! Form::label('0', 'Circunscripción acuática de destino:') !!}
                                                    <div class="col-md-12 p-0 text-center"
                                                         id="capiDestino">
                                                         @if($CapDestinoFinal!="")
                                                            @php
                                                            echo "<b>".$CapDestinoFinal->nombre."</b>";
                                                            @endphp
                                                         @endif       
                                                    </div>
                                                </div>

                                                <div class="col-md-12 py-2">
                                                
                                                    <div class="form-group">
                                                        <label for="title">Latitud punto de escala:</label>
                                                        <div id="latitudText" class="font-weight-bold">
                                                             @if($coordGrad!='')
                                                                {{$coordGrad[0]}}
                                                            @endif
                                                        </div>
                                                        @if($solicitud->coordenadas!='')
                                                            @php
                                                                $sol= json_decode($solicitud->coordenadas);
                                                              $lat=$sol[0];
                                                              $lon=$sol[1];
                                                            @endphp
                                                    @else
                                                            @php
                                                            $lat=''; $lon='';
                                                            @endphp
                                                    @endif

                                                   
                                                        <input type="hidden" class="form-control" id="latitud"
                                                               readonly
                                                               name="latitud" data-lat="{{$lat}}" value="{{$lat}}">
                                                        <input type="hidden" class="form-control" id="latitudGrad"      readonly
                                                               name="latitudGrad"   value="">
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-12 py-2">
                                                    
                                                    <div class="form-group">
                                                        <label for="title">Longitud punto de escala:</label>
                                                        <div id="longitudText" class="font-weight-bold">
                                                        @if($coordGrad!='')
                                                            {{$coordGrad[1]}}
                                                        @endif
                                                        </div>
                                                        <input type="hidden" class="form-control"
                                                               id="longitud" readonly
                                                               name="longitud" data-long="{{$lon}}" value="{{$lon}}">

                                                        <input type="hidden" class="form-control"
                                                               id="longitudGrad" readonly
                                                               name="longitudGrad"   value="">
                                                    </div>
                                                    

                                                </div>
                                                @if($solicitud->destino_capitania_id!='')
                                                        @php
                                                            $capDestino=$solicitud->destino_capitania_id;
                                                        @endphp
                                                        @else
                                                            @php
                                                            $capDestino='';
                                                            @endphp
                                                        @endif
                                                <!--<input type="hidden" class="form-control"
                                                       id="capitaniaDestino" name="coordenadasDestino" value="{{$capDestino}}">-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col text-left">
                                                <a href="{{ route('permisoszarpes.createStepThree') }}"
                                                   class="btn btn-primary pull-right">Anterior</a>
                                            </div>
                                            <div class="col text-right">
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
