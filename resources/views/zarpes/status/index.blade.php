@extends('layouts.app')
@section("titulo")
    Estatus
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Estatus</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-plus-square-o fa-lg"></i>
                             <strong>Estatus</strong>

                                 <div class="card-header-actions">
                                     <a class="btn btn-primary btn-sm"  href="{{ route('status.create') }}">Nuevo</a>
                                 </div>
                         </div>
                         <div class="card-body">
                             @include('zarpes.status.table')
                              <div class="pull-right mr-3">

                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

