function getmatricula(data1) {
    $.ajax({
        url: route('validationStepTwo'),
        data: {matricula: data1}

    })// This will be called on success
        .done(function (response) {
            divError = document.getElementById("errorMat");
                table = document.getElementById("table-buque");
              //  alert(response);

            if(response=='permisoPorCerrar'){
               // alert('permiso por cerrar');
                divError.innerHTML='<div class="alert alert-danger">La embarcación de matrícula <b>'+data1+'</b> posee un permiso de zarpe que no ha sido cerrado, debe cerrar cualquier permiso de zarpe solicitado previamente para poder realizar uno nuevo.</div>';
                table.style.display='none';

            }else if(response=='sinCoincidencias'){
                divError.innerHTML='<div class="alert alert-danger">Su usuario no puede realizar solicitudes a nombre del Buque Matricula <b>'+data1+' </b> </div>';
                table.style.display='none';

            }else {
                divError.innerHTML='';
                table.style.display='block';

                respuesta = JSON.parse(response);
                matricula=(respuesta[0].matricula_actual);
                $("#matricula").val(matricula);
                nombrebuque=(respuesta[0].nombrebuque_actual);
                $("#nombre").val(nombrebuque);
                destinacion=(respuesta[0].destinacion);
                $("#destinacion").val(destinacion);
                UAB=(respuesta[0].UAB);
                $("#UAB").val(UAB);
                ESLORA=(respuesta[0].eslora);
                $("#eslora").val(ESLORA);
                nombre_propietario=(respuesta[0].nombre_propietario);
                $("#nombre_propietario").val(nombre_propietario);
                numero_identificacion=(respuesta[0].numero_identificacion);
                $("#numero_identificacion").val(numero_identificacion);
                manga=(respuesta[0].manga);
                $("#manga").val(manga);

            }

           // alert(respuesta[0].manga);
        })

        // This will be called on error
        .fail(function (response) {
            console.log(response);
            alert('Error en la Matricula');
            table = document.getElementById("table-buque");
            table.style.display='none';
            document.getElementById("matricula").value = "";
            document.getElementById("nombre").value = "";
            document.getElementById("destinacion").value = "";
            document.getElementById("UAB").value = "";
        });

}
