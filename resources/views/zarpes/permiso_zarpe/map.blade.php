<div id="map" style=" heigth:300px;" class="my-3 col-md-12"  data-coordCaps="{{$coordCaps}}">

<x-maps-leaflet style='height: 400px' :centerPoint="['lat' => 10.4806, 'long' => -66.9036]"   :zoomLevel="5"></x-maps-leaflet>


	
</div>

<script type="text/javascript">

var capitanias=document.getElementById("map").getAttribute('data-coordCaps');
capitanias=JSON.parse(capitanias);
var polygon=[];
console.log(capitanias);
 var coordenadasCapitanias=[];
 let i=0;
 capitanias.forEach(function(capitania){
 	let idcapi=capitania.capitania;
 	console.log(idcapi);
 	 polygon[i++] = L.polygon(capitania.coords, {color: 'blue', capitaniaid:idcapi}).addTo(mymap);
 	 
 });

   /* let cordXX=[[7,58],
    [8,59],
    [9,60],
    [10,61],
    [11,62],
    [12,63],
    [13,64],
    [14,65],
    [15,67],
    [16,68],
    [17,69],
    [18,70],
    [19,85]];

     polygonX = L.polygon(cordXX, {color: 'red'}).addTo(mymap);*/
 
 
//var polygon = L.polygon(CoordsCeiba, {color: 'blue', capitaniaid:13}).addTo(mymap);

	 mymap.on('click', onMapClick);
	 var marca; /*variable que guarda la marca que se vera en pantalla al hacer click*/
    function onMapClick(click){
        var coordenada = click.latlng; //capturo las coordenadas latitud y longitud
        /*Busco los imput para agregar el valor seleccionado correspondiente latitud y longitud*/
        var latInput=document.getElementById('latitud'); 
        var longInput=document.getElementById('longitud'); 
        /*Busco el atributo data-lat y data-long que guardan la coordenada anterior para eliminar el marcador si es la segunda vez que dan click*/
        let dataLat=latInput.getAttribute("data-lat")
        let dataLong=longInput.getAttribute('data-long');
        /*pregunto si no estan en blanco, porque si tienen informacion es porque ya existe un marcador en el mapa y lo debo eliminar para crear el nuevo*/
        if(dataLat!="" && dataLong!=""){
        	offMapClick(dataLat,dataLong); //borro el marcador anterior del mapa
        } 

        /*Asigno el valor del nuevo click a los input latitud y longitud*/
        latInput.value=coordenada.lat;
        	longInput.value=coordenada.lng;

        	/*coloco en los data-lat y data-long las nuevas coordenadas por si en el futuro hay que borrarlas*/
     	latInput.setAttribute('data-lat',coordenada.lat);
     	longInput.setAttribute('data-long',coordenada.lng);
         newMarker(coordenada.lat, coordenada.lng); //Creo la nueva marca en el mapa
         let idCapitania;
         polygon.forEach(function(pol){
          idCapitania=isMarkerInsidePolygon(marca, pol);

          if(idCapitania!=false){
          	document.getElementById('capitaniaDestino').value=idCapitania; 

            estNauticoDestinoSelect(idCapitania);

          }else{
          	idCapitania=false;
          }

         });
         
        //alert("Acabas de hacer clic en: \n latitud: " + latitud + "\n longitud: " + longitud);
    };

    function offMapClick(lat,  long){
    		let marcaDelete=marca; 
    		//console.log(marcaDelete);

    		mymap.removeLayer(marcaDelete);
    }


    function newMarker(lat, long){
    		//Creo la nueva marca en el mapa

    		 marca=L.marker([lat, long]).addTo(mymap)
	    .bindPopup('Punto de escala de la navegación')
	    .openPopup();
    }





    var latlngs = [[37, -109.05],[41, -109.03],[41, -102.05],[37, -102.04]];



// zoom the map to the polygon
//mymap.fitBounds(polygon.getBounds());


function isMarkerInsidePolygon(marker, campus) { 
        var inside = false;
        var x = marker.getLatLng().lat, y = marker.getLatLng().lng;
        for (var ii=0;ii<campus.getLatLngs().length;ii++){
            var polyPoints = campus.getLatLngs()[ii];
            for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {
                var xi = polyPoints[i].lat, yi = polyPoints[i].lng;
                var xj = polyPoints[j].lat, yj = polyPoints[j].lng;

                var intersect = ((yi > y) != (yj > y))
                    && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                if (intersect){
                	inside = !inside;
                } 
            }
        }
        if(inside==true){
        	return campus.options.capitaniaid;
        }else{
        	return inside;

        }
    }

 //var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community' });

 
</script>
        