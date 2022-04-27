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
                        <div class="card-header bg-zarpes text-white">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de Zarpe INTERNACIONAL | Paso {{$paso}}</strong>
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('zarpeInternacional.index')}}">Cancelar</a>
                            </div>
                        </div>

                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.zarpe_internacional.stepsIndicator')

                            <form action="{{ route('zarpeInternacional.permissionCreateStepFour') }}" id="formStepFour"
                                  method="POST">
                                @csrf
@php
     $solicitud= json_decode(session('solicitud'));

@endphp
                                <div class="card">
                                    <div class="card-body">
                                        <div id="msjRuta"></div>
                                        <div class="row">

                                            

                                            <div class="col-sm-12 bg-light rounded">
                                                <div class="row px-0 py-2">
                                                    <div class="form-group col-sm-6">
                                                         
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

                                                    <div class="form-group col-sm-6">
                                                        {!! Form::label('', 'País de destino:') !!}
                                                        
                                                        <select id="pais_destino_id"
                                                                name="país_de_destino"
                                                                class="form-control custom-select">
                                                            <option value="">Seleccione</option>
                                                            @foreach ($paises as $pais)
                                                                @if($solicitud->paises_id==$pais->id)
                                                                    @php
                                                                        $selectedpd="selected='selected'";
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $selectedpd='';
                                                                    @endphp
                                                                @endif
                                                                <option
                                                                    value="{{$pais->id}}" {{$selectedpd}} >{{$pais->name}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
<div class="row">
<div class="col-md-6 py-2">
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
                                                            $fechasal='';
                                                            @endphp
                                                        @endif

                                                    {!! Form::label('salida', 'Fecha/hora salida:') !!}
                                                    <input type="datetime-local" id="salida" name="salida"
                                                           min="{{$fechaActual}}" class="form-control"
                                                           onblur="compararFechasZI()" max="9999-12-31T23:59" value="{{$fechasal}}">
                                                </div>

                                                <div class="col-md-6 py-2">
                                                    {!! Form::label('LLegada', 'Fecha/hora llegada a destino:') !!}

                                                    @if($solicitud->fecha_hora_regreso!='')
                                                            @php
                                                            $fechareg= $solicitud->fecha_hora_regreso;
                                                             
                                                            @endphp
                                                    @else
                                                            @php
                                                            $fechareg='';
                                                            @endphp
                                                    @endif

                                                    <input type="datetime-local" id="llegada" name="llegada"
                                                           class="form-control" max="9999-12-31T23:59" onblur="compararFechasZI()" value="{{$fechareg}}">
                                                </div>

                                                 
</div>
                                                
 

 

                                               
                                                
                                                
                                                
                                               </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col text-left">
                                                <a href="{{ route('zarpeInternacional.createStepThree') }}"
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
