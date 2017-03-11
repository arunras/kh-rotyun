/**************************************************/
/* Created by : RITH PHEARUN
/* Date       : 2011-12-14
/* EMail      : run@camitss.com
/* Company    : http://camitss.com
/* 
/**************************************************/
//<![CDATA[
//]]>

$(function(){
	//setTimeout(buildGrid, 500);
	//buildGrid();
});

function buildGrid(){
	$("#grid-content").vgrid({
		easeing: "easeOutQuint",
		useLoadImageEvent: true,
		time: 400,
		delay: 10,
		fadeIn: {
			time: 500,
			delay: 10
		}
	});
}