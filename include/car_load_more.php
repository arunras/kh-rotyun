<?php
$rLanguage = CheckLanguageChange();
if(isset($_GET['make']) && !isset($_GET['q'])){
	if($_GET['make']!=0 && $_GET['make']!='other'){
		getCarByMake($_GET['make']);
	}
	elseif($_GET['make']==0 && $_GET['make']!='other'){
		getCarAllmake();	
	}
	elseif($_GET['make']=='other'){
		getCarByMakeOther($_GET['ids']);
	}
}
elseif(!isset($_GET['make']) && !isset($_GET['q']) && !isset($_GET['body']) && !isset($_GET['price_frome']) && !isset($_GET['price_to'])  && !isset($_GET['liststore'])){
	getCarAllMake();
}
elseif(isset($_GET['make']) && isset($_GET['q'])){
	getCarByMakeSearch($_GET['make'], $_GET['q']);
}
//Filter by body type
if(isset($_GET['body'])){
	getCarByBody($_GET['body']);
}
//Filter by Price
if(isset($_GET['price_from']) && isset($_GET['price_to'])){
	getCarByPriceRange($_GET['price_from'], $_GET['price_to']);	
}
//List Store
if(isset($_GET['liststore'])){
	getListStore();
}
//get ALL Car
function getCarAllMake(){
	$last_car_id=$_GET['last_car_id'];
	$q_car_id=getResultSet("SELECT car_id FROM tbl_car WHERE car_id < $last_car_id ORDER BY car_id DESC LIMIT 10");
	$last_car_id="";
	$i = 0;
	$medium_index = 3;
	$big_index = 2;
	while($rp = mysql_fetch_array($q_car_id)){
		$car_id = $rp['car_id'];
		$car = new car($car_id);
		if($car->getCarActive()){
		if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()!=true){
			echo '<div class="item" style="width: 200px;" id="'.$car_id.'">';
				echo '<div class="desc">';
					echo '<div class="item_name" >'.$car->getCarModel().'</div>';
					echo '<div class="shop_name"><span style="padding: 5px 20px 5px 20px; background-image: url('.HTTP_DOMAIN.'images/layout/store.png);background-repeat: no-repeat;background-position: 0px center;">'.$car->getStoreName().'</span></div>';
					echo '<div class="price" >'.$car->getCarPrice().'</div>';
				echo '</div>';
				
				echo '<a href="?page=cardetail&car='.$car_id.'">';
				/*
				if($i%$big_index==0){echo '<img src="'.$product->getProductImage().'" style="width: 200px;">';}
				elseif($i%$medium_index==0){echo '<img src="'.$product->getProductImage().'" style="width: 300px;">';}
				else{ echo '<img src="'.$product->getProductImage().'" style="width: 100px;">';}
				*/
					echo '<div class="frame">';
						echo '<img src="'.$car->getCarPicture().'" style="width: 200px;" class="car_picture">';
						echo $car->getCarStatus();
					echo '</div>';
				echo '</a>';
			echo '</div>';
			//echo '</a>';
			$i++;
			}
		}
		}
	}
}

//get Car by Make
function getCarByMake($make){
	$q_car_id = getResultSet("SELECT car_id FROM tbl_car WHERE manufacturer_id=".$make);
	while($rp=mysql_fetch_array($q_car_id)){
		$car_id=$rp['car_id'];
		$car = new car($car_id);
		if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()!=true){			
			echo '<div class="item">';	
				echo '<div class="desc">';
					echo '<div class="item_name">'.$car->getCarModel().'</div>';
					echo '<div class="shop_name"><span style="padding: 5px 20px 5px 20px; background-image: url('.HTTP_DOMAIN.'images/layout/store.png);background-repeat: no-repeat;background-position: 0px center;">'.$car->getStoreName().'</span></div>';
					echo '<div class="price">'.$car->getCarPrice().'</div>';
				echo '</div>';
				echo '<a href="?page=cardetail&car='.$car_id.'">';
					//echo '<img src="'.$car->getCarPicture().'">';
					echo '<div class="frame">';
						echo '<img src="'.$car->getCarPicture().'" style="width: 200px;" class="car_picture">';
						echo $car->getCarStatus();
					echo '</div>';
	
				echo '</a>';
			echo '</div>';
			}
		}
	}
}
//get Car by Make OTHERS
function getCarByMakeOther($ids){
	//$q_make = getResultSet("SELECT manufacturer_id FROM tbl_manufacturer WHERE manufacturer_id NOT IN($ids)");
	$q_make = getResultSet("SELECT manufacturer_id FROM tbl_manufacturer WHERE manufacturer_id NOT IN($ids)");
	while($rm = mysql_fetch_array($q_make)){
		$manufacturer_id = $rm['manufacturer_id'];
		
		$q_car_id = getResultSet("SELECT car_id FROM tbl_car WHERE manufacturer_id=".$manufacturer_id);
		while($rp=mysql_fetch_array($q_car_id)){
			$car_id=$rp['car_id'];
			$car = new car($car_id);
			if($car->getCarActive()!=0){
				if($car->getCarStatusSoldExpire()!=true){			
				echo '<div class="item">';	
					echo '<div class="desc">';
						echo '<div class="item_name">'.$car->getCarModel().'</div>';
						echo '<div class="shop_name"><span style="padding: 5px 20px 5px 20px; background-image: url('.HTTP_DOMAIN.'images/layout/store.png);background-repeat: no-repeat;background-position: 0px center;">'.$car->getStoreName().'</span></div>';
						echo '<div class="price">'.$car->getCarPrice().'</div>';
					echo '</div>';
					echo '<a href="?page=cardetail&car='.$car_id.'">';
						//echo '<img src="'.$car->getCarPicture().'">';
						echo '<div class="frame">';
							echo '<img src="'.$car->getCarPicture().'" style="width: 200px;" class="car_picture">';
							echo $car->getCarStatus();
						echo '</div>';
					echo '</a>';
				echo '</div>';
				}
			}
		}		
	}
}

//get Product by make Search
function getCarByMakeSearch($make_id, $keyword){
	//$unix_product = array();
    $q_searchid = getValue("SELECT car_id FROM tbl_car WHERE car_code='$keyword'");
	if($q_searchid){
		header('Location:'.HTTP_DOMAIN.'?page=cardetail&car='.$q_searchid);
		exit();
	}
	
	$keyword=strtolower($keyword);
		if($make_id!=0){
			$q_car_id=getResultSet("SELECT DISTINCT(car_id) FROM tbl_car WHERE manufacturer_id=".$make_id." AND lower(model) LIKE '%$keyword%' OR lower(car_code) LIKE '%$keyword%' OR lower(description) LIKE '%$keyword%'");		
		}
		else{
			$q_car_id=getResultSet("SELECT DISTINCT(car_id) FROM tbl_car WHERE lower(model) LIKE '%$keyword%' OR lower(car_code) LIKE '%$keyword%' OR lower(description) LIKE '%$keyword%'");	
		}
		
								
		while($rp=mysql_fetch_array($q_car_id)){
			$car_id = $rp['car_id'];
			$car = new car($car_id);
			if($car->getCarActive()!=0){
				if($car->getCarStatusSoldExpire()!=true){			
				echo '<div class="item">';
					echo '<div class="desc">';
						echo '<div class="item_name" >'.$car->getCarModel().'</div>';
						echo '<div class="shop_name"><span style="padding: 5px 20px 5px 20px; background-image: url('.HTTP_DOMAIN.'store/image/icon/store.png);background-repeat: no-repeat;background-position: 0px center;">'.$car->getStoreName().'</span></div>';
						echo '<div class="price" >'.$car->getCarPrice().'</div>';
					echo '</div>';
					echo '<a href="?page=cardetail&car='.$car_id.'">';
						//echo '<img src="'.$car->getCarPicture().'">';
						echo '<div class="frame">';
							echo '<img src="'.$car->getCarPicture().'" style="width: 200px;" class="car_picture">';
							echo $car->getCarStatus();
						echo '</div>';
	
					echo '</a>';
				echo '</div>';
				}
			}
		}
}

//get Car by Make
function getCarByBody($body){
	$q_car_id = getResultSet("SELECT car_id FROM tbl_car WHERE body_id=".$body);
	while($rp=mysql_fetch_array($q_car_id)){
		$car_id=$rp['car_id'];
		$car = new car($car_id);
		if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()!=true){		
			echo '<div class="item">';	
				echo '<div class="desc">';
					echo '<div class="item_name">'.$car->getCarModel().'</div>';
					echo '<div class="shop_name"><span style="padding: 5px 20px 5px 20px; background-image: url('.HTTP_DOMAIN.'images/layout/store.png);background-repeat: no-repeat;background-position: 0px center;">'.$car->getStoreName().'</span></div>';
					echo '<div class="price">'.$car->getCarPrice().'</div>';
				echo '</div>';
				echo '<a href="?page=cardetail&car='.$car_id.'">';
					//echo '<img src="'.$car->getCarPicture().'">';
					echo '<div class="frame">';
						echo '<img src="'.$car->getCarPicture().'" style="width: 200px;" class="car_picture">';
						echo $car->getCarStatus();
					echo '</div>';
				echo '</a>';
			echo '</div>';
			}
		}
	}
}
//get Car by Price
function getCarByPriceRange($from, $to){
	$q_car_id = getResultSet("SELECT car_id FROM tbl_car WHERE price BETWEEN ".$from." AND ".$to);
	while($rp=mysql_fetch_array($q_car_id)){
		$car_id=$rp['car_id'];
		$car = new car($car_id);
		if($car->getCarActive()!=0){
			if($car->getCarStatusSoldExpire()!=true){		
			echo '<div class="item">';	
				echo '<div class="desc">';
					echo '<div class="item_name">'.$car->getCarModel().'</div>';
					echo '<div class="shop_name"><span style="padding: 5px 20px 5px 20px; background-image: url('.HTTP_DOMAIN.'images/layout/store.png);background-repeat: no-repeat;background-position: 0px center;">'.$car->getStoreName().'</span></div>';
					echo '<div class="price">'.$car->getCarPrice().'</div>';
				echo '</div>';
				echo '<a href="?page=cardetail&car='.$car_id.'">';
					//echo '<img src="'.$car->getCarPicture().'">';
					echo '<div class="frame">';
						echo '<img src="'.$car->getCarPicture().'" style="width: 200px;" class="car_picture">';
						echo $car->getCarStatus();
					echo '</div>';
				echo '</a>';
			echo '</div>';
			}
		}
	}
}
//List Store	
function getListStore(){
	$q_store=getResultSet("SELECT store_id, name FROM tbl_store");
	while($rs = mysql_fetch_array($q_store)){
		$store_id = $rs['store_id'];
		$store_name = $rs['name'];
		//$q_product_id = getValue("SELECT product_id FROM ".DB_PREFIX."product_to_store WHERE store_id=".$store_id." GROUP BY product_id ORDER BY RAND()");
		$store = new store($store_id);
		
		if($store->getUserActive()!=0){
		echo '<div class="item" style="width: 150px;">';
			//echo '<a href="?page=store&id='.$store_id.'&cat=all">';
			echo '<a href="'.$store->getStoreURL().'">';
				echo '<img src="'.$store->getStorePicture().'" style="width: 150px;">';
			echo '</a>';
			echo '<div style="text-align:center;color: #2554C7;">'.$store_name.'</div>';
		echo '</div>';
		}
	}
}

/*=============================================================================================================================
=============================================================================================================================*/
?>