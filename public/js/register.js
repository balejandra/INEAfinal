function showContent() {
    apellidos = document.getElementById("apellidosdiv");
    fecha=document.getElementById('fechanacimiento')
        apellidos.style.display='none';
        fecha.style.display='none';
        $("#nacimiento").remove();
        $("#apellidosdivint").remove();
        $("#tipo_identificacion").val("rif");
}

function showContentNatural() {
    fecha=document.getElementById('fechanacimiento')
        fecha.style.display='block';

        const birthday = document.querySelector("#fechanacimiento");
        birthday.innerHTML=" <div class=\"input-group mb-3\" id=\"nacimiento\">\n" +
            "                                        <div class=\"input-group-prepend\">\n" +
            "                                            <span class=\"input-group-text\"><i class=\"far fa-calendar-alt\"></i></span>\n" +
            "                                        </div>\n" +
            "                                        <input type=\"date\"\n" +
            "                                               class=\"form-control \"\n" +
            "                                               name=\"fecha_nacimiento\"  id=\"fecha_nacimiento\"\n" +
            "                                               placeholder=\"fecha_nacimiento\" required>\n" +
            "                                    </div>"
        const apellidos = document.querySelector("#apellidosdiv");
        apellidos.innerHTML="<div id=\"apellidosdivint\">\n" +
            "                                        <div class=\"input-group mb-3\">\n" +
            "                                            <div class=\"input-group-prepend\">\n" +
            "                                                <span class=\"input-group-text\"><i class=\"far fa-user\"></i></span>\n" +
            "                                            </div>\n" +
            "                                            <input type=\"text\"\n" +
            "                                                   class=\"form-control\"\n" +
            "                                                   name=\"apellidos\" id=\"apellidos\"\n" +
            "                                                   placeholder=\"Apellidos\" required>\n" +
            "                                        </div>"
        apellidos.style.display='block';
        $("#tipo_identificacion").val( 'Tipo de Documento');


}
