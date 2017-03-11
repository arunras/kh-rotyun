<div class="header">
	<div class="banner">
		<?php
			echo '<script src="'.HTTP_DOMAIN.'js/css_browser_selector.js" type="text/javascript" charset="UTF-8"></script>';
			echo '<a href="'.HTTP_DOMAIN.'"><div class="logo"></div></a>';
			$current_url = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        ?>
        <div class="log">
        	<ul>
                <?php			
				
					//Switch Language
					/*
					echo '<li style="border-left: 0px #CCC solid; padding: 0px; margin: 0px;"><a href="'.HTTP_DOMAIN.'en/?'.$_SERVER['QUERY_STRING'].'"><img src="'.HTTP_DOMAIN.'images/icon/en.gif" title="English" width="16px" height="12px" /></a></li>';
					echo '<li ><a href="'.HTTP_DOMAIN.'kh/?'.$_SERVER['QUERY_STRING'].'"><img src="'.HTTP_DOMAIN.'images/icon/kh.gif" title="Khmer" width="16px" height="12px" /></a></li>';
					*/
					echo '<li style="border-left: 0px #CCC solid; padding: 0px; margin: 0px;"><a href="'.HTTP_DOMAIN.'cookie_language_en.php?myurl='.$current_url.'"><img src="'.HTTP_DOMAIN.'images/layout/en.gif" title="English" width="16px" height="12px" /></a></li>';
					echo '<li ><a href="'.HTTP_DOMAIN.'cookie_language_kh.php?myurl='.$current_url.'"><img src="'.HTTP_DOMAIN.'images/layout/kh.gif" title="Khmer" width="16px" height="12px" /></a></li>';
					//Switch Language
				
					if(getCurrentUser()==0){
					//if($_SESSION['login_user']==0 || $_SESSION['login_user']==''){
						//echo '<li id="register"><a href="'.HTTP_DOMAIN.'?page=storeregistration">'.$rLanguage->text("Register").'</a></li>';
						echo '<li id="login"><a href="'.HTTP_DOMAIN.'?page=login">'.$rLanguage->text("Login").'</a></li>';
					}
					else{
						echo '<li id="logout"><a href="'.HTTP_DOMAIN.'?page=logout">'.$rLanguage->text("Logout").'</a></li>';
						if(getUserType()==ADMINISTRATOR){
							echo '<li id="logout"><a href="'.HTTP_DOMAIN.'?page=administration">'.$rLanguage->text("Administration").'</a></li>';	
						}
						elseif(getUserType()==OWNER){
							$store_id = getValue("SELECT store_id FROM tbl_user_to_store WHERE user_id=".getCurrentUser());
							$store_uname = new store($store_id);
							//echo '<li id="logout"><a href="?page=store&id='.$store_id.'&cat=all">'.$rLanguage->text("My Store").'</a></li>';	
							echo '<li id="logout"><a href="'.HTTP_DOMAIN.$store_uname->getStoreURL().'">'.$rLanguage->text("My Store").'</a></li>';	
						}
					}
					
				?>
                <li id="logout" style="display:none;"><a href="<?php echo HTTP_DOMAIN; ?>store/index.php?route=account/logout"><?php echo $rLanguage->text("Logout");?></a></li>
                <li style="border: none;"><div id="fb-root"></div></li>
               
                <li style="border-left: 0px #CCC solid; margin-right: 10px;">
                    <div class="fb-like" data-href="https://www.facebook.com/Cambodia.Auto" data-send="false" data-layout="button_count" data-width="30" data-show-faces="true"></div>
                    <div class="g-plusone" data-size="medium" data-href="http://cambodia-auto.com"></div>
				</li>
                <li style="border-left: 0px #CCC solid;">
                	<a href="https://www.facebook.com/Cambodia.Auto"​​​​​​ target="_new"><img src="<?php echo HTTP_DOMAIN;?>images/layout/fb_page.jpg " title="find us on facebook"/></a>
                </li>
        	</ul>
        </div>  
        <?php /*echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/facebook.js"></script>';*/?>
        <!--<span style="line-height:80px; border: 1px solid red;"><marquee onmouseover="this.stop();" onmouseout="this.start();">ទំនាក់ទំនងចុះឈ្មោះឃ្លាំងរថយន្ត ទូរស័ព្ទៈ 010 88 48 47 / អីមែល kongkea@camitss.com</marquee></span>
	-->
<table border="0" id="mar">
    <tr><td>
        <marquee scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">ទំនាក់ទំនងចុះឈ្មោះឃ្លាំង ទូរស័ព្ទៈ 010 88 48 47 / អីមែលៈ kongkea@camitss.com</marquee>
	</td></tr>
</table>
	</div>
    
</div>
<div class="menu_bar">
<div class="searchBlock">
<?php
    //$q_manufacturer = getResultSet("SELECT manufacturer_id, name  FROM tbl_manufacturer ORDER BY name ASC");
	$q_manufacturer = getResultSet("SELECT M.manufacturer_id, M.name FROM tbl_manufacturer AS M
									INNER JOIN tbl_car AS C ON C.manufacturer_id = M.manufacturer_id 
									GROUP BY C.manufacturer_id ORDER BY COUNT(C.manufacturer_id) DESC LIMIT 15");
	if(isset($_GET['page']) && isset($_GET['car'])){
		echo '<select id="ifilter_category" name="filter_category" class="select_filter">';	
	}else{
		echo '<select id="ifilter_category" name="filter_category" class="select_filter" onChange="filter_category(this.options[this.selectedIndex].value)">';		
	}
		echo '<option value="0">'.$rLanguage->text("All Categories").'</option>';
		
    while($rm=mysql_fetch_array($q_manufacturer)){
        $manufacturer_id = $rm['manufacturer_id'];
		$manufacturer = new manufacturer($manufacturer_id);
		if(isset($_GET['make']) && $manufacturer_id==$_GET['make']){
				echo '<option selected="selected" value="'.$manufacturer_id.'">'.$manufacturer->getManufacturerName().'</option>';
		}	
		else{
				echo '<option value="'.$manufacturer_id.'">'.$manufacturer->getManufacturerName().'</option>';	
		}
    }
    echo '</select>';

	if(isset($_GET['q'])){
		echo '<input class="txt_search" type="text" id="itxt_search" name="txt_search" placeholder="'.$_GET['q'].'" onkeypress="searchKeyPress(event);"/>';
	}
	else{
		echo '<input class="txt_search" type="text" id="itxt_search" name="txt_search" placeholder="'.$rLanguage->text("Product Search").'" onkeypress="searchKeyPress(event);"/>';	
	}
?>    
    <input class="btn_search" type="button" id="ibtn_search" name="btn_search" value="<?php echo $rLanguage->text("Search");?>" onclick="searchProduct();" />
    <span style="border: 0px #F00 solid; width: 50px;padding: 5px 5px 5px 5px;"><a href="<?php echo HTTP_DOMAIN."?liststore=all";?>" style="color: #FFF; width=10%;"><?php echo $rLanguage->text("Store Search");?></a></span>
</div>
</div>
