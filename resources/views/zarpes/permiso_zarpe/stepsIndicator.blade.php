@push('scripts')
    <script src="{{asset('js/zarpe.js')}}"></script>
@endpush
<ul class="row px-3 mb-3" id="progressbar">
    <li class="col text-center p-2 mx-2 {{ $paso==1 ? 'active' : '' }}">Bandera</li>
    <li class="col text-center p-2 mx-2 {{ $paso==2 ? 'active' : '' }}">Matricula</li>
    <li class="col text-center p-2 mx-2 {{ $paso==3 ? 'active' : '' }}">Tipo de Zarpe</li>
    <li class="col text-center p-2 mx-2 {{ $paso==4 ? 'active' : '' }}">Ruta</li>
    <li class="col text-center p-2 mx-2 {{ $paso==5 ? 'active' : '' }}">Tripulacion</li>
    <li class="col text-center p-2 mx-2 {{ $paso==6 ? 'active' : '' }}">Pasajeros</li>
    <li class="col text-center p-2 mx-2 {{ $paso==7 ? 'active' : '' }}">Seguridad</li>
</ul>
