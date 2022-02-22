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

                            <form action="{{ route('permisoszarpes.store') }}" method="POST">
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
                                                <h3 class="text-center">Declaracion de cumplimiento de normativas</h3>

                                                <p class="text-justify">Por medio de la presente declaro que la presente
                                                    solicitud se hace bajo el estricto cumplimiento de las normativas
                                                    vigentes y las disposiciones previstas por las leyes
                                                    venezolanas.</p>

                                                <p>Asi mismo declaro poseer en la embarcacion los siguientes equipos de
                                                    seguridad raqueridos por la normativa vigente:</p>
                                            </div>
                                            <div class="row">
                                                @foreach($equipos as $equipo)
                                                    <div class="form-check form-switch col-sm-4 ">
                                                        <input class="form-check-input" type="checkbox" name="role"
                                                               id='role' value="{{$equipo->id}}"
                                                               style="margin-left: auto;">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault"
                                                               style="margin-inline-start: 30px;">{{$equipo->equipo}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('permisoszarpes.createStepSix') }}"
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
