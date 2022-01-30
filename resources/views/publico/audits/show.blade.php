@extends('layouts.app')
@section("titulo")
    Auditoria
@endsection
@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('auditables.index') }}">Auditoria</a>
            </li>
            <li class="breadcrumb-item active1">Consulta</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Consultar Auditoria - {{$auditable->id}}</strong>
                                 <div class="card-header-actions">
                                     <a href= "{{route('auditables.index')}} " class="btn btn-primary btn-sm">Listado de Auditorias</a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="my-2">
                                     <div class="container">
                                 @include('publico.audits.show_fields')
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection