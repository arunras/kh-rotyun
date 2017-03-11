<?php
	/*echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/jquery.min.js" charset="UTF-8"></script>';*/
	//Star Rating
	/*
	echo '<script type="text/javascript" charset="utf-8" src="'.HTTP_DOMAIN.'application/starrating/js/prototype.js"></script>';
	echo '<script type="text/javascript" charset="utf-8" src="'.HTTP_DOMAIN.'application/starrating/js/stars.js"></script>';
	*/
	//Map
	echo '<link type="text/css" rel="stylesheet" href="'.HTTP_DOMAIN.'application/map/css/map.css" />';
    echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>';
	/*
	require_once($_SERVER['DOCUMENT_ROOT'] . "/". ROOT. "/application/map/js/map_store.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/". ROOT. "/application/store/store.class.php");
	*/
	require_once(dirname(dirname((__FILE__))). "/application/map/js/map_store.php");
	require_once(dirname(dirname((__FILE__))). "/application/store/store.class.php");
?>
<?php
/*For paramet normal
$store_id = $_GET['id'];
*/
$store_id = getValue("SELECT store_id FROM tbl_store WHERE storeurl='".$_GET['id']."'");
$store = new store($store_id);
if(isset($_GET['car'])){
	$car_id = $_GET['car'];
	$car = new car($car_id);
}
if($store->getUserActive()==0){
	header("Location: ".HTTP_DOMAIN);	
}
?>

<script type="text/javascript">
//Facebook Share
function fbs_click(){
	u=location.href;
	t=document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
	return false;
}
function check_commenttext(){
	var text= document.getElementById('imyComment').value;
	if(text.length<10){
		alert("Comment text must greater than 10 characters!");
		document.getElementById('imyComment').focus();
		return false;
	}
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

//Map
function PopupCenter(pageURL, title,w,h) {
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h/2);
	var targetWin = window.open (pageURL, title, 'toolbar=no, l qocation=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
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
        	<?php $store->showStoreDetail();?>
        </div>
        <!--
        <div class="product_description">
        	<div class="label"><?php echo $rLanguage->text("Store Description");?></div>
            <div class="desc">
            	<?php echo $store->getStoreDescription(); ?>
            </div>
        </div>
        -->
        <table border="0" width="100%">
        	<tr>
            	<td width="20%" valign="top">
              		<div class="product_description" style="border: 0px #F00 solid;">
                        <div class="label"><?php echo $rLanguage->text("Search");?></div>
                        <div class="desc">
                        	<input type="text" class="store_txtsearch" id="istore_txt_search" name="store_search" placeholder="<?php echo $rLanguage->text("Search") ?>" onkeypress="searchStoreKeyPress(event);"/>
                            <input type="button" class="store_btnsearch" id="istore_btn_search" value="" onclick="searchStoreProduct(<?php echo "'".$store_id."'"; ?>)"/>
                            <!--
                            <div class="store_btnsearch"></div>
                            -->
                        </div>
                    </div>
                    <div class="product_description" style="border: 0px #F00 solid;">
                        <!--<div class="label"><?php echo $rLanguage->text("Category List");?></div>-->
                        <div class="desc">
                        	<?php require_once(dirname(dirname(__FILE__)) .'/include/store_list_category.php');?>
                        </div>
                        <!--Map--
                        <div id="myMAP" style="border: 2px #F00 solid;">
                        	<div id="map_canvas">
                            	MAP
                            </div>
                            <div style="display: none;">
                                <label for="ilatitude">Lat: </label>
                                <input type="text" id="ilatitude" name="latitude" value="<?php echo $store->getStoreMapLatitude(); ?>" readonly="readonly" placeholder="latitude"/>
                                <br />
                                <label for="ilongitute">Lng: </label>
                                <input type="text" id="ilongitude" name="longitude" value="<?php echo $store->getStoreMapLongitude();?>" readonly="readonly" placeholder="longitude"/>
                            </div>
                            <a href="javascript:void(0);" onclick="PopupCenter('<?php echo HTTP_DOMAIN.'include/map_popup.php?lat='.$store->getStoreMapLatitude().'&lon='.$store->getStoreMapLongitude().'&storeid='.$store_id;?>', 'myPop1',1000,700);"><?php echo $rLanguage->text("View Large");?></a>
                    	</div>
                        --Map-->
                        <!--
                        <div class="label"></div>
                        -->
                    </div>  
                </td>
                <td  class="store_listproduct" width="80%" align="center" valign="top">
                	<div class="label">
						<?php 
							echo $rLanguage->text("Product");
							if($store->getStoreOwnerID()==getCurrentUser()){
								echo '<a href="'.HTTP_DOMAIN.$store->getStoreURL().'?page=caradd&storeid='.$store_id.'">
									<span style="float: right;">'.$rLanguage->text("New Car").'</span>
								</a>';
							}
						?>
                   	</div>
                	<?php 
						if(isset($_GET['make'])){
							$make = $_GET['make'];
						}
						if(isset($_GET['body'])){
							$body = $_GET['body'];
						}
						if(isset($_GET['price_from']) && isset($_GET['price_to'])){
							$price_from = $_GET['price_from'];
							$price_to = $_GET['price_to'];
						}
						if(isset($_GET['q'])){
							$keyword = $_GET['q'];	
						}
						if(isset($_GET['cat'])){
							$cat = $_GET['cat'];
							if($cat=='all'){
								$store->showStoreProductByAll();	
							}
							if($cat=='make'){
								$store->showStoreProductByMake($make);	
							}
							if($cat=='other'){
								$store->showStoreProductByOther($make);
							}
							if($cat=='body'){
								$store->showStoreProductByBodyType($body);	
							}
							if($cat=='price'){
								$store->showStoreProductByPrice($price_from, $price_to);	
							}
							if($cat=='q'){
								$store->showStoreProductByKeyWord($keyword);	
							}
						}
					?>
                </td>
            </tr>
        </table>
    </div>
    </div>
</div>