<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{$status->id}}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre</th>
        <td>{{ $status->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Creado</th>
        <td>{{ $status->created_at }}</td>
    </tr>
    
    </tbody>
</table>
<div class="form-group col-sm-12 text-center">
        
        <a href="{{ route('status.index') }}" class="btn  btncancelarZarpes">Cancelar</a>
    </div>