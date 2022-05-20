<!-- Uab Minimo Field -->
<div class="row">
<div class="form-group col-sm-4">
    {!! Form::label('UAB_minimo', 'Uab Minimo:') !!}
    {!! Form::number('UAB_minimo', null, ['class' => 'form-control', 'onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>

<!-- Uab Maximo Field -->
<div class="form-group col-sm-4">
    {!! Form::label('UAB_maximo', 'Uab Maximo:') !!}
    {!! Form::number('UAB_maximo', null, ['class' => 'form-control', 'onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>

<!-- Cant Tripulantes Field -->
<div class="form-group col-sm-4">
    {!! Form::label('cant_tripulantes', 'Cant Tripulantes:') !!}
    {!! Form::number('cant_tripulantes', null, ['class' => 'form-control', 'onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>
</div>
<br>

    <div class="row" id="coordenadas">
        <!-- latitud Field -->
      <div>
            {!! Form::hidden('ids[]',  null, ['class' => 'form-control']) !!}
        </div>

<div class="form-group col-3">
    {!! Form::label('Latitud', 'Cargo que desempeña:') !!}
            {!! Form::text('cargo[]', null, ['class' => 'form-control']) !!}
        </div>
        <!-- longitud Field -->
<div class="form-group col-3">

    {!! Form::label('longitud', 'Titulación minima aceptada:') !!}
            {!! Form::text('titulacion_minima[]', null , ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-3">
            {!! Form::label('longitud', 'Titulación máxima aceptada:') !!}
            {!! Form::text('titulacion_maxima[]', null, ['class' => 'form-control']) !!}
        </div>
            <div class="form-group col-sm-2 pt-4">
                {!! Form::button('Agregar', ['class' => 'btn btn-success', 'onclick' => 'agregarCargosMandos()']) !!}
            </div>

    </div>

    <div class="row">
        <div id="coords1" data-cant='1'>

        </div>
    </div>

    <!-- Submit Field -->
<div class="row form-group  mt-4">
    <div class="col text-center">
        <a href="{{route('tablaMandos.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
    <div class=" col text-center">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
