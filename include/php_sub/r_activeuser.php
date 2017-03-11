<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");
$user_id = $_GET['userid'];
$active_value = $_GET['activevalue'];
runSQL("UPDATE tbl_user SET active='".$active_value."' WHERE user_id=".$user_id);
?>