var base_url="http://www.tellitize.com/";
//var base_url="http://localhost/tellitize/";
function validate_signUp_form()	{
    var email=$.trim($("#email").val());
	 if($.trim($("#first_name").val()) == ""){
		$("#first_name").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#first_name").css("border","1px solid #CCCCCC");	
		}
	 if($.trim($("#last_name").val()) == ""){
		$("#last_name").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#last_name").css("border","1px solid #CCCCCC");	
		}
			
	 if($.trim($("#email").val()) == ""){
		$("#email").css("border","1px solid red");			  
		 return false;
		 }
		else if(!checkemail(email)){
		    alert("Invalid emailid");
			$("#email").css("border","1px solid red");			  
		 return false;
			
    	}
		else{
			$("#email").css("border","1px solid #CCCCCC");	
		}
		 if($.trim($("#username").val()) == ""){
		$("#username").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#username").css("border","1px solid #CCCCCC");	
		}
		
		 if($.trim($("#password").val()) == ""){
		$("#password").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#password").css("border","1px solid #CCCCCC");	
		}
		
		 if($.trim($("#passwordConfirm").val()) == ""){
		$("#passwordConfirm").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#passwordConfirm").css("border","1px solid #CCCCCC");	
		}
		  if($.trim($("#passwordConfirm").val()) !=$.trim($("#password").val())){
		 $("#passwordConfirm").css("border","1px solid red");
		 alert("Password mismatch")	;		  
		 return false;
		 }
		  else{
			$("#passwordConfirm").css("border","1px solid #CCCCCC");	
		}
		if(!$('#right-main input[type="checkbox"]').is(':checked')){
		  alert("Please agree to the terms and conditions");
		  return false;
		}
	
		//alert("success");
		save_user();
	 
}



function checkemail(em)   //Email validation 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))
	return true;
	else
	return false;
}

function verifyLogin(){
	if($.trim($("#loginUsername").val()) == "" || $.trim($("#loginUsername").val()) == "Username"){
		$("#loginUsername").css("border","1px solid red");			  
		 return false;
		 }
	else{
		$("#loginUsername").css("border","1px solid #CCCCCC")
	}
	if($.trim($("#loginPw").val()) == "" || $.trim($("#loginPw").val()) == "Password" ){
		$("#loginPw").css("border","1px solid red");			  
		 return false;
		 }
	else{
		$("#loginPw").css("border","1px solid #CCCCCC")
	}
	login();
}

function validatePostComment(){
	
	if($.trim($("#postasuser").val()) ==-1){
		$("#postasuser").css("border","1px solid red");			  
		 return false;
		 }
	else{
			$("#postasuser").css("border","1px solid #CCCCCC")
		}
	if($.trim($("#category").val()) ==0){
		$("#category").css("border","1px solid red");			  
		 return false;
		 }
	else{
			$("#category").css("border","1px solid #CCCCCC")
		}
	
	
	if($.trim($("#commentArea").val()) == "" || $.trim($("#commentArea").val()) == "Type Text Here"){
		$("#commentArea").css("border","1px solid red");			  
		 return false;
		 }
	
	else{
			$("#commentArea").css("border","0px ");
		}
		checkBadwords();
		
		
}
function checkBadwords(){
	dataString = $('form[name=publicPost]').serialize();
		$.ajax({
				type: "POST",
				url:base_url+"ajax/user-ajax.php?mode=checkComment",
				cache: false,
				data: dataString,
				dataType: "json",
				success: function(data) {
				 if(data.success == "yes")
				  	{    
						show_postAbout();
					}
					else if(data.success == "no")
				  	{    
						  if(data.status=="badwords"){alert("Please avoid bad words from post");}
						 $("#commentArea").css("border","1px solid red");	
					}
				
					else {
						alert(" Occured internal Error.please check network connection" );
					}
				}
		});
}

function notValid(){
	  alert("Please login to post");
	   return false;
}
function notValidSearch(){
	  alert("Please login to Search");
	   return false;
}
function notValidUser(){
	  alert("Please Register/Login");
	   return false;
}
function show_postAbout()
{
	//$("body").append('<div class="modalOverlay">');
	$('#person_area').hide();
	$('#place_area').hide();
	$('#other_area').hide();
	 $('input[name=post_about]:checked').attr('checked', false);
	$('.modalOverlay').show();
	$('.post_about').show("slow");
	
}
function skipPost(v){
	
	if(v==1){
		 $('input[name=post_about]:checked').attr('checked', false);
	 $('.post_about').hide();
	
	}
	if(v==2)
	{
			$('#email').val("");
			 $('.email_add').hide();
	}
	$('.modalOverlay').hide();
	//$('#place_name').val("");
	//$('#other_desc').val("");
	//$('#other_desc').val("");
	
	postComment();
}
function show_nextEmail(){
	 
		if($.trim($("#first_name").val()) == "" || $.trim($("#first_name").val()) == "Type first name here"){
			$("#first_name").css("border","1px solid red");			
			return false;
		}
		else{
		$("#first_name").css("border","1px solid #CCCCCC");
		}
		if($.trim($("#last_name").val()) == "" || $.trim($("#last_name").val()) == "Type last name here"){
			$("#last_name").css("border","1px solid red");			
			return false;
		}
		else{
		$("#first_name").css("border","1px solid #CCCCCC");
		}
	 $('.post_about').hide();
	$('.email_add').show("slow");
	
}
function post_withComment(){
	var postAbout=$('input[name=post_about]:checked').val();
	if(postAbout=="place"){
		if($.trim($("#place_name").val()) == "" || $.trim($("#place_name").val()) == "Type name of place here"){
			$("#place_name").css("border","1px solid red");			
			return false;
		}
		else{
		$("#place_name").css("border","1px solid #CCCCCC");
	}
	}
	if(postAbout=="other"){
		if($.trim($("#other_desc").val()) == "" || $.trim($("#other_desc").val()) == "Type text here"){
			$("#other_desc").css("border","1px solid red");			
			return false;
		}
		else{
		$("#other_desc").css("border","1px solid #CCCCCC");
	}
	}
	
	 $('.post_about').hide();
	// $('.modalOverlay').hide();
	// postComment();
	$('.email_add').show("slow");
	
}

function sendAlert(){
	
	if($.trim($("#email").val()) == "" || $.trim($("#email").val()) == "Enter email address here"){
			$("#email").css("border","1px solid red");			
			return false;
		}
		else{
		$("#email").css("border","1px solid #CCCCCC");
	}
	 $('.email_add').hide();
	// $('.modalOverlay').hide();
	// postComment();
	$('.email_from').show();
	
}
function searchNow(){
	
	/* if($.trim($("#s_first_name").val()) == "" && $.trim($("#s_last_name").val()) == ""  && $.trim($("#s_age").val()) == "" &&
		$.trim($("#s_location").val()) == ""  && $.trim($("#s_zipcode").val()) == ""  && $.trim($("#s_nick_name").val()) == "" 
		&&$.trim($("#s_others").val()) == ""){
		//v=0;alert("1");
		alert("e1");return false;
	}
	 */
	  if($.trim($("#s_first_name").val()) == "FIRST NAME" && $.trim($("#s_last_name").val()) == "LAST NAME"  && $.trim($("#s_age").val()) == "AGE" &&
		$.trim($("#s_location").val()) == "LOCATION"  && $.trim($("#s_nick_name").val()) == "NICK NAME" && $.trim($("#s_groups").val()) == "GROUPS" 
		&& $.trim($("#s_pods").val()) == "PODS"){
		alert("Enter atleast one field");
		return false;
	 }
	
	$('#search-form').submit();
}
function sendEmailanonymousCheck(v){
	if(v==1) {
		 $('.modalOverlay').hide();
		 $('#emailidUser').val("0");
		 $('.email_from').hide();
		  postComment();
	}
	else{
		$('.modalOverlay').hide();
		 $('#emailidUser').val("1");
		 $('.email_from').hide();
		  postComment();
	}
}

function forgotPw(){
	$('.modalOverlayHed').show();
	$('.forgot_pw').show();
}
function deleteOwnPost(id){
	var answer = confirm('Are you sure you want to delete this post?');
	if (answer)
		{
			 dataString='id='+id;
			 $.ajax({
				   type: "POST",
					url:base_url+"ajax/post-ajax.php?mode=deletePost",
					cache: false,
					data: dataString,
					dataType: "json",
					success: function(data) {
					if(data.success == "yes")
					  {    
						
						 //$("#message_txt").val('');
						 //$("#to_user").val('');
						$("#"+id).hide();
						
						}
					
						else {
							alert(" Occured internal Error.please check network connection" );
						}
					}
			});
		}
	else
	{
 	 console.log('cancel');
	}
}