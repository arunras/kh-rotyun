<?php
$car_id = $_GET['car'];
$car = new car($car_id);
if($car->getCarActive()==0){
	header("Location: ".HTTP_DOMAIN);	
}
?>
<?php
/*echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/jquery.min.js" charset="UTF-8"></script>';*/
//<!--PhotoScrolling-->
echo '<link rel="stylesheet" type="text/css" href="'.HTTP_DOMAIN.'application/photoscroll/css/skin.css">';
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/photoscroll/js/jquery.jcarousel.min.js"></script>';
echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/carousel_relativecar.js"></script>';

//<!--PhotoViewer-->
echo '<link rel="stylesheet" charset="utf-8" type="text/css" href="'.HTTP_DOMAIN.'application/photoviewer/css/style.css" />';
echo '<script type="text/javascript" charset="utf-8" src="'.HTTP_DOMAIN.'application/photoviewer/js/jquery-foxiswitch-0.2.js"></script>';

//<!--Photo Popup-->
echo '<link rel="stylesheet" href="'.HTTP_DOMAIN.'application/photopopup/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />';
echo '<script src="'.HTTP_DOMAIN.'application/photopopup/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>';
?>


<script type="text/javascript">
$(document).ready(function(){
  //$('#gallery').foxiswitch({textPrev:'&lt; Previous', textNext:'Next &gt;', textPlay:'Start Diashow'});
  $('#gallery').foxiswitch({
		externalImages:true,
	  });

	//Photo Popup
	/*
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
	$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:5000, hideflash: true});
	*/
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',slideshow:5000, hideflash: true});
});

//Facebook Share
function fbs_click(){
	u=location.href;
	t=document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
	return false;
}
//Google Plus Button
<!-- Place this render call where appropriate -->
/*TEMP
(function() {
	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/plusone.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
*/


</script>
<!--end PhotoVier-->
<style type="text/css">
/**
 * Overwrite for having a carousel with dynamic width.
 */
.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 92%;
	border: none;
}
.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width: 100%;
    height: 200px;
}
</style>
<!--
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=287911227924206";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
-->
<div id="center_wrapper">
	<div id="detail_menubar">
		<?php require_once(dirname(dirname((__FILE__))).'/include/menu_navigator.php');?>
    </div>

    <div id="center_detail">
        <div class="top">
        	<?php $car->showCarDetail();?>
<!--=File Upload==============================================================================================================================-->     
<?php 
//function uploadForm() {
?>
<!--
<form name="frm" method="post" onsubmit="return validate(this);" enctype="multipart/form-data">
	<input type="hidden" name="pgaction">
	<?php //if ($GLOBALS['msg']) { echo '<center><span class="err">'.$GLOBALS['msg'].'</span></center>'; }?>
	<table align="center" cellpadding="4" cellspacing="0" bgcolor="#EDEDED">	
		<tr class="tblSubHead">
			<td colspan="2">Upload any number of file</td>
		</tr>
		<tr class="txt">
			<td valign="top"><div id="dvFile"><input type="file" name="item_file[]"></div></td>
			<td valign="top"><a href="javascript:_add_more();" title="Add more"><img src="images/icon/plus_icon.gif" border="0"></a></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" value="Upload File"></td>
		</tr>
	</table>
</form>
-->
<?php
//}
?>
<!--===============================================================================================================================-->
        </div>
        
        <div class="relativeproduct">
            <div class="label"><?php echo $rLanguage->text("Relative Car");?></div>
            <div class="gallery">
                <div class=" jcarousel-skin-tango">
                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block; padding-bottom: 0px;">
                        <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative; ">
                            <ul id="mycarousel" class="jcarousel-list jcarousel-list-horizontal">
                            <?php
								if($car->getCarManufacturerId()!=''){
									$q_relative_car = getResultSet("SELECT car_id FROM tbl_car ORDER BY car_id DESC");
								}
								$total = mysql_num_rows($q_relative_car);
								if($total==0){
									echo '<li class="item" style="border: none; display: none;">';
										echo '<img src="">';
                                        echo '<span class="product_name"></span>';
                                        echo '<span class="shop_name"></span>';
                                        echo '<span class="price"></span>';
									echo '</li>';
									echo '<span style="font-size:12px; color: #CCC;">No Relative product</span>';
								}
								while($rr=mysql_fetch_array($q_relative_car)){
									$carId = $rr['car_id'];
									$relative_car = new car($carId);
									if($carId !=$car_id){
									if($relative_car->getCarActive()!=0){
									if($relative_car->getCarStatusSoldExpire()!=true){
										echo '<li class="item">';
											echo '<div class="frame">';
												echo '<a href="'.$relative_car->getStoreURL().'?page=cardetail&car='.$carId.'">'; 
													echo '<img src="'.$relative_car->getCarPictureThumb().'" class="car_picture">';
													echo $relative_car->getCarStatus();
												echo '</a>';
											echo '</div>';
											echo '<span class="product_name"><a href="?page=productdetail&product='.$carId.'">'.$relative_car->getCarModel().'</a></span>';
											echo '<span class="price">'.$relative_car->getCarPrice().'</span>';
										echo '</li>';
									}
									}
									}
								}
							?>
                            </ul>
                        </div>
                        <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block; " disabled="false"></div>
                        <div class="jcarousel-next jcarousel-next-horizontal" style="display: block; " disabled="false"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="product_description">
        	<div class="label"><?php echo $rLanguage->text("Item Description");?></div>
            <div class="desc">
                <?php
					echo $car->getCarMoreDetail();
				?>
                <br clear="all" />
            </div>
        </div>
        
        <div class="product_review">
        	<div class="label"><?php echo $rLanguage->text("Product Review");?>(<span style="color: #3B5998;">Facebook</span>)</div>
            <div class="desc">
                <div class="fb-comments" data-href="<?php echo HTTP_DOMAIN.'?page=cardetail&car='.$car_id; ?>" data-num-posts="2" data-width="940"></div>
            </div>
        </div>
    </div>
</div>

<script language="javascript">
<!--
	function _add_more() {
		var txt = "<br><input type=\"file\" name=\"item_file[]\"><span onclick='deleteFileSelection()'>Delete</span>";
		document.getElementById("dvFile").innerHTML += txt;
		//document.getElementById("dvFile").appendChild(txt);
	}
	function deleteFileSelection(){
		alert($('span').html());
		//$(this).css('background-color', 'red');
	}
	function validate(f){
		var chkFlg = false;
		for(var i=0; i < f.length; i++) {
			if(f.elements[i].type=="file" && f.elements[i].value != "") {
				chkFlg = true;
			}
		}
		if(!chkFlg) {
			alert('Please browse/choose at least one file');
			return false;
		}
		f.pgaction.value='upload';
		return true;
	}
	function deleteCarImage(img_id){
		var base_url =  document.domain + window.location.pathname;	
		
		var isDelete = confirm("Are you sure you want to delete this?");	
		if(isDelete==true){	
			$.ajax({
				url: 'http://'+ base_url +'include/php_sub/car_delete_image.php?imgid=' + img_id,
				success: function(data){
					location.reload(true);
					//alert(data);
				}
			});
		}
	}
//-->
</script>