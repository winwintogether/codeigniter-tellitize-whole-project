var base_url="http://www.tellitize.com/";
//var base_url="http://localhost/tellitize/";
function showDeletePost(id){
	 
	 $('.delete-post'+id).show();
}
function hideDeletePost(id){
	 
	 $('.delete-post'+id).hide();
}
function deleteMyPost(id){
	var answer = confirm('Are you sure you want to delete this post?');
	if (answer)
		{
			 dataString='id='+id;
			 $.ajax({
				   type: "POST",
					url: base_url+"ajax/post-ajax.php?mode=deletePost",
					cache: false,
					data: dataString,
					dataType: "json",
					success: function(data) {
					if(data.success == "yes")
					  {    
						
						 //$("#message_txt").val('');
						 //$("#to_user").val('');
						$("#list_"+id).hide();
						
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