/***********************************************
* Drop Down Date select script- by JavaScriptKit.com
* This notice MUST stay intact for use
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
* WARNING -------------------------------------------------------!-
* This javascript has been modified by *bdhacker* for real life use
* ishafiul@gmail.com
* http://bdhacker.wordpress.com
***********************************************/
//var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
var monthtext=['01','02','03','04','05','06','07','08','09','10','11','12'];
function date_populate(yearfield){
    var today=new Date();
    var yearfield=document.getElementById(yearfield)
    var thisyear=today.getFullYear()+2;
    //YEAR
	for (var y=1; y<100; y++){
        yearfield.options[y]=new Option(thisyear, thisyear)
        thisyear-=1
    }
	//yearfield.options[0]= new Option('------------------year------------------','');
    //yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}
