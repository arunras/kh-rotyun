<?php
    ob_start();
    if(!isset($_SESSION))@session_start();
	//error_reporting(0);
	require_once(dirname(dirname(__FILE__)) . "/module/module.php");

	//Global-Declaration
	$rLanguage = CheckLanguageChange();
	if(!isset($_COOKIE['language'])){
		$_COOKIE['language']='kh';
	}
?>
<head>
	<!--Meta-->
	<meta http-equiv="Pragma" content="public">
    <meta http-equiv="Cache-Control" content="public">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Cambodia, Phnom Penh, Auto, Car, Shop, Buy, Price, Good, High, Quality,">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <!--end Meta-->
    <link rel="shortcut icon" href="<?php echo HTTP_DOMAIN;?>images/icon/cambodiaauto.ico" type="image/x-icon">
<?php 
	require_once(dirname(dirname(__FILE__))."/application/car/car.class.php");
	require_once(dirname(dirname(__FILE__))."/application/store/store.class.php");
	require_once(dirname(dirname(__FILE__))."/application/manufacturer/manufacturer.class.php");

	if(isset($_GET['page']) && isset($_GET['car'])){
		if($_GET['page']=='cardetail'){
			$car_for_title = new car($_GET['car']);
			$del_br = strip_tags($car_for_title->getCarDescription());
			echo "<title>".$car_for_title->getCarModel()." | Cambodia Auto</title>";
			echo '<meta name="description" content="PRICE: '.$car_for_title->getCarPrice().', '.$del_br.'. SHOP: '.$car_for_title->getStoreName().'" />';
		}
	}
	if(isset($_GET['page']) && isset($_GET['id'])){
		if($_GET['page']=='store'){						
			$store_description_title = getValue("SELECT description FROM tbl_store WHERE storeurl='".$_GET['id']."'");					
			echo '<title>'.$_GET['id'].' | Cambodia Auto</title>';
			echo '<meta name="description" content="'.$store_description_title.'" />';	
		}			
	}
	else{
		echo "<title>✔Cambodia Auto - The FIRST and #1 ONLINE CAR SHOPS in CAMBODIA</title>";
		echo '<meta name="description" content="Cambodia Auto is #1 trusted car shops where you can search/see/know EASILY about cars you want in Cambodia." />';
		}
?>
<!--=Imports==========================================================-->
<?php
	//Jquery Library====
	echo '<script src="'.HTTP_DOMAIN.'js/jquery.min.js" type="text/javascript" charset="UTF-8"></script>';
	echo '<script type="text/javascript">';
		echo '$.ajaxSetup({cache: true});';
	echo '</script>';
	//end Jquery Library====
	//WebFont===
	/*echo '<script src="'.HTTP_DOMAIN.'js/_webfont.js" type="text/javascript" charset="UTF-8"></script>';*/
	
	//end WebFont===
	//Style
	echo '<link rel="stylesheet" href="'.HTTP_DOMAIN.'css/screen.css" />';
	echo '<link rel="stylesheet" href="'.HTTP_DOMAIN.'js/masonry_infinite_scroll/css/masonry_style.css" />';
	echo "<link href='http://fonts.googleapis.com/css?family=Moulpali' rel='stylesheet' type='text/css'>";//Web Font
	
	//masonry
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/masonry_infinite_scroll/js/jquery.masonry.min.js"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/masonry_infinite_scroll/js/jquery.infinitescroll.min.js"></script>';
	//endmasonry
	//Home Customize for Radom Photo Gallery
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/cambodiaauto_function.js"></script>';
	
	//CAR

?>    
<!--=end Imports======================================================-->
</head>
<body>
<?php
	echo '<input type="hidden" id="rLanguage" value="' . $_COOKIE['language'] . '" />';//
    echo '<input type="hidden" id="base_url" value="' . HTTP_DOMAIN . '" />';
	$page = "index";
	if(isset($_GET['page'])){
		$page = $_GET['page'];
		if(!array_key_exists($page, $path)){
			$page = "index";
		}
	}
	$include_path = dirname(dirname((__FILE__))) . "/" . $path[$page];
?>
<div class="head"><?php require_once(dirname(dirname((__FILE__))) . "/include/header.php");?></div>
<div id="phsaEZ_wrapper">
	<!--TEST-->
    <div id="container" class="transitions-enabled infinite-scroll clearfix">
    <?php
	$q_img = getResultSet("SELECT picture FROM tbl_car");
	$path = "images/content/car/thumb/";
	while($rp = mysql_fetch_array($q_img)){
		echo '<div class="box col2"><img src="'.$path.$rp["picture"].'"/></div>';
	}
	?>
    </div>
	<nav id="page-nav">
        <!--
          <a href="<?php //echo HTTP_DOMAIN.'js/masonry_infinite_scroll/pages/'?>2.html"></a>
        -->
       	<a href="<?php echo HTTP_DOMAIN.'include/car_grid.php'?>"></a>
        <!--<a href="http://cambodiaauto.localhost/?page=index&make=1"></a>-->
    </nav>
    <script>
  $(function(){

    var $container = $('#container');

    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.box',
        columnWidth: 100
      });
    });

    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.box',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
		  img: 'js/masonry_infinite_scroll/images/6RMhx.gif'
          //img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true );
        });
      }
    );

  });
</script>
    <!--TEST-->
	<?php //include($include_path);?>
</div>
<div id="footer"><?php require_once(dirname(dirname((__FILE__))) . "/include/footer.php");?></div>
</body>

<?php
	//ob_flush();
?>