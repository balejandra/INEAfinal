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
                    <a href="{!! route('capitaniaUsers.index') !!}">Usuarios de Capitania</a>
                </li>
                <li class="breadcrumb-item active">Crear</li>
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
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Crear Usuario de Capitania</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'capitaniaUsers.store']) !!}

                                   @include('publico.capitania_users.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
