<?php
$store_id = $_GET['id'];
$store = new store($store_id);
if(getStoreOwnerUser($store_id)==false && getUserType()!=ADMINISTRATOR){
	header("Location: ".HTTP_DOMAIN);
}
?>
<?php
	echo '
		<style type="text/css" title="currentStyle">
			@import "'.HTTP_DOMAIN.'application/datatable/media/css/demo_page.css";
			@import "'.HTTP_DOMAIN.'application/datatable/media/css/demo_table_jui.css";
			@import "'.HTTP_DOMAIN.'application/datatable/example/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
        ';
		echo '<script type="text/javascript" language="javascript" src="'.HTTP_DOMAIN.'application/datatable/media/js/jquery.js"></script>';
		echo '<script type="text/javascript" language="javascript" src="'.HTTP_DOMAIN.'application/datatable/media/js/jquery.dataTables.js"></script>';
?>     
		<script type="text/javascript" charset="utf-8">
			//status_value = 0 for NORMAL
			//status_value = 1 for NEW
			//status_value = 2 for SOLD
			//status_value = 3 for HIDE
			$(document).ready(function() {
				oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});				
			} );
			function setCarActive(car_id){
				if($('input[type=checkbox]#active'+car_id).attr("checked")){
					active_value = 1;
				}
				else{
					active_value = 0;	
				}
				$.ajax({
					url: 'include/php_sub/car_update_active.php?carid='+ car_id +'&active=' + active_value,
					success: function(data){}
				});
			}
			function setCarStatusNew(car_id){
				if($('input[type=checkbox]#new'+car_id).attr("checked")){
					status_value = 1;
				}
				else{
					status_value = 0;	
				}
				$.ajax({
					url: 'include/php_sub/car_update_status.php?carid='+ car_id +'&statusvalue=' + status_value,
					success: function(data){}
				});
			}
			function setCarStatusSold(car_id){
				if($('input[type=checkbox]#sold'+car_id).attr("checked")){
					status_value = 2;
				}
				else{
					status_value = 0;
				}
				$.ajax({
					url: 'include/php_sub/car_update_status.php?carid='+ car_id +'&statusvalue=' + status_value,
					success: function(data){}
				});
			}
			
			function setShowable(manufacturer_id){
				if($('input[type=checkbox]#'+manufacturer_id).attr("checked")){
					showable_value = 1;
				}
				else{
					showable_value = 0;	
				}
				//alert(showable_value);
				$.ajax({
					url: 'include/php_sub/r_manufacturershowable.php?manufacturerid='+ manufacturer_id +'&showablevalue=' + showable_value,
					success: function(data){
					}	
				});
			}
			
			function deleteStore(manufacturer_id){
				var isDelete = confirm("Are you sure you want to delete this?");	
				if(isDelete==true){	
					$.ajax({
						url: 'include/php_sub/r_manufacturerdelete.php?manufacturerid='+ manufacturer_id,
						success: function(data){
							window.location.reload();
						}
					});
				}
			}
		</script>
<!--
<body id="dt_example">
-->
<div id="center_detail" style="border: 0px #F00 solid; min-height:500px;">
<div style="border-bottom: 1px #CCC solid; font-size: 20px;margin-bottom: 30px;">
	<?php echo '<a href="'.HTTP_DOMAIN.$store->getStoreURL().'">'.$store->getStoreName().'</a> - '.$rLanguage->text("Car Management");?>
</div>
<div class="CAR_REGISTRATION" style="height: 500px; padding-top: 0px;">
		<div style="text-align: right; border: 0px #F00 solid; padding: 2px 2px 2px 2px;"><a href="<?php echo HTTP_DOMAIN.'?page=caradd&storeid='.$store_id;?>"><?php echo $rLanguage->text("New Car");?></a></div>
		<div id="container">
			<div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <!--<th>Picture</th>-->
                            <th>Model</th>
                            <th>Car Code</th>
                            <th>Price</th>
                            <th>Manufacture</th>
                            <th>Active</th>
                            <th>Status New</th>
                            <th>SoldOut</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php CarManagement($store_id);?>
                    </tbody>
                </table>
			</div>
		</div>
</div>
</div>
<!--
</body>
-->

<?php
function CarManagement($sid){
	$rLanguage = CheckLanguageChange();
	$q_car = getResultSet("SELECT car_id FROM tbl_car_to_store WHERE store_id=".$sid." ORDER BY car_id DESC");
	$filePath = HTTP_DOMAIN.'application/car/car_picture/';
	$i=1;
	while($rc=mysql_fetch_array($q_car)){
		$car_id = $rc['car_id'];
		$car = new car($car_id);
		echo '<tr class="gradeX">';
			echo '<td width="40px">'.$i.'</td>';
			//echo '<td align="center" width="50px"><img src="'.$car->getCarPicture().'" width="30px" height="30px"/></td>';
			echo '<td class="model" width="300px"><a href="'.HTTP_DOMAIN.'?page=cardetail&car='.$car_id.'"><img src="'.$car->getCarPicture().'" width="30px" height="30px" align="center" style="margin-right:5px;"/>'.$car->getCarModel().'</a></td>';
			echo '<td width="100px">'.$car->getCarCode().'</td>';
			echo '<td align="left"​​​​​​​​​ width="100px" style="color: #F00;">'.$car->getCarPrice().'</td>';
			echo '<td align="center" width="200px">'.$car->getCarManufacturer().'</td>';
			
			echo '<td class="center">';			
				if($car->getCarActivate()==0){
					echo '<input type="checkbox" id="active'.$car_id.'" name="caractive"  value="'.$car->getCarActivate().'" onchange="setCarActive('.$car_id.')"/>';
				}
				elseif($car->getCarActivate()==1){
					echo '<input type="checkbox" id="active'.$car_id.'" name="caractive" value="'.$car->getCarActivate().'"  checked="checked" onchange="setCarActive('.$car_id.')"/>';
				}
			echo '</td>';
			
			echo '<td class="center">';			
				if($car->getCarStatusValue()==0 || $car->getCarStatusValue()==2){
					echo '<input type="checkbox" id="new'.$car_id.'" name="carstatus"  value="'.$car->getCarStatusValue().'" onchange="setCarStatusNew('.$car_id.')"/>';
				}
				elseif($car->getCarStatusValue()==1){
					echo '<input type="checkbox" id="new'.$car_id.'" name="carstatus" value="'.$car->getCarStatusValue().'"  checked="checked" onchange="setCarStatusNew('.$car_id.')"/>';
				}
			echo '</td>';
			echo '<td class="center">';			
				if($car->getCarStatusValue()==2){
					echo '<input type="checkbox" id="sold'.$car_id.'" name="carstatus" value="'.$car->getCarStatusValue().'"  checked="checked" onchange="setCarStatusSold('.$car_id.')"/>';	
				}
				elseif($car->getCarStatusValue()==0 || $car->getCarStatusValue()==1){
					echo '<input type="checkbox" id="sold'.$car_id.'" name="carstatus"  value="'.$car->getCarStatusValue().'" onchange="setCarStatusSold('.$car_id.')"/>';	
				}
			echo '</td>';
			echo '<td class="center update">';
				echo '<a href="?page=caredit&car='.$car_id.'">'.$rLanguage->text("Edit").'</a>&nbsp;&nbsp;';
				//echo '<a href="#" onclick="">'.$rLanguage->text("Delete").'</a>';
			echo '</td>';
		echo '</tr>';
		$i++;				
	}
}
?>