

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

//-------------------------------------------------------------------------------

function agregarCoordenadas(){
     
var coords=document.getElementById('coords');
let cantAct=coords.getAttribute('data-cant');
cantAct<=0 ? cantAct=1 : cantAct++;

/*var campos=`<div class="row" id="coordenadas`+cantAct+`">
        <div class="form-group col-sm-5">
            <label for="Latitud">Latitud:</label>
            <input class="form-control" name="latitud[]" id="lat`+cantAct+`" type="text">
        </div>
         
        <div class="form-group col-sm-5">
            <label for="longitud">Longitud:</label>
            <input class="form-control" name="longitud[]" id="lon`+cantAct+`"  type="text">
        </div>
        <div class="form-group col-sm-2 pt-4">
        <button class="btn btn-danger" onclick="eliminarCorrdenadas(`+cantAct+`)" type="button">borrar</button>
        </div>
    </div>`;*/

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
