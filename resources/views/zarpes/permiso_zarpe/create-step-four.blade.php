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
                                 <a class="btn btn-primary btn-sm"  href="{{route('permisoszarpes.index')}}">Listado</a>

                             </div>

                         </div>
                         <div class="card-body" style="min-height: 350px;">

                             @include('zarpes.permiso_zarpe.stepsIndicator')
                    

                         	 <form action="{{ route('permisoszarpes.permissionCreateStepFour') }}" id="formStepFour" method="POST">
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

                            <div  id="msjRuta">
                                   
                                </div>
  
                              <div class="row">
       
                                  <div class="col-md-4">


                                    <div class="form-group col-sm-12">
                                        {!! Form::label('0', 'Origen:') !!}

                                        <select id="origen" name="origen" class="form-control custom-select">
                                            <option value="0">Seleccione</option>
                                             @foreach ($EstNauticos as $en)
                                                <option value="{{$en->id}}">{{$en->nombre}} </option>
                                            @endforeach
                                        </select>

                                         
                                    </div>

                                  </div>

                                  <div class="col-md-4">
                                    {!! Form::label('salida', 'Fecha/hora salida:') !!}
                                    <input type="datetime-local"  id="salida" name="salida" min='{{date("Y-m-d")}}T{{date("h:i")}}' class="form-control" onblur="compararFechas()">

                                  </div>

                                  <div class="col-md-4">

                                    {!! Form::label('regreso', 'Fecha/hora regreso:') !!}
                                    <input type="datetime-local" id="regreso" name="regreso" class="form-control" onblur="compararFechas()">

                                  </div>

                                    
                                </div>

                            <div class="row px-3"  >
                                <div class="col-md-5">

                                    <div class="form-group">
                                        <label for="title">Latitud:</label>
                                        <input type="text" class="form-control" id="latitud"  readonly name="latitud"  data-lat="">

                                    </div>

                                </div>
                                <div class="col-md-5" >

                                    <div class="form-group">
                                        <label for="title">Longitud:</label>
                                        <input type="text" class="form-control" id="longitud" readonly name="longitud"  data-long="">

                                    </div>

                                </div>
                                <input type="hidden" class="form-control" id="capitaniaDestino"  name="coordenadasDestino" >

                                
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                     <label >Coordenadas destino:</label>
                                    @include('zarpes.permiso_zarpe.map')
                                </div>
                            </div>

                          
                    </div>
  
                    <div class="card-footer text-right">
                        <div class="row">
				            <div class="col-md-6 text-left">
				                <a href="{{ route('permisoszarpes.createStepThree') }}" class="btn btn-primary pull-right">Previous</a>
				            </div>
				            <div class="col-md-6 text-right">
				                <button type="submit" class="btn btn-primary">Next</button>
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
