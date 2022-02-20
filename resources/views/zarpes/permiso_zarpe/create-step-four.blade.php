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
                    

                         	 <form action="{{ route('permisoszarpes.permissionCreateStepFour') }}" method="POST">
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
  
                              <div class="row">
       
                          <div class="col-md-4">


                            <div class="form-group col-sm-12">
                                {!! Form::label('0', 'Origen:') !!}
                                {!! Form::select('origen', ['1'=>' Maracaibo', '2'=>'Las Piedras', '3'=>'La Guaira', '4'=>'Puerto la Cruz', '5'=>'Carupano', '6'=>'Pampatar', '7'=>'Puerto Cabello', '8'=>'Caripito', '9'=>'Puerto Sucre', '10'=>'Ciudad Bolivar', '11'=>'Guiria', '12'=>'Ciudad Guayana', '13'=>'Apure', '14'=>'Amazonas', '15'=>'Miranda', '16'=>'La Vela de Coro', '17'=>'La Ceiba', '18'=>'Delta Amacuro'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'bandera']) !!}
                            </div>

                          </div>

                          <div class="col-md-4">
                            {!! Form::label('salida', 'Fecha/hora salida:') !!}
                            <input type="datetime-local" name="salida" class="form-control">

                          </div>

                          <div class="col-md-4">

                            {!! Form::label('regreso', 'Fecha/hora regreso:') !!}
                            <input type="datetime-local" name="regreso" class="form-control">

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
