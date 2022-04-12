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

            <div class="col-md-12" id="errorMat">


            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de Zarpe</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('permisoszarpes.index')}}">Listado</a>
                            </div>

                        </div>
@php
     $solicitud= json_decode(session('solicitud'));

@endphp
                        <div class="card-body" style="min-height: 350px;">
                            @include('zarpes.permiso_zarpe.stepsIndicator')

                            <form action="{{ route('permisoszarpes.permissionCreateSteptwo') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body" style="min-height: 250px;">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row gy-2 gx-3 justify-content-center">
                                            <div class="col-auto">
                                                <div class="form-group">
                                                    <label for="title">Matrícula:</label>
                                                                @if($solicitud->matricula!="")
                                                                    @php
                                                                        $matricula="$solicitud->matricula";
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $matricula='';
                                                                    @endphp
                                                                @endif
                                                    <input type="text" class="form-control" id="matricula1" value="{{$matricula}}">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <br>
                                                <button type="button" class="btn btn-primary" onclick="getmatricula($('#matricula1').val())">Verificar</button>
                                            </div>
                                        </div>
                                            <br>
                                            <div class="row">
                                            <div class="col">
                                                <div id="table-buque" style="display: none;">
                                                    <div class="text-center">
                                                        <h4>Datos de la embarcación</h4>
                                                    </div>

                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="">
                                                        <tr>
                                                            <th class="bg-light">MATRÍCULA</th>
                                                            <td><input type="text" id="matricula" name="matricula" readonly></td>
                                                            <th class="bg-light">NOMBRE</th>
                                                            <td><input type="text" id="nombre" name="nombre" readonly></td>
                                                        </tr>

                                                        <tr>
                                                            <th class="bg-light">DESTINACIÓN DEL BUQUE</th>
                                                            <td><input type="text" name="destinacion" id="destinacion" readonly></td>
                                                            <th class="bg-light">UAB</th>
                                                            <td><input type="text" name="UAB" id="UAB" readonly></td>
                                                        </tr>

                                                        <tr>
                                                            <th class="bg-light">PROPIETARIO</th>
                                                              <td><input type="text" name="nombre_propietario" id="nombre_propietario" readonly>
                                                                    <input type="text" name="nombre_propietario" id="nombre_propietario" hidden>
                                                                </td>
                                                            <th class="bg-light">CÉDULA / RIF</th>
                                                            <td>
                                                                <input type="text" name="numero_identificacion" id="numero_identificacion" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg-light">ESLORA</th>
                                                            <td> <input type="text" name="eslora" id="eslora" readonly></td>
                                                            <th class="bg-light">MANGA</th>
                                                            <td> <input type="text" name="manga" id="manga" readonly></td>
                                                        </tr>
                                                    </table>
                                                    </div>


                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col text-left">
                                                <a href="{{ route('permisoszarpes.createStepOne') }}"
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
