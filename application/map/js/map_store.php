<!--
<script type="text/javascript" src="application/map/js/infobox.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="application/map/js/expand_map.js"></script>
-->

<script type="text/javascript">
//var map;
var marker;
function initialize_store() {
	var lat = jQuery('#ilatitude').val();
	var lng = jQuery('#ilongitude').val();
	/*
	var lat=11.572313;
    var lng=104.916515;
	*/
	
	var latLng = new google.maps.LatLng(lat, lng);
	var myOptions = {
	  	zoom: 13,
		disableDefaultUI: true,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
        
	if(document.getElementById('map_canvas')){
		var map_detail = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
		marker = new google.maps.Marker({
			map: map_detail,
			position: latLng,
			draggable: false
		});
		//google.maps.event.addListener(map_detail, 'dragend', function() { alert('map dragged'); } );
		//var infoWindow = new google.maps.InfoWindow();		
	}
}
google.maps.event.addDomListener(window, 'load', initialize_store);
</script>
