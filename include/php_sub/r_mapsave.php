<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");

$store_id = $_GET['storeid'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];


runSQL("UPDATE tbl_store SET map_latitude='".$lat."', map_longitude='".$lon."' WHERE store_id=".$store_id);
?>