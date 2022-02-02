

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
} );


$(document).ready(function() {
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
divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarCoordenadas(`+cantAct+`)" type="button">borrar</button>`;

divrow.appendChild(divlat);
divrow.appendChild(divlon);
divrow.appendChild(divbtn);

coords.appendChild(divrow);

coords.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;

}

function eliminarCoordenadas(id){

    if(id!=""){
        const div = document.querySelector("#coordenadas"+id);
        div.remove();
    }


}



function bandera(){
    const div = document.querySelector("#bandera");
    

    var divdestino=document.querySelector("#form-nacional");
    var divdestino2=document.querySelector("#form-extrangera");

    if(div.value=="nacional"){
       divdestino2.setAttribute('style','display:none');
        divdestino.setAttribute('style','display:show');


    }else if(div.value=="extrangera"){
         divdestino2.setAttribute('style','display:show');
        divdestino.setAttribute('style','display:none');
    }else{

    }


}


function matricula(){
     const matriculas=['123','ADKN-SE-0001','ADKN-SE-0003','ADKN-RE-0002', 'ADKN-SE-0002'];
        txtmatricula=document.querySelector("#matricula");
        
        if(matriculas.includes(txtmatricula.value)){
           // alert(txtmatricula.value);
            licencia=document.querySelector("#table-licencia");
            licencia.setAttribute('style','display:show');

            tab=document.querySelector("#profile-tab");
            tab.setAttribute('class','nav-link');

           var btnsiguiente=document.querySelector("#table-licencia");


        }else{
            alert("Matricula no encontrada");
        }

}


function agregarPasajero(destino){
     
var pass=document.getElementById(destino);
let cantAct=pass.getAttribute('data-cant');
cantAct<=0 ? cantAct=1 : cantAct++;

const divdatos= document.createElement("div");
divdatos.classList.add("row");
divdatos.id=destino+"-datos"+cantAct;
const divname=document.createElement("div");
divname.classList.add("form-group", "col-sm-2" );
divname.innerHTML=`<label for="nombre" > Nombre</label>
            <input class="form-control" name="nombre[]" id="nombre`+cantAct+`" type="text" placeholder='Nombre'>`;

const divape=document.createElement("div");
divape.classList.add("form-group", "col-sm-2" );      
divape.innerHTML=`<label for="Apellido" > Apellido</label>
            <input class="form-control" name="apellido[]" id="apellido`+cantAct+`"  type="text" placeholder='Apellido'>`;


const divsexo=document.createElement("div");
divsexo.classList.add("form-group", "col-sm-1");      
divsexo.innerHTML=`<label for="sexo" > Sexo</label>
            <select class='form-control'>
                <option value='0'>Sexo</option>
                <option value='1'>Masculino</option>
                <option value='2'>Femenino</option>
            </select>`;

const divcedula=document.createElement("div");
divcedula.classList.add("form-group", "col-sm-2" );      
divcedula.innerHTML=`
            <label for="cedula" > Cedula</label>
            <input class="form-control" name="cedula[]" id="cedula`+cantAct+`"  type="text" placeholder='cedula / pasaporte'>`;


const divtipodoc=document.createElement("div");
divtipodoc.classList.add("form-group", "col-sm-1");      
divtipodoc.innerHTML=`<label for="Tipodoc" > Tipo </label>
            <select class='form-control'>
                <option value='0'>Seleccione</option>
                <option value='1'>V</option>
                <option value='2'>E</option>
            </select>`;


const divfechanac=document.createElement("div");
divfechanac.classList.add("form-group", "col-sm-2" );      
divfechanac.innerHTML=`<label for="fechanac" > Fecha de nacimiento</label>
            <input class="form-control" name="fechanac[]" id="fechanac`+cantAct+`"  type="date" placeholder='Fecha nacimiento'>`;




const divbtn=document.createElement("div");
divbtn.classList.add("form-group", "col-sm-2", "text-center","pt-3");
divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarTripulante(`+cantAct+`, '`+destino+`')" type="button">borrar</button>`;
 

divdatos.appendChild(divtipodoc);
divdatos.appendChild(divcedula); 
divdatos.appendChild(divname);
divdatos.appendChild(divape);
divdatos.appendChild(divsexo);
divdatos.appendChild(divfechanac);


divdatos.appendChild(divbtn);

pass.appendChild(divdatos);

pass.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;
 
}


function eliminarTripulante(id, destino){

    if(id!=""){
        const div = document.querySelector("#"+destino+"-datos"+id);
        div.remove();
    } 
    

}



function ValidarMarinos(){
    var marinos=['123456789','987654321','1357913579', '24682468'];

    txtresp=document.querySelector("#msjresmarinos");
         
txtresp.innerHTML=`<div class="alert alert-success">Marinos validados exitosamente, avance al paso siguiente.</div >`;

}

function next(){
    

    txtresp=document.querySelector("#msjpasajeros");
         
txtresp.innerHTML=`<div class="alert alert-success">Pasajeros validados exitosamente, avance al paso siguiente.</div >`;

}


function licencia(){
    var licencias=['729','ADKN-SE-0002','ADKN-SE-0002 ', '24682468'];
    txtlicencias=document.querySelector("#txtlicencias");

    if(licencias.includes(txtlicencias.value)){
        txtresp=document.querySelector("#msjlic");
        txtresp.innerHTML=`<div class="alert alert-success">Licencia encontrada</div >`;

        tableLicencias=document.querySelector("#tableLicencias");
        tableLicencias.setAttribute('style','display:show');

    }else{  
        alert("Licencia no encontrada");
    }
    
}

function rutas(){

    txtresp=document.querySelector("#msjruta");
         
    txtresp.innerHTML=`<div class="alert alert-success">Ruta registrada exitosamente, avance al paso siguiente.</div >`;
final();
}


function acciones(accion, id){
    z=document.querySelector("#z"+id);
    d=document.querySelector("#b"+id);

    switch(accion){
        case 'consultar': break;
        case 'aprobar':
            z.innerHTML="AUTORIZADO";
            z.setAttribute('class','text-success');
            d.innerHTML=`<a href="#" class="btn btn-info btn-sm" title="Consultar" onclick="acciones('consultar',3)">
                        <i class="fa fa-search" ></i>
                    </a>`;
        break;

        case 'rechazar': 
            var justificacion = prompt('Describa brevemente porque desea rechazar esta solicitud'+id);

            if(justificacion!=""){
                z.innerHTML="RECHAZADO";
                z.setAttribute('class','text-danger');
            }
            
        break;

    }
return false;
}


function final(){
    alert("Su solicitud se ha guardado exitosamente");
     window.location="http://localhost/INEAfinal/public/zarpes/permisosDeZarpe";
}


function msj(id, msj){  
    txtresp=document.querySelector("#"+id);
         
    txtresp.innerHTML='<div class="alert alert-success">'+msj+'</div >';

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

