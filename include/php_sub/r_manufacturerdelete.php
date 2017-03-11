<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
require_once($_SERVER['DOCUMENT_ROOT'] . ROOT . "/application/manufacturer/manufacturer.class.php");
$manufacturer_id = $_GET['manufacturerid'];

$manufaturer = new manufacturer($manufacturer_id);
$getFileName = $manufaturer->getManufacturerIconName();
$file_path = "../../application/manufacturer/manufacturer_picture/";
fileDelete($file_path,$getFileName);






runSQL("DELETE FROM tbl_manufacturer WHERE manufacturer_id=". $manufacturer_id);

function fileDelete($filepath,$filename) {
	
	echo $filepath.$filename;
	$success = FALSE;
	if (file_exists($filepath.$filename)&&$filename!=""&&$filename!="n/a") {
		unlink ($filepath.$filename);
		$success = TRUE;
	}
	return $success;	
}
?>


