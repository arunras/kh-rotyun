<?php
ob_start();
if(!isset($_SESSION))session_start();
/*
* This class is used to design and access to database for tbl_performer
* Creator: Rith Phearun
* Date Created: Oct-01-2011
*/
class car{
	private $car_id;
	private $car_code;
	private $car_model;
    private $car_name;
	private $car_picture;
	private $car_price;
    private $car_description;
	private $car_category;
	private $car_manufaturer;
	private $car_color;
	private $car_released_year;
	private $car_mileage;
	private $car_body_type;
	private $car_steering;
	private $car_transmission;
	private $car_drive;
	private $car_engine_size;
	private $car_seller_comment;
	private $car_created;
	private $car_modified;
	private $car_status;
	private $car_statusdate;

	private $store_name;
	private $picture_path;
	private $no_img;
	
	
    public function __construct($id = ""){
            $this->car_id = $id;
			$this->car_code = '';
			$this->car_model = '';
			$this->car_name = '';
			$this->car_picture = '';
			$this->car_price = '';
			$this->car_description = '';
			$this->car_category = '';
			$this->car_manufaturer = '';
			$this->car_color = '';
			$this->car_released_year = '';
			$this->car_mileage = '';
			$this->car_body_type = '';
			$this->car_steering = '';
			$this->car_transmission = '';
			$this->car_drive = '';
			$this->car_engine_size = '';
			$this->car_seller_comment = '';
			$this->car_created = '';
			$this->car_modified = '';
			$this->car_status = '';
			$this->car_statusdate = '';
		
			$this->store_name = '';
			$this->picture_path = 'images/content/car/';
    }
	
	private function getLanguageId(){
		if($_COOKIE['language']=="en"){return 1;}
		elseif($_COOKIE['language']=="kh"){return 2;}
    }
	
    private function initDb(){
    	require_once(dirname(dirname(dirname(__FILE__))). "/module/module.php");
    }
/*==GET from DB=============================================================================================================*/
	//get Car code
	//get car_Name
	public function getCarCode(){
			$this->car_code = getValue("SELECT car_code FROM tbl_car WHERE car_id=".$this->car_id);
			return $this->car_code;
	}
	//get car_Model
	public function getCarModel(){
		$this->car_model = getValue("SELECT model FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_model;	
	}
	//get car_Name
	public function getCarName(){
		$this->car_name = getResultSet("SET NAMES UTF8");
		$this->car_name = getValue("SELECT car_name FROM tbl_car_description WHERE car_id=".$this->car_id);
		return $this->car_name;	
	}
	//get car_Picture
	public function getCarPicture(){
		$this->car_picture = getValue("SELECT picture FROM tbl_car WHERE car_id=".$this->car_id);
		$img = HTTP_DOMAIN.$this->picture_path.$this->car_picture;
		$check_img = "images/content/car/".$this->car_picture;
		if (!file_exists($check_img)){
			$no_img = HTTP_DOMAIN.'images/content/car/noimage.jpg';
			return $no_img;
		}
		else{ return  $img;}
	}
	//get car_Picture
	public function getCarPictureThumb(){
		$this->car_picture = getValue("SELECT picture FROM tbl_car WHERE car_id=".$this->car_id);
		$img = HTTP_DOMAIN.$this->picture_path.'thumb/'.$this->car_picture;
		$img_exist = "images/content/car/thumb/".$this->car_picture;
		if (!file_exists($img_exist)){
			$no_img = HTTP_DOMAIN.'images/content/car/thumb/no_image.jpg';
			$no_picture = HTTP_DOMAIN.'images/content/car/noimage.jpg';
			$src = $this->getCarPicture();
			if($src != $no_picture)
			{
				$thumb_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/thumb/".$this->car_picture;
				createThumb($src, $thumb_path, 200);
				return $no_img;
			}
		}
		else{ return  $img;}
	}
	//get Product_Image
	public function getCarAllImage(){
		$no_car_img_thumb = HTTP_DOMAIN.'images/content/car/image_thumb/no_image.jpg';
		$CarAllImg = ''; 
		$q_carimage= getResultSet("SELECT car_image_id, image FROM tbl_car_image WHERE car_id=".$this->car_id);
		$link = '';
		while($ri=mysql_fetch_array($q_carimage)){
			$img_id = $ri['car_image_id'];
			$car_img = $ri['image'];
			$img = HTTP_DOMAIN.$this->picture_path.$car_img;
			$img_thumb = HTTP_DOMAIN.$this->picture_path.'image_thumb/'.$car_img;
			$check_img = "images/content/car/image_thumb/".$car_img;

			if(!file_exists($check_img)){
				$thumb_path = $_SERVER['DOCUMENT_ROOT']."/images/content/car/image_thumb/".$car_img;
				createThumb($img, $thumb_path, 40, 30);
				$img_thumb = $no_car_img_thumb;
			}

			if(($this->getCarOwnerID()==getCurrentUser() || getUserType()==ADMINISTRATOR) && isset($_GET['do'])){
				$link = '<a href="#" onclick="deleteCarImage('.$img_id.')">X</a>';
			}
			
			$CarAllImg = $CarAllImg.'<li><a href="'.$img.'" rel="prettyPhoto[gallery2]" title=""><img src="'.$img_thumb.'" width="40px" height="30px"/></a>'.$link.'</li> ';
		}
		return $CarAllImg;
	}
	//get car_Picture
	public function getCarPictureName(){
		$this->car_picturename = getValue("SELECT picture FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_picturename;
	}
	//get car PRICE
	public function getCarPrice(){
		$this->car_price = getValue("SELECT price FROM tbl_car WHERE car_id=".$this->car_id);
		if($this->car_price==0){return "N/A";}
		else{return number_format($this->car_price)." USD";}//Returns the number 1,234.57 number_format;
	}
	//get car PRICE
	public function getCarPriceNumberOnly(){
		$this->car_price = getValue("SELECT price FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_price;
	}
	//get car_Manufacturer_ID
	public function getCarManufacturerId(){
		$this->car_manufacturer_id = getValue("SELECT manufacturer_id FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_manufacturer_id;
	}
	//get car_Manufacturer_Name
	public function getCarManufacturer(){
		$this->car_manufacturer = getValue("SELECT name FROM tbl_manufacturer WHERE manufacturer_id=".$this->getCarManufacturerId());
		return $this->car_manufacturer;
	}
	//get car_released Year
	public function getCarReleasedYear(){
		$this->car_released_year = getValue("SELECT released_year FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_released_year;
	}
	//get car color
	public function getCarColor(){
		$this->car_color = getValue("SELECT color FROM tbl_car WHERE car_id=".$this->car_id);
		if($this->car_color==""){return 'N/A';}
		else{return $this->car_color;}
	}
	//get car mileage
	public function getCarMileage(){
		$this->car_mileage = getValue("SELECT mileage FROM tbl_car WHERE car_id=".$this->car_id);
		if($this->car_mileage==0){return 'N/A';}
		else{return $this->car_mileage;}
	}
	//get car body type
	public function getCarBodyTypeID(){
		$this->car_body_type = getValue("SELECT body_id FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_body_type;
	}
	//get car body type
	public function getCarBodyType(){
		$this->car_body_type = getValue("SELECT name FROM tbl_body_type WHERE body_id=".$this->getCarBodyTypeID());
		return $this->car_body_type;
	}
	//get car steering
	public function getCarSteering(){
		$this->car_steering = getValue("SELECT steering FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_steering;
	}
	//get car number of seat
	public function getCarNoSeat(){
		$this->car_no_seat = getValue("SELECT no_seat FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_no_seat;
	}
	//get car number of door
	public function getCarNoDoor(){
		$this->car_no_door = getValue("SELECT no_door FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_no_door;
	}
	//get car label number
	public function getCarLabelNumber(){
		$this->car_label_number = getValue("SELECT label_number FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_label_number;
	}
	//get car fuel type
	public function getCarFuelType(){
		$this->car_fuel_type = getValue("SELECT fuel_type FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_fuel_type;
	}
	//get car transmission
	public function getCarTransmission(){
		$this->car_transmission = getValue("SELECT transmission FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_transmission;
	}
	//get car drive
	public function getCarDrive(){
		$this->car_drive = getValue("SELECT drive FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_drive;
	}
	//get car engine size
	public function getCarEngineSize(){
		$this->car_engine_size = getValue("SELECT engine_size FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_engine_size;
	}
	//get car seller comment
	public function getCarSellerComment(){
		$this->car_seller_comment = getValue("SELECT seller_comment FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_seller_comment;
	}
	//get car video
	public function getCarVideo(){
		$this->car_video = getValue("SELECT video FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_video;
	}
	//get car video
	public function getCarDescription(){
		$this->car_desc = getValue("SELECT description FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_desc;
	}
	//get Car created date
	public function getCarCreated(){
		$this->car_created = getValue("SELECT CAST(created AS DATE) AS DATEONLY FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_created;
	}
	//get Car modified date
	public function getCarModified(){
		$this->car_modified = getValue("SELECT modified FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_modified;
	}
	//get Car status new/sold
	public function getCarStatus(){
		if($this->getCarStatusInterval()<=30){
			if($this->getCarStatusValue()==0){
				return '';		
			}
			elseif($this->getCarStatusValue()==1){
				return '<div class="alert_new"><img src="'.HTTP_DOMAIN.'images/layout/status_new.png"/></div>';		
			}
			elseif($this->getCarStatusValue()==2){
				return '<div class="alert_new"><img src="'.HTTP_DOMAIN.'images/layout/status_sold.png"/></div>';		
			}
		}
	}
	//get Car status new/sold
	public function getCarStatusForTitle(){
		if($this->getCarStatusInterval()<=30){
			if($this->getCarStatusValue()==0){
				return '';
			}
			elseif($this->getCarStatusValue()==1){
				return '<img src="'.HTTP_DOMAIN.'images/layout/status_new_title.png" style="margin-bottom: -5px;"/>';
			}
			elseif($this->getCarStatusValue()==2){
				return '<img src="'.HTTP_DOMAIN.'images/layout/status_sold_title.png" style="margin-bottom: -5px;" />';
			}
		}
	}
	//get Car status value
	public function getCarStatusValue(){
		$this->car_statusvalue = getValue("SELECT status FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_statusvalue;
	}
	//get Car status date
	public function getCarStatusDate(){
		$this->car_statusdate = getValue("SELECT CAST(status_date AS DATE) AS DATEONLY FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_statusdate;
	}
	//get Car status interval
	public function getCarStatusInterval(){
		$interval = calculate_days_between_dates($this->getCarStatusDate(), getToday());
		return $interval;
	}
	//get Car status sold expire
	public function getCarStatusSoldExpire(){
		if($this->getCarStatusValue()==2){
			if($this->getCarStatusInterval()>30){
				return true;	
			}
			else{
				return false;	
			}
		}
		else{
			return false;	
		}
	}
	//get Car Active
	public function getCarActivate(){
		$this->car_active = getValue("SELECT active FROM tbl_car WHERE car_id=".$this->car_id);
		return $this->car_active;
	}
	//Shop APP
	//get Shop ID
	public function getStoreId(){
		$this->store_id = getValue("SELECT store_id FROM tbl_car_to_store WHERE car_id = ".$this->car_id." AND store_id!=0");
		return $this->store_id;	
	}
	//get Shop Name
	public function getStoreName(){
		//$this->initDb();
		$this->store_name='';
		if($this->car_id !=0 && $this->getStoreId()!=''){
			$this->store_name =  getValue("SELECT name FROM tbl_store WHERE store_id=".$this->getStoreId());
		}
		return $this->store_name;	
	}
	//get Shop Name as Unique Name
	public function getStoreURL(){
		//$this->initDb();
		$this->store_url='';
		if($this->car_id !=0 && $this->getStoreId()!=''){
			$this->store_url =  getValue("SELECT storeurl FROM tbl_store WHERE store_id=".$this->getStoreId());
		}
		return $this->store_url;	
	}
	//get Store Telephone
	public function getStoreTelephone(){
		//$this->initDb();
		$this->store_telephone='';
		if($this->car_id !=0 && $this->getStoreId()!=''){
			$this->store_telephone =  getValue("SELECT telephone FROM tbl_store WHERE store_id=".$this->getStoreId());
		}
		return $this->store_telephone;
	}
	//get Store Email
//get Store_Email
	public function getStoreEmail(){
		//$this->initDb();
		if($this->store_id !=0){
			$this->store_email = getValue("SELECT email FROM tbl_store WHERE store_id=".$this->getStoreId());
		}
		return $this->store_email;
	}
	//get Owner ID
	public function getCarOwnerID(){
		//$this->initDb();
		$this->owner_id = 0;
		if($this->car_id !=0 && $this->getStoreId()!=''){
			$this->owner_id =  getValue("SELECT user_id FROM tbl_user_to_store WHERE store_id=".$this->getStoreId());
		}
		return $this->owner_id;	
	}
	
	//get Car Active
	public function getCarActive(){
		$this->active = getValue("SELECT active FROM tbl_user WHERE user_id=".$this->getCarOwnerID());
		
		if($this->active==0){return 0;}
		else{
			if($this->getCarActivate()==1){return 1;}
			elseif($this->getCarActivate()==0){
				if(getStoreOwnerUser($this->getStoreId())==true || getUserType()==ADMINISTRATOR){
					return 1;
				}	
				else{
					return 0;	
				}
			}
		}
	}
	//get Car Cout by Manufacturer
	public function getCountCarManufacturer(){
		$this->countManufacturer = getValue("SELECT active FROM tbl_user WHERE user_id=".$this->getCarOwnerID());
		return $this->countManufacturer;
	}
	//get Car Cout by Body Type
	public function getCountCarBody(){
		$this->countBody = getValue("SELECT active FROM tbl_user WHERE user_id=".$this->getCarOwnerID());
		return $this->countBody;
	}
	//get Car Cout by Price
	public function getCountCarPrice(){
		$this->countPrice = getValue("SELECT active FROM tbl_user WHERE user_id=".$this->getCarOwnerID());
		return $this->countPrice;
	}
/*==END GET from DB=============================================================================================================*/
/*==END DISPLAY=============================================================================================================*/
	//show car Detail
	//show Product Detail
	function showCarDetail(){
		$rLanguage =  CheckLanguageChange();
		/*$q_product_desc=getResultSet("SELECT product_id, model, image, price FROM ".DB_PREFIX."product WHERE product_id=".$product_id);*/		
		//echo '<meta name="title" content="'.$this->getCarModel().' - Cambodia-Auto" />';
		//echo '<meta name="description" content="'.$this->getCarPrice().', '.$this->getCarDescription().'. '.$this->getStoreName().'" />';
		
		echo '<link rel="image_src" href="'.$this->getCarPicture().'" />';
		echo '<table border="0" width="100%"><tr>';
			echo '<td width="300px"><div class="photo_view">';
				echo '<ul id="gallery" class="gallery clearfix" style="border: 0px #F00 solid;">';
					echo '<li><a href="'.$this->getCarPicture().'" rel="prettyPhoto[gallery2]" title=""><img src="'.$this->getCarPictureThumb().'" width="40px" height="30px"/></a></li> ';
					echo $this->getCarAllImage();
				echo '</ul>';
				if($this->getCarOwnerID()==getCurrentUser() || getUserType()==ADMINISTRATOR){
					echo '<a href="'.HTTP_DOMAIN.'?page=cardetail&car='.$this->car_id.'&do=edit_carimage">'.$rLanguage->text("Edit").'</a>';	
				}
			//echo '</div><a href="#">Add more</a>';
			//Upload images=======================================
			if($this->getCarOwnerID()==getCurrentUser() && isset($_GET['do'])){
			echo '			
			<form name="frm_carimage" action="'.HTTP_DOMAIN.'include/php_sub/r_carimageadd.php" method="post" onsubmit="return validate(this);" enctype="multipart/form-data">
				<input type="hidden" name="pgaction">
				<table align="center" border="0" width="100%" cellpadding="4" cellspacing="0" bgcolor="#EDEDED">	
					<tr class="txt">
						<td valign="top"><div id="dvFile"><input type="file" name="item_file[]"></div></td>
						<td valign="top" width="30px"><a href="javascript:_add_more();" title="Add more"><img src="images/layout/plus_icon.gif" border="0"></a></td>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="hidden" name="carid" value="'.$this->car_id.'"><input type="submit" value="Upload File"></td>
					</tr>
				</table>
			</form>';
			}
			//Upload images=======================================
			
			echo '</td>';
			echo '<td valign="top">';
				echo '<div class="product_desc">';
					echo '<div class="product_name">';
						echo $this->getCarModel();
						echo $this->getCarStatusForTitle();
						//echo '<img src="'.HTTP_DOMAIN.'images/layout/new.png" style="margin-bottom: -5px;"/>';
						
						//echo '<span style="float: left; margin-right: 5px;">'.$this->getCarStatus().'</span>';
					echo '</div>';	
					//href="#" link to store profile
					//echo '<div class="shop_name"><a href="?page=store&id='.$this->getStoreId().'&cat=all&car='.$this->car_id.'"><span class="bg_icon" style="background-image: url('.HTTP_DOMAIN.'images/icon/store_icon.png);">'.$this->getStoreName().'</span></a></div>';
// 					echo '<div class="shop_name"><span class="bg_icon" style="background-image: url('.HTTP_DOMAIN.'images/layout/store_icon.png);">'.$this->getStoreName().'</span></div>'; ========  Shop Name kongkea
					echo ' <div class="price"><span class="cost" style="background-image: url('.HTTP_DOMAIN.'images/layout/price_tag.png);">'.$this->getCarPrice().'</span></div>';
					
					
					
					//echo ' <div class="price"><span class="label">Price:</span><span class="cost"> $'.$this->getProductPrice().'</span></div>';
					//echo ' <div class="price"><span class="cost" style="background-image: url('.HTTP_DOMAIN.'images/layout/price_tag.png);">'.$this->getCarPrice().'</span></div>'; ====== Price kongkea
					//href="#" link to add to cart page of shop
					if($this->getCarDescription()!=''){
						echo '<div class="row" style="font-size: 14px; color: #245556;">'.$this->getCarDescription().'</div>';	
					}
					/*echo '<div class="row" style="height: 35px;">';
						echo '<table border="0" cellpadding="0" cellspacing="0">';
						$url_enc = urlencode(HTTP_DOMAIN.$this->getStoreURL()."?page=cardetail&car=".$this->car_id);
						
							echo '<tr>';
								$snsUrl = 'https://plus.google.com/share?url='.$url_enc;
								echo '<td>';
									echo '<a href="'.$snsUrl.'" onclick="return show_popup(\''.$snsUrl.'\')" target="_blank"><img  style ="border:none;margin-right:5px;" src="'.HTTP_DOMAIN.'images/layout/gshare.png" title="share on g+"></a>';
								echo '</td>';
								echo '<td>';
						echo '<div style="padding-left: 0px;margin:0px;"><g:plusone size="medium" annotation="bubble" href="'.HTTP_DOMAIN.$this->getStoreURL().'?page=cardetail&car='.$this->car_id.'"></g:plusone></div>';
								echo '</td>';
								echo '<td>';
						echo '<div style="margin-bottom: 10px;"><a class="facebook fb-share-button" href="http://www.facebook.com/share.php?u='.$url_enc.'" onclick="return fbs_click()" target="_blank"><span>Share</span></a></div>';
								echo '</td>';
								echo '<td>';
                    	echo '<div class="fb-like" data-href="'.HTTP_DOMAIN.$this->getStoreURL().'?page=cardetail&car='.$this->car_id.'" data-send="false" data-layout="button_count" data-width="30" data-show-faces="false" data-font="tahoma" style="width: 80px;margin: 0px 0px 8px 2px;"></div>';
								echo '</td>';
							echo '</tr>';
														
						echo '</table>';
                    echo '</div>';        */            
                   
                    //echo '<div class="shop_name"><span class="bg_icon">Shop Name: '.$this->getStoreName().'</span></div>';
                    //echo '<div class="shop_name">'.$rLanguage->text("Store").':<a href="?page=store&id='.$this->getStoreId().'&cat=all&car='.$this->car_id.'">'.$this->getStoreName().'</a></div>';
                    
					echo '<div class="shop_name"><span style="font-size: 14px;color: #245556;">'.$rLanguage->text("Store").': </span><a href="'.$this->getStoreURL().'?&car='.$this->car_id.'">'.$this->getStoreName().'</a></div>';
                    if($this->getStoreTelephone()!='' && $this->getStoreEmail()!=''){
                    echo '<div class="row" style="font-size: 14px; border: 0px #F00 solid; padding-top: -5px; color:  #245556;">';
                    	echo '<table border="0" width="100%" style="margin-bottom: 0px;">';
							if($this->getStoreTelephone()!=''){
							echo '<tr>';
                    			echo '<td style="width: 65px; vertical-align: top;">'.$rLanguage->text("Phone").':</td>';
                    			echo '<td><b>'.$this->getStoreTelephone().'</b></td>';
                    		echo '</tr>';	
							}
							if($this->getStoreEmail()!=''){
							echo '<tr>';
                    			echo '<td>'.$rLanguage->text("E-mail").':</td>';
                    			echo '<td>'.$this->getStoreEmail().'</td>';
                    		echo '</tr>';	
							}
                    		//echo '<div>'.$rLanguage->text("Phone").': '.$this->getStoreTelephone().' +855 999999 +855 999999 +855 999999 +855 999999</div>';
                    		//echo '<div>'.$rLanguage->text("E-mail").'&nbsp;: '.$this->getStoreEmail().'</div>';
                    echo '</table>';
                    echo '</div>';
					}
                    
                    echo '<div class="price"><span class="main_desc">'.$rLanguage->text("When contact us, please mention this car's code").'​​ <b>'.$this->getCarCode().'</b></span></div>';
					/*
					echo '<div class="row" style="height: 37px;"><a href="?page=store&id='.$this->getStoreId().'&cat=all&car='.$this->car_id.'" style="text-decoration:none;" class="contact_labe"><span class="btn">|| Contact Seller</span></a>'; 
						if($this->getCarOwnerID()==getCurrentUser()){
							echo '<span style="float: right;"><a href="'.HTTP_DOMAIN.'?page=caredit&car='.$this->car_id.'">'.$rLanguage->text("Edit").'</a></span>';	
						}
					echo '</div>';
					*/
					if($this->getLanguageId()==1){
						/*
						echo '<div class="row" style="text-align: left; height: 65px; padding: 10px 10px 20px 80px;"><a href="'.$this->getStoreURL().'?&car='.$this->car_id.'" style="text-decoration:none;"><img src="'.HTTP_DOMAIN.'images/layout/btn_gotostore_en.png" style="border: none; margin-left: 25px; width: auto;"></img></a>';
						*/
						echo '<div class="row" style="height: 65px;"><a href="'.$this->getStoreURL().'?car='.$this->car_id.'" style="text-decoration:none;"><div class="btn_gotostore_en"></div></a>';
					}
					elseif($this->getLanguageId()==2){
						/*
						echo '<div class="row" style="text-align: left; height: 65px; padding: 10px 10px 20px 80px;"><a href="'.$this->getStoreURL().'?car='.$this->car_id.'" style="text-decoration:none;"><img src="'.HTTP_DOMAIN.'images/layout/btn_gotostore_en" style="border: none; margin-left: 25px; width: auto;"></img></a>';	
						*/
						echo '<div class="row" style="height: 65px;"><a href="'.$this->getStoreURL().'?car='.$this->car_id.'" style="text-decoration:none;"><div class="btn_gotostore_kh"></div></a>';	
					}
						if($this->getCarOwnerID()==getCurrentUser() || getUserType()==ADMINISTRATOR){
							echo '<span style="float: right;"><a href="'.HTTP_DOMAIN.$this->getStoreURL().'?page=caredit&car='.$this->car_id.'">'.$rLanguage->text("Edit").'</a></span>';	
						}
					echo '</div>';
					
					/*
					echo '<div class="row shop_name" style="font-size: 12px;"><a href="?page=store&id='.$this->getStoreId().'&product='.$this->car_id.'"><span style="background-image: url('.HTTP_DOMAIN.'images/icon/info.png);background-position: 0px center; background-repeat: no-repeat; padding: 2px 2px 2px 20px; border:0px #F00 solid; font-size: 12px;">'.$rLanguage->text("About Store").'</span></a></div>';
					*/
				echo '</div>';
			echo '</td>';
		echo '</tr></table>';
	}
	//get Car Description
	public function getCarMoreDetail(){
		$rLanguage =  CheckLanguageChange();
		echo '<div class="CAR_DESC">';
		echo '<table  border="0" width="100%" style="margin-bottom: 10px;">';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("ID").'</td>';
				echo '<td class="desc_value" colspan="3" style="font-weight: bold;">'.$this->getCarCode().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Model").'</td>';
				echo '<td class="desc_value">'.$this->getCarModel().'</td>';
				echo '<td class="desc_label">'.$rLanguage->text("Manufacturer").'</td>';
				echo '<td class="desc_value">'.$this->getCarManufacturer().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Released year").'</td>';
				echo '<td class="desc_value">'.$this->getCarReleasedYear().'</td>';
				echo '<td class="desc_label">'.$rLanguage->text("Color").'</td>';
				echo '<td class="desc_value">'.$this->getCarColor().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Mileage").'</td>';
				echo '<td class="desc_value" colspan="3" style="text-align:center; font-size:20px; font-style:bold;">'.$this->getCarMileage().'</td>';
			echo '</tr>';
		echo '</table>';
		
		echo '<table  border="0" width="100%" style="margin-bottom: 10px;">';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Body Type").'</td>';
				echo '<td class="desc_value">'.$this->getCarBodyType().'</td>';
				echo '<td class="desc_label">'.$rLanguage->text("Steering").'</td>';
				echo '<td class="desc_value">'.$this->getCarSteering().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Number of Seat").'</td>';
				echo '<td class="desc_value">'.$this->getCarNoSeat().'</td>';
				echo '<td class="desc_label">'.$rLanguage->text("Number of Flate").'</td>';
				echo '<td class="desc_value">'.$this->getCarLabelNumber().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Number of Door").'</td>';
				echo '<td class="desc_value" colspan="3">'.$this->getCarNoDoor().'</td>';
			echo '</tr>';
		echo '</table>';
		
		echo '<table  border="0" width="100%" style="margin-bottom: 0px;">';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Fuel Type").'</td>';
				echo '<td class="desc_value">'.$this->getCarFuelType().'</td>';
				echo '<td class="desc_label">'.$rLanguage->text("Wheel Drive").'</td>';
				echo '<td class="desc_value">'.$this->getCarDrive().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Transmission").'</td>';
				echo '<td class="desc_value">'.$this->getCarTransmission().'</td>';
				echo '<td class="desc_label">'.$rLanguage->text("Engine Size").'</td>';
				echo '<td class="desc_value">'.$this->getCarEngineSize().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label"  style="padding-top: 6px;">'.$rLanguage->text("Price").'</td>';
				echo '<td class="desc_value" colspan="3" style="text-align:center; font-size:20px; font-style:bold;">'.$this->getCarPrice().'</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class="desc_label">'.$rLanguage->text("Car Description").'</td>';
				echo '<td class="desc_value" colspan="3">'.$this->getCarDescription().'</td>';
			echo '</tr>';
			echo '<tr>';
				//echo '<td class="desc_label">Car Photos</td>';
				echo '<td class="desc_value" colspan="4">';
//Car Photos===============================================================================================
					echo $this->showCarPhoto();					
//Car Photos===============================================================================================
				echo '</td>';
			echo '</tr>';
		echo '</table>';
		echo '</div>';
 		echo '<div style="float: right; border: 0px solid;">';
		$url_enc = urlencode(HTTP_DOMAIN.$this->getStoreURL()."?page=cardetail&car=".$this->car_id);

 			echo'<div style="border: 0px #4df solid; width: 170px; float: left; margin: 2px 5px 0 0">';		
 			$snsUrl = 'https://plus.google.com/share?url='.$url_enc;
 			echo '<a href="'.$snsUrl.'" onclick="return show_popup(\''.$snsUrl.'\')" target="_blank"><img  style ="border:none;" src="'.HTTP_DOMAIN.'images/layout/gshare.png" title="share on g+" ></a> ';	
 			echo'<div class="g-plusone" data-size="tall"></div> ';
 			$snsUrl = 'https://www.facebook.com/sharer/sharer.php?u='.$url_enc;
 			echo '<a href="'.$snsUrl.'" onclick="return show_popup(\''.$snsUrl.'\')" target="_blank"><img  style ="border:none;" src="'.HTTP_DOMAIN.'images/layout/fbshare_w.png" title="share on Facebook""></a> ';
 			echo '</div>';
		
 			echo '<div style="border: 0px #f00 solid; width:50px; float:left;">';
			echo' <div  style="border:0px solid; width: 50px;" class="fb-like" data-href="'.$url_enc.'" data-send="false" data-layout="box_count" data-width="55" data-show-faces="false"></div>';
			echo '</div>';
			echo'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
 			echo' <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="'.$url_enc.'">Tweet</a>';	
 		echo'</div>';
		
	}
	//Show Car Photos
	function showCarPhoto(){
		$q_carphoto= getResultSet("SELECT car_image_id, image FROM tbl_car_image WHERE car_id=".$this->car_id);
		$count = 0;
		echo '<table border="0" width="100%"><tr>';
		echo '<tr><td class="car_photo"><img src="'.$this->getCarPicture().'" /></td></tr>';
		while($rp=mysql_fetch_array($q_carphoto)){
			$car_id=$rp['car_image_id'];
			$car_photo = $rp['image'];
			$photo = HTTP_DOMAIN.$this->picture_path.$car_photo;
			
			if($count>0){echo '</tr><tr>'; $count=0;}
			echo '<td class="car_photo">';
				echo '<img src="'.$photo.'" />';
			echo '</td>';
			$count++;
		}
		echo '</tr></table>';
	}
/*==END Display=============================================================================================================*/	
}
?>