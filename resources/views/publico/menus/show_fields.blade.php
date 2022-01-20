<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{{ $menu->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Descripcion:') !!}
    <p>{{ $menu->description }}</p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $menu->url }}</p>
</div>

<!-- Parent Field -->
<div class="form-group">
    {!! Form::label('parent', 'Menu Padre:') !!}
    <p>{{ $menu->parent }}</p>
</div>

<!-- Order Field -->
<div class="form-group">
    {!! Form::label('order', 'Orden:') !!}
    <p>{{ $menu->order }}</p>
</div>

<!-- Icono Field -->
<div class="form-group">
    {!! Form::label('icono', 'Icono:') !!}
    <p>{{ $menu->icono }}</p>
</div>

<!-- Enabled Field -->
<div class="form-group">
    {!! Form::label('enabled', 'Habilitado:') !!}
    <p>{{ $menu->enabled }}</p>
</div>

