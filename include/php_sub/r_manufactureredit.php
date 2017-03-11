<?php
//exit();
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
require_once($_SERVER['DOCUMENT_ROOT'] . ROOT . "/application/manufacturer/manufacturer.class.php");

$manufacturer_id = $_POST['manufacturerid'];
$manufaturer = new manufacturer($manufacturer_id);
$getFileName = $manufaturer->getManufacturerIconName();

//Declaraton
$manufacturer = $_POST['manufacturer'];
//End Declaraton

//FILE
$picture = end(explode(".", $_FILES['manufacturericon']['name']));
$picture_ext = strtolower($picture);

$file_path = "../../application/manufacturer/manufacturer_picture/";
$date_added = getToday();
$date = getToday();
$time = getTime();
$date = str_replace('-','',$date);
$time = str_replace(':','', $time);
$picture_name = $date.'_'.$time;

$result=upload("manufacturericon",$file_path, $picture_name);
$temp=explode(";",$result);
$result=$temp[0];
$target_path=$temp[1];

if($result=="0"){
	$target_path = substr($target_path,6,strlen($target_path));
}
if($picture_ext!=''){
	fileDelete($file_path,$getFileName);
	$picture_name = $picture_name.'.'.$picture_ext;	
}
else{
	$picture_name = $getFileName;;
}
//End FILE

runSQL("UPDATE tbl_manufacturer SET name='".$manufacturer."', picture='".$picture_name."' WHERE manufacturer_id=".$manufacturer_id);
$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}
header('Location:../../'.$kh.'?page=manufacturer');

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