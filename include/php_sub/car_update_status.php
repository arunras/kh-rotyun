<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
$car_id = $_GET['carid'];
$status_value = $_GET['statusvalue'];
$datetime = getDateTime();
runSQL("UPDATE tbl_car SET status='".$status_value."', status_date='".$datetime."' WHERE car_id=".$car_id);
?>