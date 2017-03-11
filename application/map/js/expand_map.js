// For expand map on card detail
//loadScript("js/jquery.min.js");
jQuery(document).ready(function () {
	jQuery('#iexpand_map').toggle(
		function(){
			//alert('expand');
			jQuery('div#map_canvas_detail').css({
				'height': '300px'	
			});
			jQuery('div#imap_wrapper').css({
				'height': '325px'	
			});
			jQuery('#iexpandcollapseicon').css('background-image','url(application/map/mapIcon/expand.png)');
			initialize_detail();
		}, 
		function(){
			jQuery('div#map_canvas_detail').css({
				'height': '130px'	
			});
			jQuery('div#imap_wrapper').css({
				'height': '155px'	
			});
			jQuery('#iexpandcollapseicon').css('background-image','url(application/map/mapIcon/collapse.png)');
			initialize_detail();
		}
	);
});


//Load JS fil
function loadScript(url, callback)
{
    // adding the script tag to the head as suggested before
   var head = document.getElementsByTagName('head')[0];
   var script = document.createElement('script');
   script.type = 'text/javascript';
   script.src = url;

   // then bind the event to the callback function 
   // there are several events for cross browser compatibility
   script.onreadystatechange = callback;
   script.onload = callback;

   // fire the loading
   head.appendChild(script);
}