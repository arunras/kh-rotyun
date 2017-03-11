<?php
$store_id = $_GET['id'];
$store = new store($store_id);
if(getStoreOwnerUser($store_id)==false && getUserType()!=ADMINISTRATOR){
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
<div style="border-bottom: 1px #CCC solid; font-size: 20px;margin-bottom: 30px;"><?php echo $rLanguage->text("Store Update");?></div>
<div class="CAR_REGISTRATION" style="height: 500px;">
	<form action="<?php echo HTTP_DOMAIN;?>include/php_sub/r_storeedit.php" id="iform_editstore" method="post" enctype="multipart/form-data">
    	<table border="0" width="600px">
        	<tr>
            	<td class="label"><?php echo $rLanguage->text("Owner Name");?></td>
                <td>
                	<input type="hidden" class="textbox" name="storeid" value="<?php echo $store_id;?>"/>
                	<input type="text" class="textbox" name="owner" id="iowner" value="<?php echo $store->getStoreOwner();?>"/>
              	</td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("E-mail");?></td>
                <td><input type="text" class="textbox" name="email" id="iemail" disabled="disabled" value="<?php echo $store->getUserEmail();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Password");?></td>
                <td><input type="password" class="textbox" name="password" id="ipassword" disabled="disabled" value="<?php echo $store->getStorePassword();?>" /></td>
            </tr>
            <tr>
            	<td class="label"><br /></td><td></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("URL");?></td>
                <td>
                	<span style="font-size: 10px;">http://cambodia-auto.com/</span>
                    <input type="text" class="textbox" style="width: 77px;" name="storeuname" id="istoreuname" disabled="disabled" value="<?php echo $store->getStoreURL();?>" />
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Store Name");?></td>
                <td><input type="text" class="textbox" name="storename" id="istorename" value="<?php echo $store->getStoreName();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Telephone");?></td>
                <td><input type="text" class="textbox" name="telephone" id="itelephone" value="<?php echo $store->getStoreTelephone();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Website");?></td>
                <td><input type="text" class="textbox" name="url" id="iurl" value="<?php echo $store->getStoreWebsite();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Address");?></td>
                <td><input type="text" class="textbox" name="address" id="iaddress" value="<?php echo $store->getStoreAddress();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Picture");?></td>
                <td>
                	<input type="file" name="storepicture" id="istorepicture"/>
                	<input type="hidden" value="2000000" name="MAX_FILE_SIZE" id="iMAX_FILE_SIZE" />
                </td>
            </tr>
            <tr>
            	<td class="label" valign="top"><?php echo $rLanguage->text("Store Description");?></td>
                <td>
					<textarea name="description" id="idescription" style="width: 198px;"><?php echo str_replace('<br />','',$store->getStoreDescription());?></textarea>                
                </td>
            </tr>
            <tr>
            	<td class="label"></td>
                <td>
                	<input type="button" name="btn_add" id="ibtn_add" onclick="submitStoreEdit();" value="<?php echo $rLanguage->text("Update");?>" />
                	<input type="button" name="cancel" id="icancel" onclick="goBack();" value="<?php echo $rLanguage->text("Cancel");?>" />
                </td>
            </tr>
        </table>
    </form>
</div>
</div>


<script type="text/javascript">
	function submitStoreEdit(){
		if(file_validation('istorepicture')==true){
			$('form#iform_editstore').submit();
		}
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