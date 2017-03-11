<div class="detail_bar_nav">
    <ul>
    <?php
		$getPage = $_GET['page'];
		echo '<a href="'.HTTP_DOMAIN.'?page=index"><li>'.$rLanguage->text("Home").'</li></a>&raquo;';
		if($getPage=="store" && isset($_GET['cat']) && !isset($_GET['car'])){
			/*
			if($car->getCarManufacturerId()!=0){
				echo '<a href="?page=index&make='.$car->getCarManufacturerId().'"><li>'.$car->getCarManufacturer().'</li></a>&raquo;';	
			}
			//echo '<a href="?page=index&make='.$car->getCarManufacturerId().'"><li>'.$car->getCarManufacturer().'</li></a>&raquo;';	
			echo '<a href="?page=cardetail&car='.$car_id.'"><li>'.$car->getCarModel().'</li></a>';	
			*/
		}
		else{
			if(isset($_GET['car'])){
				if($car->getCarManufacturerId()!=0){
					echo '<a href="?page=index&make='.$car->getCarManufacturerId().'"><li>'.$car->getCarManufacturer().'</li></a>&raquo';	
				}
			echo '<a href="?page=cardetail&car='.$car_id.'"><li>'.$car->getCarModel().'</li></a>';
			}
		}
	?>
    </ul>
</div>