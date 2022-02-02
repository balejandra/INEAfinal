@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
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

                              <input type="text" name="id" value="6" hidden>
                              <!-- Nombre Buque Field -->
                              <div class="row">
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('nombre_buque', 'Nombre Buque:') !!}
                                      <input type="text" name="nombre_buque"  class="form-control" value="{{$permisoEstadia['nombre_buque']}}">
                                  </div>

                                  <!-- Numero Registro Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('numero_registro', 'Numero Registro:') !!}
                                      {!! Form::text('numero_registro', $permisoEstadia['numero_registro'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Tipo Buque Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('tipo_buque', 'Tipo Buque:') !!}
                                      {!! Form::text('tipo_buque', $permisoEstadia['tipo_buque'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Puerto Matricula Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('puerto_matricula', 'Puerto Matricula:') !!}
                                      {!! Form::text('puerto_matricula', $permisoEstadia['puerto_matricula'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Nacionalidad Buque Field -->
                                  <div class="form-group col-sm-6" onLoad='myOnLoad()'>
                                      {!! Form::label('nacionalidad_buque', 'Nacionalidad Buque:') !!}
                                      <div id="nacionalidad">
                                          <select class="form-control" name="nacionalidad_buque" id="nacionalidad_buque">
                                              <option value="">Seleccione</option>

                                          </select>
                                      </div>
                                  </div>

                                  <!-- Propietario Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('propietario', 'Propietario:') !!}
                                      {!! Form::text('propietario', $permisoEstadia['propietario'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Pasaporte Capitan Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('pasaporte_capitan', 'Pasaporte Capitan:') !!}
                                      {!! Form::text('pasaporte_capitan', $permisoEstadia['pasaporte_capitan'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Nombrescompletos Capitan Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('nombrescompletos_capitan', 'Nombres completos Capitan:') !!}
                                      {!! Form::text('nombrescompletos_capitan', $permisoEstadia['nombrescompletos_capitan'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Eslora Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('eslora', 'Eslora:') !!}
                                      {!! Form::number('eslora', $permisoEstadia['eslora'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Manga Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('manga', 'Manga:') !!}
                                      {!! Form::number('manga', $permisoEstadia['manga'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Puntal Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('puntal', 'Puntal:') !!}
                                      {!! Form::number('puntal', $permisoEstadia['puntal'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Arqueo Bruto Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('arqueo_bruto', 'Arqueo Bruto:') !!}
                                      <input type="text" name="arqueo_bruto" value="{{$permisoEstadia['arqueo_bruto']}}" id="arqueo_bruto" class="form-control" onblur="ochina($('#arqueo_bruto').val())">
                                  </div>

                                  <!-- Arqueo Neto Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('arqueo_neto', 'Arqueo Neto:') !!}
                                      {!! Form::text('arqueo_neto', $permisoEstadia['arqueo_neto'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Actividades Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('actividades', 'Actividades:') !!}
                                      {!! Form::text('actividades', $permisoEstadia['actividades'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Numero Tripulantes Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('numero_tripulantes', 'Numero de Tripulantes:') !!}
                                      {!! Form::number('numero_tripulantes', $permisoEstadia['numero_tripulantes'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Puerto Origen Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('puerto_origen', 'Puerto de Origen:') !!}
                                      {!! Form::text('puerto_origen', $permisoEstadia['numero_tripulantes'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Ultimo Puertovisitado Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('ultimo_puertovisitado', 'Ultimo Puerto visitado:') !!}
                                      {!! Form::text('ultimo_puertovisitado', $permisoEstadia['ultimo_puertovisitado'], ['class' => 'form-control']) !!}
                                  </div>

                                  <!-- Tiempo Estadia Field -->
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('tiempo_estadia', 'Tiempo de Estadia:') !!}
                                      {!! Form::text('tiempo_estadia', $permisoEstadia['tiempo_estadia'], ['class' => 'form-control']) !!}
                                  </div>

                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Zarpe original de procedencia:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Registro de la embarcación:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Despacho de emigración:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Pasaportes de los tripulantes:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Comprobante de visita del SENIAT:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2" required>
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Comprobante de pago de Alícuota:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Inspección:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Comprobante de visita SAIME:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Comprobante de visita INSAI:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6">
                                      {!! Form::label('documento_1', 'Pago del Permiso Especial de Estadía:') !!}
                                      <input type="file" class="form-control" name="foto_final2" id="foto_final2">
                                  </div>
                                  <div class="form-group col-sm-6" id="documentoOchina">
                                  </div>
                              </div>
                              <!-- Submit Field -->
                              <div class="form-group col-sm-12">
                                  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                  <a href="{{ route('permisosestadia.index') }}" class="btn btn-secondary">Cancelar</a>
                              </div>


                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
