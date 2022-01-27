@extends('layouts.app')
@section("titulo")
    Menus
@endsection
@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('menus.index') !!}">Menu</a>
          </li>
          <li class="breadcrumb-item active1">Editar</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar Menu</strong>

                              <div class="card-header-actions">
                                  <a href= "{{route('menus.index')}} " class="btn btn-primary btn-sm">Listado de Menus</a>
                              </div>
                          </div>
                          <div class="card-body">
                          </div>
                          <div class="card-body">
                              {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'patch']) !!}

                              @include('publico.menus.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
