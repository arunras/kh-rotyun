<?php
//exit();
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");


$storeurl_request = $_POST['storeuname'];
$store_url = getValue("SELECT storename FROM tbl_store WHERE storename=".$storeurl_request);


?>