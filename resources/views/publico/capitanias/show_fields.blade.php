 
<table class="table table-bordered">
    <tbody>
        <tr>
            <th width="30%" class="bg-light">Nombre</th>
            <td> {{$capitania->nombre}} </td>
        </tr>
        <tr>
            <th class="bg-light">Siglas</th>
            <td> {{$capitania->sigla}}</td>
        </tr>
        <tr>
            <th class="bg-light">Capitan asignado</th>
            <td> 
                
                @if(count($capitan)>0)
                       {{$capitan[0]->nombres}} {{$capitan[0]->apellidos}}

                 @endif

                </td>
        </tr>
        <tr>
            <th class="bg-light">Correo Capitan asignado</th>
            <td> 
                @if(count($capitan)>0)
                    {{$capitan[0]->email}}
                 @endif
                  </td>
        </tr>
         
    </tbody>
</table>

<div class="row d-flex justify-content-center">
<div class="text-center col-md-12" >
<table   id='coordenadas-table' class="table table-bordered">
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

</div>


</div>

