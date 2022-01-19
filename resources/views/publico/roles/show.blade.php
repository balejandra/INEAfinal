@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('permissions') !!}">Permisos</a>
      </li>
      <li class="breadcrumb-item active">Consiltar Permiso</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Consultar Rol - {{$role->name}}</strong>

                                <div class="card-header-actions">
                                     <a href= "{{route('roles')}} " class="btn btn-primary btn-sm">Listado de roles</a>
                                  </div>
                            </div>
                            <div class="card-body">
                                
 
 						 
            <div class="my-2">
            <div class="container">
                 
                    <div class="row"> 
                    	<div class="col-md-12">
                    		Permisos asignados:
                    	</div>
                        @forelse($role->permissions as $permission)
                            
                            <div class="col-md-1 mx-1">
                            	<span class="badge badge-info">{{$permission->name}} </span>
                            </div>
                        @empty
                            <div class="col-md-12 border rounded p-2"> 
                            	<span class="badge badge-danger">Sin permisos asignados</span>
                            </div>
                            
                                 
                        @endforelse
                    </div>
                            
                           
                        
                

                </div>
            </div>


                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection