<?php
$car_id = $_GET['car'];
$car = new car($car_id);
$store_id = $car->getStoreId();
if(getStoreOwnerUser($store_id)==false && getUserType()!=ADMINISTRATOR){
	header("Location: ".HTTP_DOMAIN);
}
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/yearforedit.js"></script>';
//Form Validation
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/_formvalidation/js/jquery.validate.js"></script>';
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/_formvalidation/js/run_formvalidation.js"></script>';
echo '<link type="text/css" rel="stylesheet" href="'.HTTP_DOMAIN.'application/_formvalidation/css/s_formvalidation.css">';
//end Form Validation
?>

<div id="center_detail" style="border: 0px #F00 solid; height:500px;">
<div style="border-bottom: 1px #CCC solid; font-size: 20px;margin-bottom: 30px;"><?php echo $rLanguage->text("Update Car");?></div>
<div class="CAR_REGISTRATION">
<table border="0px" width="100%">
	<tr>
    	<td width="400px">
	<form action="<?php echo HTTP_DOMAIN;?>include/php_sub/car_edit.php" id="iform_caredit" onsubmit="return file_validation_for_car()" method="post" enctype="multipart/form-data">
    	<table>
        	<tr>
            	<td class="label"><?php echo $rLanguage->text("Model");?></td>
                <td>
                	<input type="hidden" class="textbox" name="carid" value="<?php echo $car_id;?>"/>
                	<input type="text" class="textbox" name="model" id="imodel" value="<?php echo $car->getCarModel();?>"/>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Manufacturer");?></td>
                <td>
                    <select name="manufacturer" id="imanufacturer" class="selection">
                    <?php
						$q_manufacturer = getResultSet("SELECT manufacturer_id, name FROM tbl_manufacturer ORDER BY name");
						echo "<option value='".$car->getCarManufacturerId()."'>".$car->getCarManufacturer()."</option>";
						while($rm=mysql_fetch_array($q_manufacturer)){
							$manufacturer_id = $rm['manufacturer_id'];
							$name = $rm['name'];
							if($manufacturer_id!=$car->getCarManufacturerId()){
								echo "<option value='".$manufacturer_id."'>".$name."</option>";	
							}
						}
					?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Released Year");?></td>
                <td>
                    <select name="releasedyear" id="iyear" class="selection">
                    	<option selected="selected" value="<?php echo $car->getCarReleasedYear();?>"><?php echo $car->getCarReleasedYear();?></option>
                    </select>
                    <script type="text/javascript">date_populate("iyear");</script>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Color");?></td>
                <td><input type="text" class="textbox" name="color" id="icolor" value="<?php echo $car->getCarColor();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Mileage");?></td>
                <td><input type="text" class="textbox" name="mileage" id="imileage" value="<?php echo $car->getCarMileage();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Body Type");?></td>
                <td>
                	<select name="bodytype" id="ibodytype" class="selection">
                    <?php
						$q_body_type = getResultSet("SELECT body_id, name FROM tbl_body_type");
						echo '<option value="'.$car->getCarBodyTypeID().'">'.$car->getCarBodyType().'</option>';
						while($rm=mysql_fetch_array($q_body_type)){
							$body_id = $rm['body_id'];
							$name = $rm['name'];
							if($car->getCarBodyTypeID()!=$body_id){
								echo "<option value='".$body_id."'>".$name."</option>";	
							}
						}
					?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Steering");?></td>
                <td>
                	<select name="steering"  id="isteering" class="selection">
                    	<option value="<?php echo $car->getCarSteering();?>"><?php echo $car->getCarSteering();?></option>
                    	<option value="<?php echo $rLanguage->text("Left");?>"><?php echo $rLanguage->text("Left");?></option>
                        <option value="<?php echo $rLanguage->text("Right");?>"><?php echo $rLanguage->text("Right");?></option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Number of Seat");?></td>
                <td><input type="text" class="textbox" name="noseat" id="inoseat" value="<?php echo $car->getCarNoSeat();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Number of Door");?></td>
                <td><input type="text" class="textbox" name="nodoor" id="inodoor" value="<?php echo $car->getCarNoDoor();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Label Number");?></td>
                <td><input type="text" class="textbox" name="labelnumber" id="ilabelnumber" value="<?php echo $car->getCarLabelNumber();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Fuel Type");?></td>
                <td>
                    <select name="fueltype" id="ifueltype" class="selection">
                    	<option value="<?php echo $car->getCarFuelType();?>"><?php echo $car->getCarFuelType();?></option>
                    	<option value="<?php echo $rLanguage->text("Gasoline");?>"><?php echo $rLanguage->text("Gasoline");?></option>
                        <option value="<?php echo $rLanguage->text("Diesel");?>"><?php echo $rLanguage->text("Diesel");?></option>
                        <option value="<?php echo $rLanguage->text("Gas");?>"><?php echo $rLanguage->text("Gas");?></option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Wheel Drive");?></td>
                <td>
                	<select name="drive" id="idrive" class="selection">
                    	<option value="<?php echo $car->getCarDrive();?>"><?php echo $car->getCarDrive();?></option>
                    	<option value="<?php echo $rLanguage->text("4WD");?>"><?php echo $rLanguage->text("4WD");?></option>
                        <option value="<?php echo $rLanguage->text("Front");?>"><?php echo $rLanguage->text("Front");?></option>
                        <option value="<?php echo $rLanguage->text("Rear");?>"><?php echo $rLanguage->text("Rear");?></option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Transmission");?></td>
                <td>
                    <select name="transmission" id="itransmission" class="selection">
                    	<option value="<?php echo $car->getCarTransmission();?>"><?php echo $car->getCarTransmission();?></option>
                    	<option value="<?php echo $rLanguage->text("Automatic");?>"><?php echo $rLanguage->text("Automatic");?></option>
                        <option value="<?php echo $rLanguage->text("Manual");?>"><?php echo $rLanguage->text("Manual");?></option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Engine Size");?></td>
                <td><input type="text" class="textbox" name="enginesize" id="ienginesize" value="<?php echo $car->getCarEngineSize();?>"/></td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Picture");?></td>
                <td>
                	<input type="file" name="carpicture" id="icarpicture"/>
                	<input type="hidden" value="2000000" name="MAX_FILE_SIZE" />
                </td>
            </tr>
            <tr>
            	<td class="label"><?php echo $rLanguage->text("Price").'(USD)';?></td>
                <td><input type="text" class="textbox" name="price" id="iprice" value="<?php echo $car->getCarPriceNumberOnly();?>"/></td>
            </tr>
            <tr>
            	<td class="label" valign="top"><?php echo $rLanguage->text("Car Description");?></td>
                <td>
					<textarea name="description" id="idescription" style="width: 198px;"><?php echo str_replace('<br />','',$car->getCarDescription());?></textarea>                
                </td>
            </tr>
            <tr>
            	<td class="label"></td>
                <td>
                    <input type="button" name="btn_update" id="ibtn_update" value="<?php echo $rLanguage->text("Update");?>" onclick="submitCarEdit();" />
                	<input type="button" name="cancel" id="icancel" value="<?php echo $rLanguage->text("Cancel");?>" onclick="goBack()"/>
                </td>
            </tr>
        </table>
    </td>
    	<td valign="top">
        	<div class="activeBlock">
            	<?php 
					if($car->getCarActivate()==1){
						echo '<input type="checkbox" name="active" value="1" checked>Activate';
					}
					else{
						echo '<input type="checkbox" name="active" value="1">Activate';
					}
				?>
        	</div>
        	
			<div class="statusBlock">
            	<fieldset>
                	<legend>Status</legend>
                    <div class="statusText">
                <?php
					if($car->getCarStatusValue()==0){
						echo '
						<input type="radio" name="status" value="0" checked>Normal<br>
						<input type="radio" name="status" value="1">New<br>
						<input type="radio" name="status" value="2">Sold
						';
					}
					elseif($car->getCarStatusValue()==1){
						echo '
						<input type="radio" name="status" value="0">Normal<br>
						<input type="radio" name="status" value="1" checked>New<br>
						<input type="radio" name="status" value="2">Sold
						';
					}
					elseif($car->getCarStatusValue()==2){
						echo '
						<input type="radio" name="status" value="0">Normal<br>
						<input type="radio" name="status" value="1">New<br>
						<input type="radio" name="status" value="2" checked>Sold
						';
					}
				?>
                    <!--<input type="radio" name="status" value="3" checked>Hide-->
                    <div>
                </fieldset>
        	</div>
	</form>
        </td>
    </tr>
</table>
</div>
</div>

<script type="text/javascript">
	function submitCarEdit(){
		if(file_validation('icarpicture')==true){
    		$('form#iform_caredit').submit();
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