<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
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
	$picture_name = $picture_name.'.'.$picture_ext;	
}
else{
	$picture_name = '';
}
//End FILE
runSQL("INSERT INTO tbl_manufacturer(name, picture) VALUES('".$manufacturer."', '".$picture_name."')");

$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}
header('Location:../../'.$kh.'?page=manufacturer');
?>