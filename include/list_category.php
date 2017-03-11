<?php
$make_id = "";
$body = "";
$get_price_from = "";
if(isset($_GET['make'])){
    $make_id = $_GET['make'];
}
if(isset($_GET['body'])){
	$body = $_GET['body'];
}
if(isset($_GET['price_from'])){
	$get_price_from = $_GET['price_from'];
}
echo '<div id="icategory">';
//==Mark==
if($make_id==0){
	echo '<a href="?page=index&make=0" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/all.png);background-color: #C9C9C9 ; border:none; color: #FFF; padding-left: 30px;">'.$rLanguage->text("All Categories").'</h4></a>';//#FF5500
}
else{
	echo '<a href="?page=index&make=0" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/all.png); padding-left: 30px;">'.$rLanguage->text("All Categories").'</h4></a>';
}
	$q_manufacturer = getResultSet("SELECT M.manufacturer_id, M.name, M.picture FROM tbl_manufacturer AS M
									INNER JOIN tbl_car AS C ON C.manufacturer_id = M.manufacturer_id 
									GROUP BY C.manufacturer_id ORDER BY COUNT(C.manufacturer_id) DESC LIMIT 10");
	$countOther = array();
	$img_path = 'application/manufacturer/manufacturer_picture/';
    while($rm = mysql_fetch_array($q_manufacturer)){
        $manufacturer_id = $rm['manufacturer_id'];
        $name = $rm['name'];	
		$picture = $rm['picture'];
		$m_count = getValue("SELECT COUNT(car_id) FROM tbl_car WHERE manufacturer_id=".$manufacturer_id);
		if($m_count!=0){	
			if($manufacturer_id==$make_id){
				echo '<a href="?page=index&make='.$manufacturer_id.'" title="expand/collapse"><h4 class="expand open current_parent" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.'); background-position: 1px center;background-repeat: no-repeat;background-color: #FF5500; border:none; color: #FFF; padding-left: 30px;">'.$name.'<span class="count_eachtype">('.$m_count.')</span></h4></a>';			
				$countOther[] = $manufacturer_id;
			}
			else{
				echo '<a href="?page=index&make='.$manufacturer_id.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; padding-left: 30px;">'.$name.'<span class="count_eachtype">('.$m_count.')</span></h4></a>';	
				$countOther[] = $manufacturer_id;
			}
		}
    }
	
	$ids = join(',',$countOther);
	function countOther($ida){
		/*=================*/
		$total_car = getValue("SELECT COUNT(car_id) FROM tbl_car_to_store");
		$count_other = 0;
		if($total_car!=0){
			$q_manufacture_count = getResultSet("SELECT manufacturer_id FROM tbl_manufacturer WHERE manufacturer_id NOT IN($ida)");
		}
		else{
			return 0;	
		}
		/*=============================*/
		while($rm = mysql_fetch_array($q_manufacture_count)){
			$manufacturer_id = $rm['manufacturer_id'];
			$q_car_count = getValue("SELECT COUNT(car_id) FROM tbl_car WHERE manufacturer_id=".$manufacturer_id);
			$count_other = $count_other + $q_car_count;
		}
		return $count_other;
	}
	if(countOther($ids)!=0){
	echo '<a href="?page=index&make=other&ids='.$ids.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'application/manufacturer/manufacturer_picture/other.gif);">Others<span class="count_eachtype">('.countOther($ids).')</span></h4></a>';
	}
	//Body type category
/*	
	echo '<br />';
	$q_body_type = getResultSet("SELECT body_id, name, picture FROM tbl_body_type");
	//$img_path = 'application/manufacturer/manufacturer_picture/';
	$img_path = 'images/icon/body/';
    while($rm = mysql_fetch_array($q_body_type)){
        $body_id = $rm['body_id'];
        $name = $rm['name'];	
		$picture = $rm['picture'];
		$b_count = getValue("SELECT COUNT(car_id) FROM tbl_car WHERE body_id=".$body_id);
		if($body_id==$body){
			echo '<a href="?page=index&body='.$body_id.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #0B5FBD; background-color: #FF5500;">'.$name.' ('.$b_count.')<span class="count_eachtype">('.$b_count.')</span></h4></a>';	
		}
		else{
			echo '<a href="?page=index&body='.$body_id.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #0B5FBD;">'.$name.'<span class="count_eachtype">('.$b_count.')</span></h4></a>';		
		}
    }
*/	
	//Price
	echo '<br />';
	$q_price_range = getResultSet("SELECT price_range_id, price_from, price_to, picture FROM tbl_price_range");
	//$img_path = 'application/manufacturer/manufacturer_picture/';
	$img_path = 'images/layout/';
    while($rm = mysql_fetch_array($q_price_range)){
        $price_range_id = $rm['price_range_id'];
        $price_from = $rm['price_from'];	
		$price_to = $rm['price_to'];
		$picture = $rm['picture'];
		$p_count = getValue("SELECT COUNT(car_id) FROM tbl_car WHERE price BETWEEN ".$price_from." AND ".$price_to);
		
		if($p_count!=0){
			if($price_from==$get_price_from){
				echo '<a href="?page=index&price_from='.$price_from.'&price_to='.$price_to.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #267374; background-color: #FF5500;">$'.$price_from.'- $'.$price_to.'<span class="count_eachtype">('.$p_count.')</h4></a>';	
			}
			else{
				echo '<a href="?page=index&price_from='.$price_from.'&price_to='.$price_to.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.$picture.');background-position: 1px center;background-repeat: no-repeat; color: #267374;">$'.$price_from.'- $'.$price_to.'<span class="count_eachtype">('.$p_count.')</span></h4></a>';		
			}
		}
    }
	/*Search car by id
	echo '<span style="font-weight: bold;">'.$rLanguage->text("View by car id").'</span>';
	echo '<input type="text" name="txt_searchid" class="store_txtsearch" style="width: 165px; border: 1px #1F73D1 solid; margin: 1px 1px 1px 1px;" id="itxt_searchid" placeholder="CA000-00000" onkeypress="searchKeyPressID(event)"/>';
	echo '<input type="button" class="store_btnsearch" style="margin-left: 2px;" name="btn_searchid" id="ibtn_searchid" value="" onclick="searchProductID()"/>';
	*/
	//==Store==
	echo '<br />';
	$q_store = getResultSet("SELECT store_id, name, storeurl FROM tbl_store LIMIT 0,5");
	$img_path = 'images/layout/';
	if(isset($_GET['liststore'])){
		echo '<a href="'.HTTP_DOMAIN.'?liststore=all" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'images/layout/store_icon.png);background-position: 1px 5px;background-repeat: no-repeat; color: #267374; background-color: #FF5500; padding-left: 30px;padding-top: 7px;">'.$rLanguage->text("All Store").'</h4></a>';
	}
	else{
		echo '<a href="'.HTTP_DOMAIN.'?liststore=all" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.'images/layout/store_icon.png);background-position: 1px 5px;background-repeat: no-repeat; color: #267374; padding-left: 30px;padding-top: 7px;">'.$rLanguage->text("All Store").'</h4></a>';	
	}
    while($rs = mysql_fetch_array($q_store)){
		$store_id = $rs['store_id'];
		$store_name = $rs['name'];
		$store_url = $rs['storeurl'];
		$storeList = new store($store_id);
		if($storeList->getUserActive()!=0){
			echo '<a href="'.HTTP_DOMAIN.$store_url.'" title="expand/collapse"><h4 class="expand open" style="background-image: url('.HTTP_DOMAIN.$img_path.'body.png);background-position: 1px center;background-repeat: no-repeat; color: #267374;">'.$store_name.'</h4></a>';
		}
    }
//==Store==

echo '</div>';
?>