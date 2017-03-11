<?php
//exit();
//include(dirname(dirname(dirname(__FILE__))) . "/config/config.php");
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");

if (isset($_POST['storeuname'])) {                                                               
    //$storeuname = mysql_real_escape_string($_POST['storeuname']);                                  
	$storeuname = $_POST['storeuname'];                                  
    $check_for_storeuname = getResultSet("SELECT storeurl FROM tbl_store WHERE storeurl='$storeuname'"); 
    if (mysql_num_rows($check_for_storeuname)) {
        echo "false";                                                                           
    } else {
        echo "true";//No Record Found - Username is available
    }
}
exit;
?>