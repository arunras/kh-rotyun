<?php
ob_start();
if(!isset($_SESSION))@session_start();
//session_start();
$error='';
$active=0;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form 
$myusername=addslashes($_POST['email']); 
$mypassword=addslashes($_POST['password']); 

$sql="SELECT user_id, active FROM tbl_user WHERE email='$myusername' AND password='".MD5($mypassword)."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$active=$row['active'];

$q_user_login = getResultSet("SELECT user_id FROM tbl_user WHERE email='$myusername' AND password='".MD5($mypassword)."'");
$count=mysql_num_rows($q_user_login);
while($ru=mysql_fetch_array($q_user_login)){
	$user_id = $ru['user_id'];
}
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1 && $active==1)
{
//session_register("myusername");
//$_SESSION['login_user']=$myusername;
$_SESSION['login_user']=$user_id;

$kh = '';
//if($_SESSION['language_selected']!='kh'){$kh=$_SESSION['language_selected'];}
	if(getUserType()==2){
		header("Location:".HTTP_DOMAIN."?page=administration");
	}
	else{
		$store_id = getValue("SELECT store_id FROM tbl_user_to_store WHERE user_id=".$user_id);
		$storeurl = getValue("SELECT storeurl FROM tbl_store WHERE store_id=".$store_id);

		//header("location:".HTTP_DOMAIN.$kh."?page=store&id=".$store_id."&cat=all");
		header("location:".HTTP_DOMAIN.$storeurl);
	}
}
else 
{
	$error="Your Login Name or Password is invalid";
}
}
?>
<div id="center_detail" style="border: 0px #F00 solid; height:500px;">
<div style="border-bottom: 1px #CCC solid; font-size: 20px;margin-bottom: 30px;"><?php echo $rLanguage->text("Welcome to Cambodia-Auto");?></div>
<div class="LOGIN">
	<table border="0" width="100%">
    	<tr>
        	<td width="40%">
            	<!-- <?php echo HTTP_DOMAIN.'include/php_sub/r_login.php';?> -->
                <form action="" id="iformLogin" method="post"> <!--target="loginsuccess" store/index.php?route=account/login-->
                    <table border="0">
                        <tr>
                            <td><label for="email"><?php echo $rLanguage->text("User ID").':';?></label></td>
                            <td><input type="text" name="email" class="textbox" value="" autofocus="autofocus"/></td>
                        </tr>
                        <tr>
                            <td><label for="password"><?php echo $rLanguage->text("Password").':';?></label></td>
                            <td><input type="password" name="password" class="textbox" value="" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="right">	
                            	<!--<div class="btn_login" onclick="submitLogin();"></div>-->
                                <!--
                                <button type="button" onclick="getTime()">Login</button>
                                -->
                                <input type="submit" class="btn_login" value="" style="border:none;"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                            	<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                            </td>
                        </tr>        
                    </table>
                </form>
    		</td>
            <td  style="border-left:1px #e3e3e3 solid;">
            <!--
                <div class="box-content" style="margin-left: 40px; border: none;">
                    <a class="box-fbconnect-a" href="https://www.facebook.com/dialog/oauth?client_id=287911227924206&redirect_uri=http://plazaphnompenh.com/store/index.php?route=account/fbconnect&state=1548258b5e93528f934afdf7bb20a839&scope=email,user_birthday,user_location,user_hometown"><img src="<?php echo HTTP_DOMAIN;?>images/icon/fb_connect.png" /></a>
                </div>
            -->
            </td>
    	</tr>
        <tr>
        	<td colspan="2">
            	<div class="moreinfo" style="display: none;">
                	<div style="font-size:12px;">More</div>
                	<div><?php echo $rLanguage->text("If you do not have an account,") ?><a href="<?php echo HTTP_DOMAIN.'?page=storeregistration'; ?>"><?php  echo $rLanguage->text("Register");?></a>.</div>
                    <div><?php echo $rLanguage->text("Forgot your") ?> <a href="#"><?php  echo $rLanguage->text("password") ?></a>?</div>
                </div>
            </td>
        </tr>
    </table>
</div>
</div>
<iframe id="loginsuccess" name="loginsuccess"  style="display: none;"></iframe>

<script type="text/javascript">
function redirectLogin(){
	window.location.href="?page=administration";	
}
</script>