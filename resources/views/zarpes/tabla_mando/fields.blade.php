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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
