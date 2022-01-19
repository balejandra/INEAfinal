@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('menus.index') !!}">Permisos</a>
      </li>
      <li class="breadcrumb-item active">Nuevo Permiso</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                
                                    <i class="fa fa-plus-square-o fa-lg"></i>
                                    <strong>Crear Permiso</strong>
                                 
                                  <div class="card-header-actions">
                                     <a href= "{{route('permissions')}} " class="btn btn-primary btn-sm">Listado de permisos</a>
                                  </div>
 
                            </div>
                            <div class="card-body">
                                
 
                                          
                        <form action= "{{route('permissions.store')}} " method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nombre del permiso" name="name" value= "{{ old('name') }}" required>
                                         @if($errors->has('name'))
                                            <span class="error text-danger" for='input-name'>
                                                    {{ $errors->first('name') }}
                                            </span>
                                         @endif
                                    </div>
                                </div>
                                <div class="col-md-2 text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-bg-inea">Guardar</button>
                                </div>
                            </div>
                        </form>
                                
             
                    </div>
  





                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection