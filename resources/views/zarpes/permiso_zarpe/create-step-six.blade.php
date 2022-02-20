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
                    

                         	 <form action="{{ route('permisoszarpes.permissionCreateStepSix') }}" method="POST">
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
                                <div class="row px-5" id="msj">
                                    
                                </div>
                                <div class="col-md-3">
                                                
                                    <div class="form-group">
                                        <label for="title">Cédula:</label>
                                        <input type="text" class="form-control" id="numero_identificacion"  name="numero_identificacion">
                                                    
                                    </div>

                                </div>

                                <div class="col-md-3">
                                        
                                    <div class="form-group">
                                        <label for="title">Fecha de nacimiento:</label>
                                        
                                        <input type="date"
                                               class="form-control "
                                               name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" id="fecha_nacimiento"
                                               placeholder="fecha_nacimiento" required >
                                    
                                                    
                                    </div>

                                </div>
                                <div class="col-md-3">
                                        
                                    <div class="form-group">
                                        <label for="title">Sexo:</label>
                                        {!! Form::select('sexo', ['F'=>'Femenino', 'M'=>'Masculino'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'sexo']) !!}
                                                    
                                    </div>

                                </div>

                                <div class="col-md-3 mt-4">
                                    <button type="button" class="btn btn-primary" onclick="getData()">Agregar</button>
                                </div>
                                            
                            </div>

                            <div class="row px-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Cédula</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>sexo</th>
                                                <th>Fecha Nacimiento</th>
                                                <th></th>
                                                 
                                            </tr>
                                        </thead>

                                        <tbody id="pasajeros"> 
                                             
                                        </tbody>
                                    </table>

                                </div>
                                
                            </div>
                          
                    </div>
  
                    <div class="card-footer text-right">
                        <div class="row">
				            <div class="col-md-6 text-left">
				                <a href="{{ route('permisoszarpes.createStepFive') }}" class="btn btn-primary pull-right">Anterior</a>
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
