<div id="map" style="width:400px; heigth:800px;" class="my-3"></div>


<script type="text/javascript">
	
	let map;
	function initMap(){
		map=new google.maps.Map(document.getElementById('map'), {
			center:{ lat: -34.247, lng: 158.644},
			zoom:8,
			scrollWhell:true,

		});
	}
</script>


 <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlmSJeecjkcY0QWvKfVhBD_ppF0ftIB7g&callback=initMap&v=weekly"
      async
    ></script>
