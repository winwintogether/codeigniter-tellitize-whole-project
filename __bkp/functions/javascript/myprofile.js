
$(function() {
		   
		 
		
		$('#editButton').click(function() {
			// $('#filter_contact').hide();
		 	$('#editButton').hide();
			$('#user_photo').removeAttr('disabled')
			$('#username').removeAttr('disabled');
			$('#name').removeAttr('disabled');
			$('#email').removeAttr('disabled');
			$('#password').removeAttr('disabled');
			$('#location').removeAttr('disabled');
			$('#aboutme').removeAttr('disabled');
			$("#doneButton").show();
					
			
	     });
	});	 


function validateUpdation(){
	 var email=$.trim($("#email").val());
	 if($.trim($("#username").val()) == ""){
		$("#username").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#username").css("border","1px solid #CCCCCC");	
		}
	if($.trim($("#firstname").val()) == ""){
		$("#firstname").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#firstname").css("border","1px solid #CCCCCC");	
		}
	if($.trim($("#lastname").val()) == ""){
		$("#lastname").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#lastname").css("border","1px solid #CCCCCC");	
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
		
		
		/* if($.trim($("#password").val()) == ""){
		$("#password").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#password").css("border","1px solid #CCCCCC");	
		}*/
		updateUser();
}
function validateGroup(){
	
	 if($.trim($("#gname").val()) == ""){
		$("#gname").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#gname").css("border","1px solid #CCCCCC");	
		}
	
	if($.trim($("#g_desc").val()) == ""){
		$("#g_desc").css("border","1px solid red");			  
		 return false;
		 }

		else{
			$("#g_desc").css("border","1px solid #CCCCCC");	
		}
		
	
		createGroup();
}

function validateDiscussion(){
	 
	 if($.trim($("#place").val()) == ""){
		$("#place").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#place").css("border","1px solid #CCCCCC");	
		}
	
	if($.trim($("#p_desc").val()) == ""){
		$("#p_desc").css("border","1px solid red");			  
		 return false;
		 }

		else{
			$("#p_desc").css("border","1px solid #CCCCCC");	
		}
		
	
		createPlace();
}

function checkemail(em)   //Email validation 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))
	return true;
	else
	return false;
}
function updatePassword(){
	 if($.trim($("#oldpw").val()) == ""){
		$("#oldpw").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#oldpw").css("border","1px solid #CCCCCC");	
		}
		 if($.trim($("#newpw").val()) == ""){
		$("#newpw").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#newpw").css("border","1px solid #CCCCCC");	
		}
		 if($.trim($("#confirm_pw").val()) == ""){
		$("#confirm_pw").css("border","1px solid red");			  
		 return false;
		 }
		 else{
			$("#confirm_pw").css("border","1px solid #CCCCCC");	
		}
		savePassword();
	
}

