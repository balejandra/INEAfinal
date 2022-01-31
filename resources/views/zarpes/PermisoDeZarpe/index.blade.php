@extends('layouts.app')
@section("titulo")
    Capitania
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Solicitud de Permisos de Zarpe</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             <strong>Solicitud de Permisos de Zarpe</strong>

                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="#">Nuevo</a>
                             </div>

                         </div>
                         <div class="card-body">

                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

