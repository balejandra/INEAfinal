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
                                            <div class="container">
                                                <h3 class="text-center">Declaración de cumplimiento de normativas</h3>

                                                <p class="text-justify">Por medio de la presente declaro que la presente
                                                    solicitud se hace bajo el estricto cumplimiento de las normativas
                                                    vigentes y las disposiciones previstas por las leyes
                                                    venezolanas.</p>

                                                <p>Así mismo declaro poseer en la embarcación los siguientes equipos de
                                                    seguridad requeridos por la normativa vigente:</p>
                                            </div>
                                            <table class="table table-striped table-bordered" id="equipos">
                                                <thead>
                                                <tr>
                                                    <th>Equipo</th>
                                                    <th>Cantidad</th>
                                                    <th>Otros</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($equipos as $equipo)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check form-switch col-12">
                                                                <input class="form-check-input equipo" type="checkbox" name="equipo[] "
                                                                       id='equipo' value="{{$equipo->id}}"
                                                                       style="margin-left: auto;" data-cant="{{$equipo->cantidad}}" data-otrs="{{$equipo->otros}}" >
                                                                <label class="form-check-label" for="flexSwitchCheckDefault"
                                                                       style="margin-inline-start: 30px;"> {{$equipo->equipo}}</label>

                                                                 <input type="text" class="form-control col-sm-7" id="{{$equipo->id}}selected" name="{{$equipo->id}}selected" value="false" hidden>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            @if ($equipo->cantidad==true)
                                                                <div class=" col-12 ">
                                                                    <input type="number" class="form-control" id="{{$equipo->id}}cantidad" name="{{$equipo->id}}cantidad">
                                                                </div>
                                                            @else
                                                                <div class=" col-12 ">
                                                                    NO APLICA
                                                                </div>
                                                                @endif

                                                        </td>

                                                        <td>
                                                            @if($equipo->otros!='ninguno')


                                                                    <div class=" form-inline">
                                                                        <label for="inputEmail4" class="col-sm-5" style="text-transform: uppercase;">
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
                                                                        <input type="{{$type}}" class="form-control col-sm-7" id="{{$equipo->id}}valores_otros" name="{{$equipo->id}}valores_otros" {{$max}} >
                                                                        <input type="text" class="form-control col-sm-7" id="otros" name="{{$equipo->id}}otros" value="{{$equipo->otros}}" hidden>
                                                                    </div>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

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
                                                <button type="submit" class="btn btn-primary">Generar solicitud</button>
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
