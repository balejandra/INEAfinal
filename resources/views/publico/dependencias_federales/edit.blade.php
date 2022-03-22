@extends('layouts.app')
@section("titulo")
    Dependencias Federales
@endsection
@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('dependenciasfederales.index') !!}">Dependencia Federal</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Dependencia Federal</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($dependenciaFederal, ['route' => ['dependenciasfederales.update', $dependenciaFederal->id], 'method' => 'patch']) !!}

                              @include('publico.dependencias_federales.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
