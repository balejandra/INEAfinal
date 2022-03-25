@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('users.index') !!}">Usuarios</a>
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
                                <strong>Crear Usuario</strong>
                                <div class="card-header-actions">
                                    <a href= "{{route('users.index')}} " class="btn btn-primary btn-sm">Listado de Usuarios</a>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'users.store']) !!}

                                <!-- Email Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('email', 'Email:') !!}
                                        {!! Form::email('email', null, ['class' => 'form-control','required']) !!}
                                    </div>

                                    <!-- Nombres Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('nombres', 'Nombres:') !!}
                                        {!! Form::text('nombres', null, ['class' => 'form-control','required']) !!}
                                    </div>

                                    <!-- Password Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('password', 'Contraseña:') !!}
                                        <input type="password" class="form-control" id="password" name="password" required>
                                        {!! Form::label('password', 'Confirmar Contraseña:') !!}
                                        <input type="password" name="password_confirmation" class="form-control" required
                                               placeholder={{ __('Confirm Password') }}>
                                    </div>


                                    <div class="form-group col-sm-6">
                                        {!! Form::label('role id', 'Rol asignado:') !!}

                                        {!! Form::select('roles', $roles, null, ['class' => 'roles form-control custom-select','placeholder' => 'Puede asignar un Rol...','onchange="requeridos(); EstablecimientoUser();"','required']) !!}
                                    </div>
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('capitania_id', 'Capitania Asignada:') !!}
                                        {!! Form::select('capitanias', $capitanias, null, ['id'=>'capitanias','class' => ' form-control custom-select','placeholder' => 'Puede asignar una capitania...','onchange="EstablecimientoUser();"']) !!}
                                    </div>

                                    <div class="form-group col-sm-6">
                                        {!! Form::label('0', 'Establecimiento náutico asignado:') !!}

                                        <select id="establecimiento" name="establecimiento" title="" class="form-control custom-select">
                                            <option value="">Puede asignar un Establecimiento...</option>

                                        </select>
                                    </div>
                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                    </div>

                                    <input type="text" name="tipo_usuario" value="interno" hidden>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
