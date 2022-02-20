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
				                                <label for="title">Product Name:</label>
				                                <input type="text" value="{{ $product->name ?? '' }}" class="form-control" id="taskTitle"  name="name">
				                            </div>
				                            <div class="form-group">
				                                <label for="description">Product Amount:</label>
				                                <input type="text"  value="{{{ $product->amount ?? '' }}}" class="form-control" id="productAmount" name="amount"/>
				                            </div>
				   
				                            <div class="form-group">
				                                <label for="description">Product Description:</label>
				                                <textarea type="text"  class="form-control" id="taskDescription" name="description">{{{ $product->description ?? '' }}}</textarea>
				                            </div>
				                          
				                    </div>
				  
				                    <div class="card-footer text-right">
				                        <div class="row">
								            <div class="col-md-6 text-left">
								                <a href="{{ route('permisoszarpes.createStepSix') }}" class="btn btn-primary pull-right">Anterior</a>
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
