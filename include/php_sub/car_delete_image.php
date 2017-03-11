<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php"); 
$img_id = $_GET['imgid'];
$file_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/";
$thumb_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/image_thumb/";

$getFileName = getValue("SELECT image FROM tbl_car_image WHERE car_image_id=".$img_id);

fileDelete($file_path,$getFileName);
fileDelete($thumb_path,$getFileName);

runSQL("DELETE FROM tbl_car_image WHERE car_image_id=". $img_id);

echo $img_id;
?>


