<?php
//exit();
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
require_once($_SERVER['DOCUMENT_ROOT'] . ROOT . "/application/store/store.class.php");

$store_id = $_POST['storeid'];
$store = new store($store_id);
$getFileName = $store->getStorePictureName();

//Declaraton
$owner = $_POST['owner'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$storename = $_POST['storename'];
$telephone = $_POST['telephone'];
$url = $_POST['url'];
$address = $_POST['address'];
$description = nl2br($_POST['description']);
$description = mysql_real_escape_string($description);

//End Declaraton
//FILE
$picture = end(explode(".", $_FILES['storepicture']['name']));
$picture_ext = strtolower($picture);

$file_path = "../../images/content/store/";
$date_added = getToday();
$date = getToday();
$time = getTime();
$date = str_replace('-','',$date);
$time = str_replace(':','', $time);
$picture_name = $date.'_'.$time;

$result=upload("storepicture",$file_path, $picture_name);
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

runSQL("UPDATE tbl_store SET name='".$storename."', owner_name='".$owner."', picture='".$picture_name."', telephone='".$telephone."', email='".$email."', website='".$url."', address='".$address."', description='".$description."' WHERE store_id=".$store_id);
$storeurl = getValue("SELECT storeurl FROM tbl_store WHERE store_id=".$store_id);

$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}

//header('Location:../../'.$kh.'?page=store&id='.$store_id.'&cat=all');
header('Location:../../'.$storeurl);


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