<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
require_once($_SERVER['DOCUMENT_ROOT'] . ROOT . "/application/store/store.class.php");

$store_id = $_POST['storeid'];
$store = new store($store_id);

$car_id = getValue("SELECT car_id FROM tbl_car ORDER BY car_id DESC LIMIT 1") + 1;

$store_name = strtoupper(substr($store->getStoreName(), 0, 2)); // returns "d"$store->getStoreName();


$code_store = str_pad($store_id, 3, '0', STR_PAD_LEFT);  
$code_car = str_pad($car_id, 5, '0', STR_PAD_LEFT);  
$carcode = $store_name.$code_store.'-'.$code_car;

//Declaraton
$user_id = getCurrentUser();
$model = $_POST['model'];
$manufacturer = (int)($_POST['manufacturer']);
$released_year = $_POST['releasedyear'];
$color = $_POST['color'];
$mileage = $_POST['mileage'];
$body_type = $_POST['bodytype'];
$steering = $_POST['steering'];
$no_seat = $_POST['noseat'];
$no_door = $_POST['nodoor'];
$label_number = $_POST['labelnumber'];
$fuel_type = $_POST['fueltype'];
$drive = $_POST['drive'];
$transmission = $_POST['transmission'];
$engine_size = $_POST['enginesize'];
$video = '';
$price = $_POST['price'];
//$status = 1;
$status = $_POST['status'];
$active = isset($_POST['active']) && $_POST['active']  ? "1" : "0";

$desc = nl2br($_POST['description']);
$desc = mysql_real_escape_string($desc);
//$picture = $_POST['picture'];
//End Declaraton
//FILE
$picture = end(explode(".", $_FILES['carpicture']['name']));
$picture_ext = strtolower($picture);

$file_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/";

$datetime = getDateTime();
$date = getToday();
$time = getTime();
$date = str_replace('-','',$date);
$time = str_replace(':','', $time);
$picture_name = $date.'_'.$time;

$result=upload("carpicture",$file_path, $picture_name);
$temp=explode(";",$result);
$result=$temp[0];
$target_path=$temp[1];

if($result=="0"){
	$target_path = substr($target_path,6,strlen($target_path));
}
$picture_name = $picture_name.'.'.$picture_ext;

$src = $_SERVER['DOCUMENT_ROOT']."/". $target_path;
$thumb_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/thumb/".$picture_name;
createThumb($src, $thumb_path, 200);
//End FILE

runSQL("INSERT INTO tbl_car (car_code, model, picture, manufacturer_id, released_year, color, mileage, body_id, steering, no_seat, no_door, label_number, fuel_type, transmission, drive, engine_size, description, video, price, created, modified, status_date, status, active) 
		VALUES('".$carcode."', '".$model."', '".$picture_name."', '".$manufacturer."', '".$released_year."', '".$color."', '".$mileage."', '".$body_type."', '".$steering."', '".$no_seat."', '".$no_door."', '".$label_number."', '".$fuel_type."', '".$transmission."', '".$drive."', '".$engine_size."', '".$desc."', '".$video."', '".$price."', '".$datetime."', '".$datetime."', '".$datetime."', '".$status."', '".$active."')");
$car_id = mysql_insert_id();

runSQL("INSERT INTO tbl_car_to_store (car_id, store_id) VALUES('".$car_id."', '".$store_id."')");
		
$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}

//header('Location:../../'.$kh.'?page=store&id='.$store_id.'&cat=all');
header('Location:../../'.$store->getStoreURL());
?>