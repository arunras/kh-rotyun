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
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				oTable = $('#example').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
				//Set Active
				/*
				$("input.active").bind(!$.browser.msie ? "change" : "propertychange", function(){
//					alert($(this).val() + ";" +$(this).attr("checked"));
					var user_id = $(this).attr('id');
					if($(this).attr("checked")){
						active_value = 1;
					}
					else{
						active_value = 0;	
					}
					$.ajax({
						url: 'include/php_sub/r_activeuser.php?userid='+ user_id +'&activevalue=' + active_value,
						success: function(data){}	
					});
				})
				*/;
			} );
			
			
			function setActive(user_id){
				if($('input[type=checkbox]#'+user_id).attr("checked")){
					active_value = 1;
				}
				else{
					active_value = 0;	
				}
				$.ajax({
					url: 'include/php_sub/r_activeuser.php?userid='+ user_id +'&activevalue=' + active_value,
					success: function(data){}
				});
			}

			function deleteStore(){
				var isDelete = confirm("Are you sure you want to delete this?");	
				if(isDelete==true){	
					$.ajax({
						url: '',
						success: function(data){
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
	<?php echo "Administration - ".$rLanguage->text("Store Management");?>
	<span style="float: right; font-size: 12px;"><a href="<?php echo HTTP_DOMAIN.'?page=manufacturer';?>"><?php echo $rLanguage->text("Manufacturer Management");?></a></span>
</div>
<div class="CAR_REGISTRATION">
		<div id="container">
			<div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Shop Name</th>
                            <th>Owner</th>
                            <th>Email</th>
                            <th>Active</th>
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
	$q_store_id = getResultSet("SELECT store_id FROM tbl_store");
	$i=1;
	
	//$lang = $_SESSION['language_selected'];
	while($rs=mysql_fetch_array($q_store_id)){
		$store_id = $rs['store_id'];
		$store = new store($store_id);
		echo '<tr class="gradeX">';
			echo '<td width="50px">'.$i.'</td>';
			//echo '<td><a href="'.HTTP_DOMAIN.$lang.'/?page=store&id='.$store_id.'&cat=all">'.$store->getStoreName().'</a></td>';
			echo '<td><a href="'.HTTP_DOMAIN.$store->getStoreURL().'"><img src="'.$store->getStorePicture().'" width="16px" height="16px" style="margin: 0px 3px 0px 0px;vertical-align: text-bottom;"/>'.$store->getStoreName().'</a></td>';
			
			echo '<td>'.$store->getStoreOwner().'</td>';
			echo '<td>'.$store->getUserEmail().'</td>';
			echo '<td class="center">';			
				if($store->getUserGroupType()==2){
					echo '<input type="checkbox" class="active" disabled="disabled" id="'.$store->getStoreOwnerID().'" name="active" value="'.$store->getUserActive().'"  checked="checked"/>';	
					echo '<td class="center">';
						echo '<a href="?page=storeedit&id='.$store_id.'">'.$rLanguage->text("Edit").'</a>&nbsp;';
					echo '</td>';
					$i++;
					continue;
				}
				if($store->getUserActive()==1){
					echo '<input type="checkbox" class="active" id="'.$store->getStoreOwnerID().'" name="active" value="'.$store->getUserActive().'"  checked="checked" onchange="setActive('.$store->getStoreOwnerID().')"/>';	
				}
				elseif($store->getUserActive()==0){
					echo '<input type="checkbox" class="active" id="'.$store->getStoreOwnerID().'" name="active"  value="'.$store->getUserActive().'" onchange="setActive('.$store->getStoreOwnerID().')"/>';	
				}
			echo '</td>';
			echo '<td class="center update">';
				echo '<a href="?page=storeedit&id='.$store_id.'">'.$rLanguage->text("Edit").'</a>&nbsp;';
			echo '</td>';
		echo '</tr>';
		$i++;				
	}
}
?>