@extends('layouts.app')
@section("titulo")
    Equipos
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Equipos</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-plus-square-o fa-lg"></i>
                             <strong>Equipos</strong>

                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{ route('equipos.create') }}">Nuevo</a>
                             </div>
                         </div>
                         <div class="card-body">
                             @include('zarpes.equipos.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

