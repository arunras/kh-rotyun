<?php
    ob_start();
    if(!isset($_SESSION))@session_start();


    include(dirname(dirname(__FILE__)) . "/config/config.php");
	include(dirname(dirname(__FILE__)) . "/module/url_fake.php");
	include(dirname(dirname(__FILE__)) . "/application/languages/language.class.php");
	/*
	include($_SERVER['DOCUMENT_ROOT'] . "/" . ROOT . "/module/url_fake.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/" . ROOT . "/application/languages/language.class.php");
	*/

    define("OWNER", 1);
	define("ADMINISTRATOR", 2);
    /*
     * Parameters note
     * ?page=report&subject_id=... => subject report
     *
     */

    $path = array(
            "index" => "include/index_home.php",
			"cardetail" => "include/cardetail.php",
			"store" => "include/store.php",
			"login" => "include/login.php",
			"logout" => "include/logout.php",
			"caradd" => "include/caradd.php",
			"caredit" => "include/caredit.php",
			"storeregistration" => "include/store_registration.php",
			"storeedit" => "include/store_edit.php",
			"changepassword" => "include/store_changepassword.php",
			"administration" => "include/administration.php",
			"manufactureradd" => "include/manufactureradd.php",
			"manufactureredit" => "include/manufactureredit.php",
			"manufacturer" => "include/manufacturer.php",
			"carmanagement" => "include/carmanagement.php",
            );

    /* check and switch language display */
    function CheckLanguageChange(){
        //return new language($_SESSION['language_selected']);
		if(isset($_COOKIE['language'])){
			return new language($_COOKIE['language']);	
		}
		else{
			return new language('kh');	
		}
    }

    //random string
    function RandomString($length=20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
        $string = "";
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters)-1)];
        }
      return $string;
    }

    //convert the escape html text in javascript to php
    function escapte_js_decrypt($string){
        return (urldecode($string));
    }

    function array_to_json( $array ){
        if( !is_array( $array ) ){
            return false;
        }
        $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
        if( $associative ){
            $construct = array();
            foreach( $array as $key => $value ){
                // We first copy each key/value pair into a staging array,
                // formatting each key and value properly as we go.

                // Format the key:
                if( is_numeric($key) ){
                    $key = "key_$key";
                }
                $key = "\"".addslashes($key)."\"";

                // Format the value:
                if( is_array( $value )){
                    $value = array_to_json( $value );
                } else if( !is_numeric( $value ) || is_string( $value ) ){
                    $value = "\"".addslashes($value)."\"";
                }

                // Add to staging array:
                $construct[] = "$key: $value";
            }

            // Then we collapse the staging array into the JSON form:
            $result = "{ " . implode( ", ", $construct ) . " }";

        } else { // If the array is a vector (not associative):

            $construct = array();
            foreach( $array as $value ){

                // Format the value:
                if( is_array( $value )){
                    $value = array_to_json( $value );
                } else if( !is_numeric( $value ) || is_string( $value ) ){
                    $value = "'".addslashes($value)."'";
                }

                // Add to staging array:
                $construct[] = $value;
            }

            // Then we collapse the staging array into the JSON form:
            $result = "[ " . implode( ", ", $construct ) . " ]";
        }

        return $result;
    }

    /* convert time format hh:mm AM/PM to database format  */
    function convert_time($val, $format){
        if($val == "") return "";
        if($format == 12){
            $l = strlen($val);
            //$p = substr($val, $l - 2);
            //$time = substr($val, 0, $l-2);
            $result = explode(":", substr($val, 0, $l-2) , 2);
            if(substr($val, $l - 2) == "PM") $result[0] = $result[0] + 12;
            return date("H:i:s", mktime($result[0], $result[1], 0));
        }
        else{
            $val = explode(":", $val);
            return date("H:i:s", mktime($val[0], $val[1], 0));
        }
    }

    /* convert date from mysql database format to display format */
    function to_date_display($val){
        $date = explode(" " , $val);
        $date = explode("-", $date[0] , 3);
        if($_SESSION['language_selected'] == "ja")
            return $date[0] . "年" . $date[1] . "月" . $date[2] . "日" ;
        else
            return $date[0] . "/" . $date[1] . "/" . $date[2];
    }

    /* convert date from mysql database format to display in textbox */
    function to_date_edit($val){
        $date = explode(" " , $val);
        $date = explode("-", $date[0] , 3);
        //return $date[0] . "/" . $date[1] . "/" . $date[2];
        if($_SESSION['language_selected'] == "ja")
            return $date[0] . "年" . $date[1] . "月" . $date[2] . "日" ;
        else
            return $date[0] . "/" . $date[1] . "/" . $date[2];
    }

    /* convert time from mysql database format to display format */
    function to_time_display($val){
        if($val == "") return "";
        $val = explode(":", $val);
        return $val[0] . ":" . $val[1];
    }



    function connectDB(){
	$cn=mysql_connect(HOST_NAME,USER_NAME,USER_PASSWORD) or die("Cannot connect to DB");
	$cn=mysql_select_db(DB_NAME) or die("cannot select database");
    }

    function runSQL($str){
    	connectDB();
    	mysql_query($str) or die("cannot execute statement: $str<br/>".mysql_error());
    }
    function getResultSet($str){
    	connectDB();
    	$rs=mysql_query($str) or die("cannot select: $str ".mysql_error());
    	return $rs;
    }
    function getValue($str){
    	$rs=getResultSet($str);
    	while ($row = mysql_fetch_array($rs,MYSQL_NUM)) {
    		return $row[0];
    	}
    }

    function getDateTime(){
    	return date("Y-m-d H:i:s");
    }
    function getToday(){
    	return date("Y-m-d");
    }
    function getTime(){
    	return date("H:i:s");
    }
	function calculate_days_between_dates($startDate, $endDate = null) {
		if(empty($endDate)) $endDate = date('Y-m-d');
		return abs(strtotime($endDate) - strtotime($startDate)) / (60*60*24);
	}
    function randomID($tbname,$fname){
    	$val=random(0,1999999999);
    	while(getValue("select $fname from $tbname where $fname=$val")!=""){
    		$val=random(0,1999999999);
    	}
    	return $val;
    }
    function random($min,$max){
    	return rand($min,$max);
    }

    /* ----------------- Check Duplicate value in Database ------------------- */
    function isDuplicate($table_name, $field_name, $value, $type){
    	if($type == "string"){
    		$value = "'" . $value . "'";
    	}
    	$isduplicate = false;
    	if(getValue("SELECT * FROM " . $table_name . " WHERE " . $field_name . " = " . $value) != "")$isduplicate = true;
    	return $isduplicate;
    }

    function getCurrentUser(){
        if(isset($_SESSION['login_user'])){
            $user_id = $_SESSION['login_user'];
		}
        else{
			$user_id = 0;
		}
        return $user_id;
    }
	
	function getUserType(){
        $user_id = getCurrentUser();
        if($user_id != 0){
            $user_type = getValue("SELECT user_group_id FROM tbl_user WHERE user_id = " . $user_id);
            if($user_type == 2) return ADMINISTRATOR;
            else if($user_type == 1) return OWNER;
        }
    }
	function getStoreOwnerUser($store_id){
        $user_id = getCurrentUser();
        if($user_id != 0){
            $store_user = getValue("SELECT store_id FROM tbl_user_to_store WHERE user_id = " . $user_id);
            if($store_user == $store_id) return true;
            else if($store_user != $store_id) return false;
        }
    }
    /* set current user after login */
    function setCurrentUser($id){
        $_SESSION['_user_rakugo_id'] = $id;
    }
	/* set current user after login */
    function logout(){
        unset($_SESSION['_user_rakugo_id']);
    }

    /* check if user exist */
    function checkUser($id, $ps){
        return getValue("SELECT user_id FROM tbl_user WHERE email = '" . $id . "' AND password = '" . $ps . "'");
    }

    function getCurrentUserProfileName(){
        $user_id = getCurrentUser();
        $user_profile = "";
        if($user_id != 0){
            /*$user_profile = getValue("SELECT user_profile_name FROM tbl_users WHERE user_id = " . $user_id);
            if($user_profile == ""){
               $user_profile = getValue("SELECT user_name FROM tbl_users WHERE user_id = " . $user_id);
            }*/
        }
        return $user_profile;
    }
	function createThumb($src, $dst, $width, $height=0){
		$percentage = 1;
        if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
        $type = getImageType($src);
        if($type == 'jpeg') $type = 'jpg';
        switch($type){
            case 'bmp': $img = imagecreatefromwbmp($src); break;
            case 'gif': $img = imagecreatefromgif($src); break;
            case 'jpg': $img = imagecreatefromjpeg($src); break;
            case 'png': $img = imagecreatefrompng($src); break;
            default : return "Unsupported picture type!";
        }
		if($w>$width) $percentage = $width/$w;
		$width = $percentage * $w;
		if($height==0){$height = $percentage * $h;}
		
        $new = imagecreatetruecolor($width, $height);
    
        // preserve transparency
        if($type == "gif" or $type == "png"){
            imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
            imagealphablending($new, false);
            imagesavealpha($new, true);
        }
    
        imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $w, $h);
        switch($type){
            case 'bmp': imagewbmp($new, $dst); break;
            case 'gif': imagegif($new, $dst); break;
            case 'jpg': imagejpeg($new, $dst); break;
            case 'png': imagepng($new, $dst); break;
        }
        return $dst;
	}
	function getImageType($file_relative_path){
		$tem = explode(".",$file_relative_path);
		$type = strtolower($tem[count($tem)-1]);
		return $type;
	}
    function getUploadSize($id){
        $filesize=$_FILES[$id]['size'];
        return $filesize;
    }

    function upload($id, $path, $name = ""){
        $result=0;
    	$allowtype=array("jpg","jpeg","gif","png","ico");

    	$filename=$_FILES[$id]['name'];
    	$filename=str_replace("#","_",$filename);
    	$filename=str_replace("$","_",$filename);
    	$filename=str_replace("%","_",$filename);
    	$filename=str_replace("^","_",$filename);
    	$filename=str_replace("&","_",$filename);
    	$filename=str_replace("*","_",$filename);
    	$filename=str_replace("?","_",$filename);
    	$filename=str_replace(" ","_",$filename);
    	$filename=str_replace("!","_",$filename);
    	$filename=str_replace("@","_",$filename);
    	$filename=str_replace("(","_",$filename);
    	$filename=str_replace(")","_",$filename);
    	$filename=str_replace("/","_",$filename);
    	$filename=str_replace(";","_",$filename);
    	$filename=str_replace(":","_",$filename);
    	$filename=str_replace("'","_",$filename);
    	$filename=str_replace("\\","_",$filename);
    	$filename=str_replace(",","_",$filename);
    	$filename=str_replace("+","_",$filename);
    	$filename=str_replace("-","_",$filename);
    	$filesize=$_FILES[$id]['size'];
    	$filetype=end(explode(".",strtolower($filename)));
        if($name != "")$filename = $name . "." . $filetype;
    	if(!in_array($filetype,$allowtype)){
    		$result="2;";
    	}
    	if($filesize>$_POST['MAX_FILE_SIZE'] || $filesize==0){
    		$result="1;";
    	}
    	if($result==0){
    		//$subfolder=date("Y_m_d_H_i_s");
    		$path=$path;// . "/";
			/*
    		if(mkdir($path,0777,true));
            if(file_exists($path.$filename)){
              unlink($path.$filename);
            }
			*/
			
    		if(move_uploaded_file($_FILES[$id]['tmp_name'],$path.$filename)){
    			$result=$result.";".$path.$filename;
    		}
    		else{
    			$result="3;";
    		}
    	}
    	return $result;
    }
	function fileDelete($filepath,$filename) {	
		//echo $filepath.$filename;
		$success = FALSE;
		if (file_exists($filepath.$filename)&&$filename!=""&&$filename!="n/a") {
			unlink ($filepath.$filename);
			$success = TRUE;
		}
		return $success;	
	}

    function display_icon($file_path){
        $image_file_extension = array("JPG", "JPEG", "GIF", "PNG");
        $document_file_extension = array("XLS" => "images/excel.png",
                                    "XLSX" => "images/excel.png",
                                    "DOC" => "images/word.png",
                                    "DOCX" => "images/word.png",
                                    "PPT" => "images/ppt.png",
                                    "PPTX" => "images/ppt.png",
                                    "PDF" => "images/pdf.png");

        $file_name = explode("/", $file_path);
        $file_name = $file_name[count($file_name)-1];
        $file_ext  = explode(".", $file_name);
        $file_ext  = $file_ext[count($file_ext)-1];
        $file_ext  = strtoupper($file_ext);
        if(in_array($file_ext, $image_file_extension)) return $file_path;
        else if(array_key_exists($file_ext, $document_file_extension)) return $document_file_extension[$file_ext];
        else return "images/file_blank.png";
    }


/***RUN Function**************************************************************************/////////////
function autoID($tbname,$fname){
	$q_id = getResultSet("SELECT $fname FROM $tbname");
	$id=0;
	while($ri = mysql_fetch_array($q_id))
	{
		$id=$ri[$fname];
	}
	return $id+1;
}

function getUrl($id){
	//$sub=ROOT;
    global $detail_page;
	$name=getValue("SELECT hotel_name FROM tbl_hotels where hotel_id=$id");
	if($name!=""){
		return "?mangoparam=".$detail_page."&id=".$id;
	}
	else{
		//return $sub."/".$name;
	}
}

function get_file_extension($file_name)
{
  return substr(strrchr($file_name,'.'),1);
}

function f_extension($fn){
$str=explode('/',$fn);
$len=count($str);
$str2=explode('.',$str[($len-1)]);
$len2=count($str2);
$ext=$str2[($len2-1)];
return $ext;
}

function Field($s){
	$rev="'".$s."'";
	return $rev;
}

function cutString($str,$numChar)
{
	if(strlen($str)>$numChar){$dot="...";} else{$dot="";}
	$str = substr($str,0, $numChar).$dot;
	return $str;
}

function createPageNavigator($my_total_page, $my_page_link) //, $my_pagesize, $cur_page, $my_page_link)
{

	if (isset($_GET['curP'])== null | isset($_GET['curP'])== " " | isset($_GET['curP'])== 0){ $cur_page = 1;}
	if (isset($_GET["curP"]) != null) { $cur_page = $_GET["curP"]; }

	echo "Page: ";
	if (($cur_page == 1) || ($my_total_page==0)){
		echo "";}
	else {
		echo '<a title="First" href="' . $my_page_link . '1" style="text-decoration:none;">
				<img align="absmiddle" src="images/nav_first.png"></img>
			 </a>'; //[First]</a>';
		echo '<a title="Previous" href="' . $my_page_link . ($cur_page - 1) . '" style="text-decoration:none;">
				<img align="absmiddle" src="images/nav_previous.png"></img>
			   </a>';//[Previous]</a> ';
	}
	// End of First Previous
	// Page Number
	for ($j=1; $j <= $my_total_page; $j++) {
		if ($j == $cur_page)
			echo " " . $j . " ";
		else
			echo ' <a href="' . $my_page_link . $j . '">' . $j . '</a> ' ;
	}
	// End of Page Number
	// Next Last
	if (($cur_page == $my_total_page) || ($my_total_page==0) )
		//echo " [Next] [Last] ";
		echo " ";
	else {
		echo '  <a title="Next" href="' . $my_page_link . ($cur_page + 1) . '" style="text-decoration:none;">
					<img align="absmiddle" src="images/nav_next.png" onmouseover="src=images/next_pressed.png"></img>
				</a>';//[Next]</a> ';
		echo '<a title="Last" href="' . $my_page_link . $my_total_page . '" style="text-decoration:none;">
					<img align="absmiddle" src="images/nav_last.png" onmouseover="src=images/last_pressed.png"></img>
			  </a>';//[Last]</a>';
	}
	// End of Next Last
}
// ***** End of Page Method *********


/***End RUN Function**************************************************************************/////////////

    //check session
    function check_session()
    {
        if(!isset($_SESSION['_user_09_09_2011_id']))echo "reload";
    }


?>