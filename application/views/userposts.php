<!--<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tellitize</title>
<link type="text/css" href="<?php //echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
</head>
<body>

<div id="header">
<?php //$this->load->view('header'); $base_url=$GLOBALS['base_url'];?>
</div>-->

<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
	<div id="mid_container">
		<div class="mid_content">
			<div class="left" style="width:80%;background:#E0E0E0;margin:5px;">
				<div id="post_contents" style="width:100%">
		          <ul class="pagination1">
			
					<?php
					$html='';
					if(isset($_SESSION['userid'])){
						
							$select=mysql_query("SELECT * FROM public_post where postid not in 
										(SELECT postid FROM report_abused_list 
										where userid =".$_SESSION['userid'].") and status=0 order by  postid desc
										");
							}	
							else{
							$select=mysql_query("SELECT * FROM public_post where status=0 order by  postid desc");
							}
							
							if($select){
							   while($row=mysql_fetch_array($select)){
								$agreed='';
								$disagreed='';
								$agree_status='';
								 $selectuser=mysql_query("SELECT user_name,name,reg_status from users where userid='".$row['from']."'");
								 $user=mysql_fetch_array($selectuser);
								if($row['from']=='' || $row['from']=='0')  $from='Anonymous';
								else 
								{	if($user['reg_status']==0)
										$from=$user['user_name'];
									else
										$from=$user['name'];
								}
								$share_btncode=' <a href="">share</a>';
								if(isset($_SESSION['username'])){
									$agreeClick='onclick="agreePost('.$row['postid'].');"';
									$disagreeClick='onclick="disagreePost('.$row['postid'].');"';
									$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
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
										
										if( $agree_status==0) { $disagree_click="style=display:none"; 
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
									else{$profilPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';}
								}
								}
								else{
									$agreeClick='';
									$disagreeClick='';
									$report_abuse='';
									$agree_click='';
									$disagree_click='';
								}
								$agree_cnt=0;
								$disagree_cnt=0;
								$select_count = mysql_query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=1");
								$agree=mysql_fetch_array($select_count );
								$agree_cnt=$agree['c'];
								
								$select_count  =  mysql_query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=0");
								$dagree=mysql_fetch_array($select_count );
								$disagree_cnt=$dagree['c'];
								
								
									
								
								
								$date=$row['post_date'];
								$date=explode( '-', $date );
								$date=$date[1].'-'.$date[2].'-'.$date[0];
								$location=$row['location'];
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
										if($about=='place')
										$category=$postAbout['place'];
										if($about=='other')
										$category=$postAbout['other_description'];
									}
									if($category=='') $style='style="padding-top:6px"';
									else $style="";
									if(isset($_SESSION['username'])) {
										$share_btncode='<div class="addthis_toolbox addthis_default_style " >
						
																<a class="addthis_button"  href="http://www.addthis.com/bookmark.php" addthis:url="http://118.94.177.106:8165/" 
																  addthis:title="'.$category.', '.$row['comment'].'"  addthis:description=" '.$row['comment'].'">share</a>
														</div>';
									 }
									$html.='<li id="list_'.$row['postid'].'"><div id="article">
														<div class="post_user-main">
															<div class="user_post-icon"></div>
															<div class="userpost-name">
																 <div class="userpost-title">'.$category.'</div>
																<div class="user-post-id" '.$style.'>From: <span class="id-text">'.$from.'</span></div>
															 </div>
															 <div class="userpost-city">Posted: '.$date.','.$location.'</div>
														 </div>
														
														
																<div class="postcontent-main">
																 <div class="postcontent">
																	  '.$row['comment'].'
																 </div>
																  <div class="postcontent-aggre-main">
																		 <div class="circle" id="agree_circle'.$row['postid'].'">'.$agree_cnt.'</div>
																		 <div class="people-agree">people Agree</div>
																		 <div class="circle" id="disagree_circle'.$row['postid'].'">'.$disagree_cnt.'</div>
																		  <div class="people-agree">people disAgree</div>
																		   <div class="report-abues reLink" ><a  class="reLink" href="javascript:void(0)"' .$report_abuse.'>Report Abuse</a></div>';
																		   if($agreed==''){
																		 $html.=  '<div  class="agree-btn "  id="btn'.$row['postid'].'">
																		   
																			<a href="javascript:void(0)"' .$agreeClick.' id="agreebtn'.$row['postid'].'"'.$agree_click.' class="able_agree">agree</a>
																		 </div>';
																		 }
																		 else {$html.='<div  class="agree-btn "  id="btn'.$row['postid'].'">'.$agreed.' </div>'; }
																		  if($disagreed==''){
																		$html.= ' <div  class="disagree-btn" id="btnd'.$row['postid'].'">
																			 <a href="javascript:void(0)"' .$disagreeClick.'  id="disagreebtn'.$row['postid'].'"'.$disagree_click.' " class="able_disagree">disagree</a>
																		  </div>';
																		 }
																		 else {$html.='<div  class="disagree-btn" id="btnd'.$row['postid'].'">'.$disagreed.' </div>'; }
																															  
																		  $html.='<div class="share">'.$share_btncode.'</div>
															   </div>
														</div>
													</div>';
													
									if(isset($_SESSION['userid'])){
										//no: of comments
										$Countquery =mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$row['postid']."'");
										if ($row_count=mysql_fetch_array($Countquery) ) {	$count=$row_count['cnt']; }
										if($count>5) 
										{ $html.='<div class="view_all view_all'.$row['postid'].'"><a href="javascript:void(0)" onclick="viewreplies('.$row['postid'].');">View all '.$count.' comments</a></div>';}else{
											$html.='<div class="view_all view_all'.$row['postid'].'"></div>';
										}
										 //view comment
										 $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$row['postid']."' order by id desc limit 5 ");
											$html.='<div class="viewList'.$row['postid'].'">';
											while($row1=mysql_fetch_array($selectreplies)){											
											
												//delete link only for user who posts or replied
												$user_post=0;
												//if replied user
												$selectUserreply=mysql_query("SELECT userid from post_replies where  id='".$row1['id']."'");
												if($ruser_r=mysql_fetch_array($selectUserreply)){if($ruser_r['userid']==$_SESSION['userid']) $user_post=1;}
																								
												//if posted user
												$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$row['postid']."'");
												if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
												
												if($user_post==1)
												$delete_link='  |   <span class="deletReply'.$row1['id'].'">
												<a onclick="deleteReply('.$row1['id'].','.$row['postid'].');" href="javascript:void(0);">Delete </a>
												</span>';
												else 
												$delete_link='';
											
												//if replies 
												$agree_link=' <a onclick="agreeReply('.$row1['id'].');" href="javascript:void(0);" >Agree </a>';
												$disagree_link=' <a onclick="disagreeReply('.$row1['id'].');"  href="javascript:void(0);">Disgree </a>';
												$selectReplylikes = mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row1['id']."'");
												while($replyStatus=mysql_fetch_array($selectReplylikes)){
												
													   $like_status=$replyStatus['like_status'];
													   if($like_status==1){ $agree_link="<a>Agreed</a>";
													   }
													   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
													   }
													}
										
												$usr_img='';
												$query = mysql_query("SELECT profile_img,name,last_name from users where userid='".$row1['userid']."'");
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
												if($usr_img!='') {
												$userPic='<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
												}
												else{
												$userPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';
												}
												$html.='<div id="replyComment" class="replyComment'.$row1['id'].'">
													
														<div class=profilepicreply>
														<a class="link_user" href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row1['userid'].'">
														'.$userPic.'</a>
														</div>
														<div class="commentreplyview">'.$row1['comment'].'</div>
														<div class="agreereply" >
														  <span class="agreeReply'.$row1['id'].'">'.$agree_link.'  </span> | 
														   <span class="disagreeReply'.$row1['id'].'">'.$disagree_link.' </span>	 '
									  						. $delete_link.'
														</div>
														
														</div>		';
									}	
									$html.='</div>';		
									  //reply comment	
										$html.='<div id="replyComment">
												<form name="replyPost" id="replyPost">
													<div class=profilepicreply>'.$profilPic.'</div>
													<div class="commentreply">
												<textarea class="input-tetlize commentreplyArea" name="commentreplyArea" id="commentreplyArea'.$row['postid'].'"></textarea>
													</div>
													<div class="postreply" onclick="postReply('.$row['postid'].');"><img alt="comment" src="images/comment.png"></div>
												</form>	
													</div>		';
										}$html.='</li>';				
									}
											
									echo $html;
								}
								
					?>
		 </ul>

		 <div class="clearing"></div>
		</div> 
	
  </div>
 </div>
</div>
	
<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
<script language="javascript">
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
				$('.agreeReply'+id).html("<a>Agreed</a>");
				$('.disagreeReply'+id).html("");
				$('.disagreeReply'+id).html('<a onclick="disagreeReply('+id+');" href="javascript:void(0);" >Disgree </a>');
				
				
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
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>




<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	//$("ul.pagination2").quickPagination({pagerLocation:"both"});
	//$("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
});
</script>

<style type="text/css">

</style>

 <?php if(isset($_SESSION['username'])){ ?>
<!-- AddThis Button BEGIN -->

<script type="text/javascript">var addthis_config = {"ui_click": "true" ;}</script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50657e722d6e2021"></script>
<!-- AddThis Button END -->
<?php }?>