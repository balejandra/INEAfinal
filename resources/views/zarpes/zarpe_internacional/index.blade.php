@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos de Zarpe INTERNACIONAL</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fas fa-ship"></i>
                             <strong>Solicitud de Permisos de Zarpe INTERNACIONAL</strong>
                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{ route('zarpeInternacional.createStepOne') }}">Nuevo</a>
                             </div>
                         </div>
                         <div class="card-body" style="min-height: 350px;">
                             @include('zarpes.zarpe_internacional.table')

                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection
