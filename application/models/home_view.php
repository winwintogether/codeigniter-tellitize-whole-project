<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tellitize</title>

</head>
<body>
<div class="modalOverlay" style="display:none"></div>
<div id="header">
<?php $this->load->view('header'); ?>
</div>


	<div id="mid_container">
			<div class="mid_content">
				<div class="left">
						<div class="top_bar">
							<div class="man_icon"></div>
							<div class="mid-text">
								<h4>Where Anything and Everything Can Be Said </h4>
								<h3>This is a place to find out how others view you </h3>
							</div>
							<div class="user_group">
								<h3>Send Anonymous Messages </h3>
							</div>
						</div><!--top_bar-->
						<div class="post_main">
							<div class="post_main_content">
								  <?php echo form_open('posts',array('name' => 'publicPost' ,'id'=>'publicPost')); ?>
								  <?php if(isset($_SESSION['username'])){ ?>
								 
								<div class="black_sep" style="height:23px;">
									<span style="color:#FFFFFF;font:13px arial;font-weight:bold;padding:4px;">Title</span>
								</div>
									<?php } else {?>
								<div class="anonyms_text">FROM:<span style="color:#FF7C00;font-weight:bold;"> Anonymous</span> </div>
								
								<div style="" class="tellitize_text"><h2>Tellitize</h2></div>
								<div class="black_sep"></div>
								<?php } ?>	
								
								<div class="tetlize-text-comment">
									<textarea class="input-tetlize word" name="commentArea" id="commentArea"  onfocus="if(this.value  == 'Type Text Here') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Type Text Here'; } " />Type Text Here</textarea>
								</div>
								
								<!--<div class="titlz-namebox-bottom"><?php //echo $city.','.$country;?></div>	-->
								<input type="hidden" name="location" id="location" value="<?php echo $city.','.$country;?>">
								 <div  class="top_from" style="width:92%;margin-left:4%;margin-bottom:3px;">
								
								
								<!--<div style="float:left;padding-right:1%;width:53%">
									<div style="float:left"><input type="checkbox" value="1" name="postasuser"></div>
									<span  class="as_user"><?php //echo  $_SESSION['username'];?></span>
									
								</div>-->
								<?php if(isset($_SESSION['username'])){ ?>
								<div  class="postTopBox"> <div class="postTop-title">POST AS :</div>
									<div>
									<select name="postasuser" id="postasuser" class="toppost">
									<option value="-1">Select</option>
									<option value="0">Anonymous</option>
									<option value="<?php echo $_SESSION['userid'];?>"><?php echo  $_SESSION['username'];?></option>
									</select> 
									</div>
								</div>
								
								<div class="post-btn">
								
								<a href="javascript:void(0)">
								<img width="72" height="26" alt="post-comment" src="../images/post.png" 
								onClick="<?php if(isset($_SESSION['username'])){ ?>validatePostComment()<?php }else { ?>notValid()<?php }  ?>;">
								</a>
								</div>
								<div style="margin-left:10px;" class="postTopBox"><div class="postTop-title">SELECT CATEGORY: </div>
								  <div><?php if(isset($category)) echo $category;?></div>
									
								</div>
								<?php } else{ ?>
								
								
								<div class="post-btn">
								
								<a href="javascript:void(0)">
								<img width="72" height="26" alt="post-comment" src="../images/post.png" 
								onClick="notValid();">
								</a>
								</div>
								<div style="margin-left:10px;" class="postTopBox"><div class="postTop-title">SELECT CATEGORY: </div>
								  <div><?php if(isset($category)) echo $category;?></div>
									
								</div>
								<?php } ?>
								<!--<div style="margin-left:10px;" class="postTopBox"><div class="postTop-title">PLACES OF DISCUSSION: </div>
									  <div><?php //if(isset($place)) echo $place;?></div>
									
								</div>
								<div style="margin-left:10px;" class="postTopBox"> <div class="postTop-title">GROUP :</div>
									<div><?php // if(isset($group)) echo $group;?></div>
								</div>-->
								
								
								</div>
							
							
							</div>
							<?php echo form_close(); ?>
							
							
							
						</div><!--post_main-->
						
						<div class="post_area_bg">
								<div class="orang_left"></div>
								<div class="orang_mid">
									<h4>Tellitize POST AREA</h4>
									<span style="float:right">
									<a href="javascript:void(0)"  onClick="refreshPost();"><img width="102" height="36" alt="refresh-icon" src="../images/refresh-icon.png" id="refresh"></a>
									</span>
									</div>
								<div class="orang_rit"></div>
								
						</div>
						<div id="post_contents">
						
							<?php if(isset($article)) echo $article;?>
						 	
						
						</div>
						<div style="color:#565656;clear:left;font:12px arial;font-weight:bold;float:right;padding-top:-5px;"><a href="<?php echo $GLOBALS['base_url']; ?>index.php/posts">View More</a></div>
						     
						
				</div><!--left-->
				
				<?php
					require("right-nav.php");
				?>
	</div>
	</div><!-- mid-->
<div id="footer">
<?php $this->load->view('footer'); ?>
</div>

</body>
<!--post_about pop up-->
<?php
		  echo form_open('posts',array('name' => 'postAbout' ,'id'=>'posts')); 
	 ?>
<div class="post_about" style="display:none">
	
	<div  id="close_signUp">
		<img src="../images/close_icon2.png" alt="close"/>
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
	<a href="javascript:void(0)" onClick="skipPost(1);">Skip</a>

</div>
<?php echo form_close(); ?>
<!-- ends post_about pop up-->


<!--email_add pop up-->
<div class="email_add" style="display:none">
	
	
	<form name="mailAlert" method="post" id="mailAlert">
		<h3>Do You know email address of this person ?
		<input type="radio" name="email" value="1" id="email_yes">Yes
		<input type="radio" name="email" value="0" id="email_no">No
		</h3>
		<div style="display:none" id="email_field">
			<ul>
			<li style="float:left">Email Id</li>
			<li style="float:left;padding-left:7px;">
				<input type="text" id="email" name="email" value="Enter email address here" onFocus="if(this.value  == 'Enter email address here') { this.value = ''; } " 
										onblur="if(this.value == '') { this.value = 'Enter email address here'; } ">
			</li>
		 <li style="clear:left"><input type="button" value="Send Alert" onClick="sendAlert()" id="postbtn"></li>
		 </ul>
		 </div>
		 <a href="javascript:void(0)" onClick="skipPost(2);">Skip</a>
		 </div>
	</form>
</div>
<!-- ends email_add pop up-->

</html>
<script language="javascript">


	$(document).ready(function() {

		 
		 
		 
		 $('#close_signUp').click(function() {
			// $('#filter_contact').hide();
		 	$('.post_about').hide();
			//$("#email").val("");
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
		 
		
    });


	function refreshPost(){
	        $('#post_contents').html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=viewComment",
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
	function postComment(){
	
	  
		dataString = $('form[name=publicPost]').serialize();
		dataString+="&"+ $('form[name=postAbout]').serialize();
		if($.trim($("#email").val()) != "" || $.trim($("#email").val()) != "Enter email address here"){
		dataString+="&"+ $('form[name=mailAlert]').serialize();
		}	
	
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
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=postReply",
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
			$('#post_contents').html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
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
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=viewReplies",
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
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=deleteReply",
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
	
	
					
</script>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<!--<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>-->
</div>
<script type="text/javascript">//var addthis_config = {"data_track_addressbar":true};
var addthis_config = {
      services_custom: {
              name: "AddThis",
              url: "http://www.addthis.com/bookmark.php?url={{url}}&title={{title}}",
              icon: "http://www.clearspring.com/favicon.png"}
}
</script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50657e722d6e2021"></script>
<script type="text/javascript">
	
addthis.button('.postcontent', {}, {url: "http://www.tellitize.com/", title: "The 24th post"});

</script>
<!-- AddThis Button END -->