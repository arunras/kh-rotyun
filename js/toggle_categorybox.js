// JavaScript Document
$(document).ready(function () {
	var getWidth = $('#ilist_allproduct').css('width');
	getWidth = parseInt(getWidth.replace('px',''));
	getWidth = parseInt(getWidth);
	var sidebarWidth = 210;
	var contentWidth = getWidth-sidebarWidth;
	
	var base_url = $('#base_url').val();
	
	$('#iallcategory_label').toggle(
		function() {
			/*===*/
			$('#lefttd').css({
				width: '210px'	
			});
			/*===*/
			$('#icategory').show();
			$('#iallcategory_label').css('background-image','url('+ base_url +'images/layout/expand.png)');
			//buildGrid();
			$('#rsort').trigger('click');
		},
		function() {
			$('#lefttd').css({
				width: '1px'	
			});
			$('#icategory').hide();
			$('#iallcategory_label').css('background-image','url('+ base_url +'images/layout/collapse.png)');
			//buildGrid();
			$('#rsort').trigger('click');
		}
	);
	//$('#iallcategory_label').trigger('click');
});