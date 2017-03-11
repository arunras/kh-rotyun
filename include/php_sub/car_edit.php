<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
require_once($_SERVER['DOCUMENT_ROOT'] . ROOT . "/application/car/car.class.php");

$car_id = $_POST['carid'];
$car = new car($car_id);
$getFileName = $car->getCarPictureName();
//Declaraton
$user_id = getCurrentUser();
$store_id = 10;
$model = $_POST['model'];
$carcode = 'Car ID...';
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
$thumb_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/thumb/";
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
if($picture_ext!=''){
	fileDelete($file_path,$getFileName);
	fileDelete($thumb_path, $getFileName);
	$picture_name = $picture_name.'.'.$picture_ext;
}
else{$picture_name = $getFileName;}
//End FILE

runSQL("UPDATE tbl_car SET model='".$model."', picture='".$picture_name."', manufacturer_id='".$manufacturer."', released_year='".$released_year."', color='".$color."', mileage='".$mileage."', body_id='".$body_type."', steering='".$steering."', no_seat='".$no_seat."', no_door='".$no_door."', label_number='".$label_number."', fuel_type='".$fuel_type."', transmission='".$transmission."', drive='".$drive."', engine_size='".$engine_size."', description='".$desc."', video='".$video."', price='".$price."', modified='".$datetime."', status_date='".$datetime."', status='".$status."', active='".$active."' WHERE car_id=".$car_id);
		
$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}
//header('Location:../../'.$kh.'?page=cardetail&car='.$car_id.'&cat=all');
header('Location:../../'.$car->getStoreURL().'?page=cardetail&car='.$car_id.'&cat=all');
?>