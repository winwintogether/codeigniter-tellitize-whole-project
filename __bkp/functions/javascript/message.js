var base_url="http://www.tellitize.com/";
//var base_url="http://localhost/tellitize/";
function sendMessage(){
	  if($.trim($("#to_user").val()) == ""){
		  $("#to_user").css("border","1px solid red");
		  return false;
	  }
	  else{
		   $("#to_user").css("border","1px");
	  }
	  if($.trim($("#message_txt").val()) == ""){
		  $("#message_txt").css("border","1px solid red");	
		  return false;
	  }
	  else{
		   $("#message_txt").css("border","1px");
	  }
	  saveMessage();
}
function saveMessage(){
	dataString = $('form[name=messageForm]').serialize();
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/message-ajax.php?mode=saveMessage",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				 $("#message_txt").val('');
				 $("#to_user").val('');
				 $("#msg_result").show('');
				
				}
			 else if(data.status == "notexist")
			  {   
			   // $("#to_user").css("border","1px solid red");
			  	return false;
			  }
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
function deleteMsg(id){
	var answer = confirm('Are you sure you want to delete this message?');
if (answer)
	{
		$.ajax({
		   type: "POST",
			url: base_url+"ajax/message-ajax.php?mode=deleteMessage",
			cache: false,
			data: "id="+id,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
			     $('.message_box'+id).html('');
				
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

function viewMore(id){
	
	 $('#message_body'+id).hide('');
	 $('#message_body_full'+id).show();
}