<?php
if(getCurrentUser()==0){ // || getUserType()==ADMINISTRATOR
	header("Location: ".HTTP_DOMAIN);
}
//Form Validation
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/jquery.min.js"></script>';
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/_formvalidation/js/jquery.validate.js"></script>';
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/_formvalidation/js/run_formvalidation.js"></script>';
echo '<link type="text/css" rel="stylesheet" href="'.HTTP_DOMAIN.'application/_formvalidation/css/s_formvalidation.css">';
//end Form Validation
?>

<div id="center_detail" style="border: 0px #F00 solid; height:500px;">
<div style="border-bottom: 1px #CCC solid; font-size: 20px;margin-bottom: 30px;">Store Edit</div>
<div class="CAR_REGISTRATION" style="height: 500px;">
	<form action="include/php_sub/r_changepassword.php" id="iform_changepassword" method="post" enctype="multipart/form-data">
    	<table>
            <tr>
            	<td class="label">Password</td>
                <td><input type="password" class="textbox" name="password" id="ipassword" autofocus="autofocus"/></td>
            </tr>
            <tr>
            	<td class="label">Confirm Password</td>
                <td><input type="password" class="textbox" name="passwordconfirm" id="iconfirm"/></td>
            </tr>
            <tr>
            	<td><br /></td><td></td>
            </tr>
            <tr>
            	<td class="label"></td>
                <td>
                    <input type="button" name="btn_add" id="ibtn_add" value="Save" onclick="return submitChangePassword();" />
                	<input type="button" name="cancel" id="icancel" value="Cancel" onclick="goBack()"/>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>



<script type="text/javascript">
	function submitChangePassword(){
    	$('form#iform_changepassword').submit();
	}

	function submitSuccess(per_id){
		$('div img.isending').show();
		var alert_text = $('div.Lmessages span#ialertcomplet').html();
		alert(alert_text);
		<?php if($_SESSION['language_selected']=='ja'){$_SESSION['language_selected']='';}?>
		window.location.href="<?php echo '../../../'.$_SESSION['language_selected'];?>" + "?page=perprofile&perid=" + per_id;
		//header('Location:../../../'.$_SESSION['language_selected'].'?page=perprofile&perid='.$per_id);
	}
	function goBack(){
		 history.back();
	}
</script>

<?php
		/*==Messages===========================================================*/
		echo '<div class="Lmessages" style="display: none;">';
			echo '<span id="ialertcomplet">'.$rLanguage->text("Registration Complete").'</span>';
			echo '<span id="ismsrequired">'.$rLanguage->text("This field is required").'</span>';
			echo '<span id="ismsurl">'.$rLanguage->text("Please enter a valid URL").'</span>';
			echo '<span id="ismsemail">'.$rLanguage->text("Please enter a valid email address").'</span>';
			echo '<span id="ismsequalTo">'.$rLanguage->text("Please enter the same value again").'</span>';
			echo '<span id="iuploadfilevalidate">'.$rLanguage->text("File is not supported!").'</span>';
		echo '</div>';
		/*==Messages===========================================================*/
?>