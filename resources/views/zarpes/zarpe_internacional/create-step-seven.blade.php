@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos de {{$titulo}}</li>
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
                            <strong>Solicitud de Permisos de {{$titulo}} | Paso {{$paso}}</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('zarpeInternacional.index')}}">Cancelar</a>
                            </div>
                        </div>

                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.zarpe_internacional.stepsIndicator')

                            <form action="{{ route('zarpeInternacional.store') }}" method="POST">
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
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-8 card-norma">
                                                    <div class="card">
                                                        <div class="card-body text-norma">
                                                            “Declaro que la presente solicitud se hace bajo el estricto
                                                            cumplimiento de las normativas vigentes y las disposiciones
                                                            previstas por las leyes venezolanas”
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 card-norma">
                                                    <div class="card">
                                                        <div class="card-body card-acepto">

                                                            <div class="form">
                                                                <div class="inputGroup">
                                                                    <input id="option1" name="option1" type="checkbox" required/>
                                                                    <label for="option1">ACEPTO</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="table-nooptions-equipo"  style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 40%">Equipo</th>
                                                        <th style="width: 30%">Cantidad</th>
                                                        <th>Otros</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($equipos as $equipo)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-switch col-12">
                                                                    <input class="form-check-input equipo {{$equipo->equipo}}" type="checkbox"
                                                                           name="equipo[] " id='{{$equipo->id}}' value="{{$equipo->id}}"
                                                                           style="margin-left: auto;"
                                                                           onclick="equipocheck('{{$equipo->id}}','{{$equipo->cantidad}}','{{$equipo->otros}}')">
                                                                    <label class="form-check-label"
                                                                           for="flexSwitchCheckDefault"
                                                                           style="margin-inline-start: 30px;"> {{$equipo->equipo}}</label>

                                                                    <input type="text" class="form-control col-sm-7"
                                                                           id="{{$equipo->id}}selected"
                                                                           name="{{$equipo->id}}selected" value="false"
                                                                           hidden>

                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div id="div_cant{{$equipo->id}}" style="display: none">
                                                                    @if ($equipo->cantidad==true)
                                                                        <div class=" col-12 ">
                                                                            <input type="number" class="form-control"
                                                                                   id="{{$equipo->id}}cantidad"
                                                                                   name="{{$equipo->id}}cantidad">
                                                                        </div>
                                                                    @else
                                                                        <div class=" col-12 ">
                                                                            NO APLICA
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div id="valores_otros{{$equipo->id}}" style="display: none">
                                                                    @if($equipo->otros!='ninguno')


                                                                        <div class=" form-inline">
                                                                            <label for="inputEmail4" class="col-sm-5"
                                                                                   style="text-transform: uppercase;">
                                                                                @if($equipo->otros=="fecha_ultima_inspeccion")
                                                                                    Fecha de última inspección

                                                                                    @php
                                                                                        $type="date";
                                                                                        $max="max=".date('Y-m-d').""
                                                                                    @endphp

                                                                                @else
                                                                                    {{$equipo->otros}}
                                                                                    @php
                                                                                        $type="text";
                                                                                        $max="";
                                                                                    @endphp

                                                                                @endif


                                                                            </label>
                                                                            <input type="{{$type}}"
                                                                                   class="form-control col-sm-7"
                                                                                   id="{{$equipo->id}}valores_otros"
                                                                                   name="{{$equipo->id}}valores_otros" {{$max}} >
                                                                            <input type="text" class="form-control col-sm-7"
                                                                                   id="otros" name="{{$equipo->id}}otros"
                                                                                   value="{{$equipo->otros}}" hidden>
                                                                        </div>

                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('zarpeInternacional.createStepSix') }}"
                                                   class="btn btn-primary pull-right">Anterior</a>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button id="solicitud" type="submit" class="btn btn-primary">Generar solicitud</button>
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
