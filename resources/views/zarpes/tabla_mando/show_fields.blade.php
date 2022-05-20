<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">Uab Minimo</th>
        <td>{{ $tablaMando->UAB_minimo }}</td>
    </tr>
    <tr>
        <th class="bg-light">Uab Maximo</th>
        <td>{{ $tablaMando->UAB_maximo }}</td>
    </tr>
    <tr>
        <th class="bg-light" style="width:25%">Cant Tripulantes</th>
        <td>{{ $tablaMando->cant_tripulantes }}</td>
    </tr>

    <tr>
        <th class="bg-light">Creado</th>
        <td>{{ $tablaMando->created_at }}</td>
    </tr>
    </tbody>
</table>
<table class="table">

    <thead>
    <th>Cargo</th>
    <th>Titulacion Minima</th>
    <th>Titulacion Máxima</th>
    </thead>
    <tbody>
    @forelse($tablaMando->cargotablamandos as $cargotablamando)

        <tr>
            <td>
                <span class="badge badge-info">{{$cargotablamando->cargo_desempena}} </span>
            <td>
                <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_minima}} </span>
            </td>
            <td>
                <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_maxima}} </span>
            </td>
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
        </tr>

    @endforelse
    </tbody>
</table>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <a href="{{route('tablaMandos.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
</div>
