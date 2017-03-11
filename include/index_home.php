<?php
	//Photo Gallery
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/grid_view/jquery.easing.1.3.js" type="text/javascript" charset="UTF-8"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/grid_view/jquery.vgrid.0.1.7.min.js" type="text/javascript" charset="UTF-8"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/grid_view/vgrid.js" type="text/javascript"></script>';
	//ToolTip
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/tooltip/jquery.balloon.js"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/tooltip/jquery.tile.js"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/toggle_categorybox.js"></script>';
	//List Category Expand
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'js/expand.js"></script>';
?>
<form action="#" method="get" style="margin-bottom:10px; display: none;">
    <input type="button" id="additem" value="Add Item" style="font-weight: bold;">
    <input type="button" id="hsort" value="Headline Sort">
    <input type="button" id="rsort" value="Random Sort">
    
    <span id="message1" style="display: inline-block; visibility: hidden; ">onStart</span>
    <span id="message2" style="display: inline-block; visibility: hidden; ">onFinish</span>
</form>
<div id="center_wrapper">
	<div id="iallcategory_label">
        <span><?php echo $rLanguage->text("Product Category"); ?></span>
    </div>
    <!--List Category-->
    <div id="ilist_allproduct">
        <?php 
            require_once(dirname(dirname(__FILE__)) .'/include/list_category.php');
        ?>
        <script> $(function() { eval($('#ilist_allproduct .tooltip_itemstyle').text()); }); </script>    	
        <div class="tooltip_styleblock">
            <code class="tooltip_itemstyle" style="display: none;">
                    $('#grid-content div.item').balloon({
                        tipSize: 10,
                        css: {
                        	font: 'Tahoma, Geneva, sans-serif, "Moulpali", cursive',
                            border: '1px #000 solid',
                            padding: '10px',
                            //width: '300px',
                            fontSize: '15px',
                            //fontWeight: 'bold',
                            lineHeight: '1.2',
                            backgroundColor: '#000',
                            color: '#fff',
                            textAlign: 'center',
                        }
                    });
            </code>
        </div>
    </div>
<!--TEST===========================================================================-->
<div id="container">
<?php
/*
if(isset($_GET['category'])){
	echo '<div id="grid-content" style="left:224px;">';  
}
else{
	echo '<div id="grid-content">';
}
*/
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1" id="lefttd"></td>
    <td align="left" valign="top">
    	<!--<div id="loading_grid"><img src="<?php //echo HTTP_DOMAIN.'/images/layout/loading_grid.gif';?>" />Loading...</div>-->
    	<div id="grid-content" style="display: block;">
<?php
require_once(dirname(dirname((__FILE__))). "/include/car_grid.php");
//echo '</div>';
?>
    	</div>
    </td>
  </tr>
</table>
<!--end TEST=======================================================================-->    
</div>
</div>