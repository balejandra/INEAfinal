@extends('layouts.app')
@section("titulo")
    Capitania
@endsection
@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('capitanias.index') }}">Capitania</a>
            </li>
            <li class="breadcrumb-item ">Consulta</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Consultar Capitania</strong>
                                 <div class="card-header-actions">
                                     <a href= "{{route('capitanias.index')}} " class="btn btn-primary btn-sm">Listado de Capitanias</a>
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="my-2">
                                     <div class="container">
                                 @include('publico.capitanias.show_fields')
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
