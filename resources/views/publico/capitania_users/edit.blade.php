@extends('layouts.app')
@section("titulo")
    Usuarios de Capitanias
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('capitaniaUsers.index') }}">Usuarios de Capitanias</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
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
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar Usuario de Capitania</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($capitaniaUser, ['route' => ['capitaniaUsers.update', $capitaniaUser->id], 'method' => 'patch']) !!}

                              @include('publico.capitania_users.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
