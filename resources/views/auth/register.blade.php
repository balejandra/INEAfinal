@extends('layouts/auth')
@section("titulo")
    Registro
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
             <span>
                    <img src="{{asset('images/inea.png')}}" alt="cardenasconstrucciones" class="nav-avatar">
                </span>
            <div class="card mx-4">
                <div class="card-body p-4">
                    <form method="post" action="{{ url('/register') }}">
                        @csrf
                        <h1>{{ __('Register') }}</h1>
                        <p class="text-muted">Crear tu cuenta</p>
                        <div class="row">
                            <div class="col-md-6 col-sm-12  form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                    </div>
                                    <input type="text"
                                           class="form-control {{ $errors->has('nombres')?'is-invalid':'' }}"
                                           name="nombres" value="{{ old('nombres') }}"
                                           placeholder="Nombres">
                                    @if ($errors->has('nombres'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('nombres') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                    </div>
                                    <input type="text"
                                           class="form-control {{ $errors->has('tipo_documento')?'is-invalid':'' }}"
                                           name="tipo_documento" value="{{ old('tipo_documento') }}"
                                           placeholder="Tipo de documento">
                                    @if ($errors->has('tipo_documento'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('tipo_documento') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                    </div>
                                    <input type="date"
                                           class="form-control {{ $errors->has('fecha_nacimiento')?'is-invalid':'' }}"
                                           name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                           placeholder="fecha_nacimiento">
                                    @if ($errors->has('fecha_nacimiento'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12  form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                    </div>
                                    <input type="text"
                                           class="form-control {{ $errors->has('apellidos')?'is-invalid':'' }}"
                                           name="apellidos" value="{{ old('apellidos') }}"
                                           placeholder="Apellidos">
                                    @if ($errors->has('apellidos'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                    </div>
                                    <input type="text"
                                           class="form-control {{ $errors->has('numero_identificacion')?'is-invalid':'' }}"
                                           name="numero_identificacion" value="{{ old('numero_identificacion') }}"
                                           placeholder="Numero de identificacion">
                                    @if ($errors->has('numero_identificacion'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('numero_identificacion') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                    </div>
                                    <input type="text"
                                           class="form-control {{ $errors->has('telefono')?'is-invalid':'' }}"
                                           name="telefono" value="{{ old('telefono') }}"
                                           placeholder="Telefono">
                                    @if ($errors->has('telefono'))
                                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-user"></i>
                              </span>
                                </div>
                                <input type="text"
                                       class="form-control {{ $errors->has('direccion')?'is-invalid':'' }}"
                                       name="direccion" value="{{ old('direccion') }}"
                                       placeholder="direccion">
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('direccion') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}"
                                       name="email"
                                       value="{{ old('email') }}" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-lock"></i>
                              </span>
                                </div>
                                <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}"
                                       name="password" placeholder="Contraseña">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="icon-lock"></i>
                              </span>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control"
                                       placeholder={{ __('Confirm Password') }}>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                                @endif
                            </div>
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                        <a href="{{ url('/login') }}" class="text-center">{{ __('I already have a membership')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
