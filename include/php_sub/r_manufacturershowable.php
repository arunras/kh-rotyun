<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
$manufacturer_id = $_GET['manufacturerid'];
$showable_value = $_GET['showablevalue'];
runSQL("UPDATE tbl_manufacturer SET showable='".$showable_value."' WHERE manufacturer_id=".$manufacturer_id);

echo $manufacturer_id;
?>