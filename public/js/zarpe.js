function getmatricula(data1) {
    $.ajax({
        url: route('validationStepTwo'),
        data: {matricula: data1}

    })// This will be called on success
        .done(function (response) {
              alert(response);
            table = document.getElementById("table-buque");
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
            //alert(response);
        })

        // This will be called on error
        .fail(function (response) {
            alert('Error en la Matricula');
            table = document.getElementById("table-buque");
            table.style.display='none';
            document.getElementById("matricula").value = "";
            document.getElementById("nombre").value = "";
            document.getElementById("destinacion").value = "";
            document.getElementById("UAB").value = "";
        });

}
