<div class="row  ">
    <div class="col-md-3 "></div>

    <div class="col-sm-12 col-md-12 col-lg-6 border rounded">

        <div class="row p-3">
<!-- Parametro Embarcacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro_embarcacion', 'Parámetro Embarcación:') !!}
    {!! Form::text('parametro_embarcacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Operador Logico Field -->
<div class="form-group col-sm-6">
    {!! Form::label('operador_logico', 'Operador Lógico:') !!}
    {!! Form::text('operador_logico', null, ['class' => 'form-control']) !!}
</div>

<!-- Parametro Comparacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro_comparacion', 'Cantidad Comparación:') !!}
    {!! Form::text('cantidad_comparacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Certificado Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_certificado', 'Nombre Certificado:') !!}
    {!! Form::text('nombre_certificado', null, ['class' => 'form-control']) !!}
</div>
        </div>
        <div class="row">
            <!-- Submit Field -->
            <div class="form-group text-center col-sm-6">
                <a href="{{ route('certificadoObligatorios.index') }}" class="btn btn-light btncancelarZarpes">Cancelar</a>
            </div>
            <div class="form-group text-center col-sm-6">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

            </div>

        </div>
    <div class="col-md-3 "></div>
</div>
</div>
