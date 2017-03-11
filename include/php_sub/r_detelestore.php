<?php
require_once((dirname(dirname(dirname(__FILE__)))) . "/module/module.php");

runSQL("DELETE FROM tbl_comments WHERE comment_id=". $comment_id);
?>


