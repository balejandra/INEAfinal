@extends('layouts/auth')
@section("titulo")
    Registro
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/register.js')}}"></script>
    @endpush
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <span>
                    <img src="{{asset('images/inea.png')}}" alt="inealogo" class="nav-avatar">
                </span>
                <div class="card mx-4">
                    <div class="card-body p-4">

                        <form method="post" action="{{ url('/register') }}">
                            @csrf
                            <h1>{{ __('Register') }}</h1>
                            <p class="text-muted">Crear tu cuenta</p>
                            <div class="form-row">
                                <!--////////// NATURAL O JURIDICA //////////////-->
                                <div class="container">
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            <div class="form-check-inline form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="natural" checked
                                                onchange="javascript:showContentNatural()">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Natural</label>
                                            </div>
                                        </div>
                                        <div class="col-6 form-group">
                                            <div class="form-check-inline form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                       id="juridica" onchange="javascript:showContent()">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Juridica</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100 d-none d-md-block"></div>
                                <!--- ////// TIPO DOCUMENTO ///// -->
                                <div class="col-md-6 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-passport"></i></span>
                                        </div>
                                        <select class="form-select" aria-label="documentacion" id="tipo_documento" name="tipo_documento">
                                            <option selected>Tipo de Documento</option>
                                            <option value="cedula">Cedula</option>
                                            <option value="pasaporte">Pasaporte</option>
                                            <option value="rif">RIF</option>
                                        </select>
                                        @if ($errors->has('tipo_documento'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('tipo_documento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--- /////// NUMERO DE IDENTIFICACION /////// -->
                                <div class="col-md-6 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                        </div>
                                        <input type="text"
                                               class="form-control {{ $errors->has("numero_identificacion")?"is-invalid":"" }}"
                                               name="numero_identificacion" value="{{ old('numero_identificacion') }}"
                                               placeholder="Numero de identificacion">
                                        @if ($errors->has('numero_identificacion'))
                                            <span class="invalid-feedback">
                                    <strong>{{ $errors->first('numero_identificacion') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-100 d-none d-md-block"></div>
                                <!-- /////// FECHA DE NACIMIENTO ///// -->
                                <div class="col-md-12 col-sm-12" id="fechanacimiento">
                                    <div class="input-group mb-3" id="nacimiento">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date"
                                               class="form-control "
                                               name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" id="fecha_nacimiento"
                                               placeholder="fecha_nacimiento" required>
                                    </div>
                                </div>
                                <div class="w-100 d-none d-md-block"></div>
                                <!--////////// NOMBRES //////////////-->
                                <div class="col-md-6 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                               class="form-control {{ $errors->has('nombres')?'is-invalid':'' }}"
                                               name="nombres" value="{{ old('nombres') }}"
                                               placeholder="Nombres">
                                        @if ($errors->has('nombres'))
                                            <span
                                                class="invalid-feedback"><strong>{{ $errors->first('nombres') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <!--////////// APELLIDOS //////////////-->
                                <div class="col-md-6 col-sm-12" id="apellidosdiv">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text"
                                               class="form-control"
                                               name="apellidos" value="{{ old('apellidos') }}" id="apellidos"
                                               placeholder="Apellidos">
                                        @if ($errors->has('apellidos'))
                                            <span
                                                class="invalid-feedback"><strong>{{ $errors->first('apellidos') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-100 d-none d-md-block"></div>
                                <!--////////// TELEFONO //////////////-->
                                <div class="col-md-6 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-phone"></i>
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
                                <!--////////// DIRECCION //////////////-->
                                <div class="col-md-6 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text"
                                               class="form-control {{ $errors->has('direccion')?'is-invalid':'' }}"
                                               name="direccion" value="{{ old('direccion') }}"
                                               placeholder="direccion">
                                        @if ($errors->has('direccion'))
                                            <span
                                                class="invalid-feedback"><strong>{{ $errors->first('direccion') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-100 d-none d-md-block"></div>
                                <!--////////// EMAIL //////////////-->
                                <div class="col-md-12 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                                        </div>
                                        <input type="email"
                                               class="form-control {{ $errors->has('email')?'is-invalid':'' }}"
                                               name="email"
                                               value="{{ old('email') }}" placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <!--////////// PASSWORD //////////////-->
                                <div class="col-md-12 col-sm-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password"
                                               class="form-control {{ $errors->has('password')?'is-invalid':''}}"
                                               name="password" placeholder="Contraseña">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <!--////////// PASSWORD CONFIRMATION //////////////-->
                                <div class="col-md-12 col-sm-12">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder={{ __('Confirm Password') }}>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                <!--////////// BOTON //////////////-->
                                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                                <a href="{{ url('/login') }}"
                                   class="text-center">{{ __('I already have a membership')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
