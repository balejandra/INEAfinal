@extends('layouts.app')
@section("titulo")
    Menus
@endsection
@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('menus.index') !!}">Menu</a>
      </li>
      <li class="breadcrumb-item">Crear</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear Menu</strong>

                                <div class="card-header-actions">
                                    <a href= "{{route('menus.index')}} " class="btn btn-primary btn-sm">Listado de Menus</a>
                                </div>

                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'menus.store']) !!}

                                   @include('publico.menus.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
