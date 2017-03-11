<?php
//exit();
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
//Declaraton
$user_id = getCurrentUser();
$password = md5($_POST['password']);
//$password = $_POST['password'];
$store_id = getValue("SELECT store_id FROM tbl_user_to_store WHERE user_id=".$user_id);
$storeurl = getValue("SELECT storeurl FROM tbl_store WHERE store_id=".$store_id);
//end Declaration

runSQL("UPDATE tbl_user SET password='".$password."' WHERE user_id=".$user_id);

$kh = '';
if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}

//header('Location:../../'.$kh.'?page=store&id='.$store_id.'&cat=all');
header('Location:../../'.$storeurl);

?>