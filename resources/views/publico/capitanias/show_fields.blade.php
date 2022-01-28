
<table class="table table-bordered">
    <tbody>
        <tr>
            <th class="bg-light">Nombre</th>
            <td>{{ $capitania->nombre }}</td>
        </tr>
        <tr>
            <th class="bg-light">Siglas</th>
            <td>{{ $capitania->sigla }}</td>
        </tr>
       
         

    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="bg-light text-center">Coordenadas</th>
        </tr>
        <tr class="bg-light">
            <th>Latitud</th>
            <th>Longitud</th>
        </tr>
    </thead>
    <tbody>
        @forelse($coords as $coord)
        <tr>
            <td>{{ $coord->latitud }}</td>
            <td>{{ $coord->longitud }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">Sin coordenadas asignadas</td>
        </tr>
        @endforelse
    </tbody>
</table>


