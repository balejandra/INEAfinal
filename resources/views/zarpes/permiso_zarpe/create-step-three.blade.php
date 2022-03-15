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
                             <strong>Solicitud de Permisos de Zarpe | Paso 3</strong>

                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{route('permisoszarpes.index')}}">Listado</a>

                             </div>

                         </div>
                         <div class="card-body" style="min-height: 350px;">

                         	@include('zarpes.permiso_zarpe.stepsIndicator')


                         	 <form action="{{ route('permisoszarpes.permissionCreateStepThree') }}" method="POST">
                @csrf

                <div class="card">


                    <div class="card-body" style="min-height: 200px;">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-1"></div>

                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="title">Tipo de navegación:</label>

                                            <select id="tipo_de_navegacion" name="tipo_de_navegacion" class="form-control custom-select">
                                            <option value="">Seleccione</option>

                                              @foreach ($TipoZarpes as $tz)
                                                <option value="{{$tz->id}}">{{$tz->nombre}} </option>
                                            @endforeach
                                        </select>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="title">Descripción de la navegación:</label>

                                            <select id="descripcion_de_navegacion" name="descripcion_de_navegacion" class="form-control custom-select">
                                            <option value="">Seleccione</option>
                                            <option value="1">Dentro de una circunscripción</option>
                                            <option value="2">Dentro de una circunscripción pero hacia una dependencia federal</option>
                                            <option value="3">Entre circunscripciones</option>
                                            <option value="4">Internacional</option>

                                               
                                        </select>
                                        </div>

                                    </div>
                                
                                <div class="col-md-3">

                                        <div class="form-group">
                                            <label for="title">Capitanía de origen:</label>

                                            <select id="capitania" name="capitania" class="form-control custom-select">
                                            <option value="">Seleccione</option>

                                              @foreach ($capitanias as $capitania)
                                                <option value="{{$capitania->id}}">{{$capitania->nombre}} </option>
                                            @endforeach
                                        </select>
                                        </div>

                                    </div>

                            </div>
                                <div class="col-md-1"></div>


                    </div>

                    <div class="card-footer text-right">
                        <div class="row">
				            <div class="col-md-6 text-left">
				                <a href="{{ route('permisoszarpes.CreateStepTwo') }}" class="btn btn-primary pull-right">Anterior</a>
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
