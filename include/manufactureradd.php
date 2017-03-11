<?php
if(getUserType()!=ADMINISTRATOR){
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
<div style="border-bottom: 1px #CCC solid; font-size: 20px;margin-bottom: 30px;"><?php echo $rLanguage->text("Add Manufacturer");?></div>
<div class="CAR_REGISTRATION" style="height: 500px;">
	<form action="<?php echo HTTP_DOMAIN;?>include/php_sub/r_manufactureradd.php" id="iform_manufactureradd" method="post" enctype="multipart/form-data">
    	<table border="0" width="600px">
        	<tr>
            	<td class="label"><?php echo $rLanguage->text("Manufacturer");?></td>
                <td><input type="text" class="textbox" name="manufacturer" id="imanufacturer" autofocus="autofocus"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Icon");?></td>
                <td>
                	<input type="file" name="manufacturericon" id="imanufacturericon"/>
                	<input type="hidden" value="2000000" name="MAX_FILE_SIZE" id="iMAX_FILE_SIZE" />
                </td>
            </tr>
            <tr>
            	<td class="label"></td>
                <td>
                	<input type="button" name="btn_add" id="ibtn_add" value="<?php echo $rLanguage->text("Add");?>" onclick="submitManufacturerAdd();" />
                	<input type="button" name="cancel" id="icancel" value="<?php echo $rLanguage->text("Cancel");?>" onclick="goBack()"/>
                </td>
            </tr>
        </table>
    </form>
</div>
</div>

<script type="text/javascript">
	function submitManufacturerAdd(){
		if(file_validation('imanufacturericon')==true){
			$('form#iform_manufactureradd').submit();
		}
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