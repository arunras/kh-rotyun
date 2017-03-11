<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
//Declaraton
$owner = $_POST['owner'];
$email = $_POST['email'];
$password = md5($_POST['password']);
//$password = $_POST['password'];

$storeuname = $_POST['storeuname'];
$storename = strtolower($_POST['storename']);
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
	$picture_name = $picture_name.'.'.$picture_ext;	
}
else{
	$picture_name = '';
}

//End FILE
runSQL("INSERT INTO tbl_store (name, storeurl, owner_name, picture, telephone, email, website, address, description) VALUES('".$storename."','".$storeuname."', '".$owner."', '".$picture_name."', '".$telephone."', '".$email."', '".$url."', '".$address."', '".$description."')");
$store_id = mysql_insert_id();
//User
runSQL("INSERT INTO tbl_user (user_name, email, password, user_group_id, date_added, date_modified, active) VALUES('".$email."', '".$email."', '".$password."', '1', '".$date_added."', '".$date_added."', '0')");
$user_id = mysql_insert_id();
runSQL("INSERT INTO tbl_user_to_store(user_id, store_id) VALUES('".$user_id."', '".$store_id."')");
//$storeurl = getValue("SELECT storeurl FROM tbl_store WHERE store_id=".$store_id);

$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}

//header('Location:../../'.$kh.'?page=store&id='.$store_id.'&cat=all');
header('Location:../../'.$storeuname);
?>