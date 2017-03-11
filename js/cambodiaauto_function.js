/**************************************************/
/* Created by : RITH PHEARUN
/* Date       : 2011-12-26
/* EMail      : run@camitss.com
/* Company    : http://camitss.com
/**************************************************/

function filter_category(manufacturer_id){
	var base_url =  document.domain + window.location.pathname;
	document.location.href = 'http://' + base_url + '?page=index&make=' + manufacturer_id;	
}

function searchProduct(){
	var e = document.getElementById("ifilter_category");
	var manufacturer_id = e.options[e.selectedIndex].value;
	var keyword = document.getElementById('itxt_search').value;
	var base_url =  document.domain + window.location.pathname;
	document.location.href = 'http://' + base_url + '?page=index&make=' + manufacturer_id + '&q=' + keyword;
}

//Seach by ID
function searchProductID(){
	//loadScript("js/jquery.min.js");
	var keyword = document.getElementById('itxt_searchid').value;
	
	var base_url =  document.domain + window.location.pathname;
	$.ajax({
		url: 'http://'+ base_url +'/include/php_sub/r_searchid.php?action=searchid&keyword=' + keyword,
		success: function(car_id){
			if(car_id==0){
				alert('Search not found!');
			}
			else{
				document.location.href = 'http://' + base_url + '?page=cardetail&car=' + car_id;	
			}
		}
	});
}


function searchKeyPress(e)
{
	// look for window.event in case event isn't passed in
	if (window.event) { e = window.event; }
	if (e.keyCode == 13)
	{
			document.getElementById('ibtn_search').click();
	}
}
function searchKeyPressID(e)
{
	// look for window.event in case event isn't passed in
	if (window.event) { e = window.event; }
	if (e.keyCode == 13)
	{
			document.getElementById('ibtn_searchid').click();
	}
}
//Load JS fil
function loadScript(url, callback)
{
    // adding the script tag to the head as suggested before
   var head = document.getElementsByTagName('head')[0];
   var script = document.createElement('script');
   script.type = 'text/javascript';
   script.src = url;

   // then bind the event to the callback function 
   // there are several events for cross browser compatibility
   script.onreadystatechange = callback;
   script.onload = callback;

   // fire the loading
   head.appendChild(script);
}
/*==Delete Comment===========================================================================================================================*/
function delete_comment(comment_id){
	loadScript("js/jquery.min.js");
	var base_url =  document.domain + window.location.pathname;	
	
	var isDelete = confirm("Are you sure you want to delete this?");	
	if(isDelete==true){	
		$.ajax({
			url: 'http://'+ base_url +'include/php_sub/r_commentdelete.php?action=commentdelete&commentid=' + comment_id,
			success: function(data){
				location.reload(true);
			}
		});
	}
}
/*==END Delete Comment===========================================================================================================================*/
/*==get Computer Time===========================================================================================================================*/
function getTime()
{
var d = new Date();
var c_hour = d.getHours();
var c_min = d.getMinutes();
var c_sec = d.getSeconds();
var t = Date() + c_hour + ":" + c_min + ":" + c_sec;
alert(t);
//return t;
}
/*==END get Computer Time===========================================================================================================================*/

//Store
function searchStoreProduct(store_id){
	//var keyword = $('#itxt_search').val();
	var keyword = document.getElementById('istore_txt_search').value;
	keyword=keyword.toLowerCase();
	
	var base_url =  document.domain + window.location.pathname;
	document.location.href = 'http://' + base_url + '?cat=q&q=' + keyword;
}
function searchStoreKeyPress(e)
{
	// look for window.event in case event isn't passed in
	if (window.event) { e = window.event; }
	if (e.keyCode == 13)
	{
			document.getElementById('istore_btn_search').click();
	}
}
//end Store