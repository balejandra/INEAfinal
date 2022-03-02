

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




//-----------------------------------------------------------------------------------------


function ochina(data1){
    if (data1>=40){
        const ochina = document.querySelector("#documentoOchina");
        ochina.innerHTML=" <div id=\"ochina\">" +
            "<label for=\"documento1\">Comprobante de pago a OCHINA:</label>\n" +
            "        <input type=\"file\" class=\"form-control\" name=\"foto_final2\" id=\"foto_final2\">" +
            " </div>"

    } else{
        $("#ochina").remove();
    }
}


$(document).ready(function() {
    const nacionalidad = document.querySelector("#nacionalidad");
    nacionalidad.innerHTML=" <select class=\"form-control\" name=\"nacionalidad_buque\" id=\"nacionalidad_buque\">\n" +
        "        <option value=\"\">Seleccione</option>\n" +
        "        <option value=\"10\">Argentina</option>\n" +
        "        <option value=\"20\">Afganistán</option>\n" +
        "        <option value=\"30\">Albania</option>\n" +
        "        <option value=\"40\">Alemania</option>\n" +
        "        <option value=\"50\">Andorra</option>\n" +
        "        <option value=\"60\">Angola</option>\n" +
        "        <option value=\"70\">Anguilla</option>\n" +
        "        <option value=\"80\">Antártida Argentina</option>\n" +
        "        <option value=\"90\">Antigua y Barbuda</option>\n" +
        "        <option value=\"100\">Antillas Holandesas</option>\n" +
        "        <option value=\"110\">Arabia Saudita</option>\n" +
        "        <option value=\"120\">Argelia</option>\n" +
        "        <option value=\"130\">Armenia</option>\n" +
        "        <option value=\"140\">Aruba</option>\n" +
        "        <option value=\"150\">Australia</option>\n" +
        "        <option value=\"160\">Austria</option>\n" +
        "        <option value=\"170\">Azerbaiján</option>\n" +
        "        <option value=\"180\">Bahamas</option>\n" +
        "        <option value=\"190\">Bahrain</option>\n" +
        "        <option value=\"200\">Bangladesh</option>\n" +
        "        <option value=\"210\">Barbados</option>\n" +
        "        <option value=\"220\">Bélgica</option>\n" +
        "        <option value=\"230\">Belice</option>\n" +
        "        <option value=\"240\">Benin</option>\n" +
        "        <option value=\"250\">Bhutan</option>\n" +
        "        <option value=\"260\">Bielorusia</option>\n" +
        "        <option value=\"bolivia\">Bolivia</option>\n" +
        "        <option value=\"280\">Bosnia Herzegovina</option>\n" +
        "        <option value=\"290\">Botswana</option>\n" +
        "        <option value=\"brasil\">Brasil</option>\n" +
        "        <option value=\"310\">Brunei</option>\n" +
        "        <option value=\"320\">Bulgaria</option>\n" +
        "        <option value=\"330\">Burkina Faso</option>\n" +
        "        <option value=\"340\">Burundi</option>\n" +
        "        <option value=\"350\">Cabo Verde</option>\n" +
        "        <option value=\"360\">Camboya</option>\n" +
        "        <option value=\"370\">Camerún</option>\n" +
        "        <option value=\"380\">Canadá</option>\n" +
        "        <option value=\"390\">Chad</option>\n" +
        "        <option value=\"chile\">Chile</option>\n" +
        "        <option value=\"410\">China</option>\n" +
        "        <option value=\"420\">Chipre</option>\n" +
        "        <option value=\"430\">Colombia</option>\n" +
        "        <option value=\"440\">Comoros</option>\n" +
        "        <option value=\"450\">Congo</option>\n" +
        "        <option value=\"460\">Corea del Norte</option>\n" +
        "        <option value=\"470\">Corea del Sur</option>\n" +
        "        <option value=\"480\">Costa de Marfil</option>\n" +
        "        <option value=\"490\">Costa Rica</option>\n" +
        "        <option value=\"500\">Croacia</option>\n" +
        "        <option value=\"510\">Cuba</option>\n" +
        "        <option value=\"520\">Darussalam</option>\n" +
        "        <option value=\"530\">Dinamarca</option>\n" +
        "        <option value=\"540\">Djibouti</option>\n" +
        "        <option value=\"550\">Dominica</option>\n" +
        "        <option value=\"560\">Ecuador</option>\n" +
        "        <option value=\"570\">Egipto</option>\n" +
        "        <option value=\"580\">El Salvador</option>\n" +
        "        <option value=\"590\">Em. Arabes Un.</option>\n" +
        "        <option value=\"600\">Eritrea</option>\n" +
        "        <option value=\"610\">Eslovaquia</option>\n" +
        "        <option value=\"620\">Eslovenia</option>\n" +
        "        <option value=\"espana\">España</option>\n" +
        "        <option value=\"640\">Estados Unidos</option>\n" +
        "        <option value=\"650\">Estonia</option>\n" +
        "        <option value=\"660\">Etiopía</option>\n" +
        "        <option value=\"670\">Fiji</option>\n" +
        "        <option value=\"680\">Filipinas</option>\n" +
        "        <option value=\"690\">Finlandia</option>\n" +
        "        <option value=\"700\">Francia</option>\n" +
        "        <option value=\"710\">Gabón</option>\n" +
        "        <option value=\"720\">Gambia</option>\n" +
        "        <option value=\"730\">Georgia</option>\n" +
        "        <option value=\"740\">Ghana</option>\n" +
        "        <option value=\"750\">Gibraltar</option>\n" +
        "        <option value=\"760\">Grecia</option>\n" +
        "        <option value=\"770\">Grenada</option>\n" +
        "        <option value=\"780\">Groenlandia</option>\n" +
        "        <option value=\"790\">Guadalupe</option>\n" +
        "        <option value=\"800\">Guam</option>\n" +
        "        <option value=\"810\">Guatemala</option>\n" +
        "        <option value=\"820\">Guayana Francesa</option>\n" +
        "        <option value=\"830\">Guinea</option>\n" +
        "        <option value=\"840\">Guinea Ecuatorial</option>\n" +
        "        <option value=\"850\">Guinea-Bissau</option>\n" +
        "        <option value=\"860\">Guyana</option>\n" +
        "        <option value=\"870\">Haití</option>\n" +
        "        <option value=\"880\">Holanda</option>\n" +
        "        <option value=\"890\">Honduras</option>\n" +
        "        <option value=\"900\">Hong Kong</option>\n" +
        "        <option value=\"910\">Hungría</option>\n" +
        "        <option value=\"920\">India</option>\n" +
        "        <option value=\"930\">Indonesia</option>\n" +
        "        <option value=\"940\">Irak</option>\n" +
        "        <option value=\"950\">Irán</option>\n" +
        "        <option value=\"960\">Irlanda</option>\n" +
        "        <option value=\"970\">Islandia</option>\n" +
        "        <option value=\"980\">Islas Cayman</option>\n" +
        "        <option value=\"990\">Islas Cook</option>\n" +
        "        <option value=\"1000\">Islas Faroe</option>\n" +
        "        <option value=\"1010\">Islas Marianas del Norte</option>\n" +
        "        <option value=\"1020\">Islas Marshall</option>\n" +
        "        <option value=\"1030\">Islas Solomon</option>\n" +
        "        <option value=\"1040\">Islas Turcas y Caicos</option>\n" +
        "        <option value=\"1050\">Islas Vírgenes</option>\n" +
        "        <option value=\"1060\">Islas Wallis y Futuna</option>\n" +
        "        <option value=\"1070\">Israel</option>\n" +
        "        <option value=\"1080\">Italia</option>\n" +
        "        <option value=\"1090\">Jamaica</option>\n" +
        "        <option value=\"1100\">Japón</option>\n" +
        "        <option value=\"1110\">Jordania</option>\n" +
        "        <option value=\"1120\">Kazajstán</option>\n" +
        "        <option value=\"1130\">Kenya</option>\n" +
        "        <option value=\"1140\">Kirguistán</option>\n" +
        "        <option value=\"1150\">Kiribati</option>\n" +
        "        <option value=\"1160\">Kuwait</option>\n" +
        "        <option value=\"1170\">Laos</option>\n" +
        "        <option value=\"1180\">Lesotho</option>\n" +
        "        <option value=\"1190\">Letonia</option>\n" +
        "        <option value=\"1200\">Líbano</option>\n" +
        "        <option value=\"1210\">Liberia</option>\n" +
        "        <option value=\"1220\">Libia</option>\n" +
        "        <option value=\"1230\">Liechtenstein</option>\n" +
        "        <option value=\"1240\">Lituania</option>\n" +
        "        <option value=\"1250\">Luxemburgo</option>\n" +
        "        <option value=\"1260\">Macao</option>\n" +
        "        <option value=\"1270\">Macedonia</option>\n" +
        "        <option value=\"1280\">Madagascar</option>\n" +
        "        <option value=\"1290\">Malasia</option>\n" +
        "        <option value=\"1300\">Malawi</option>\n" +
        "        <option value=\"1310\">Mali</option>\n" +
        "        <option value=\"1320\">Malta</option>\n" +
        "        <option value=\"1330\">Marruecos</option>\n" +
        "        <option value=\"1340\">Martinica</option>\n" +
        "        <option value=\"1350\">Mauricio</option>\n" +
        "        <option value=\"1360\">Mauritania</option>\n" +
        "        <option value=\"1370\">Mayotte</option>\n" +
        "        <option value=\"1380\">México</option>\n" +
        "        <option value=\"1390\">Micronesia</option>\n" +
        "        <option value=\"1400\">Moldova</option>\n" +
        "        <option value=\"1410\">Mónaco</option>\n" +
        "        <option value=\"1420\">Mongolia</option>\n" +
        "        <option value=\"1430\">Montserrat</option>\n" +
        "        <option value=\"1440\">Mozambique</option>\n" +
        "        <option value=\"1450\">Myanmar</option>\n" +
        "        <option value=\"1460\">Namibia</option>\n" +
        "        <option value=\"1470\">Nauru</option>\n" +
        "        <option value=\"1480\">Nepal</option>\n" +
        "        <option value=\"1490\">Nicaragua</option>\n" +
        "        <option value=\"1500\">Níger</option>\n" +
        "        <option value=\"1510\">Nigeria</option>\n" +
        "        <option value=\"1520\">Noruega</option>\n" +
        "        <option value=\"1530\">Nueva Caledonia</option>\n" +
        "        <option value=\"1540\">Nueva Zelandia</option>\n" +
        "        <option value=\"1550\">Omán</option>\n" +
        "        <option value=\"1570\">Pakistán</option>\n" +
        "        <option value=\"1580\">Panamá</option>\n" +
        "        <option value=\"1590\">Papua Nueva Guinea</option>\n" +
        "        <option value=\"paraguay\">Paraguay</option>\n" +
        "        <option value=\"1610\">Perú</option>\n" +
        "        <option value=\"1620\">Pitcairn</option>\n" +
        "        <option value=\"1630\">Polinesia Francesa</option>\n" +
        "        <option value=\"1640\">Polonia</option>\n" +
        "        <option value=\"1650\">Portugal</option>\n" +
        "        <option value=\"1660\">Puerto Rico</option>\n" +
        "        <option value=\"1670\">Qatar</option>\n" +
        "        <option value=\"1680\">RD Congo</option>\n" +
        "        <option value=\"1690\">Reino Unido</option>\n" +
        "        <option value=\"1700\">República Centroafricana</option>\n" +
        "        <option value=\"1710\">República Checa</option>\n" +
        "        <option value=\"1720\">República Dominicana</option>\n" +
        "        <option value=\"1730\">Reunión</option>\n" +
        "        <option value=\"1740\">Rumania</option>\n" +
        "        <option value=\"1750\">Rusia</option>\n" +
        "        <option value=\"1760\">Rwanda</option>\n" +
        "        <option value=\"1770\">Sahara Occidental</option>\n" +
        "        <option value=\"1780\">Saint Pierre y Miquelon</option>\n" +
        "        <option value=\"1790\">Samoa</option>\n" +
        "        <option value=\"1800\">Samoa Americana</option>\n" +
        "        <option value=\"1810\">San Cristóbal y Nevis</option>\n" +
        "        <option value=\"1820\">San Marino</option>\n" +
        "        <option value=\"1830\">Santa Elena</option>\n" +
        "        <option value=\"1840\">Santa Lucía</option>\n" +
        "        <option value=\"1850\">Sao Tomé y Príncipe</option>\n" +
        "        <option value=\"1860\">Senegal</option>\n" +
        "        <option value=\"1870\">Serbia y Montenegro</option>\n" +
        "        <option value=\"1880\">Seychelles</option>\n" +
        "        <option value=\"1890\">Sierra Leona</option>\n" +
        "        <option value=\"1900\">Singapur</option>\n" +
        "        <option value=\"1910\">Siria</option>\n" +
        "        <option value=\"1920\">Somalia</option>\n" +
        "        <option value=\"1930\">Sri Lanka</option>\n" +
        "        <option value=\"1940\">Sudáfrica</option>\n" +
        "        <option value=\"1950\">Sudán</option>\n" +
        "        <option value=\"1960\">Suecia</option>\n" +
        "        <option value=\"1970\">Suiza</option>\n" +
        "        <option value=\"1980\">Suriname</option>\n" +
        "        <option value=\"1990\">Swazilandia</option>\n" +
        "        <option value=\"2000\">Taiwán</option>\n" +
        "        <option value=\"uruguay\">Uruguay</option>\n" +
        "    </select>"

});






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
                    pass.innerHTML+=html;
                    addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val());
                }else{
                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                }
            }
        }else{

            if( $('#nombres').val()=="" ||  $('#apellidos').val()==""){

                msj.innerHTML='<div class="alert alert-danger">111Los campos nombres y apellidos son requeridos</div>' ;
            }else{
                if ($('#menor').prop('checked')) {
                    //si es venezolano menor de edad
                    if(tipodoc=="NC"){ //si es no cedulado
                        let  pasajeroExiste=document.getElementById('pass'+cedula);
                        if(pasajeroExiste==null){
                            var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";
                            pass.innerHTML+=html;
                            addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val());
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
                                        addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val());

                                    pass.innerHTML+=html;

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


function addPassengers(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos){
    console.log(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos);

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
                            default:
                            console.log(respuesta);
                            break;
                        }
                     
                    }else{
                        let  marinoExiste=document.getElementById('trip'+respuesta[0].ci);
                         
                        if(marinoExiste==null){ 
                           
                                
                            
                            let fecha=respuesta[0].fecha_vencimiento.substr(0, 10);
                            //let vt=validarTripulante(respuesta[0].documento, cap);
                            if(validacion[0]){
                                validarCapitan("");
                                console.log(respuesta);
                                var html="<tr id='trip"+respuesta[0].ci+"'> <td>"+cap+"</td><td>"+respuesta[0].ci+"</td> <td>"+respuesta[0].nombre+" "+respuesta[0].apellido+"</td>   <td>"+fecha+"</td> <td>"+respuesta[0].documento+"</td> </tr>";
                                cantAct=parseInt(document.getElementById("dataMarinos").getAttribute("data-cantMar"));
                                if(cantAct==0){
                                    tabla.innerHTML="";
                                } 
                                tabla.innerHTML+=html;
                                document.getElementById('cedula').value="";
                                document.getElementById('fecha_nacimiento').value="";
                                addMarino(respuesta[0].id, cap, respuesta[0].ci,respuesta[0].nombre+" "+respuesta[0].apellido, fecha, respuesta[0].documento);

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
            
            alert(response);
        })

        // This will be called on error
        .fail(function (response) {
             
            alert('fallo');
        });

}



function addMarino(ids, cap, ci, nombreape, fechav, doc){
   
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

    

     idmar.type="hidden";
     capitan.type="hidden";
     cedula.type="hidden";
     nombre.type="hidden";
     fechaVence.type="hidden";
     documento.type="hidden";
      

     idmar.name="ids[]";
     capitan.name="capitan[]";
     cedula.name="cedula[]";
     nombre.name="nombre[]";
     fechaVence.name="fechaVence[]";
     documento.name="documento[]";


     idmar.value=ids;
     capitan.value=cap;
     cedula.value=ci;
     nombre.value=nombreape;
     fechaVence.value=fechav;
     documento.value=doc;

     
     contenedor.appendChild(idmar);
     contenedor.appendChild(capitan);
     contenedor.appendChild(cedula);
     contenedor.appendChild(nombre);
     contenedor.appendChild(fechaVence);
     contenedor.appendChild(documento);


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
         
 
 


//*FIN DE VALIDACIONES DE PASO 4 MAPA*//

//FIN DE VALIDACION DE PERMISOS DE ZARPES
