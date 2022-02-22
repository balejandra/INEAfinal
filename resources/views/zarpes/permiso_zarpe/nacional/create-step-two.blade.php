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
                            <strong>Solicitud de Permisos de Zarpe</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('permisoszarpes.index')}}">Listado</a>
                            </div>

                        </div>
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
                                                    <label for="title">Matricula:</label>
                                                    <input type="text" class="form-control" id="matricula1">
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
                                                    <table class="table table-striped table-bordered" id="">
                                                        <thead>
                                                            <tr>
                                                                <th>MATRÍCULA</th>
                                                                <th>NOMBRE</th>
                                                                <th>DESTINACIÓN DEL BUQUE</th>
                                                                <th>UAB</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="myTable">
                                                            <tr>
                                                                <td><input type="text" id="matricula" name="matricula" readonly></td>
                                                                <td><input type="text" id="nombre" name="nombre" readonly></td>
                                                                <td><input type="text" name="destinacion" id="destinacion" readonly></td>
                                                                <td><input type="text" name="UAB" id="UAB" readonly></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <a href="{{ route('permisoszarpes.createStepOne') }}"
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
