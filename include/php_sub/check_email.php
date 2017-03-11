<?php
//exit();
//include(dirname(dirname(dirname(__FILE__))) . "/config/config.php");
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");

if (isset($_POST['email'])) {                                                               
    //$storeuname = mysql_real_escape_string($_POST['storeuname']);                                  
	$email = $_POST['email'];              
    $check_email = getResultSet("SELECT email FROM tbl_user WHERE email='$email'"); 
    if (mysql_num_rows($check_email)) {
        echo "false";                                                                           
    } else {
        echo "true";//No Record Found - Username is available
    }
}
exit;
?>