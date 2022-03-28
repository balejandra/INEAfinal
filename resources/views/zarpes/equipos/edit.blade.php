@extends('layouts.app')
@section("titulo")
    Equipos
@endsection
@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('equipos.index') !!}">Equipos</a>
          </li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar Equipo</strong>
                              <div class="card-header-actions">
                                  <a href="{{route('equipos.index')}} " class="btn btn-primary btn-sm">Listado de Equipos</a>
                              </div>
                          </div>
                          <div class="card-body">
                              {!! Form::model($equipo, ['route' => ['equipos.update', $equipo->id], 'method' => 'patch']) !!}

                              @include('zarpes.equipos.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection