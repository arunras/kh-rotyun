<?php
if(getUserType()!=ADMINISTRATOR){
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
<!--
		<style type="text/css" title="currentStyle">
			@import "application/datatable/media/css/demo_page.css";
			@import "application/datatable/media/css/demo_table_jui.css";
			@import "application/datatable/example/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
		</style>
		<script type="text/javascript" language="javascript" src="application/datatable/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="application/datatable/media/js/jquery.dataTables.js"></script>
-->
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
				
				/*
				$("input.showable").bind(!$.browser.msie ? "change" : "propertychange", function(){
//					alert($(this).val() + ";" +$(this).attr("checked"));
					var manufacturer_id = $(this).attr('id');
					if($(this).attr("checked")){
						showable_value = 1;
					}
					else{
						showable_value = 0;	
					}
					$.ajax({
						url: 'include/php_sub/r_manufacturershowable.php?manufacturerid='+ manufacturer_id +'&showablevalue=' + showable_value,
						success: function(data){
						}	
					});
				});
				*/
			} );
			
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
	<?php echo "Administration - ".$rLanguage->text("Manufacturer Management");?>
	<span style="float: right; font-size: 12px;"><a href="<?php echo HTTP_DOMAIN.'?page=administration';?>"><?php echo $rLanguage->text("Store Management");?></a></span>
</div>
<div class="CAR_REGISTRATION" style="height: 500px; padding-top: 0px;">
		<div style="text-align: right; border: 0px #F00 solid; padding: 2px 2px 2px 2px;"><a href="<?php echo HTTP_DOMAIN.'?page=manufactureradd';?>"><?php echo $rLanguage->text("New Manufacturer");?></a></div>
		<div id="container">
			<div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Manufacturer</th>
                            <th>Picture</th>
                            <th>Show</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php Administration();?>
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
function Administration(){
	$rLanguage = CheckLanguageChange();
	$q_manufacturer_id = getResultSet("SELECT manufacturer_id FROM tbl_manufacturer");
	$filePath = HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/';
	$i=1;
	while($rs=mysql_fetch_array($q_manufacturer_id)){
		$manufacturer_id = $rs['manufacturer_id'];
		$manufacturer = new manufacturer($manufacturer_id);
		echo '<tr class="gradeX">';
			echo '<td width="50px">'.$i.'</td>';
			echo '<td>'.$manufacturer->getManufacturerName().'</td>';
			echo '<td align="center"><img src="'.$filePath.$manufacturer->getManufacturerIconName().'" width="20px" height="20px"/></td>';
			echo '<td class="center">';

			if($manufacturer->getManufacturerShowable()==1){
				echo '<input type="checkbox" class="showable" id="'.$manufacturer_id.'" name="active" value="'.$manufacturer->getManufacturerShowable().'"  checked="checked" disabled="disabled" onchange="setShowable('.$manufacturer_id.')"/>';	
			}
			elseif($manufacturer->getManufacturerShowable()==0){
				echo '<input type="checkbox" class="showable" id="'.$manufacturer_id.'" name="active"  value="'.$manufacturer->getManufacturerShowable().'" disabled="disabled" onchange="setShowable('.$manufacturer_id.')"/>';	
			}
			
			echo '</td>';
			echo '<td class="center update">';
				echo '<a href="?page=manufactureredit&id='.$manufacturer_id.'">'.$rLanguage->text("Edit").'</a>&nbsp;&nbsp;';
				echo '<a href="#" onclick="deleteStore('.$manufacturer_id.')">'.$rLanguage->text("Delete").'</a>';
			echo '</td>';
		echo '</tr>';
		$i++;				
	}
}
?>