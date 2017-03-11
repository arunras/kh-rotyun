<script type="text/javascript">
var map;
function initialize_edit() {
    //var lat = jQuery('#ilatitude').val();
	//var lng = jQuery('#ilongitude').val();
	<?php
	if($_GET['lat']!=0 || $_GET['lon']!=0){
		echo 'var lat ='.$_GET['lat'].';';
		echo 'var lng ='.$_GET['lon'].';';
	}
	else{
		echo 'var lat = 11.572313;';
		echo 'var lng = 104.916515;';
	}
	
	?>
	
	var latLng = new google.maps.LatLng(lat, lng);
	var myOptions = {
	  	zoom: 13,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
        
	if(document.getElementById('map_view')){
		map = new google.maps.Map(document.getElementById('map_view'), myOptions);
		var marker = new google.maps.Marker({
			map: map,
			position: latLng,
			title: 'You are here!',
			<?php
			if(getStoreOwnerUser($_GET['storeid'])==true || getUserType()==ADMINISTRATOR){echo 'draggable: true';}
			else{echo 'draggable: false';}
			?>
		});
		geocodePosition(marker.getPosition());
		// Update current position info.
		updateMarkerPosition(latLng);
		geocodePosition(marker.getPosition());
		
		// Add dragging event listeners.
		google.maps.event.addListener(marker, 'dragstart', function() {
			updateMarkerAddress('Dragging...');
		});
		
		google.maps.event.addListener(marker, 'drag', function() {
			updateMarkerStatus('Dragging...');
			updateMarkerPosition(marker.getPosition());
		});
		
		google.maps.event.addListener(marker, 'dragend', function() {
			updateMarkerStatus('Drag ended');
			geocodePosition(marker.getPosition());
		});
	}
}
//Set Position
var geocoder = new google.maps.Geocoder();
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
	  //aaaaaaaaaaaaaaa
	  /*
	  for (var i = 0; i < responses[0].address_components.length; i++)
		{
			var addr = responses[0].address_components[i];
			// check if this entry in address_components has a type of country
			if (addr.types[0] == "administrative_area_level_1"){
				//alert (addr.short_name);
				document.getElementById('imycity').value = addr.long_name;
			}
			if (addr.types[0] == "country"){
				//alert (addr.short_name);
				document.getElementById('imycountry').value = addr.long_name;
			}
		}
		*/
	  //aaaaaaaaaaaaaaaa
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}
//update Marker Status
function updateMarkerStatus(str) {
  	document.getElementById('markerStatus').innerHTML = str;
}
//update Marker Position
function updateMarkerPosition(latLng) {
  	document.getElementById('ilatitude').value=latLng.lat();//.toFixed(5);
	document.getElementById('ilongitude').value=latLng.lng();//.toFixed(5);
}
//update Marker Adress
function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}
// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize_edit);
</script>