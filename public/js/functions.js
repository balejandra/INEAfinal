

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