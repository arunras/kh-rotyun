<?php
$make_id = "";
$body = "";
$get_price_from = "";
$cat = "all";
if(isset($_GET['cat'])){
    $cat = $_GET['cat'];
}
if(isset($_GET['make'])){
    $make_id = $_GET['make'];
}
if(isset($_GET['body'])){
	$body = $_GET['body'];
}
if(isset($_GET['price_from'])){
	$get_price_from = $_GET['price_from'];
}
echo '<div id="icategory" style="position: relative;display: block;">';
if($cat=='all'){
	echo '<a href="'.$store->getStoreURL().'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/all.png);background-color: #95A1C9; border:none; color: #FFF; padding-left: 30px;">'.$rLanguage->text("All Categories").'</h4></a>';	
}
else{
	echo '<a href="'.$store->getStoreURL().'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/all.png); padding-left: 30px;">'.$rLanguage->text("All Categories").'</h4></a>';
}
	$img_path = 'application/manufacturer/manufacturer_picture/';

	$q_manufacturer = getResultSet("SELECT M.manufacturer_id, M.name, M.picture FROM tbl_manufacturer AS M
									INNER JOIN tbl_car AS C ON C.manufacturer_id = M.manufacturer_id  
									INNER JOIN tbl_car_to_store AS S ON S.car_id = C.car_id 
									WHERE S.store_id = $store_id 
									GROUP BY C.manufacturer_id ORDER BY COUNT(C.manufacturer_id) DESC LIMIT 10");
	$countOther = array();
	
    while($rm = mysql_fetch_array($q_manufacturer)){
        $manufacturer_id = $rm['manufacturer_id'];
        $name = $rm['name'];	
		$picture = $rm['picture'];
		$q_mcount = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id 
									WHERE C.manufacturer_id=".$manufacturer_id." AND S.store_id=".$store_id);
		$m_count = mysql_num_rows($q_mcount);
		if($manufacturer_id==$make_id){
			echo '<a href="?cat=make&make='.$manufacturer_id.'" title="expand/collapse"><h4 class="expand open current_parent" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.'); background-position: 1px center;background-repeat: no-repeat;background-color: #FF5500; border:none; color: #FFF;padding-left: 30px;">'.$name.'<span class="count_eachtype">('.$m_count.')</span></h4></a>';
			$countOther[] = $manufacturer_id;
		}
		else{
			echo '<a href="?cat=make&make='.$manufacturer_id.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat;padding-left: 30px;">'.$name.'<span class="count_eachtype">('.$m_count.')</span></h4></a>';	
			$countOther[] = $manufacturer_id;
		}
    }
	$ids = join(',',$countOther);
	
	function countOther($ida, $s_id){
	    $total_car = getValue("SELECT COUNT(car_id) FROM tbl_car_to_store WHERE store_id=".$s_id);
		if($total_car!=0){
			$q_manufacture_count = getResultSet("SELECT S.car_id, C.manufacturer_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id 
									WHERE C.manufacturer_id NOT IN($ida) AND S.store_id=".$s_id);	
		}
		else{
			return 0;	
		}
		$count_other = 0;
		while($rm = mysql_fetch_array($q_manufacture_count)){
			$manufacturer_id = $rm['manufacturer_id'];
			$q_car_count = getValue("SELECT COUNT(car_id) FROM tbl_car WHERE manufacturer_id=".$manufacturer_id);
			$count_other = $count_other + $q_car_count;
		}
		return $count_other;
	}
	if(countOther($ids, $store_id)!=0){
		if($cat=='other'){
			echo '<a href="?cat=other&make='.$ids.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/other.gif);background-color: #FF5500; border:none; color: #FFF;padding-left: 30px;">Others<span class="count_eachtype">('.countOther($ids, $store_id).')</span></h4></a>';
		}
		else{
			echo '<a href="?cat=other&make='.$ids.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/other.gif);padding-left: 30px;">Others<span class="count_eachtype">('.countOther($ids, $store_id).')</span></h4></a>';	
		}
	}
/*==Body type category=============================================================================================
	echo '<br />';
	$q_body_type = getResultSet("SELECT body_id, name, picture FROM tbl_body_type");
	//$img_path = 'application/manufacturer/manufacturer_picture/';
	$img_path = 'images/icon/body/';
    while($rm = mysql_fetch_array($q_body_type)){
        $body_id = $rm['body_id'];
        $name = $rm['name'];	
		$picture = $rm['picture'];
		//$b_count = getValue("SELECT COUNT(car_id) FROM tbl_car WHERE body_id=".$body_id);
		$q_bcount = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id 
									WHERE C.body_id=".$body_id." AND S.store_id=".$store_id);
		$b_count = mysql_num_rows($q_bcount);
		if($body_id==$body){
			echo '<a href="?page=store&id='.$store_id.'&cat=body&body='.$body_id.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #0B5FBD; background-color: #FF5500;">'.$name.'<span class="count_eachtype">('.$b_count.')</span></h4></a>';	
		}
		else{
			echo '<a href="?page=store&id='.$store_id.'&cat=body&body='.$body_id.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #0B5FBD;">'.$name.'<span class="count_eachtype">('.$b_count.')</span></h4></a>';		
		}
    }
==Body type category=============================================================================================*/
	//Price
	echo '<br />';
	$q_price_range = getResultSet("SELECT price_range_id, price_from, price_to, picture FROM tbl_price_range");
	$img_path = 'images/layout/';
    while($rm = mysql_fetch_array($q_price_range)){
        $price_range_id = $rm['price_range_id'];
        $price_from = $rm['price_from'];	
		$price_to = $rm['price_to'];
		$picture = $rm['picture'];
		$q_pcount = getResultSet("SELECT S.car_id FROM tbl_car_to_store AS S
									INNER JOIN tbl_car AS C ON C.car_id=S.car_id 
									WHERE C.price BETWEEN ".$price_from." AND ".$price_to." AND S.store_id=".$store_id);
		$p_count = mysql_num_rows($q_pcount);
		if($p_count!=0){
			if($price_from==$get_price_from){
				echo '<a href="?cat=price&price_from='.$price_from.'&price_to='.$price_to.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #267374; background-color: #FF5500;padding-left: 30px;">$'.$price_from.'- $'.$price_to.'<span class="count_eachtype">('.$p_count.')</span></h4></a>';	
			}
			else{
				echo '<a href="?cat=price&price_from='.$price_from.'&price_to='.$price_to.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #267374;padding-left: 30px;">$'.$price_from.'- $'.$price_to.'<span class="count_eachtype">('.$p_count.')</span></h4></a>';		
			}
		}
    }
echo '</div>';
?>