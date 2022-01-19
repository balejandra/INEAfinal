<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $menu->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $menu->description }}</p>
</div>

<!-- Url Field -->
<div class="form-group">
    {!! Form::label('url', 'Url:') !!}
    <p>{{ $menu->url }}</p>
</div>

<!-- Parent Field -->
<div class="form-group">
    {!! Form::label('parent', 'Parent:') !!}
    <p>{{ $menu->parent }}</p>
</div>

<!-- Order Field -->
<div class="form-group">
    {!! Form::label('order', 'Order:') !!}
    <p>{{ $menu->order }}</p>
</div>

<!-- Icono Field -->
<div class="form-group">
    {!! Form::label('icono', 'Icono:') !!}
    <p>{{ $menu->icono }}</p>
</div>

<!-- Enabled Field -->
<div class="form-group">
    {!! Form::label('enabled', 'Enabled:') !!}
    <p>{{ $menu->enabled }}</p>
</div>

