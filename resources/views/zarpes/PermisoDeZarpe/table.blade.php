<div class="table-responsive-sm mt-5">
    <table class="table table-striped table-bordered" id="generic-table">
        <thead>
        <tr>
            <th>MATRÍCULA</th>
            <th>NOMBRE</th>
            <th>DESTINACIÓN DEL BUQUE</th>
            <th>PROPIETARIO</th>
            <th>STATUS</th>
            <th>ACCIONES</th>

        </tr>
        </thead>
        <tbody id="permisosZarpes">
            @if(Auth::user()->tipo_usuario!="Usuario web")
            <tr>
                <td>
                    ADKN-SE-0001
                </td>
                <td>
                    MEREGOTE
                </td>
                <td>
                    SERVICIO
                </td>
                <td>
                    INEA
                </td>
                <td id="z1" class="text-warning">
                    PENDIENTE
                </td>
                <td id="b1">
                    <a href="#" class="btn btn-info btn-sm" title="Consultar" onclick="acciones('consultar',1)">
                        <i class="fa fa-search" ></i>
                    </a>
                    @if(Auth::user()->tipo_usuario!="Usuario web")
                    <a href="#" class="btn btn-success btn-sm" title="Aprobar" onclick="acciones('aprobar',1)">
                        <i class="fa fa-check" ></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" title="Rechazar" onclick="acciones('rechazar',1)">
                        <i class="fa fa-ban"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endif
             <tr>
                <td>
                   ADKN-D-11137
                </td>
                <td>
                    CLARISSA
                </td>
                <td>
                    RECREO
                </td>
                <td>
                    Jhony Jesus Galvan Garcia
                </td>
                <td id="z2" class="text-success">
                    AUTORIZADO
                </td>
                <td id="b2">
                    <a href="#" class="btn btn-info btn-sm" title="Consultar" onclick="acciones('consultar',2)">
                        <i class="fa fa-search" ></i>
                    </a>
                     
                    </a>
                </td>
            </tr>
            @if(Auth::user()->tipo_usuario!="Usuario web")
             <tr>
                <td>
                    ADKN-3833
                </td>
                <td>
                    PETRA VIII
                </td>
                <td>
                    SERVICIO
                </td>
                <td>
                    SERVI LANCHAS, C.A
                </td>
                <td id="z3" class="text-warning">
                    PENDIENTE
                </td>
                <td id="b3">
                    <a href="#" class="btn btn-info btn-sm" title="Consultar" onclick="acciones('consultar',3)">
                        <i class="fa fa-search" ></i>
                    </a>
                    @if(Auth::user()->tipo_usuario!="Usuario web")
                    <a href="#" class="btn btn-success btn-sm" title="Aprobar" onclick="acciones('aprobar',3)"> 
                        <i class="fa fa-check" ></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm" title="Rechazar">
                        <i class="fa fa-ban" onclick="acciones('rechazar',3)"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @endif
             <tr>
                <td>
                    ADKN-D-9323
                </td>
                <td>
                    ER TOY
                </td>
                <td>
                    RECREO
                </td>
                <td>
                    TERRA SPORT, C.A.
                </td>
                <td id="z4" class="text-success">
                    AUTORIZADO
                </td>
                <td id="b4">
                    <a href="#" class="btn btn-info btn-sm" title="Consultar" onclick="acciones('consultar',4)">
                        <i class="fa fa-search" ></i>
                    </a>
                     
                </td>
            </tr>
        </tbody>
    </table>
</div>
