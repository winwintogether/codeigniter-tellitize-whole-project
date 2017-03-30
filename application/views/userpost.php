<script language="javascript">
function closeEmail() {
	$('.pop_up').hide();
	$('.modalOverlay').hide();
}
	
function emailPost(postid,status){

	//$('.modalOverlay').show();
	//$('.email_post').show();
	$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=emailPost&postid="+postid+"&status="+status,
			cache: false,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {   
				$('.modalOverlay').show();
				$('#email_contents').html(data.html);
				$('.email_post').show();
				
				}
				
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
}
function sendEmail(id){
	var email=$.trim($("#to_email").val());
	 if($.trim($("#to_email").val()) == ""){
		$("#to_email").css("border","1px solid red");			  
		 return false;
		 }
		else if(!checkemail(email)){
		    alert("Invalid emailid");
			$("#to_email").css("border","1px solid red");			  
		 return false;
			
    	}
		else{
			$("#to_email").css("border","1px solid #CCCCCC");	
		}
	dataString = $('form[name=emailcontent]').serialize();
	$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=sendEmail&post_id="+id,
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {   
				$('.email_post').hide();
			
				$('.modalOverlay').hide();
				}
				
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
}
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
				
				$('#post_contents').html('');
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
	else {
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
			$('li#list_'+id).html('<p align="center"><img src="../images/ajax-loader.gif"  /></p>');
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
				//alert("Removed");
				//$('#post_contents').html('');
				$('li#list_'+id).html('');
				
				//refreshPost();
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
				$('.agreeReply'+id).html("<img border='0' alt='Agreed' src='<?php echo $GLOBALS['base_url'];?>images/agree.png'>");
				$('.disagreeReply'+id).html("");
				$('.disagreeReply'+id).html('<input type="button" value="disagree" class="agreeDisagree" onclick="disagreeReply('+id+');" >');
				
				
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
				$('.disagreeReply'+id).html("<img border='0' alt='Agreed' src='<?php echo $GLOBALS['base_url']; ?>images/disagree.png'>");
				$('.agreeReply'+id).html("");
				$('.agreeReply'+id).html('<input type="button" value="agree" class="agreeDisagree" onclick="agreeReply('+id+');">');
				
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
function checkemail(em)   //Email validation 
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(em))
	return true;
	else
	return false;
}
// Added by SB on 17-11-2014  sms text start
function smsPost(postid,status){

	$.ajax({

			type: "POST",

			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=smsPost&postid="+postid+"&status="+status,

			cache: false,

			dataType: "json",

			success: function(data) {

				if(data.success == "yes")

				{

					$('.modalOverlay').show();

					$('#email_contents').html(data.html);

					$('.email_post').show();

				}

				else

				{

					alert(" Occured internal Error.please check network connection" );

				}

			}

		});

}
// send SMS start
function sendSMS(id){

	
	 if($.trim($("#to_phone").val()) == ""){

		$("#to_phone").css("border","1px solid red");

		 return false;

		 }
		else{

			$("#to_phone").css("border","1px solid #CCCCCC");

		}

	dataString = $('form[name=emailcontent]').serialize();

	$.ajax({

			type: "POST",

			url: "<?php echo $GLOBALS['base_url']; ?>ajax/post-ajax.php?mode=sendSms&post_id="+id,

			cache: false,

			data: dataString,

			dataType: "json",

			success: function(data) {

             if(data.success == "yes")

			  {

				$('.email_post').hide();
				$('.modalOverlay').hide();

				}
				else {
                                        $('.email_post').hide();
                                        $('.modalOverlay').hide();
					alert(" Occured internal Error.please check network connection" );

				}

			}

		});

}
// send SMS end
// Added by SB on 17-11-2014  sms text end
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/posts.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	
});
</script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
<style type="text/css">
ul.pagination1{
margin:0px;
padding:0px;
}
ul.pagination1 li{
}
</style>
<?php $base_url = $GLOBALS['base_url'];?>
<div class="modalOverlay" style="display:none"></div>

	<div id="mid_container">
		<div class="mid_content">
			<div class="left" >
			<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;"><span style="position:relative;top:10px;"></span>
							<span style="font:14px arial;font-weight:normal;color:#666666;padding-top:-10px;"></span>
							</div>
							
							<div class="user_group" style="float:right">
								<h3>SEND ANONYMOUS EMAILS</h3>
							</div>
						</div><!--top_bar-->
					<div class="post_area_bg" style="padding-top:0px;">
								<div class="orang_left"></div>
								<div class="orang_mid">
									<h4> POST AREA</h4>
									
									</div>
								<div class="orang_rit"></div>
								
						</div>
				<div id="post_contents" >
		          <ul class="pagination1">
				  	<?php
					
					$html	= '';
					$select	= mysql_query("SELECT * FROM public_post where status=0 and postid=".$postid);
					
					if($select){
						if($num=mysql_num_rows($select)>0)
						{
						while($row=mysql_fetch_array($select)){
						 
							$agreed='';
							$disagreed='';
							$agree_status='';
							$selectuser=mysql_query("SELECT user_name,name,reg_status from users where userid='".$row['from']."'");
							$user=mysql_fetch_array($selectuser);
							if($row['from']=='' || $row['from']=='0') $from='Anonymous';
							else 
							{	
								$from=$this->home_model->getFullName($row['from']);
							}
							$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
							if(isset($_SESSION['username'])){
								$agreeClick='onclick="agreePost('.$row['postid'].');"';
								$disagreeClick='onclick="disagreePost('.$row['postid'].');"';
								//$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
								//check agreed or disagreed
								$agree_click='';
								$disagree_click='';
								$selectQuery = mysql_query("SELECT like_status from post_likes where userid='".$_SESSION['userid']."' and postid='".$row['postid']."'");
								if($agreeStatus=mysql_fetch_array($selectQuery)){
									$agree_status=$agreeStatus['like_status'];
									$agreed='';
									if($agree_status==1)  { $agree_click="style=display:none";
										$agreed=' <a href="javascript:void(0)"  id="agreebtn'.$row['postid'].'" class="disable_agree"></a>';
									}
									if( $agree_status==0) { 
										$disagree_click="style=display:none"; 
										$disagreed=' <a href="javascript:void(0)"  id="disagreebtn'.$row['postid'].' " class="disable_disagree"></a>';
									}
								}
								$profile_img='';
								$query = mysql_query("SELECT profile_img from users where userid='".$_SESSION['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								{
									$profile_img=$p_row['profile_img'];
								}
								if($profile_img!='') 
								{
									$profilPic='<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$base_url.'/ajax/uploads/'.$profile_img.'" />';
								}
								else
								{
									$profilPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';}
								}
							}
							else
							{
								$agreeClick='onclick="notValidUser()"';
								$disagreeClick='onclick="notValidUser()"';
								//$report_abuse='onclick="notValidUser()"';
								$agree_click='';
								$disagree_click='';
							}
							
							$agree_cnt		= 0;
							$disagree_cnt	= 0;
							$select_count 	= mysql_query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=1");
							$agree			= mysql_fetch_array($select_count );
							$agree_cnt		= $agree['c'];
							$select_count  	=  mysql_query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=0");
							$dagree			= mysql_fetch_array($select_count );
							$disagree_cnt	= $dagree['c'];
							$date			= $row['post_date'];
							$date			= explode( '-', $date );
							$date			= $date[1].'-'.$date[2].'-'.$date[0];
							$location		= $row['location'];
							$selectcat=mysql_query("SELECT cate_name from category where cid='".$row['cid']."'");
							$cat=mysql_fetch_array($selectcat);
							$category=$cat['cate_name'];
							$category='';
							$selectPostAbout = mysql_query("SELECT * from post_details where  postid='".$row['postid']."'");
							if($postAbout=mysql_fetch_array($selectPostAbout) )
							{
								$about=$postAbout['post_about'];
								if($about=='person')
									$category=$postAbout['first_name']." ".$postAbout['last_name'];
								else if($about=='place')
									$category=$postAbout['place'];
								else if($about=='other')
									$category=$postAbout['other_description'];
								else if($about=='group' || $about=='pod')
								{
									$category='';
									$category=$postAbout['first_name'];											
								}
								else $category='';
							}
							if($category=='') $style='style="padding-top:6px"';
									else $style="";
									$comment_posted= $this->home_model->autolink($row['comment'] );
									$category_link= str_replace(" ","-",$category);
									$commentonpost=htmlentities($row['comment']);
									
									$html.='<li id="list_'.$row['postid'].'"><div id="article">
														<div class="post_user-main">
															<div class="delete-post'.$row['postid'].'" id="delete-post" onclick="deleteMyPost('.$row['postid'].')"> 
																<img src="'.$GLOBALS['base_url'].'images/close-btn.jpg" width="15" height="15" alt="delete" title="delete"></a>
															</div>
															<div class="user_post-icon"></div>
															<div class="userpost-name">
																 <div class="userpost-title"><h1 style="font-size:14px;margin-top:-2px;">'.$category.'</h1></div>
																<div class="user-post-id" '.$style.' style="margin-top:-6px;">From: <span class="id-text">'.$from.'</span></div>
															 </div>
															 <div class="userpost-city">Posted: '.$date.','.$location.'</div>
														 </div>
														
														
																<div class="postcontent-main">
																 <div class="postcontent">
																	  '.$comment_posted.'
																 </div>
																 <div class="postcontent-aggre-main">
																		 <div class="circle" id="agree_circle'.$row['postid'].'">'.$agree_cnt.'</div>
																		 <div class="people-agree">Agree</div>
																		 <div class="circle" id="disagree_circle'.$row['postid'].'">'.$disagree_cnt.'</div>
																		  <div class="people-agree">DisAgree</div>';
																		  $html.=' <div class="report-abues reLink" ><a  class="reLink" href="javascript:void(0)"' .$report_abuse.'>Report Abuse</a></div>';
																		  
																		  if($agreed==''){
																		  	/*$html.=  '<div  class="agree-btn "  id="btn'.$row['postid'].'">
																		   			  	<a href="javascript:void(0)"' .$agreeClick.' id="agreebtn'.$row['postid'].'"'.$agree_click.' class="able_agree">agree</a>
																		 			  </div>';*/
																			$html.=  '<div class="orangeButton agree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
																						<input type="button" id="agreebtn'.$row['postid'].'"'.$agree_click.' class="orangeButton-right" value="agree" '.$agreeClick.'>
                                                                                      </div>';
																		 }
																		 else {
																		 	/*$html.= '<div  class="agree-btn "  id="btn'.$row['postid'].'">'.$agreed.' </div>'; */
																			$html.='<div  class="disableButton agree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
																						<input type="button" id="agreebtn'.$row['postid'].'" class="disableButton-right" value="agree">
                                                                                    </div>';
																		 }
																		 
																		 if($disagreed==''){
																			/*$html.= '<div  class="disagree-btn" id="btnd'.$row['postid'].'">
																			 			<a href="javascript:void(0)"' .$disagreeClick.'  id="disagreebtn'.$row['postid'].'"'.$disagree_click.' " class="able_disagree">disagree</a>
																		  			 </div>';*/
																			$html.=  '<div class="orangeButton disagree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
																						<input type="button" id="disagreebtn'.$row['postid'].'" '.$disagree_click.' " class="orangeButton-right" value="disagree" '.$disagreeClick.'>
                                                                                      </div>';
																		 }
																		 else {
																		 	/*$html.='<div  class="disagree-btn" id="btnd'.$row['postid'].'">'.$disagreed.' </div>'; */
																			$html.='<div  class="disableButton disagree_'.$row['postid'].'"  id="btn'.$row['postid'].'">
																						<input type="button" id="disagreebtn'.$row['postid'].'" class="disableButton-right" value="disagree">
                                                                                    </div>';
																		 }
																															  
													  $url_twit=$GLOBALS['base_url'].''.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'];
													  $twittercomment=$category.':'.$commentonpost;
													  $twitcomment_url=$twittercomment.' '.$url_twit;
													  if(strlen($twitcomment_url) > 140){
													        $length=strlen($GLOBALS['base_url']);
															if($length<140)
														   $twitter_commentonpost =  substr($twittercomment, 0, 136-$length).'...';
														   else {$url_twit=''.$GLOBALS['base_url'];$twitter_commentonpost=substr($twittercomment, 0, 136-strlen($url_twit)).'...';}
														}
														   else {$twitter_commentonpost=$twittercomment;}
														
													  $html.='<div class="share">
													  <a target="_new" href="http://www.facebook.com/dialog/feed?
														app_id=171832922955728&
														link='.$GLOBALS['base_url'].''.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'/&
														picture='.$GLOBALS['base_url'].'images/fb_logo.png&
														name=Tellitize&
														caption='.$category.'&
														description='.htmlspecialchars($commentonpost).'&
														redirect_uri='.$GLOBALS['base_url'].'">
														<img src="'.$GLOBALS['base_url'].'images/fbshare.jpg" title="Share on Facebook" id="face"/></a>
														<a target="_new" class="twitter" 
														href="http://twitter.com/share?url='.$url_twit.'&text='.htmlspecialchars($twitter_commentonpost).'">
														<img src="'.$GLOBALS['base_url'].'images/twitter-share.jpg" title="Share on Twitter" id="Tweet"/>
														</a>
													</div>
										 </div>
									</div>
								</div>';
								
								if(isset($_SESSION['userid'])){
									////////////// no: of comments ///////////////////////
									$Countquery 	= mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$row['postid']."'");
									if($row_count	= mysql_fetch_array($Countquery)) 
									{	
										$count=$row_count['cnt']; 
									}
									if($count>5) 
									{ 
										$html.='<div class="view_all view_all'.$row['postid'].'">
													<a href="javascript:void(0)" onclick="viewreplies('.$row['postid'].');">View all '.$count.' comments</a></div>';
									}
									else
									{
										$html.='<div class="view_all view_all'.$row['postid'].'"></div>';
									}
									
									//////////////// view comment /////////////////////////
									$html.='<div class="viewList'.$row['postid'].'">';
									
									$selectreplies	= mysql_query("SELECT * from post_replies where  postid='".$row['postid']."' order by id desc limit 5 ");
									while($row1=mysql_fetch_array($selectreplies))
									{
										////////////// delete link only for user who posts or replied   //////////////////////
										$user_post=0;
										//////// if replied user ///////////////
										$selectUserreply=mysql_query("SELECT userid from post_replies where  id='".$row1['id']."'");
										if($ruser_r=mysql_fetch_array($selectUserreply))
										{
											if($ruser_r['userid'] == $_SESSION['userid']) 
												$user_post=1;
										}
										
										//if posted user
										$selectUserpost=mysql_query("SELECT userid from public_post where postid='".$row['postid']."'");
										$ruser_p=mysql_fetch_array($selectUserpost);
										if($ruser_p=mysql_fetch_array($selectUserpost))
										{
											if($ruser_p['userid'] == $_SESSION['userid']) 
												$user_post	= 1;
										}
										
										///////////////////// delete ////////////////
										if($user_post==1)
										{
											$delete_link = '<div class="deleteMsg deletReply'.$row1['id'].'">
																<input type="button" onclick="deleteReply('.$row1['id'].','.$row['postid'].');" style="margin-right:-18px;" value="DELETE" class="deleteMsg-right">
															</div>';
										}
										else
										{
											$delete_link = '';
										}
										
										$usr_img	= ''; $user_image = ''; $name_link	= '';
										$query		= mysql_query("SELECT profile_img,name,last_name from users where userid='".$row1['userid']."'");
										if($p_row=mysql_fetch_array($query)){
											   {
												$usr_img=$p_row['profile_img'];
												if($p_row['last_name']!='')
												$name_link=$p_row['name'].' '.$p_row['last_name'];				
												else
												 $name_link=$p_row['name'];														
												}
												$name_link= str_replace(" ","-",$name_link);
										}
										
										if($usr_img!='') 
										{
											$userPic	= '<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
										}
										else
										{
											$userPic	= '<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';
										}
										
										$comment_replied= $this->home_model->autolink($row1['comment']);
										
										if($row1['userid'] > 0)
										{
											$user_image.='<a class="link_user" href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row1['userid'].'">'.$userPic.'</a>';
										}
										else
										{
											$user_image.=$userPic;
										}
										
										////////////// agree and disagree buttons ///////////
										$selectReplylikes	= mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row1['id']."'");
										$replyStatus		= mysql_fetch_array($selectReplylikes);
										if(count($replyStatus) > 1)
										{
											$like_status		= $replyStatus['like_status'];
											if($like_status == 1)
											{
												$agree_link		= '<div style="float:left; margin:0 10px 0 0;" class="disableButton agree_'.$row1['id'].'">
																	<input type="button" value="agree" class="disableButton-right" >
																   </div>';
												$disagree_link	= '<div style="float:left; margin:0 10px 0 0;" class="orangeButton disagree_'.$row1['id'].'">
																	<input type="button" value="disagree" class="orangeButton-right" onclick="disagreeReply('.$row1['id'].');" >
																   </div>';
											}
											if($like_status == 0)
											{
												$agree_link		= '<div style="float:left; margin:0 10px 0 0;" class="orangeButton agree_'.$row1['id'].'">
																	<input type="button" value="agree" class="orangeButton-right" onclick="agreeReply('.$row1['id'].');">
																   </div>';
												$disagree_link	= '<div style="float:left; margin:0 10px 0 0;" class="disableButton disagree_'.$row1['id'].'">
																	<input type="button" value="disagree" class="disableButton-right" >
																   </div>';
											}
										}
										else
										{
											$agree_link		= '<div style="float:left; margin:0 10px 0 0;" class="orangeButton agree_'.$row1['id'].'">
																<input type="button" value="agree" class="orangeButton-right" onclick="agreeReply('.$row1['id'].');">
															   </div>';
											$disagree_link	= '<div style="float:left; margin:0 10px 0 0;" class="orangeButton disagree_'.$row1['id'].'">
																<input type="button" value="disagree" class="orangeButton-right" onclick="disagreeReply('.$row1['id'].');" >
															   </div>';
										}
										
										$select_count1	= mysql_query("SELECT count(*) as c from reply_likes where  reply_id ='".$row1['id']."' AND like_status=1");
										$agree_post		= mysql_fetch_array($select_count1);
										$agree_cnt_post	= $agree_post['c'];
										
										$select_count2	= mysql_query("SELECT count(*) as c from reply_likes where  reply_id ='".$row1['id']."' AND like_status=0");
										$disagree_post	= mysql_fetch_array($select_count2);
										$disagree_cnt_post	= $disagree_post['c'];
										
										$html.='<div class="replyComment'.$row1['id'].'" id="replyComment">
												<div class="profilepicreply">'.$user_image.'</div>
												<div class="commentreplyview">'.$comment_replied.'</div>
												<div class="postcontent-aggre-main">
													<div class="circle" id="agree_circle242">'.$agree_cnt_post.'</div>
													<div style="font-size:10px;font-size:10px;font-weight:normal;color:#666666; padding:4px 23px 0px 4px; float:left;">&nbsp; AGREE</div>
													<div class="circle" id="agree_circle242">'.$disagree_cnt_post.'</div>
													<div style="font-size:10px;font-size:10px;font-weight:normal;color:#666666; padding:4px 23px 0px 4px; float:left;">&nbsp; DISAGREE</div>	
													<div style=" float:right; margin:0 12px 6px 0;">'.$agree_link.$disagree_link.$delete_link.'
													</div>
												</div>
											</div>';	
									}
									$html.='</div>';
									$user_image_query 	= mysql_query("SELECT profile_img from users where userid='".$_SESSION['userid']."'");
									$arr_user_image		= mysql_fetch_array($user_image_query);
									if($arr_user_image[0] != '')
									{
										$post_user_image	= $GLOBALS['base_url'].'ajax/uploads/'.$arr_user_image[0];
									}
									else
									{
										$post_user_image	= $GLOBALS['base_url'].'images/user-photo.jpg';
									}
										
									$html.= '<div id="replyComment">
													<form name="replyPost" id="replyPost">
														<div class=profilepicreply><img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$post_user_image.'" /></div>
														<div class="commentreply">
															<textarea class="input-tetlize commentreplyArea" name="commentreplyArea" id="commentreplyArea'.$row['postid'].'"></textarea>
														</div>
														<div class="anonymousCheck"><input type="checkbox" name="anonymous_user" id="anonymous_user" value="1">check to post as Anonymous user</div>
														<div class="orangeButton" style="float:right;margin:-18px 2px 2px 0px;"><input type="button" name="comment" value="Comment" onclick="postReply('.$row['postid'].');" class="orangeButton-right"></div>
													</form>	
												</div>'; //<div class="postreply" onclick="postReply('.$row['postid'].');"><img alt="comment" src="../../images/comment.png"></div>
												
								}
									
									$html.='</li>';
									if(isset($_SESSION['userid'])){	
									$clickfn='onClick="emailPost('.$row['postid'].',1);"';
									$anony_clickfn='onClick="emailPost('.$row['postid'].',0)"';
									}
									else {
										$clickfn='onclick="notValidUser()"';
										$anony_clickfn='onclick="notValidUser()"';
									}
									
									$respond_author_html	= '';
									$query	= mysql_query("SELECT userid from public_post where postid='".$row['postid']."'");
									$arr	= mysql_fetch_array($query);
									$post_user_id	= $arr['userid'];
										
									if(isset($_SESSION['userid']))
									{
										$comment_post_html	= '';
										
										if($post_user_id == $_SESSION['userid'])
										{
											$respond_author_html	= '';
											$margin_left_anonymous	= '25px;';
											//$margin_left_yourself	= '333px;';
										}
										else
										{
											$respond_author_html	= '<div class="greyLeft" style="margin-left:25px;">
																			<input type="button" onClick="respondToAuthor('.$row['postid'].')" value="Respond to Author" class="greyLeft_btn">
																		</div>';
											$margin_left_anonymous	= '0px;'; //115px;
											//$margin_left_yourself	= '105px;';
										}
									}
									else
									{
										$comment_post_html		= '<div class="greyLeft">
																	<input type="button" value="Comment" class="greyLeft_btn" onclick="comment_post()">
															   	   </div>';
										$respond_author_html	= '<div class="greyLeft" style="margin-left:6px;">
																			<input type="button" onClick="respondToAuthor(0)" value="Respond to Author" class="greyLeft_btn"> 
																		</div>'; //messageAnonymous-right
										$margin_left_anonymous	= '0px;'; //115px;
										//$margin_left_yourself	= '117px;';
									}
									
									$html.='<div id="email-btns">'.$respond_author_html.'
												<div class="greyLeft" style="margin-left:'.$margin_left_anonymous.'">
													<input type="button" '.$anony_clickfn.' value="Email Message Anonymously" class="greyLeft_btn">
												</div>
												<div class="greyLeft">
                                                    <input type="button" class="greyLeft_btn greenBtn" value="Text This Post Anonymously" onclick="smsPost('.$row['postid'].',0)" /></div>
											   <div class="greyLeft">
											   		<input type="button" '.$anony_clickfn.' value="Email Message As Yourself" class="greyLeft_btn">
                                               </div>'.$comment_post_html.' 
											 </div>'; // messageYourself <div class="orang_mid_anonymous" '.$anony_clickfn.'></div> <div class="orang_mid_email" style="float:right" '.$clickfn.'></div>
							$html.='</div> ';			
									}
									
							}
						else{
								
							$html = '<li class="simplePagerPage1" style="display: list-item;">
							<div>This Post has been removed</div>
							</li>';
								 
						}
						echo $html;			
									
						}
								
					?>
			 </ul>
		<div class="clearing"></div>
		<?php if($num=mysql_num_rows($select)=='')
						{?>
						</div>
						<?php } ?>
	</div>
 <?php
 	require("right-nav.php");
 ?>
</div>
</div>
</div>

<!--email pop up-->
<?php echo form_open('posts',array('name' => 'emailcontent' ,'id'=>'emailcontent')); ?>
<div class="email_post pop_up" style="display:none">
  <div class="pop_up_bg">
		<div  class="close_signUp_email" id="close_signUp" onClick="closeEmail();">
			<img src="<?php echo $GLOBALS['base_url']; ?>images/popup-close.jpg" alt="close"/>
		</div>
    
	<div id="email_contents">
    </div>	
	
		<!--<a href="javascript:void(0)" onClick="skipPost(1);">Skip</a>-->
	</div>	

</div>
<?php echo form_close(); ?>
<!-- ends email pop up-->

<?php echo form_open('posts',array('name' => 'respondtoauthor' ,'id'=>'respondtoauthor')); ?>
<div class="respond_to_author pop_up" style="display:none">
	<div class="pop_up_bg">
		<div  class="close_signUp_email" id="close_signUp" onClick="closeEmail();">
			<img src="<?php echo $GLOBALS['base_url']; ?>images/popup-close.jpg" alt="close"/>
		</div>
    	<div id="grant_div" class="grant_div"></div>
	</div>
</div>
<?php echo form_close(); ?>

<script language="JavaScript">
function respondToAuthor(post_id){ 

		if(post_id == 0)
		{
			alert('Please Login');
			return false;
		}
		else
		{
			$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/message-ajax.php?mode=respond_to_author&post_id="+post_id,
			cache: false,
			dataType: "json",
			success: function(data) {
				if(data.success == "yes")
				{
					$('.modalOverlay').show();
					$('#grant_div').html(data.html);
					$('.respond_to_author').show();
				}
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
			});
		}
}

function sendResponseToAuthor()
{
	var grantText	= $("#grant_text").val();
	var toUser		= $("#to_user").val();
	var fromUser	= $("#from_user").val();
	
	if(grantText != "")
	{
		$.ajax({
				type: "POST",
				url: base_url+"ajax/message-ajax.php?mode=grant&from_user="+toUser+"&to_user="+fromUser+"&message="+grantText,
				cache: false,
				data: grantText,
				dataType: "html",
				success: function(data) {
					$("#grant_text").val('');
					$('.pop_up').hide();
					$('.modalOverlay').hide();
					alert('You have successfully sent message to the author');
				}
		});
	}
	else
	{
		$("#grant_text").css("border","1px solid red");
		$("#grant_text").focus();
	}
				
}

function comment_post()
{
	alert('Please Login');
}
</script>