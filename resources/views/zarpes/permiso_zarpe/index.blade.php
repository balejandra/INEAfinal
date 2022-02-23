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
                                 <a class="btn btn-primary btn-sm"  href="{{ route('permisoszarpes.createStepOne') }}">Nuevo</a>
                             </div>
                         </div>
                         <div class="card-body" style="min-height: 350px;">
                             @include('zarpes.permiso_zarpe.table')

                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection