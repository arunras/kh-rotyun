<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");

$car_id = $_POST['carid'];
//$img = $_POST[''];

echo $car_id;


upload_image($car_id);
$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}
header('Location:../../'.$kh.'?page=cardetail&car='.$car_id);
//exit();
//function to store uploaded file

function upload_image($cid){	
//Declaration
$file_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/";
$date = getToday();
$date = str_replace('-','',$date);

	if(count($_FILES["item_file"]['name'])>0) { //check if any file uploaded
		$GLOBALS['msg'] = ""; //initiate the global message
		$i=0;
		for($j=0; $j < count($_FILES["item_file"]['name']); $j++) { //loop the uploaded file array
			//$filen = $_FILES["item_file"]['name']["$j"]; //file name
			//$path = $file_path.$filen; //generate the destination path
			$i++;
			$picture = end(explode(".", $_FILES['item_file']['name']["$j"]));
			$ext = strtolower($picture);
			$time = getTime();
			$time = str_replace(':','', $time);
			$pic_name = $cid.'_'.$date.'_'.$time.'_'.$i;
			$picture_name = $pic_name.'.'.$ext;
			
			$src = $file_path.$picture_name;
			$thumb_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/car_images_thumb/".$picture_name;
			
			if(move_uploaded_file($_FILES["item_file"]['tmp_name']["$j"],$src)) { //upload the file
				createThumb($src, $thumb_path, 40, 30);
				runSQL("INSERT INTO tbl_car_image (car_id, image) VALUES('".$cid."', '".$picture_name."')");
			}
		}
	}
	else {
		$GLOBALS['msg'] = "No files found to upload"; //Failed message	
	}
	//uploadForm(); //display the main form
}
?>