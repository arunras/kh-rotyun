
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    ob_start();
    if(!isset($_SESSION))@session_start();

	//error_reporting(0);

	require_once(dirname(dirname(__FILE__)) . "/module/module.php");

    define("HTTP_DOMAIN",(!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', "") : "http://" . $_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', "") . ROOT . "/");
	//Global-Declaration
	$rLanguage = CheckLanguageChange();
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../application/map/css/map.css" />
<script src="../js/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!--
<script type="text/javascript" src="../application/map/js/map_view.php"></script>
-->
<?php 
require_once(dirname(dirname((__FILE__))). "/application/map/js/map_view.php");
require_once(dirname(dirname((__FILE__))). "/application/store/store.class.php");
$store_id = $_GET['storeid'];
$store = new store($store_id);

$lat = $_GET['lat'];
$lon = $_GET['lon'];
?>

<title>View Mape</title>
</head>

<body>
<div id="MAP_VIEW_WRAPPER">
    <div id="map_view"></div>
    <div class="map_infoBox">
     	<div class="info_address">
        	<span style="font-weight: bold;">Closest road: </span><span id="address"></span>
            <div class="direction"><a href="http://maps.google.com.kh/maps?saddr=&daddr=<?php echo $lat.','.$lon.'('.$store->getStoreName().')';?>" target="_new"><?php echo $rLanguage->text("Direction");?></a></div>
        </div>
        <?php       
			if(getStoreOwnerUser($_GET['storeid'])==false && getUserType()!=ADMINISTRATOR){echo '<div class="form_savemap" style="display: none;">';}
			else{echo '<div class="form_savemap" style="display: block;">';}		
		?>
            <form name="frm_mapedit" id="ifrm_mapedit" method="post">
                <input type="hidden" name="storeid" id="istoreid" value="<?php echo $_GET['storeid'];?>" />
                <label for="ilatitude" style="font-weight: bold;">Lat: </label>
                <input type="text" id="ilatitude" name="latitude" value="" readonly="readonly" placeholder="latitude"/>
                <label for="ilongitute" style="font-weight: bold;">Lng: </label>
                <input type="text" id="ilongitude" name="longitude" value="" readonly="readonly" placeholder="longitude"/>
                <input type="button" name="btn_save" id="ibtn_save" value="Save" onclick="saveMap()"/>
            </form>
            <span style="font-weight: bold;">Status: </span><span id="markerStatus"></span>
        </div>
    </div>
</div>
</body>
</html>

<script type="text/javascript">
function saveMap(){
	var storeid = $("#istoreid").val();
	var lat = $("#ilatitude").val();
	var lon = $("#ilongitude").val();
	
	var isSave = confirm("Are you sure you want to save this?");	
	if(isSave==true){	
		$.ajax({
			url: 'php_sub/r_mapsave.php?lat='+ lat +'&lon=' + lon + '&storeid=' + storeid,
			success: function(data){
				alert('Save map success!');
			}
		});
	}
}
</script>