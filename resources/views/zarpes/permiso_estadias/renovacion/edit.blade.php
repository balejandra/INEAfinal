@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/estadia.js')}}"></script>
    @endpush
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('permisosestadia.index') !!}">Permiso Estadia</a>
        </li>
        <li class="breadcrumb-item ">Editar</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-edit fa-lg"></i>
                            <strong>Editar Permiso de Estadia</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::model($permisoEstadia, ['route' => ['permisosestadia.update', $permisoEstadia->id], 'method' => 'patch','files' => true]) !!}

                            @include('zarpes.permiso_estadias.show_fields')
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    {!! Form::label('permiso_seniat', 'Permiso de Admisión Temporal emitida por el SENIAT:') !!}
                                    <input type="file" class="form-control" name="permiso_seniat"
                                           id="permiso_seniat" accept="application/pdf" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('comprobante_alicuota', 'Comprobante de pago de Alícuota:') !!}
                                    <input type="file" class="form-control" name="comprobante_alicuota"
                                           id="comprobante_alicuota" accept="application/pdf"required>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('inspeccion_visita', 'Inspección por el Visitador:') !!}
                                    <input type="file" class="form-control" name="inspeccion_visita"
                                           id="inspeccion_visita" accept="application/pdf" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('comprobante_saime', 'Comprobante de visita SAIME:') !!}
                                    <input type="file" class="form-control" name="comprobante_saime"
                                           id="comprobante_saime" accept="application/pdf" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('comprobante_insai', 'Comprobante de visita INSAI:') !!}
                                    <input type="file" class="form-control" name="comprobante_insai"
                                           id="comprobante_insai" accept="application/pdf" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('pago_permisoEstadia', 'Pago del Permiso Especial de Estadía:') !!}
                                    <input type="file" class="form-control" name="pago_permisoEstadia"
                                           id="pago_permisoEstadia" accept="application/pdf" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('comprobante_ochina', 'Comprobante de pago a OCHINA:') !!}
                                    <input type="file" class="form-control" name="comprobante_ochina"
                                           id="pago_permisoEstadia" accept="application/pdf" required>
                                </div>
                                <!-- Submit Field -->
                                <div class="form-group col-sm-12">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('permisosestadia.index') }}"
                                       class="btn btn-secondary">Cancelar</a>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection