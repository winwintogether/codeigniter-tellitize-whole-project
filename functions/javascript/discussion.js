//var base_url="http://localhost/tellitize_new/";
//var base_url="http://yours-website.com/tellitize/";
//var base_url="http://www.tellitize.com/";
function addToGroup(){
	 var email=$.trim($("#email").val());
	  if($.trim($("#name").val()) == ""){
		  $("#name").css("border","1px solid red");
		  return false;
	  }
	  else{
		   $("#name").css("border","1px");
	  }
	 /*  if($.trim($("#email").val()) == ""){
		$("#email").css("border","1px solid red");			  
		 return false;
		 }
		else */if($.trim($("#email").val()) != "")
			{ if(!checkemail(email)){
				alert("Invalid emailid");
				$("#email").css("border","1px solid red");			  
			 return false;
			
    		}
		else{
			$("#email").css("border","1px solid #CCCCCC");	
		}
			}
	  if($.trim($("#places").val()) == 0 ){
		  $("#places").css("border","1px solid red");	
		  return false;
	  }
	  else{
		   $("#places").css("border","1px");
	  }
	 // saveDiscussionUser();
	  listPODUsers();
}
function listPODUsers(){
	dataString = $('form[name=adddiscussion]').serialize();
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=listPodUsers",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('.modalOverlay').show();
				$('#userListPOD').html(data.html);
				$('#userListPOD').show();
				}
			
				else {
					saveDiscussionUser(0);
				}
			}
	});
}
function saveExistDiscussionUser(){
	dataString = $('form[name=adddiscussion]').serialize();
	$.ajax({
		   type: "POST",
			url:base_url+"ajax/user-ajax.php?mode=saveDiscussionUser&notexist=0",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			{
				$('.modalOverlay').hide();
				$('#userListPOD').hide();
				$("#exist_result").hide();
				$("#add_result").show();
				/*$("#adddiscussion").attr("action", <?php  echo $GLOBALS['base_url'];?>+"placediscussions?placeid="+data.place);*/
				$('#adddiscussion').submit();
			}
			else 
			{
				alert(" Occured internal Error.please check network connection" );
			}
		}
	});
}

function searchUser()
{
	var place_id =  $("#places").val();
	$.ajax({
	   type: "POST",
		url:base_url+"ajax/user-ajax.php?mode=get_place_name_link&place_id="+place_id,
		cache: false,
		data: dataString,
		dataType: "html",
		success: function(data) { 
			if(data != "")
			{
				var location			= base_url+data;
				window.location.href 	= location;
			}
			else 
			{
				history.back(-1);
			}
		}
	});
}

function closePODexistlist()
{
	$("#userExistPOD").hide();
}

function saveDiscussionUser(userid){
	dataString = $('form[name=adddiscussion]').serialize();
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=saveDiscussionUser&userid="+userid,
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  { 
			  	$('.modalOverlay').hide();
				$('#userListPOD').hide();
				 $("#exist_result").hide();
				 $("#add_result").show();
				$("#adddiscussion").attr("action",base_url+"placediscussions?placeid="+data.place);
				$('#adddiscussion').submit();
				
				}
			 else if(data.status == "exist")
			  {  
			  	$('.modalOverlay').hide();
				$('#userListPOD').hide();
			    $("#add_result").hide();
			    $("#exist_result").show();
			  	return false;
			  }
			 else if(data.status == "existname")
			  {  
			  	$('#userListPOD').hide();
				$('#userExistPOD').show();
				return false;
			  }
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
function checkemail(em)   //Email validation 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))
	return true;
	else
	return false;
}

function validateGroupPostComment(){ 
	
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
		checkGroupPostBadwords();
		
		
}
function checkGroupPostBadwords(){
	dataString = $('form[name=publicPost]').serialize();
		$.ajax({
				type: "POST",
				url: base_url+"ajax/user-ajax.php?mode=checkComment",
				cache: false,
				data: dataString,
				dataType: "json",
				success: function(data) {
				 if(data.success == "yes")
				  	{    
						groupPostCommentCheckemail();
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
function sendAlertGroup(){
	
	if($.trim($("#email").val()) == "" || $.trim($("#email").val()) == "Enter email address here"){
			$("#email").css("border","1px solid red");			
			return false;
		}
		else{
		$("#email").css("border","1px solid #CCCCCC");
	}
	$('.email_add').hide();
	 $('.modalOverlay').hide();
	 $('.title_hed').html('<input type="hidden" name="user_email" value="'+$("#email").val()+'" id="user_email"><input type="hidden" name="name_user" value="'+name+'">'+name);
	 groupPostComment();
	
}
function skipPostPod(v){
	
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
	
	groupPostComment();
}
function closePODlist(){
		  $('.modalOverlay').hide();	
		  $('#userListPOD').hide();	
}
function delPodUser(id){
	var answer = confirm('Are you sure you want to delete this memeber?');
	if (answer)
	{
		$.ajax({
					type: "POST",
					url: base_url+"ajax/user-ajax.php?mode=delPodUser&id="+id,
					cache: false,
					dataType: "json",
					success: function(data) {
					 if(data.success == "yes")
						{    
							$('#poduserlist_'+id).hide();
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