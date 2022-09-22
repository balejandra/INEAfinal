<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{$certificadoObligatorio->id}}</td>
    </tr>
<tr>
    <th class="bg-light">Parámetro Embarcación</th>
    <td>{{ $certificadoObligatorio->parametro_embarcacion }}</td>
</tr>
<tr>
    <th class="bg-light">Operador Lógico</th>
    <td>{{ $certificadoObligatorio->operador_logico }}</td>
</tr>
    <tr>
        <th class="bg-light">Cantidad Comparación</th>
        <td>{{ $certificadoObligatorio->parametro_comparacion }}</td>
    </tr>

    <tr>
        <th class="bg-light">Nombre Certificado</th>
        <td>{{ $certificadoObligatorio->nombre_certificado }}</td>
    </tr>

    </tbody>
</table>

<div class="row">
    <div class="form-group text-center col-sm-12">
        <a href="{{ route('certificadoObligatorios.index') }}" class="btn btn-light btncancelarZarpes">Cancelar</a>
    </div>
</div>
