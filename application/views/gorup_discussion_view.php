<?php
/*$IP =$_SERVER['REMOTE_ADDR'];
//$location=file_get_contents ('http://api.ipinfodb.com/v3/ip-country/?key=b2d523786815bab0125937c7bbbbc87e67f3f70eecae2fdd9e3456c2d5fc0eaa&ip='.$IP);
$location=$this->ip2locationlite->getCity($IP);
$city=$this->ip2locationlite->getCity($IP);
echo $location['countryName'].','.$location['regionName'].','.$location['cityName'];*/

 
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tellitize</title>

<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>functions/css/message.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>functions/css/group.css" rel="stylesheet" />
<style type="text/css">
#scrollbox{ width:180px; height:500px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
</style>
</head>
<body>
<div class="modalOverlay" style="display:none"></div>
<div id="header">
<?php $this->load->view('header'); $base_url=$GLOBALS['base_url'];?>
</div>

   <input type="hidden" name="nameuser" value="" id="nameuser">
	<input type="hidden" name="emailuser" value="" id="emailuser">
	<div id="mid_container" class="group_posts">
		<div class="mid_content">
			<div id="group_posts_left" >
									<div class="top_bar_left" style="width:180px;"><span>User List</span></div>
									<div style="margin-bottom:10px;overflow:hidden;">
									  <input type="text" name="search_name" value="Search name here" onFocus="if(this.value  == 'Search name here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Search name here'; } " id="search_name" style="float:left;width:175px;" onKeyUp="searchgroupusers();">
									<!--<a href="javascript:void(0);" style="float:right" onClick="searchgroupusers();">
									<img width="25" height="20" src="<?php echo $GLOBALS['base_url']; ?>images/searchname.jpg" alt="search-icon" >
									</a>-->
									</div>
									<div id="scrollbox">
									 <?php
									 		echo $groupUsers;
									 ?>
									 </div>
									
			</div><!--left_msg-->
			<div class="left" style="width:515px;">
			<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;">
							
							</div>
						</div><!--top_bar-->

					 <div class="top_text_message">Click on the tellitize button adjacent to names to post about the person</div>
						
				<div class="post_area_bg">
								<div class="orang_left"></div>
								<div class="orang_mid" style="width:487px;">
									<h4>Group POST AREA</h4>
									<!--<span style="float:right">
									<a href="javascript:void(0)"  onClick="refreshPost();"><img width="102" height="36" alt="refresh-icon" src="../images/refresh-icon.png" id="refresh"></a>
									</span>-->
									</div>
								<div class="orang_rit"></div>
								
						</div>
						<div id="post_contents" style="width:487px;">
						
							<?php if(isset($article)) echo $article;?>
						 	
						
						</div>
	
  </div>
 <?php
 	require("right-nav.php");
 ?>
</div>
</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
<!--post_about pop up-->
<?php
		  echo form_open('posts',array('name' => 'postAbout' ,'id'=>'posts')); 
	 ?>
<div class="post_about" style="display:none">
	
	<div  id="close_signUp">
		<img src="<?php echo $GLOBALS['base_url']; ?>images/close_icon2.png" alt="close"/>
	</div>
	
	<h3>Would you like to Post About 
	<input type="radio" name="post_about" value="person" id="person">Person
	<input type="radio" name="post_about" value="place" id="place">Place
	<input type="radio" name="post_about" value="other" id="other">Other</h3>
	
	<ul id="person_area" style="display:none">
		<li style="float:left">First Name</li>
		<li style="float:left">
			<input type="text" name="first_name" value="Type first name here" onFocus="if(this.value  == 'Type first name here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Type first name here'; } " id="first_name">
		</li>
		<li style="clear:left;float:left">Last Name</li>
		<li style="float:left">
			<input type="text" id="last_name" name="last_name" value="Type last name here" onFocus="if(this.value  == 'Type last name here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Type last name here'; } ">
		</li>
		<li style="float:right;padding-right:50px;clear:left"> <input type="button" value="NEXT" onClick="show_nextEmail()" id="postbtn"></li>
		
		
	</ul>
	<ul id="place_area" style="display:none">
		<li style="float:left"> Name of Place</li>
		<li style="float:left">
			<input type="text" name="place_name" value="Type name of place here" onFocus="if(this.value  == 'Type name of place here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Type name of place here'; } " id="place_name">
		</li>
		
		<li style="float:right;padding-right:50px;clear:left"> <input type="button" value="NEXT" onClick="post_withComment()" id="postbtn"></li>
		
		
	</ul>
	<ul id="other_area" style="display:none">
		<li style="float:left">Enter here...</li>
		<li style="float:left">
			<input type="text" name="other_desc" value="Type text here" onFocus="if(this.value  == 'Type text here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Type text here'; } " id="other_desc">
		</li>
		
		<li style="float:right;padding-right:50px;clear:left"> <input type="button" value="NEXT" onClick="post_withComment()" id="postbtn"></li>
		
		
	</ul>
	<!--<a href="javascript:void(0)" onClick="skipPost(1);">Skip</a>-->

</div>
<?php echo form_close(); ?>
<!-- ends post_about pop up-->


<!--email_add pop up-->
<div class="email_add" style="display:none">
	
	
	<form name="mailAlert" method="post" id="mailAlert">
	 	
		<h3>Would You Like To Email This Message To Somebody?
		<input type="radio" name="email" value="1" id="email_yes">Yes
		<input type="radio" name="email" value="0" id="email_no" onClick="skipPost(2);">No
		</h3>
		<div style="display:none" id="email_field">
			<ul>
			<li style="float:left">Email Id</li>
			<li style="float:left;padding-left:7px;">
				<input type="text" id="email" name="email" value="Enter email address here" onFocus="if(this.value  == 'Enter email address here') { this.value = ''; } " 
										onblur="if(this.value == '') { this.value = 'Enter email address here'; } ">
			</li>
		 <li style="clear:left"><input type="button" value="Send Alert" onClick="sendAlertGroup()" id="postbtn"></li>
		 </ul>
		 </div>
		 <!--<a href="javascript:void(0)" onClick="skipPostGroup(2);">Skip</a>-->
	</form>
</div>
<!-- ends email_add pop up-->

<!--<tellitize post pop up starts here...-->

					<div class="post_main" id="post_main_group" style="display:none;">
							<div  id="close_post">
								<img src="<?php echo $GLOBALS['base_url']; ?>images/close_icon2.png" alt="close"/>
							</div>
							<div class="post_main_content">
								  <?php echo form_open('posts',array('name' => 'publicPost' ,'id'=>'publicPost')); ?>
								  <?php if(isset($_SESSION['username'])){ ?>
								 
								<div class="black_sep" style="height:23px;">
									<span style="color:#FFFFFF;font:13px arial;font-weight:bold;padding:4px;" class="title_hed">Title</span>
									<!--<div style="float:right">
										<?php //echo $groupUsersList; ?>
									</div>-->
								</div>
									<?php } else {?>
								<div class="anonyms_text">FROM:<span style="color:#FF7C00;font-weight:bold;"> Anonymous</span> </div>
								
								<div style="" class="tellitize_text"><h2>Tellitize</h2></div>
								<div class="black_sep"></div>
								<?php } ?>	
								
								
									<textarea class="tetlize-text-comment" name="commentArea" id="commentArea"  onfocus="if(this.value  == 'Type Text Here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Type Text Here'; } " style="max-width:454px; min-width:454px;" />Type Text Here</textarea>
									<input type="hidden" name="location" id="location" value="<?php echo $city.','.$country;?>">
									<input type="hidden" name="group" id="group_id" value="<?php echo $groupid;?>">
							
								 <div class="top_from" style="width:100%;margin-bottom:3px;margin-left:9px;">
								<?php if(isset($_SESSION['username'])){ ?>
								<div  class="postTopBox"> <div class="postTop-title">POST AS :</div>
									<div>
									<select name="postasuser" id="postasuser" class="toppost" style="width:80px;">
									<option value="-1">Select</option>
									<option value="0">Anonymous</option>
									<option value="<?php echo $_SESSION['userid'];?>"><?php echo  $_SESSION['username'];?></option>
									</select> 
									</div>
								</div>
								
								<div class="post-btn" style="width:60px;">
									<div class="orangeButton" style="margin-top:-3px;margin-left:10px;">
										<input type="button" name="post" value="post" class="orangeButton-right" onClick="<?php if(isset($_SESSION['username'])){ ?>validateGroupPostComment()<?php }else { ?>notValid()<?php }  ?>" style="width:44px">
									</div>
								</div>
								<div style="margin-left:3px;" class="postTopBox">
									<div class="postTop-title">SELECT CATEGORY: </div>
								  	<div><?php if(isset($category)) echo $category;?></div>
								</div>
								<?php } else{ ?>
								
								
								<div class="post-btn">
								
								<a href="javascript:void(0)">
								<img width="72" height="26" alt="post-comment" src="<?php echo $GLOBALS['base_url']; ?>images/post.png" 
								onClick="notValid();">
								</a>
								</div>
								<div style="margin-left:10px;" class="postTopBox"><div class="postTop-title">SELECT CATEGORY: </div>
								  <div><?php if(isset($category)) echo $category;?></div>
									
								</div>
								<?php } ?>
																
								
								</div>
							
							
							</div>
							<?php echo form_close(); ?>
							
							
							
				</div><!--post_main-->

<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/message.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/group.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	//$("ul.pagination2").quickPagination({pagerLocation:"both"});
	//$("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
});
</script>
<script language="javascript">


	$(document).ready(function() {
		$('#close_signUp').click(function() {
			// $('#filter_contact').hide();
		 	$('.post_about').hide();
			//$("#email").val("");
			$('.modalOverlay').hide();
		});
		 	   
		 $('#close_post').click(function() {
		 	$('#post_main_group').hide();
		 	$('.modalOverlay').hide();			
	     });
		 
		 $('input[id=email_yes]').change(function(){
           $('#email_field').show();
		 });
		 
		$('input[id=email_no]').change(function(){
			$('#email_field').hide();
		});
		
	 $('input[id=person]').change(function(){
           $('#person_area').show();
		   $('#place_area').hide();
			$('#other_area').hide();
	});
	$('input[id=place]').change(function(){
           $('#place_area').show();
		   $('#person_area').hide();
			$('#other_area').hide();
	});
	$('input[id=other]').change(function(){
           $('#other_area').show();
		   $('#person_area').hide();
			$('#place_area').hide();
	});
	var lastid;
function lastPostFunc() 
{ 
    	 if(lastid== $(".contents_list:last").attr("id")) return false;
        lastid=$(".contents_list:last").attr("id");
		$(".contents_list:last").after('<div class="receive_text"><div id="receiveImg"><img src="<?php echo $GLOBALS['base_url']; ?>/images/recivingGif.gif" width="174" height="89"></div></div>');
		var groupid=$('#group_id').val();
		var name=$('#nameuser').val();
		var email=$('#emailuser').val();
		$.ajax({
				type: "POST",
				url: "<?php echo $GLOBALS['base_url']; ?>ajax/scroll-ajax.php?mode=getLastPosts&groupid="+groupid+"&name="+name+" &email="+email+"&lastID=" + $(".contents_list:last").attr("id"), 
				cache: false,
				dataType: "json",
				success: function(data) {	
				 if(data.success == "yes")
				  {    
					 $(".receive_text").html('');
					 $(".receive_text").hide();
					 $(".contents_list:last").after(data.html);  
					
					}
				
					
					else {
						alert(" Occured internal Error.please check network connection" );
					}
				}
			});
			
};  
	var $myDiv = $('.contents_list');

    if ( $myDiv.length){
	
			 $(window).scroll(function(){
			if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			   lastPostFunc();
			}
			});
		} 
		
    });


	function refreshPost(){
	        $('#post_contents').html('<p align="center"><img src="<?php echo $GLOBALS['base_url']; ?>images/ajax-loader.gif"  /></p>');
			var groupid=$('#group_id').val();
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=viewComment&groupid="+groupid,
			cache: false,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {    
				
				//$('#post_contents').html('');
				$('#post_contents').html(data.html);
				
				
				}
				else if(data.success == "no")
			    {    
					alert("failed to load");
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	function groupPostCommentCheckemail(){
		var email=$('#user_email').val();
		if(email=='Enter email address here') email='';
		if(email!=''){
			groupPostComment();
		}
			else
			{
				
				$('#post_main_group').hide('slow');
						$('.modalOverlay').hide();
				$('.email_add').show("slow");
			}	
	}
	function groupPostComment(){
	
	  
		dataString = $('form[name=publicPost]').serialize();
		
		
		
				$.ajax({
					type: "POST",
					url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=saveComment",
					cache: false,
					data: dataString,
					dataType: "json",
					success: function(data) {
					 if(data.success == "yes")
					  {    
						
						$('#commentArea').val('');
						$('#email').val('');						
						$('#post_main_group').hide('slow');
						$('.modalOverlay').hide();
						refreshPost();
						
						}
						else if(data.success == "no")
						{    
							if(data.status == "notauser"){
							  alert("Please login to post");
							}
							else
							{ 
							alert("failed ");
							}
						}
					
						else {
							alert(" Occured internal Error.please check network connection" );
						}
					}
				});
			
		
	}

function agreePost(id){
	        dataString='postid='+id+'&lik=1';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreePost",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('#agree_circle'+id).html('');
				$('#agree_circle'+id).html(data.agree);
				$('#disagree_circle'+id).html('');
				$('#disagree_circle'+id).html(data.disagree);
				$('#agreebtn'+id).hide();
				$('#agreebtn'+id).hide();
				$('#btn'+id).html("");
				$('#btn'+id).html('<a href="javascript:void(0)"  id="disagreebtn" class="disable_agree"></a>');
				$('#btnd'+id).html("");
				$('#btnd'+id).html('<a href="javascript:void(0)"  id="disagreebtn'+id+'" class="able_disagree" onclick="disagreePost('+id+')">disagree</a>');
				//$('#disagreebtn'+id).hide();
				
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already agreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	function disagreePost(id){
	        dataString='postid='+id+'&lik=0';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreePost",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('#agree_circle'+id).html('');
				$('#agree_circle'+id).html(data.agree);
				$('#disagree_circle'+id).html('');
				$('#disagree_circle'+id).html(data.disagree);
				//$('#agreebtn'+id).hide();
				//$('#disagreebtn'+id).hide();
				$('#btnd'+id).html("");
				$('#btnd'+id).html('<a href="javascript:void(0)"  id="disagreebtn" class="disable_disagree"></a>');
				$('#btn'+id).html("");
				$('#btn'+id).html('<a href="javascript:void(0)" id="agreebtn'+id+'" class="able_agree" onclick="agreePost('+id+')">agree</a>');
				
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already disagreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
	
	
function postReply(id){
			//$('#post_contents').html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
			if($.trim($('#commentreplyArea'+id).val()) == ""){
			$('#commentreplyArea'+id).css("border","1px solid red");			  
			 return false;
			 }
			 else{
				$('#commentreplyArea'+id).css("border","");	
			}
			var comment=$('#commentreplyArea'+id).val();
	        dataString='postid='+id+'&comment='+comment;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=postReplyGroup",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {  
			  	 $('.view_all'+id).html('');
				 $('.view_all'+id).html(data.view);
				$('.viewList'+id).html('');
				$('#commentreplyArea'+id).val('');
				$('.viewList'+id).html(data.html);
				//alert("s");
				}
				else if(data.success == "no")
			    {    
				    
					alert("failed to load");
					
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
   function reportAbuse(id){
			$('#post_contents').html('<p align="center"><img src="<?php echo $GLOBALS['base_url']; ?>images/ajax-loader.gif"  /></p>');
	        dataString='postid='+id;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=reportAbuse",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				refreshPost();
				}
				else if(data.success == "no")
			    {    
				    
					alert("failed to load");
					
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	
  function viewreplies(id){	
  	 		dataString='postid='+id;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=viewRepliesGroup",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {      
			        $('.view_all'+id).html('');
			  		 $('.viewList'+id).html('');
			   		$('.viewList'+id).html(data.html);
				
				}
				else if(data.success == "no")
			    {    
				    
					alert("failed to load");
					
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
 } 
 
 function agreeReply(id){
	        dataString='replyid='+id+'&lik=1';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreeReply",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				
				$('.agreeReply'+id).html("");
				$('.agreeReply'+id).html("<a>Agreed</a>");
				$('.disagreeReply'+id).html("");
				$('.disagreeReply'+id).html('<a onclick="disagreeReply('+id+');" href="javascript:void(0);">Disgree </a>');
				$('#agreereply_circle'+id).html('');
				$('#agreereply_circle'+id).html(data.agree);
				$('#disagreereply_circle'+id).html('');
				$('#disagreereply_circle'+id).html(data.disagree);
				
				//alert(""+data.agree);
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already agreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
	 function disagreeReply(id){
	        dataString='replyid='+id+'&lik=0';
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=agreeReply",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				$('.disagreeReply'+id).html("");
				$('.disagreeReply'+id).html("<a>Disgreed</a>");
				$('.agreeReply'+id).html("");
				$('.agreeReply'+id).html('<a onclick="agreeReply('+id+');" href="javascript:void(0);">Agree</a>');
				$('#agreereply_circle'+id).html('');
				$('#agreereply_circle'+id).html(data.agree);
				$('#disagreereply_circle'+id).html('');
				$('#disagreereply_circle'+id).html(data.disagree);
				
				//alert(""+data.agree);
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already disagreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}	
	
	function deleteReply(id,pid){
	        dataString='replyid='+id+'&pid='+pid;
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=deleteReplyGroup",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('.view_all'+pid).html('');
				$('.view_all'+pid).html(data.view);
				$('.viewList'+pid).html('');
				$('#commentreplyArea'+pid).val('');
				$('.viewList'+pid).html(data.html);
				}
				else if(data.success == "no")
			    {    
				    if(data.status=='liked'){
						alert("already disagreed");
					}
					else{
					alert("failed to load");
					}
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
	}
	
	function showPostArea(name,email){
		$('#post_main_group').show();
		$('.modalOverlay').show();
		$('.title_hed').html('');
		$('.title_hed').html('<input type="hidden" name="user_email" value="'+email+'" id="user_email"><input type="hidden" name="name_user" value="'+name+'">'+name);
	}
	function showPostsAbout(name,email,id){
	   $('#nameuser').val(name);
	    $('#emailuser').val(email);
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=viewPostsAbout&groupid="+id+"&name="+name+"&email="+email,
			cache: false,
			dataType: "json",
			success: function(data) { 
				if(data.success == "yes")
				  {    
					$('#post_contents').html('');
					$('#post_contents').html(data.html);
					}
					
				
				else {
						alert(" Occured internal Error.please check network connection" );
				}
			}
		});
		
	}
	
function searchgroupusers(){

	var name=$('#search_name').val();
	$.ajax({
					type: "POST",
					url: base_url+"ajax/user-ajax.php?mode=searchGroupUsers&id="+<?php echo $groupid; ?>+"&name="+name,
					cache: false,
					dataType: "json",
					success: function(data) {
					 if(data.success == "yes")
						{    
							//$('#groupuserlist_'+id).hide();
							$('#scrollbox').html('');$('#scrollbox').html(data.html);
						}
										
						else {
							alert(" Occured internal Error.please check network connection" );
						}
					}
			});
}
	</script>
