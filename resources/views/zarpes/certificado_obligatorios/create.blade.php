@extends('layouts.app')
@section("titulo")
    Certificados
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('certificadoObligatorios.index') !!}">Certificados</a>
                </li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </nav>
    </div>
    </header>
     <div class="container-fluid">
          <div class="animated fadeIn">
              @include('errors.messages')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-certificate"></i>
                                <strong>Crear Certificado Obligatorio</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'certificadoObligatorios.store']) !!}

                                   @include('zarpes.certificado_obligatorios.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
