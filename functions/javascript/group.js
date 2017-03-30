
//var base_url="http://localhost/tellitize/";


function addToGroup(){
	 var email=$.trim($("#email").val());
	  if($.trim($("#name").val()) == ""){
		  $("#name").css("border","1px solid red");
		  return false;
	  }
	  else{
		   $("#name").css("border","1px");
	  }
	  /* if($.trim($("#email").val()) == ""){
		$("#email").css("border","1px solid red");			  
		 return false;
		 }
		else*/
		if($.trim($("#email").val()) != "")
		{
				if(!checkemail(email)){
				alert("Invalid emailid");
				$("#email").css("border","1px solid red");			  
			 return false;
				
			}
			else{
				$("#email").css("border","1px solid #CCCCCC");	
			}
		}
	  if($.trim($("#group").val()) == 0 ){
		  $("#group").css("border","1px solid red");	
		  return false;
	  }
	  else{
		   $("#group").css("border","1px");
	  }
	 // saveGroup();
	 listUsers();
}
function listUsers(){
	dataString = $('form[name=addgroup]').serialize();
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=listUsers",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('.modalOverlay').show();
				$('#userListView').html(data.html);
				$('#userListView').show();
				}
			
				else {
					saveGroup(0);
				}
			}
	});
}
function saveExistgroupUser(){
	dataString = $('form[name=addgroup]').serialize();
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=saveGroup&notexist=0",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				 $("#exist_result").hide();
				 $("#add_result").show();
				 $('#userExistgroup').hide();
				 $("#addgroup").attr("action",base_url+"groupdiscussions?groupid="+data.group);
				$('#addgroup').submit();
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
function saveGroup(userid){
	dataString = $('form[name=addgroup]').serialize();
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=saveGroup&userid="+userid,
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				 //$("#message_txt").val('');
				// $("#to_user").val('');
				 $("#exist_result").hide();
				 $("#add_result").show();
				 
				 $("#addgroup").attr("action",base_url+"groupdiscussions?groupid="+data.group);
				$('#addgroup').submit();
				 
				
				}
			 else if(data.status == "exist")
			  {   
			   $('.modalOverlay').hide();
				$('#userListView').hide();
			   $("#add_result").hide();
			    $("#exist_result").show();
			  	return false;
			  }
			  else if(data.status == "existname")
			  {  
			  	$('#userListView').hide();
				$('#userExistgroup').show();
				return false;
			  }
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}


function showEdit(id){
	$('.edit_delete'+id).show();
}
function hideEdit(id){
	$('.edit_delete'+id).hide();
}
function deleteGroup(id){
	var answer = confirm('Are you sure you want to delete this Group?');
	if (answer)
	{
	
			$.ajax({
				   type: "POST",
					url: base_url+"ajax/user-ajax.php?mode=deleteGroup&id="+id,
					cache: false,
					dataType: "json",
					success: function(data) {
					if(data.success == "yes")
					  {    
						
						$("#grouplist"+id).hide();			
						
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

function showEditPlace(id){
	$('.edit_deletePlace'+id).show();
}
function hideEditPlace(id){
	$('.edit_deletePlace'+id).hide();
}
function deletePlace(id){
	var answer = confirm('Are you sure you want to delete this POD?');
	if (answer)
	{
	
			$.ajax({
				   type: "POST",
					url: base_url+"ajax/user-ajax.php?mode=deletePlace&id="+id,
					cache: false,
					dataType: "json",
					success: function(data) {
					if(data.success == "yes")
					  {    
						
						$("#placelist"+id).hide();		
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
		
		var name_user = $("#name_user").val();
		$(".name_user").val(name_user);
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
	 $('.title_hed').html('<input type="hidden" name="user_email" value="'+$("#email").val()+'" id="user_email"><input type="hidden" name="name_user" id="name_user" value="'+name+'">'+name);
	 groupPostComment();
}

function nextStep()
{
	$('.email_add').hide();
	$('.email_from').show();
}

function skipPostGroup(v){
	
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
function closeUserlist(){
		  $('.modalOverlay').hide();	
		  $('#userListView').hide();	
}
function closegroupexistlist(){
		  $('.modalOverlay').hide();	
		  $('#userExistgroup').hide();	
}
function delGroupUser(id){
	var answer = confirm('Are you sure you want to delete this memeber?');
	if (answer)
	{
		$.ajax({
					type: "POST",
					url: base_url+"ajax/user-ajax.php?mode=deleteGroupUser&id="+id,
					cache: false,
					dataType: "json",
					success: function(data) {
					 if(data.success == "yes")
						{    
							$('#groupuserlist_'+id).hide();
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