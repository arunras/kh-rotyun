<?php
ob_start();
if(!isset($_SESSION))session_start();

class manufacturer{
	private $manufacturer_id;
    private $manufacturer_name;
	private $manufacturer_picture;
	
	
    public function __construct($id = ""){
            $this->manufacturer_id = $id;
			$this->manufacturer_name = "";
			$this->manufacturer_picture = "";
    }
	
	private function getLanguageId(){
		if($_SESSION['language_selected']=="en"){return 1;}
		elseif($_SESSION['language_selected']=="kh"){return 2;}
    }
	
    private function initDb(){
    	require_once(dirname(dirname(dirname(__FILE__))) . "/module/module.php");
    }
/*==GET from DB=============================================================================================================*/
	//get Category Name
	public function getManufacturerName(){
		$this->initDb();
		if($this->manufacturer_id !=0){
			//$this->manufacturer_name = getResultSet("SET NAMES UTF8");
			$this->manufacturer_name = getValue("SELECT name FROM tbl_manufacturer WHERE manufacturer_id=".$this->manufacturer_id);
		}
		return $this->manufacturer_name;//."lag= ".$this->getLanguageId();	
	}
	//get List Category Icon
	public function getManufacturerIconName(){
		$this->initDb();
		if($this->manufacturer_id !=0){
			$this->manufacturer_picture = getValue("SELECT picture FROM tbl_manufacturer WHERE manufacturer_id=".$this->manufacturer_id);
		}
		return $this->manufacturer_picture;	
	}
	//get Shwoable
	public function getManufacturerShowable(){
		$this->initDb();
		if($this->manufacturer_id !=0){
			$this->manufacturer_show = getValue("SELECT showable FROM tbl_manufacturer WHERE manufacturer_id=".$this->manufacturer_id);
		}
		return $this->manufacturer_show;	
	}
	
	
	//get car_Picture
	public function getCarPicture(){
		$this->initDb();
		if($this->car_id !=0){
			$this->car_picture = getValue("SELECT picture FROM tbl_car WHERE car_id=".$this->car_id);
		}
		$img = HTTP_DOMAIN.'application/car/car_picture/'.$this->car_picture;

		if ($this->car_picture==''){return HTTP_DOMAIN.'application/car/car_picture/noimage.jpg';}
		else{ return  $img;}

	}
	
/*==END GET from DB=============================================================================================================*/
/*==END DISPLAY=============================================================================================================*/

/*==END Display=============================================================================================================*/

                    
                    
                        
                            
                            
                           
                            
                                
                            
                        
                    
                
            
	
}
?>