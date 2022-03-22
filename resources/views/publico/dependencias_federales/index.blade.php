@extends('layouts.app')
@section("titulo")
    Dependencias Federales
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dependencias Federales</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             DependenciaFederals
                             <a class="pull-right" href="{{ route('dependenciasfederales.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                             @include('publico.dependencias_federales.table')
                              <div class="pull-right mr-3">

                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

