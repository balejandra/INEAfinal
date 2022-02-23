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
        <th class="bg-light">Created At</th>
        <td>{{ $tablaMando->created_at }}</td>
    </tr>
    </tbody>
</table>
<table class="table">
    <tbody>
    <thead>
    <th>Cargo</th>
    <th>Titulacion Minima</th>
    </thead>
    @forelse($tablaMando->cargotablamandos as $cargotablamando)
        <tr>
            <td>
                <span class="badge badge-info">{{$cargotablamando->cargo_desempena}} </span>
            <td>
                <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_minima}} </span>
            </td>
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
        </tr>
    @endforelse
</table>

