/*=Document Ready=====================================================================================================================*/
$(document).ready(function(){
	//New Registration
	//var base_url =  document.domain;// + window.location.pathname;
	var base_url = $('#base_url').val();
    $("#iform_newstore").validate({
		rules:{
			owner: 'required',
			email: {
						required: true,
						email: true,
						remote:{
								url: base_url+'include/php_sub/check_email.php',
								type: 'post',
								data:{
									email: function(){
										return $('#iemail').val();
									}
							   }
						}
				   },
			password: 'required',
			passwordconfirm:{ equalTo: '#ipassword'},
			
			storeuname: {
							required: true,
							//noSpace: true,
							charOnly: true,
							remote:{
								url: base_url+'include/php_sub/check_storeurl.php',
								type: 'post',
								data:{
									storeuname: function(){
										return $('#istoreuname').val();
									}
								}
							}
						},
			storename: 'required',
			url: 'url',
		},
		messages: {
            storeuname:{
                remote: "This storename is already taken!",
            },
			email:{
				remote: "this email is already used",
			}
        }
	});
	
	//Edit Store
	$("#iform_editstore").validate({
		rules:{
			owner: 'required',
			email: 'required email',
			password: 'required',
			passwordconfirm:{ equalTo: '#ipassword'},
			
			storename: 'required',
			url: 'url',
		}	
	});
	//Change Password
	$("#iform_changepassword").validate({
		rules:{
			//percurrentpassword: 'required',
			password: 'required',
			passwordconfirm:{ equalTo: '#ipassword'}
		}	
	});	
	
	//New Car
    $("#iform_caradd").validate({
		rules:{
			model: 'required',
			price: 'number',
		}
	});
	
	//Edit Car
    $("#iform_caredit").validate({
		rules:{
			model: 'required',
			price: 'number',
		}
	});
	
	//Add Manufacturer
    $("#iform_manufactureradd").validate({
		rules:{
			manufacturer: 'required',
		}
	});
	
	//Add Manufacturer
    $("#iform_manufactureredit").validate({
		rules:{
			manufacturer: 'required',
		}
	});
	
	jQuery.extend(jQuery.validator.messages,{
		required: $('div.Lmessages span#ismsrequired').html(),
		email: $('div.Lmessages span#ismsemail').html(),
		url: $('div.Lmessages span#ismsurl').html(),
		equalTo: $('div.Lmessages span#ismsequalTo').html()
		//minlength: "*"
	});
});
/*======================================================================================================================*/
//Finish
//File Upload  
function file_validation(id){
	filename = $('#'+id).val();
	filelength = parseInt(filename.length)-3;
	fileext = filename.substring(filelength, filelength+3);
	fileext = fileext.toLowerCase(fileext);
	
	if(fileext=='jpg' || fileext=='jpeg' || fileext=='png' || fileext=='gif' || fileext=='ico' || fileext==''){
		return true;	
	}
	else{
		alert($('div.Lmessages span#iuploadfilevalidate').html());
		return false;
	}
	//allowtype=array("jpg","jpeg","gif","png");  
}
//File Upload 
/* 
function file_validation_for_car(){
	filename = $('#carpicture').val();
	filelength = parseInt(filename.length)-3;
	fileext = filename.substring(filelength, filelength+3);
	fileext = fileext.toLowerCase(fileext);

	if(fileext=='jpg' || fileext=='jpeg' || fileext=='png' || fileext=='gif' || fileext==''){
		return true;	
	}
	else{
		alert($('div.Lmessages span#iuploadfilevalidate').html());
		return false;
	}
	//allowtype=array("jpg","jpeg","gif","png");  
}
*/