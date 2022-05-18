<!-- Uab Minimo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UAB_minimo', 'Uab Minimo:') !!}
    {!! Form::number('UAB_minimo', null, ['class' => 'form-control']) !!}
</div>

<!-- Uab Maximo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('UAB_maximo', 'Uab Maximo:') !!}
    {!! Form::number('UAB_maximo', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Tripulantes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_tripulantes', 'Cant Tripulantes:') !!}
    {!! Form::number('cant_tripulantes', null, ['class' => 'form-control']) !!}
</div>

{!! Form::label('Cargos', 'Cargos:') !!}
@php($var=0)

@forelse($coordenadas as $key =>$coord)
    <div>
        {!! Form::hidden('deletes[]',  null, ['class' => 'form-control', 'id'=>'deletes'. $key]) !!}
    </div>
    <div class="row" id="coordenadas{{$key}}">
        <!-- latitud Field -->
        <div>
            {!! Form::hidden('ids[]',  $coord->id, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4">
            @if ($var==0)
                {!! Form::label('Latitud', 'Cargo que desempeña:') !!}
            @endif
            {!! Form::text('latitud[]', $coord->cargo_desempena, ['class' => 'form-control']) !!}
        </div>
        <!-- longitud Field -->
        <div class="form-group col-sm-4">
            @if ($var==0)
                {!! Form::label('longitud', 'Titulación minima aceptada:') !!}
            @endif
            {!! Form::text('longitud[]', $coord->titulacion_aceptada_minima , ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-4">
            @if ($var==0)
                {!! Form::label('longitud', 'Titulación máxima aceptada:') !!}
            @endif
            {!! Form::text('longitud[]', $coord->titulacion_aceptada_maxima , ['class' => 'form-control']) !!}
        </div>

    @if ($var==0)
        @php($var++)
            <div class="form-group col-sm-2 pt-4">
{!! Form::button('Agregar otras', ['class' => 'btn btn-success', 'onclick' => 'agregarcargosMandos()']) !!}
            </div>
@else
        <div class="form-group col-sm-2 ">

        {!! Form::button('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'eliminarCoordenadasDF(this.id, '.$coord->id.')', 'id'=>$key]) !!}

            </div>
@endif
    </div>

@empty
    <div class="row" >
        <!-- latitud Field -->

        <div class="form-group col-sm-5">
            {!! Form::label('Latitud', 'Latitud:') !!}
            {!! Form::text('latitud[]', null, ['class' => 'form-control']) !!}
        </div>
        <!-- longitud Field -->
        <div class="form-group col-sm-5">
            {!! Form::label('longitud', 'Longitud:') !!}
            {!! Form::text('longitud[]', null , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-2 pt-4">
        <!--   {!! Form::button('Agregar otras', ['class' => 'btn btn-success', 'onclick' => 'agregarCoordenadasDF()']) !!}-->
        </div>

    </div>

@endforelse
<div  id="coords1" data-cant='1'>

</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
