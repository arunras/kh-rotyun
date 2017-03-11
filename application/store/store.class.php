<?php
ob_start();
if(!isset($_SESSION))session_start();
    /*
    * This class is used to design and access to database for tbl_performer
    * Creator: Rith Phearun
    * Date Created: Oct-01-2011
    */
class store{
	private $store_id;
    private $store_name;
	private $picture_path;
	
	
    public function __construct($id = ""){
            $this->store_id = $id;
			$this->store_name = "";
			$this->picture_path = "images/content/store/";
    }

    private function initDb(){
    	require_once(dirname(dirname(dirname(__FILE__))) . "/module/module.php");
    }
/*==GET from DB=============================================================================================================*/
	//get Store owner Name
	public function getStoreOwner(){
		//$this->initDb();
		$this->store_name='';
		if($this->store_id !=0){
			$this->store_owner =  getValue("SELECT owner_name FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_owner;	
	}
	//get Category Name
	public function getStoreName(){
		//$this->initDb();
		$this->store_name='';
		if($this->store_id !=0){
			$this->store_name =  getValue("SELECT name FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_name;	
	}
	//get Category Unique Name as ID
	public function getStoreURL(){
		//$this->initDb();
		$this->store_url='';
		if($this->store_id !=0){
			$this->store_url =  getValue("SELECT storeurl FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_url;	
	}
	//get Store_Picture
	public function getStorePicture(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_picture = getValue("SELECT picture FROM tbl_store WHERE store_id=".$this->store_id);
		}

		$img = HTTP_DOMAIN.$this->picture_path.$this->store_picture;
		if(@fopen($img,'r')){ return  $img;}
		else{return HTTP_DOMAIN.$this->picture_path.'noimage.jpg';}
		/*
		if ($this->store_picture==''){return HTTP_DOMAIN.'application/store/store_picture/noimage.jpg';}
		else{ return  $img;}
		*/
	}
	//get Store_Picture
	public function getStorePictureName(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_picturename = getValue("SELECT picture FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_picturename;
	}
	//get Store_Address
	public function getStoreAddress(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_address = getValue("SELECT address FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_address;
	}
	//get Store_Phone
	public function getStoreTelephone(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_telephone = getValue("SELECT telephone FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_telephone;
	}
	//get Store_Email
	public function getStoreEmail(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_email = getValue("SELECT email FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_email;
	}
	//get Store_Email
	public function getStorePassword(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_password = getValue("SELECT password FROM tbl_user WHERE user_id=".$this->getStoreOwnerID());
		}
		return $this->store_password;
	}
	//get Store_Email
	public function getStoreOwnerID(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->user_id = getValue("SELECT user_id FROM tbl_user_to_store WHERE store_id=".$this->store_id);
		}
		return $this->user_id;
	}
	//get Check User Active
	public function getUserActive(){
		//$this->initDb();
		$this->active = 0;
		if($this->store_id !=0 && $this->getStoreOwnerID()!=0){
			$this->active = getValue("SELECT active FROM tbl_user WHERE user_id=".$this->getStoreOwnerID());
		}
		return $this->active;
	}
	//get Check User Active
	public function getUserGroupType(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->active = getValue("SELECT user_group_id FROM tbl_user WHERE user_id=".$this->getStoreOwnerID());
		}
		return $this->active;
	}
	//get Check User Active
	public function getUserEmail(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->user_email = getValue("SELECT email FROM tbl_user WHERE user_id=".$this->getStoreOwnerID());
		}
		return $this->user_email;
	}
	//get Shop URL
	public function getStoreWebsite(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_website = getValue("SELECT website FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_website;
	}
	//get Store_Description
	public function getStoreDescription(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_desc = getValue("SELECT description FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_desc;
	}
	//get Store_MAP_latitude
	public function getStoreMapLatitude(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_latitude = getValue("SELECT map_latitude FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_latitude;
	}
	//get Store_MAP_longitude
	public function getStoreMapLongitude(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_longitude = getValue("SELECT map_longitude FROM tbl_store WHERE store_id=".$this->store_id);
		}
		return $this->store_longitude;
	}
	//get Store Rate Average
	public function getStoreRate(){
		////$this->initDb();
		if($this->store_id !=0){
			$this->store_rate = getValue("SELECT AVG(store_rate_value) FROM ".DB_PREFIX."store_comment WHERE store_id=".$this->store_id);
		}
		return round($this->store_rate);	
	}
	public function getUserName($user_id){
		$user_firstname = getValue("SELECT firstname FROM ".DB_PREFIX."user WHERE user_id=".$user_id);
		$user_lastname = getValue("SELECT lastname FROM ".DB_PREFIX."user WHERE user_id=".$user_id);	
		$user_name = $user_firstname.' '.$user_lastname;
		return $user_name;
		
	}
/*==END GET from DB=============================================================================================================*/
/*==END DISPLAY=============================================================================================================*/
		//show Product Detail
	function showStoreDetail(){
		$rLanguage =  CheckLanguageChange();
		/*$q_product_desc=getResultSet("SELECT product_id, model, image, price FROM ".DB_PREFIX."product WHERE product_id=".$product_id);*/
		echo '<link rel="image_src" href="'.$this->getStorePicture().'" />';
		
		echo '<table border="0" width="100%"><tr>';
			echo '<td valign="top" style="border-right: 1px #CCC solid; padding: 0px; width: 210px;">';
				echo '<img src="'.$this->getStorePicture().'" style="width: 200px;" />';
			echo '</td>';
			echo '<td valign="top">';
				echo '<div class="product_desc" style="height: auto;max-width: 99%;">';
					echo '<div class="product_name">'.$this->getStoreName(); 
						if($this->getStoreOwnerID()==getCurrentUser() || getUserType()==ADMINISTRATOR){
							echo '<span style="float: right; font-size: 10px;"><a href="'.HTTP_DOMAIN.'?page=carmanagement&id='.$this->store_id.'">'.$rLanguage->text("Car Management").'</a>&nbsp;&nbsp;&nbsp;';
							echo '<span style="float: right; font-size: 10px;"><a href="'.HTTP_DOMAIN.'?page=storeedit&id='.$this->store_id.'">'.$rLanguage->text("Edit store").'</a>';
							if(getUserType()!=ADMINISTRATOR){
								echo '&nbsp;&nbsp;&nbsp;<a href="'.HTTP_DOMAIN.'?page=changepassword">'.$rLanguage->text("Change Password").'</a></span>';
							}
						}
					echo '</div>';
					
					echo '<div class="row" style="border: 0px #F00 solid;">';
						echo '<table border="0" width="100%">';
							echo '<tr>';
							echo '<td valign="top" width="280px">';
								echo '<div class="contact_info">';
								echo '<table border="0" width="100%">';
									if($this->getStoreAddress()!=''){
									echo '<tr>';
										echo '<td  class="label" valign="top">'.$rLanguage->text("Address").':</td>';
										echo '<td class="info"  valign="top">'.$this->getStoreAddress().'</td>';
									echo '</tr>';
									}
									if($this->getStoreEmail()!=''){
									echo '<tr>';
										echo '<td class="label">'.$rLanguage->text("E-mail").':</td>';
										echo '<td class="info">'.$this->getStoreEmail().'</td>';
									echo '</tr>';
									}
									if($this->getStoreTelephone()!=''){
									echo '<tr>';
										echo '<td class="label" style="padding-top: 5px;">'.$rLanguage->text("Phone").':</td>';
										echo '<td class="info" style="font-size:18px; font-weight: bold;">'.$this->getStoreTelephone().'</td>';
									echo '</tr>';
									}
									if($this->getStoreWebsite()!=''){
									echo '<tr>';
										echo '<td  class="label">'.$rLanguage->text("URL").':</td>';
										echo '<td class="info"><a href="'.$this->getStoreWebsite().'" style="font-size: 12px;" target="_new">'.cutString($this->getStoreWebsite(),26).'</a></td>';
									echo '</tr>';
									/*
									echo '<tr>';
										echo '<td  class="label"></td>';
										echo '<td class="info"><a href="'.$this->getStoreUrl().'" target="_new"><img src="'.HTTP_DOMAIN.'images/icon/btn_gotostore.png" style="border: none;"></img></a></td>';
									echo '</tr>';
									*/
									}
									echo '<tr>';
										echo '<td colspan="2">';
											echo '<div class="row" style="height: 33px;">';
													echo '<table border="0" cellpadding="0" cellspacing="0">';
													echo '<tr>';
													$url_enc = urlencode(HTTP_DOMAIN.$this->getStoreURL());
														//$snsUrl = 'https://plus.google.com/share?url='.HTTP_DOMAIN.$this->getStoreURL()."?page=store&id=".$this->store_id."&cat=all";
													$snsUrl = 'https://plus.google.com/share?url='.$url_enc;
														echo '<td>';
// 															echo '<a href="'.$snsUrl.'" onclick="return show_popup(\''.$snsUrl.'\')" target="_blank"><img  style ="border:none;margin-right:5px;" src="'.HTTP_DOMAIN.'images/layout/gshare.png" title="share on g+"></a>';
														echo '<a href="'.$snsUrl.'" onclick="return show_popup(\''.$snsUrl.'\')" target="_blank"><img  style ="border:none;margin-right:5px;" src="'.HTTP_DOMAIN.'images/layout/gshare.png" title="share on g+"></a>';
														echo '</td>';
														echo '<td>';
															echo '<div style="margin:0px; border: 0px #F00 solid; width: 60px;"><g:plusone size="medium" annotation="bubble" href="'.HTTP_DOMAIN.$this->getStoreURL().'?page=store&id='.$this->store_id.'&cat=all"></g:plusone></div>';
														echo '</td>';
														echo '<td>';
															echo '<div style="margin: 0px 0px 10px 2px;"><a class="facebook fb-share-button" href="http://www.facebook.com/share.php?u='.$url_enc.'" onclick="return fbs_click()" target="_blank"><span>Share</span></a></div>';
														echo '</td>';
														echo '<td>';
															echo '<div class="fb-like" data-href="'.HTTP_DOMAIN.$this->getStoreURL().'?page=store&id='.$this->store_id.'&cat=all" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="tahoma" style="width: 70px;margin: 0px 0px 8px 1px;"></div>';
														echo '</td>';
													echo '</tr>';
												echo '</table>';
											echo '</div>';
										echo '</td>';
									echo '</tr>';
								echo '</table>';
								echo '</div>';
							echo '</td>';
							echo '<td style="font-size: 12px; color: #333; width: 270px; vertical-align: top; padding-top: 5px;">';
								echo $this->getStoreDescription();
							echo '</td>';
							echo '<td valign="top" style="padding-top: 10px;">';
								//<!--Map-->
								echo '<div id="myMAP">';
									echo '<div id="map_canvas">';
										echo 'Map loading...';
									echo '</div>';
									echo '<div style="display: none;">';
										echo '<label for="ilatitude">Lat: </label>';
										echo '<input type="text" id="ilatitude" name="latitude" value="'.$this->getStoreMapLatitude().'" readonly="readonly" placeholder="latitude"/>
										<br />';
										echo '<label for="ilongitute">Lng: </label>';
										echo '<input type="text" id="ilongitude" name="longitude" value="'.$this->getStoreMapLongitude().'" readonly="readonly" placeholder="longitude"/>';
									echo '</div>';
									echo '<a href="http://maps.google.com.kh/maps?saddr=&daddr='.$this->getStoreMapLatitude().','.$this->getStoreMapLongitude().'('.$this->getStoreName().')" target="_new" style="float: right;">'.$rLanguage->text("Direction").'</a>';
									
									echo '<a href="javascript:void(0);" onclick="PopupCenter(\''.HTTP_DOMAIN.'include/map_popup.php?lat='.$this->getStoreMapLatitude().'&lon='.$this->getStoreMapLongitude().'&storeid='.$this->store_id.'\', \'myPop1\',1000,700);" style="float: left;">'.$rLanguage->text("View Large").'</a>';
								echo '</div>';
								//<!--Map-->								
							echo '</td>';
							echo '</tr>';
						echo '</table>';	
				echo '</div>';
					/*
					echo '<div class="row" style="height: 33px;">';
							echo '<table border="0" cellpadding="0" cellspacing="0">';
							echo '<tr>';
								echo '<td>';
						echo '<div class="fb-like" data-href="'.HTTP_DOMAIN.'?page=store&id='.$this->store_id.'&cat=all" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="tahoma" style="width: 80px;margin-bottom: 8px;"></div>';
                    	//echo '<div class="fb-like" data-href="'.HTTP_DOMAIN.'?page=store&id='.$this->store_id.'&car='.$_GET['car'].'" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="tahoma" style="width: 80px;margin-bottom: 8px;"></div>';
								echo '</td>';
								echo '<td>';
						echo '<div style="margin-bottom: 10px;"><a class="facebook fb-share-button" href="http://www.facebook.com/share.php?u='.HTTP_DOMAIN.'" onclick="return fbs_click()" target="_blank"><span>Share</span></a></div>';
								echo '</td>';
								echo '<td>';
						echo '<div style="padding-left: 10px;margin:0px;"><g:plusone size="medium" annotation="bubble" href="'.HTTP_DOMAIN.'?page=store&id='.$this->store_id.'&cat=all"></g:plusone></div>';
						//echo '<div style="padding-left: 10px;margin:0px;"><g:plusone size="medium" annotation="bubble" href="'.HTTP_DOMAIN.'?page=store&id='.$this->store_id.'&car='.$_GET['car'].'"></g:plusone></div>';
								echo '</td>';
							echo '</tr>';
						echo '</table>';
                    echo '</div>';
					*/
				echo '</div>';
			echo '</td>';
		echo '</tr></table>';
	}
	function showUserFeedback(){
		$q_ufeedback = getResultSet("SELECT comment_id, user_id, store_rate_value, comment_text, created_datetime FROM ".DB_PREFIX."store_comment WHERE store_id=".$this->store_id." ORDER BY comment_id DESC");
		while($rf=mysql_fetch_array($q_ufeedback)){
			$comment_id = $rf['comment_id'];
			$user_id = $rf['user_id'];
			$store_rate_value = $rf['store_rate_value'];
			$comment_text = $rf['comment_text'];
			$datetime = $rf['created_datetime'];
			
			echo '<div class="user_feedback">';
				if(getUserType()==ADMINISTRATOR  || getCurrentUser()==$user_id){
					//echo '<span id="ideletefeedback" class="delete_icon" onclick="delete_comment('.$comment_id.')">X</span>';
				}
				echo '<div class="name">';
					echo '<span>'.$this->getUserName($user_id).'<span>';
					echo '	<script type="text/javascript">
								var s5 = new Stars({
									maxRating: 5,
									value: '.$store_rate_value.',
									imagePath: "'.HTTP_DOMAIN.'application/starrating/images/feedback/",
									locked: true
								});		
							</script>';
				echo '</div>';
				echo '<div class="comment">'.$comment_text.'</div>';
				echo '<div class="datetime">'.$datetime.'</div>';
        	echo '</div>';	
		}
	}
	function showStoreProductByAll(){
		$q_product = getResultSet("SELECT car_id FROM tbl_car_to_store WHERE store_id=".$this->store_id." ORDER BY car_id DESC");
		
		$count = 0;
		//echo '<table border="1" width="100%"><tr>';
		while($rp=mysql_fetch_array($q_product)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			$name = $car->getCarModel();
			$price = $car->getCarPrice();
			$picture = $car->getCarPictureThumb();
			if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()==false){
				//if($count>3){echo '</tr><tr>'; $count=0;}
				/*
				echo '<td valign="top">';
					echo '<div class="item">';
						echo '<div class="frame">';
							echo '<a href="?page=cardetail&car='.$car_id.'">';
								echo '<img src="'.$picture.'" class="car_picture" width="150px"/>';
								echo $car->getCarStatus();
							echo '</a>';
						echo '</div>';
						echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
						echo '<div class="price">'.$price.'</div>';
					echo '</div>';
				echo '</td>';
				*/
					echo '<div class="item" style="display: inline-block;">';
						echo '<div class="frame">';
							echo '<a href="?page=cardetail&car='.$car_id.'">';
								echo '<img src="'.$picture.'" class="car_picture" width="150px"/>';
								echo $car->getCarStatus();
							echo '</a>';
						echo '</div>';
						echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
						echo '<div class="price">'.$price.'</div>';
					echo '</div>';
				$count++;
			}
			}
		}
		//echo '</tr></table>';
	}
	function showStoreProductByMake($make_id){
		$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id
									WHERE S.store_id=".$this->store_id." AND C.manufacturer_id=".$make_id." ORDER BY car_id DESC");
		
		$count = 0;
		//echo '<table border="0" width="100%"><tr>';
		while($rp=mysql_fetch_array($q_product)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			$name = $car->getCarModel();
			$price = $car->getCarPrice();
			$picture = $car->getCarPictureThumb();
			if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()==false){
				echo '<div class="item" style="display: inline-block;">';
					echo '<div class="frame">';
						echo '<a href="?page=cardetail&car='.$car_id.'">';
							echo '<img src="'.$picture.'" class="car_picture" width="150px"/>';
							echo $car->getCarStatus();
						echo '</a>';
					echo '</div>';
					echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
					echo '<div class="price">'.$price.'</div>';
				echo '</div>';
			}
			}
		}
		//echo '</tr></table>';
	}
	
	function showStoreProductByOther($make_id){
		$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id
									WHERE S.store_id=".$this->store_id." AND C.manufacturer_id NOT IN($make_id) ORDER BY car_id DESC");
		
		$count = 0;
		echo '<table border="0" width="100%"><tr>';
		while($rp=mysql_fetch_array($q_product)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			$name = $car->getCarModel();
			$price = $car->getCarPrice();
			$picture = $car->getCarPictureThumb();
			if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()==false){
				echo '<div class="item" style="display: inline-block;">';
					echo '<div class="frame">';
						echo '<a href="?page=cardetail&car='.$car_id.'">';
							echo '<img src="'.$picture.'" class="car_picture" width="150px"/>';
							echo $car->getCarStatus();
						echo '</a>';
					echo '</div>';
					echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
					echo '<div class="price">'.$price.'</div>';
				echo '</div>';
			}
			}
		}
		echo '</tr></table>';
	}
	
	
	function showStoreProductByBodyType($body_id){
		//$q_product = getResultSet("SELECT car_id FROM tbl_car_to_store WHERE store_id=".$this->store_id." AND body_id=".$body_id." ORDER BY car_id DESC");
		$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id
									WHERE S.store_id=".$this->store_id." AND C.body_id=".$body_id." ORDER BY car_id DESC");
		$count = 0;
		echo '<table border="0" width="100%"><tr>';
		while($rp=mysql_fetch_array($q_product)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			$name = $car->getCarModel();
			$price = $car->getCarPrice();
			$picture = $car->getCarPictureThumb();
			if($count>2){echo '</tr><tr>'; $count=0;}
			echo '<td valign="top">';
				echo '<div class="item">';
					echo '<a href="?page=cardetail&car='.$car_id.'">';
						echo '<img src="'.$picture.'" class="car_picture"  width="150px"/>';
						echo $car->getCarStatus();
					echo '</a>';
					echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
					echo '<div class="price">'.$price.'</div>';
				echo '</div>';
			echo '</td>';
			$count++;
		}
		echo '</tr></table>';
	}
	function showStoreProductByPrice($price_from, $price_to){
		//$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S WHERE store_id=".$this->store_id." AND price BETWEEN ".$price_from." AND ".$price_to." ORDER BY car_id DESC");
		$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id
									WHERE S.store_id=".$this->store_id." AND C.price BETWEEN ".$price_from." AND ".$price_to." ORDER BY car_id DESC");
		
		
		$count = 0;
		echo '<table border="0" width="100%"><tr>';
		while($rp=mysql_fetch_array($q_product)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			$name = $car->getCarModel();
			$price = $car->getCarPrice();
			$picture = $car->getCarPictureThumb();
			if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()==false){
				echo '<div class="item" style="display: inline-block;">';
					echo '<div class="frame">';
						echo '<a href="?page=cardetail&car='.$car_id.'">';
							echo '<img src="'.$picture.'" class="car_picture" width="150px"/>';
							echo $car->getCarStatus();
						echo '</a>';
					echo '</div>';
					echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
					echo '<div class="price">'.$price.'</div>';
				echo '</div>';
			}
			}
		}
		echo '</tr></table>';
	}
	function showStoreProductByKeyWord($keyword){
		//$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S WHERE store_id=".$this->store_id." AND price BETWEEN ".$price_from." AND ".$price_to." ORDER BY car_id DESC");
		$q_product = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id
									WHERE S.store_id=".$this->store_id." AND lower(C.model) LIKE '%$keyword%' OR lower(C.car_code) LIKE '%$keyword%' OR lower(description) LIKE '%$keyword%' ORDER BY car_id DESC");
		
		
		$count = 0;
		echo '<table border="0" width="100%"><tr>';
		while($rp=mysql_fetch_array($q_product)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			$name = $car->getCarModel();
			$price = $car->getCarPrice();
			$picture = $car->getCarPictureThumb();
			if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()==false){
				echo '<div class="item" style="display: inline-block;">';
					echo '<div class="frame">';
						echo '<a href="?page=cardetail&car='.$car_id.'">';
							echo '<img src="'.$picture.'" class="car_picture" width="150px"/>';
							echo $car->getCarStatus();
						echo '</a>';
					echo '</div>';
					echo '<div class="name"><a href="?page=cardetail&car='.$car_id.'">'.$name.'</a></div>';
					echo '<div class="price">'.$price.'</div>';
				echo '</div>';
			}
			}
		}
		echo '</tr></table>';
	}
/*==END Display=============================================================================================================*/
}
?>