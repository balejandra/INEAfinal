<!-- Equipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('equipo', 'Equipo:') !!}
    {!! Form::text('equipo', null, ['class' => 'form-control']) !!}
</div>

<div class="form-check form-switch col-sm-6">
    <input type="checkbox" name="cantidad" class="form-check-input" id="cantidad" value="false" style="margin-left: auto;"  onclick="javascript:inputcant()">
    <label class="form-check-label" for="flexSwitchCheckDefault" style="margin-inline-start: 30px;">Cantidad </label>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('equipo', 'Otros:') !!}
    {!! Form::text('otros', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('equipos.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
