@extends('layouts.app')
@section("titulo")
    Capitanias
@endsection
@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('capitanias.index') !!}">Capitania</a>
      </li>
      <li class="breadcrumb-item active1">Crear</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear Capitania</strong>
                                <div class="card-header-actions">
                                    <a href= "{{route('capitanias.index')}} " class="btn btn-primary btn-sm">Listado de Capitanias</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'capitanias.store']) !!}

                                   @include('publico.capitanias.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
