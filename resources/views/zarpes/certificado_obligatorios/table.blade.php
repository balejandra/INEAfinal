<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:80%">
    <thead>
    <tr>
        <th>Id</th>
        <th>Parámetro Embarcación</th>
        <th>Cantidad Comparación</th>
        <th>Nombre Certificado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($certificadoObligatorios as $certificadoObligatorio)
        <tr>
            <td>{{ $certificadoObligatorio->id }}</td>
            <td>{{ $certificadoObligatorio->parametro_embarcacion }}</td>
            <td>{{ $certificadoObligatorio->cantidad_comparacion }}</td>
            <td>{{ $certificadoObligatorio->nombre_certificado }}</td>
            <td>
                @can('consultar-certificado')
                    <a class="btn btn-sm btn-success"
                       href="  {{ route('certificadoObligatorios.show', [$certificadoObligatorio->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-certificado')
                    <a class="btn btn-sm btn-info"
                       href=" {{ route('certificadoObligatorios.edit', [$certificadoObligatorio->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-certificado')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['certificadoObligatorios.destroy', $certificadoObligatorio->id], 'method' => 'delete','class'=>'delete-form']) !!}
                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar"
                                data-mensaje="el certificado {{$certificadoObligatorio->id}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
