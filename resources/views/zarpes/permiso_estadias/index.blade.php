@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Permisos de Estadia</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             Permisos de estadia
                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{ route('permisosestadia.create') }}">Nuevo</a>
                             </div>
                         </div>
                         <div class="card-body">
                             @include('zarpes.permiso_estadias.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

