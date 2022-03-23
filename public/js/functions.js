function inputcant() {
    if($("#cantidad").is(':checked')){
        $("#cantidad").attr('value', 'true');
    }else{
        $("#cantidad").attr('value', 'false');
    }
}

//-------------------Tooltips----------------------------
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

function motivoRechazo() {
    $motivo = $("#motivo1 option:selected").text();
    if ($motivo == 'Observaciones en los documentos') {
        table = document.getElementById("inputmotivo");
        table.style.display = 'block';
        $("#motivo1").attr("name","motivofalso");
        $("#motivo2").attr("name","motivo");
        document.querySelector('#motivo2').required = true;

    }else{
        table = document.getElementById("inputmotivo");
        table.style.display = 'none';
        $("#motivo1").attr("name","motivo");
        $("#motivo2").attr("name","motivofalso");
        document.querySelector('#motivo2').required = false;
    }
}
//-------------------Datatables----------------------------


$(document).ready(function() {
    $('#TableRoles').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#permisoZarpes-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#TablePermissions').DataTable({
        responsive: true,
        fixedHeader: true,
        ordering: false,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],

    });

    $('#permisoZarpesdestino-table').DataTable({
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#TableMenus').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#dependenciaFederals-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );




$(document).ready(function() {
    $('#users-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#capitanias-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );

$(document).ready(function() {
    $('#auditables-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );


$(document).ready(function() {
    $('#menusroles-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $('#permisoEstadias-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );


$(document).ready(function() {
    $('#generic-table').DataTable({
        responsive: true,
        fixedHeader: true,
        language: {
            "url": "../assets/DataTables/es_es.json"
        },
        dom: 'Blfrtp',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
} );


//-------------------------------------------------------------------------------

function agregarCoordenadas(){

var coords=document.getElementById('coords');
let cantAct=coords.getAttribute('data-cant');
cantAct<=0 ? cantAct=1 : cantAct++;


const divrow= document.createElement("div");
divrow.classList.add("row");
divrow.id="coordenadas"+cantAct;

const divids=document.createElement("div");
divids.innerHTML=`<input class="form-control" name="ids[]" type="hidden" >`;

const divlat=document.createElement("div");
divlat.classList.add("form-group", "col-sm-5");
divlat.innerHTML=`
            <input class="form-control" name="latitud[]" id="lat`+cantAct+`" type="text">`;


const divlon=document.createElement("div");
divlon.classList.add("form-group", "col-sm-5");
divlon.innerHTML=`
            <input class="form-control" name="longitud[]" id="lon`+cantAct+`"  type="text">`;

const divbtn=document.createElement("div");
divbtn.classList.add("form-group", "col-sm-2");
divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarCoordenadas(`+cantAct+`,'')" type="button">borrar</button>`;

divrow.appendChild(divids);
divrow.appendChild(divlat);
divrow.appendChild(divlon);
divrow.appendChild(divbtn);

coords.appendChild(divrow);

coords.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;

}

function eliminarCoordenadas(id, idcoord){

    if(id!=""){
        const div = document.querySelector("#coordenadas"+id);
        div.remove();
    }
    if(idcoord!=""){
       const del = document.querySelector("#deletes"+id);
        del.value=idcoord;
    }

}



//-------------------------------------------------------------------------------

function agregarCoordenadasDF(){

var coords=document.getElementById('coords');
let cantAct=coords.getAttribute('data-cant');
cantAct<=0 ? cantAct=1 : cantAct++;


const divrow= document.createElement("div");
divrow.classList.add("row");
divrow.id="coordenadas"+cantAct;

const divids=document.createElement("div");
divids.innerHTML=`<input class="form-control" name="ids[]" type="hidden" >`;

const divlat=document.createElement("div");
divlat.classList.add("form-group", "col-sm-5");
divlat.innerHTML=`
            <input class="form-control" name="latitud[]" id="lat`+cantAct+`" type="text">`;


const divlon=document.createElement("div");
divlon.classList.add("form-group", "col-sm-5");
divlon.innerHTML=`
            <input class="form-control" name="longitud[]" id="lon`+cantAct+`"  type="text">`;

const divbtn=document.createElement("div");
divbtn.classList.add("form-group", "col-sm-2");
divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarCoordenadas(`+cantAct+`,'')" type="button">borrar</button>`;

divrow.appendChild(divids);
divrow.appendChild(divlat);
divrow.appendChild(divlon);
divrow.appendChild(divbtn);

coords.appendChild(divrow);

coords.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;

}

function eliminarCoordenadasDF(id, idcoord){

    if(id!=""){
        const div = document.querySelector("#coordenadas"+id);
        div.remove();
    }
    if(idcoord!=""){
       const del = document.querySelector("#deletes"+id);
        del.value=idcoord;
    }

}

//-----------------------------------------------------------------------------------------


//INICIO VALIDACIONES DE PERMISOS DE ZARPES


 function getData() {
    let cedula= document.getElementById('numero_identificacion').value;
    let fechanac= document.getElementById('fecha_nacimiento').value;
    let sexo= document.getElementById('sexo').value;
    let tipodoc= document.getElementById('tipodoc').value;
    let menor= document.getElementById('menor').value;
    let men='';
    var msj= document.getElementById('msj');
    var pass=document.getElementById('pasajeros');



    var div=document.getElementById("dataPassengers");
    cantAct=parseInt(div.getAttribute("data-cant"));

    if(cantAct==0){
        pass.innerHTML="";
    }

    if ($("#menor").is(':checked')) {men="SI";}else{men="NO";}

    if (cedula!="" && fechanac!="" && sexo!="" && tipodoc!="") {

        if(tipodoc=="P"){

            if( $('#nombres').val()=="" ||  $('#apellidos').val()==""){
                //si no han llenado los nombres y apellidos
                msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
            }else{
                //si llenaron los nombres y apellidos
                let  pasajeroExiste=document.getElementById('pass'+cedula);
                if(pasajeroExiste==null){
                    var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                    addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(), html);
                }else{
                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                }
            }
        }else{

            if( tipodoc=="NC" && ($('#nombres').val()=="" ||  $('#apellidos').val()=="") ){

                msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
            }else{
                if ($('#menor').prop('checked')) {
                    //si es venezolano menor de edad
                    if(tipodoc=="NC"){ //si es no cedulado
                        let  pasajeroExiste=document.getElementById('pass'+cedula);
                        if(pasajeroExiste==null){
                            var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                            msj.innerHTML="";
                            addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html);
                            document.querySelector("#nc").remove();
                        }else{
                            msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                        }

                    }else{//si es menor con cedula
                        $.ajax({
                            url: route('consultasaime2'),
                            data: {cedula: cedula, fecha:fechanac, sexo:sexo }

                        })// This will be called on success
                        .done(function (response) {

                            var respuesta = JSON.parse(response);
                            let tamano = respuesta.length;
                            if (tamano == 0) {
                                console.log(respuesta);
                            } else {
                                respuesta=respuesta[0];
                                let sex='';
                                respuesta.sexo=='F'? sex="Femenino":sex="Masculino";
                               let  pasajeroExiste=document.getElementById('pass'+respuesta.cedula);

                                if(pasajeroExiste==null){
                                    let nombres, apellidos;
                                    if (respuesta.nombre2==null) {nombres=respuesta.nombre1; }else{ nombres=respuesta.nombre1+" "+respuesta.nombre2;}
                                    if (respuesta.apellido2==null){apellidos=respuesta.apellido1; }else {apellidos=respuesta.apellido1+" "+respuesta.apellido2;}
                                    $('#nombres').val(nombres);
                                    $('#apellidos').val(apellidos);

                                    var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";
                                        addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html);


                                    msj.innerHTML="";
                                }else{
                                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                                }


                            }
                            //alert(response);
                        })
                        .fail(function (response) {
                            msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

                        });

                    }
                }else{

                    //si es venezolano mayor de edad
                    $.ajax({
                        url: route('consultasaime2'),
                        data: {cedula: cedula, fecha:fechanac, sexo:sexo }

                    })// This will be called on success
                    .done(function (response) {

                        var respuesta = JSON.parse(response);
                        let tamano = respuesta.length;
                        if (tamano == 0) {
                            console.log(respuesta);
                        } else {
                            respuesta=respuesta[0];
                            let sex='';
                            respuesta.sexo=='F'? sex="Femenino":sex="Masculino";
                           let  pasajeroExiste=document.getElementById('pass'+respuesta.cedula);

                            if(pasajeroExiste==null){
                                let nombres, apellidos;
                                if (respuesta.nombre2==null) {nombres=respuesta.nombre1; }else{ nombres=respuesta.nombre1+" "+respuesta.nombre2;}
                                if (respuesta.apellido2==null){apellidos=respuesta.apellido1; }else {apellidos=respuesta.apellido1+" "+respuesta.apellido2;}
                                $('#nombres').val(nombres);
                                $('#apellidos').val(apellidos);


                                    var html="<tr id='pass"+respuesta.cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+respuesta.cedula+"</td> <td>"+nombres+"</td> <td>"+apellidos+"</td> <td>"+sex+"</td>  <td>"+respuesta.fecha_nacimiento+"</td> <td>"+men+"</td> </tr>";

                                pass.innerHTML+=html;
                                addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val());

                            }else{
                                msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                            }


                        }
                        //alert(response);
                    })
                    .fail(function (response) {
                        msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

                    });


                }
            }

        }



    }else{

        msj.innerHTML='<div class="alert alert-danger">Existen campos vacios en el formulario, por favor verifique...</div>' ;
    }



}




$('#menor').click(function() {
    let option= document.createElement("option");

    if($("#menor").is(':checked')){
        $("#textoMenor").text('SI');  // checked
        $('.DatosRestantes').attr('style', 'display:block');

        let select=document.querySelector("#tipodoc");
        option.id="nc";
        option.value="NC";
        option.textContent="No cedulado";
        select.appendChild(option);

        str =$( "select option:selected" ).val();
        let date = new Date();
        let fechamin="";
        if( str=="NC"){
            $('#apellidos').val("");
            $('#nombres').val("");
            fechamin=date.getFullYear()-10;
            fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
            fechamin+="-"+String(date.getDate()).padStart(2, '0');
        }else{
            fechamin=date.getFullYear()-18;
            fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
            fechamin+="-"+String(date.getDate()).padStart(2, '0');
        }

        let fmax=date.getFullYear()+"-"+(String(date.getMonth() + 1).padStart(2, '0'))+"-"+String(date.getDate()).padStart(2, '0');

        $('#fecha_nacimiento').attr('min',fechamin );
        $('#fecha_nacimiento').attr('max',fmax );


    }
    else{
        $("#textoMenor").text('NO');
        $('.DatosRestantes').attr('style', 'display:none');
        document.querySelector("#nc").remove();
        let date = new Date();
        let fechamax="";
        fechamax=date.getFullYear()-18;
        fechamax+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
        fechamax+="-"+String(date.getDate()).padStart(2, '0');
        $('#fecha_nacimiento').attr('max',fechamax );
        $('#fecha_nacimiento').attr('min',"" );


    }


});




$( "#tipodoc" )
  .change(function () {
    var str = "";
    str =$( "select option:selected" ).val();

    if(str=="P"){
      $('.DatosRestantes').attr('style', 'display:block');
    }else{
        let date = new Date();
        let fechamin="";

        if((str=="V" || str=="NC") && $('#menor').prop('checked')){

            $('.DatosRestantes').attr('style', 'display:block');
            if( str=="NC"){
                fechamin=date.getFullYear()-10;
                fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
                fechamin+="-"+String(date.getDate()).padStart(2, '0');
            }else{
                fechamin=date.getFullYear()-18;
                fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
                fechamin+="-"+String(date.getDate()).padStart(2, '0');
            }

            $('#fecha_nacimiento').attr('min',fechamin );
            let fmax=date.getFullYear()+"-"+(String(date.getMonth() + 1).padStart(2, '0'))+"-"+String(date.getDate()).padStart(2, '0');
            $('#fecha_nacimiento').attr('max',fmax );
        }else{
            $('.DatosRestantes').attr('style', 'display:none');
            $('#fecha_nacimiento').attr('min',"" );

            let date = new Date();
            let fechamax="";
            fechamax=date.getFullYear()-18;
            fechamax+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
            fechamax+="-"+String(date.getDate()).padStart(2, '0');
            $('#fecha_nacimiento').attr('max',fechamax );


        }
    }

  })
  .change();


function addPassengers(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html){
    console.log(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos);

    var cantPass= document.getElementById("cantPasajeros");
    let cant=parseInt(cantPass.getAttribute("data-cantPass"));

    if(cant > 0){

        cant=cant-1;
        cantPass.innerHTML=cant;
        cantPass.setAttribute("data-cantPass", cant);


        var pass=document.getElementById('pasajeros');
            pass.innerHTML+=html;


        var div=document.getElementById("dataPassengers");
        cantAct=parseInt(div.getAttribute("data-cant"));
        let contenedor= document.createElement("div");
        contenedor.id="content"+cantAct;


        let inputMenor= document.createElement("input");
        let inputTipodoc= document.createElement("input");
        let inputNrodocc= document.createElement("input");
        let inputFechanac= document.createElement("input");
        let inputSexo= document.createElement("input");
        let inputNombres= document.createElement("input");
        let inputApellidos= document.createElement("input");

         inputMenor.type="hidden";
         inputTipodoc.type="hidden";
         inputNrodocc.type="hidden";
         inputFechanac.type="hidden";
         inputSexo.type="hidden";
         inputNombres.type="hidden";
         inputApellidos.type="hidden";

         inputMenor.name="menor[]";
         inputTipodoc.name="tipodoc[]";
         inputNrodocc.name="nrodoc[]";
         inputFechanac.name="fechanac[]";
         inputSexo.name="sexo[]";
         inputNombres.name="nombres[]";
         inputApellidos.name="apellidos[]";

         inputMenor.value=menor;
         inputTipodoc.value=tipodoc;
         inputNrodocc.value=nrodoc;
         inputFechanac.value=fechanac;
         inputSexo.value=sexo;
         inputNombres.value=nombres;
         inputApellidos.value=apellidos;

         contenedor.appendChild(inputMenor);
         contenedor.appendChild(inputTipodoc);
         contenedor.appendChild(inputNrodocc);
         contenedor.appendChild(inputFechanac);
         contenedor.appendChild(inputSexo);
         contenedor.appendChild(inputNombres);
         contenedor.appendChild(inputApellidos);



         div.appendChild(contenedor);

         div.setAttribute("data-cant",cantAct+1);
        console.log(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos);
        $("#menor").prop('checked', false);
        $("#textoMenor").text('NO');
        /*document.getElementById("numero_identificacion").value="";
        document.getElementById("tipodoc").options.item(0).selected = 'selected';
        document.getElementById("fecha_nacimiento").value="";
        document.getElementById("sexo").options.item(0).selected = 'selected';
        document.getElementById("nombres").value="";
        document.getElementById("apellidos").value="";*/

    }else{
        var msj= document.getElementById('msj');
        msj.innerHTML='<div class="alert alert-danger">Ha alcanzado la cantidad máxima de pasajeros para esta embarcación.</div>' ;
    }

}



/* inicio de validacion paso cinco marinos*/

function getMarinos() {
        let cedula= document.getElementById('cedula').value;
        let fechanac= document.getElementById('fecha_nacimiento').value;
        let msj=document.getElementById('msjMarino');
        msj.innerHTML="";

        let tabla=document.getElementById('marinos');
        let divMarinos=document.getElementById('dataMarinos');
        let cantMax=divMarinos.getAttribute('data-cantMaxima');
        let cantMar=divMarinos.getAttribute('data-cantMar');
        let cap="";
        if($("#cap").is(':checked')){
            cap="SI";
        }else{
            cap="NO";
        }

 if(cantMar >= cantMax){
    msj.innerHTML='<div class="alert alert-danger">ha alcanzado la cantidad máxima de tripulantes para esta embarcación</div>' ;

 }else{

    if(cedula=="" || fechanac==""){

    msj.innerHTML='<div class="alert alert-danger">El campo cédula y fecha de nacimiento son requeridos, por favor verifique</div>' ;

    }else{
            $.ajax({
                url: route('validarMarino'),
                data: {cedula: cedula, fecha:fechanac, cap:cap }

            })// This will be called on success
                .done(function (response) {
                    console.log(response);
                    resp = JSON.parse(response);
                    respuesta=resp[0];
                    validacion=resp[1];
                    let tamano = respuesta.length;
                    console.log(validacion);


                    if(typeof respuesta=='string'){
                         switch(respuesta){
                            case 'saimeNotFound':
                                msj.innerHTML='<div class="alert alert-danger">No se han encontrado coincidencias con los datos suministrados, por favor verifique</div>' ;

                            break;
                            case 'gmarNotFound':
                                msj.innerHTML='<div class="alert alert-danger">La cédula suministrada no pertenece a ningun marino, por favor verifique</div>' ;

                            break;
                            case 'FoundButDefeated':
                                msj.innerHTML='<div class="alert alert-danger">La vigencia de la licencia del tripulante C.I. '+cedula+' se encuentra vencida, por este motivo no puede tripular ninguna embarcación por el momento.</div>' ;
                            break;
                            case 'FoundButAssigned':
                                msj.innerHTML='<div class="alert alert-danger">El tripulante C.I. '+cedula+' se encuentra asignado a una embarcación que tiene un zarpe programado o en curso actualmente</div>' ;
                            break;

                            default:
                            console.log(respuesta);
                            break;
                        }

                    }else{
                        let  marinoExiste=document.getElementById('trip'+respuesta[0].ci);

                        if(marinoExiste==null){



                            let fecha=respuesta[0].fecha_vencimiento.substr(0, 10);
                            let fechaemision=respuesta[0].fecha_emision.substr(0, 10);
                            //let vt=validarTripulante(respuesta[0].documento, cap);
                            if(validacion[0]){
                                validarCapitan("");
                                console.log(respuesta);
                                var html="<tr id='trip"+respuesta[0].ci+"'> <td>"+cap+"</td><td>"+respuesta[0].ci+"</td> <td>"+respuesta[0].nombre+" "+respuesta[0].apellido+"</td>   <td>"+fechaemision+"</td> <td>"+respuesta[0].documento+"</td> </tr>";
                                cantAct=parseInt(document.getElementById("dataMarinos").getAttribute("data-cantMar"));
                                if(cantAct==0){
                                    tabla.innerHTML="";
                                }
                                tabla.innerHTML+=html;
                                document.getElementById('cedula').value="";
                                document.getElementById('fecha_nacimiento').value="";
                                addMarino(respuesta[0].id, cap, respuesta[0].ci,respuesta[0].nombre+" "+respuesta[0].apellido, fecha, respuesta[0].documento, fechaemision);

                            }else{


                                if($("#cap").is(':checked')){

                                    msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+respuesta[0].ci+' no esta permisado para ser capitán esta embarcación.</div>' ;
                                    validarCapitan('X');
                                }else{
                                    msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+respuesta[0].ci+' no esta permisado para tripular esta embarcación.</div>' ;

                                }

                            }

                        }else{
                            msj.innerHTML='<div class="alert alert-danger">El tripulante ya se encuentra asignado a la lista, por favor verifique</div>' ;

                        }

                    }
                })

                // This will be called on error
                .fail(function (response) {
                            msj.innerHTML='<div class="alert alert-danger">No se ha encontrado la cedula o la fecha de nacimiento</div>' ;
                            console.log(response);

                });
        }


 }




}

function validarCapitan(param){
    if(param==""){
        if($("#cap").is(':checked')){
            var cap="SI";
            $("#cap").prop("checked", false);
            $("#textoCap").text('NO');
        }else{
            var cap="NO";
        }
    }else{

        $("#cap").prop("checked", true);
        $("#textoCap").text('SI');
        var cap="SI";
    }

    return cap;
}





function validarTripulante(documento, capitan) {
    $.ajax({
        url: route('validacionJerarquizacion'),
        data: {doc: documento, cap:capitan }

    })// This will be called on success
        .done(function (response) {
          //  alert(response);
            respuesta = JSON.parse(response);

            //alert(response);
        })

        // This will be called on error
        .fail(function (response) {

            alert('fallo');
        });

}



function addMarino(ids, cap, ci, nombreape, fechav, doc,fechaemision){

    var div=document.getElementById("dataMarinos");
    cantAct=parseInt(div.getAttribute("data-cantMar"));
    let contenedor= document.createElement("div");
    contenedor.id="contentMar"+cantAct;


    let idmar= document.createElement("input");
    let capitan= document.createElement("input");
    let cedula= document.createElement("input");
    let nombre= document.createElement("input");
    let fechaVence= document.createElement("input");
    let documento= document.createElement("input");
    let fechaEmi= document.createElement("input");



     idmar.type="hidden";
     capitan.type="hidden";
     cedula.type="hidden";
     nombre.type="hidden";
     fechaVence.type="hidden";
     documento.type="hidden";
     fechaEmi.type="hidden";


     idmar.name="ids[]";
     capitan.name="capitan[]";
     cedula.name="cedula[]";
     nombre.name="nombre[]";
     fechaVence.name="fechaVence[]";
     documento.name="documento[]";
     fechaEmi.name="fechaEmision[]";


     idmar.value=ids;
     capitan.value=cap;
     cedula.value=ci;
     nombre.value=nombreape;
     fechaVence.value=fechav;
     documento.value=doc;
     fechaEmi.value=fechaemision;


     contenedor.appendChild(idmar);
     contenedor.appendChild(capitan);
     contenedor.appendChild(cedula);
     contenedor.appendChild(nombre);
     contenedor.appendChild(fechaVence);
     contenedor.appendChild(documento);
     contenedor.appendChild(fechaEmi);


     div.appendChild(contenedor);

     div.setAttribute("data-cantMar",cantAct+1);
    console.log(idmar, cap);

}


$('#cap').click(function() {


    if($("#cap").is(':checked')){
        $("#textoCap").text('SI');  // checked
    }
    else{
        $("#textoCap").text('NO');

    }


});


$('.equipo').click(function() {

    let id=$(this).val();

    if($("#equipo").is(':checked')){
        document.getElementById(id+"selected").value="true";
        let cantidad=$(this).attr("data-cant");
        let otros=$(this).attr("data-otrs");

        if(cantidad==true){
        document.getElementById(id+"cantidad").setAttribute("required",true);
        }
        if(otros!="ninguno"){
        document.getElementById(id+"valores_otros").setAttribute("required",true);

        }


    }
    else{
        document.getElementById(id+"selected").value="false";

        let cantidad=$(this).attr("data-cant");
        let otros=$(this).attr("data-otrs");


        if(cantidad==true){
        document.getElementById(id+"cantidad").removeAttribute("required");
        }

        if(otros!="ninguno"){
        document.getElementById(id+"valores_otros").removeAttribute("required");
        }
    }

});


/*FIN validacion paso cinco marinos*/


///**INICION DE VALIDACIONES DE PASO 4 MAPA*//
function compararFechas(){
    var salida =document.getElementById('salida').value;
    var regreso =document.getElementById('regreso');

    regreso.setAttribute("min",salida);
    var date1 = new Date(salida);
    var date2 = new Date(regreso.value);

    if(date1>date2){

        document.getElementById("msjRuta").innerHTML="<div class='alert alert-danger'>La fecha y hora de salida no pueden ser menores que la de regreso, por favor verifique.</div>"
        regreso.value="";
    }


}


function estNauticoDestinoSelect(idCapitania){


    $.ajax({
        url: route('BuscaEstablecimientosNauticos'),
        data: {idcap: idCapitania }

    })// This will be called on success
        .done(function (response) {
          //  alert(response);
            respuesta = JSON.parse(response);
            let estabecimientos=respuesta[1];
            document.getElementById('capiDestino').innerHTML=" <b>"+respuesta[0].nombre+" </b>";
            let select=document.getElementById("estNautioDestino");
            let options="<option value='0'>Seleccione</option>";
            for (var i = 0; i < estabecimientos.length; i++) {
                options+="<option value='"+estabecimientos[i].id+"'>"+estabecimientos[i].nombre+"</option>"
            }
            select.innerHTML=options;
           // console.log(options);
        })

        // This will be called on error
        .fail(function (response) {
           // respuesta = JSON.parse(response);
            console.log("fallo al buscar establecimientos nautico destino ");
        });
}


//*FIN DE VALIDACIONES DE PASO 4 MAPA*//

//FIN DE VALIDACION DE PERMISOS DE ZARPES

function getCapitania(){
  
    data=document.getElementById('descripcion_de_navegacion').value;
    
    $.ajax({
        url: route('FindCapitania'),
        data: {descripcion_de_navegacion: data}

    })// This will be called on success
    .done(function (response) {
        let resp=JSON.parse(response);
        let options="<option value='0'>Seleccione</option>";
        for (var i = 0; i < resp.length; i++) {
            options+="<option value='"+resp[i].id+"'>"+resp[i].nombre+"</option>"
        }
        select=document.getElementById('capitania');
        select.innerHTML=options;
       // console.log(options);
    })
        // This will be called on error
    .fail(function (response) {
            console.log(response);
             divError.innerHTML='<div class="alert alert-danger"> Ha ocurrido un error durante la búsqueda de la información.</div>';
            
    });
}