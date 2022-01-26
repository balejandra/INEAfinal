function showContent() {
    apellidos = document.getElementById("apellidosdiv");
    fecha=document.getElementById('fechanacimiento')
    check = document.getElementById("juridica");
    check1=document.getElementById('natural')
    if (check.checked) {
        apellidos.style.display='none';
        fecha.style.display='none';
        $("#nacimiento").remove();
        $("#apellidosdiv").remove();
        check1.checked=false;
        $("#tipo_documento").val("rif");
    }
    else {
        apellidos.style.display='block';
    }
}

function showContentNatural() {
    apellidos = document.getElementById("apellidosdiv");
    fecha=document.getElementById('fechanacimiento')
    check = document.getElementById("juridica");
    check1=document.getElementById('natural')
    if (check1.checked) {
       // apellidos.style.display='block';
        fecha.style.display='block';

        const birthday = document.querySelector("#fechanacimiento");
        birthday.innerHTML=" <div class=\"input-group mb-3\" id=\"nacimiento\">\n" +
            "                                        <div class=\"input-group-prepend\">\n" +
            "                                            <span class=\"input-group-text\"><i class=\"far fa-calendar-alt\"></i></span>\n" +
            "                                        </div>\n" +
            "                                        <input type=\"date\"\n" +
            "                                               class=\"form-control \"\n" +
            "                                               name=\"fecha_nacimiento\" value=\"{{ old('fecha_nacimiento') }}\" id=\"fecha_nacimiento\"\n" +
            "                                               placeholder=\"fecha_nacimiento\" required>\n" +
            "                                    </div>"

        check.checked=false;
        $("#tipo_documento").val( 'Tipo de Documento');

    }
    else {
        apellidos.style.display='none';
    }
}
