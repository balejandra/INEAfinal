@extends('layouts.app')
@section("titulo")
    Capitanias
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('capitanias.index') !!}">Capitania</a>
                </li>
                <li class="breadcrumb-item">Editar</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar Capitania {{$capitania->nombre}}</strong>
                              <div class="card-header-actions">
                                  <a href= "{{route('capitanias.index')}} " class="btn btn-primary btn-sm">Listado de Capitanias</a>
                              </div>
                          </div>
                          <div class="card-body">
                              {!! Form::model($capitania, ['route' => ['capitanias.update', $capitania->id], 'method' => 'patch']) !!}

                              @include('publico.capitanias.fieldsedit')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
