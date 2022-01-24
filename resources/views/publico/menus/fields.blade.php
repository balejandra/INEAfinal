<!-- Enabled Field -->
<div class="form-group row">
    {!! Form::label('name', 'Roles:') !!}


    @foreach ($roles as $key => $item)
        <div class="form-check form-switch col-sm-3 ">


                <input class="form-check-input" type="checkbox" name="role[]" id='role' value="{{$item->id}}"  style="margin-left: auto;" {{$item->checked}}>
                <label class="form-check-label" for="flexSwitchCheckDefault" style="margin-inline-start: 30px;">{{$item->name}} </label>


        </div>
    @endforeach
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Descripcion:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'URL:') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('parent', 'Menu padre:') !!}
    {!! Form::select('parent', $parent, null, ['class' => 'form-control','placeholder' => 'Seleccione un padre']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Orden:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Icono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icono', 'Icono:') !!}
    {!! Form::text('icono', null, ['class' => 'form-control']) !!}
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enabled', 'Habilitado:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('enabled', 0) !!}
        {!! Form::checkbox('enabled', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
