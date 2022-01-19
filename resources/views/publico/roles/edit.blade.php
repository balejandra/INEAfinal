@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('permissions') !!}">Permisos</a>
      </li>
      <li class="breadcrumb-item active">Modificar Permiso</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Modificar Permiso</strong>

                                <div class="card-header-actions">
                                     <a href= "{{route('roles')}} " class="btn btn-primary btn-sm">Listado de roles</a>
                                  </div>
                            </div>
                            <div class="card-body">
                                
 
 						 <form action= "{{route('roles.update', $role->id)}} " method="post" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre :</label>
                                <input type="text" class="form-control" id="name" placeholder="Nombre del permiso" name="name" value= "{{ $role->name }}" required>
                                 @if($errors->has('name'))
                                    <span class="error text-danger" for='input-name'>
                                            {{ $errors->first('name') }}
                                    </span>
                                 @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="h6 mt-3" >Permisos:</label>

                            <div class="container">
                                <div class="row">
                                    @foreach($permissions as $id => $permission)
                                    <div class="col-3">
                                        <div class="form-check form-check-inline mt-sm-2" style="float:left">
                                            <input class="form-check-input form-field-acceptconditions" type="checkbox" name="permissions[]" id="{{$id}}" value="{{$id}}" {{ $role->permissions->contains($id) ? 'checked' : '' }} data-toggle="tooltip" data-placement="right" title=" {{$permission}} ">
                                            <p class="form-check-label" for="inlineCheckbox1 texto-recortado">{{ $permission}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-bg-inea">Modificar</button>
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