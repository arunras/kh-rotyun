<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");	 
$keyword = $_GET['keyword'];

$get_carid = getValue("SELECT car_id FROM tbl_car WHERE car_code='".$keyword."'");

echo $get_carid;
?>


