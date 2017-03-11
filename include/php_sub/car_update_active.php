<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
$car_id = $_GET['carid'];
$active = $_GET['active'];
runSQL("UPDATE tbl_car SET active='".$active."' WHERE car_id=".$car_id);
?>