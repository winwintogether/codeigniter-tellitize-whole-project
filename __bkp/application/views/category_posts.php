<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tellitize</title>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
<style type="text/css">
ul.pagination1{
margin:0px;
padding:0px;

}
ul.pagination1 li{


}


</style>
</head>
<body>

<div id="header">
<?php $this->load->view('header'); $base_url=$GLOBALS['base_url'];?>
</div>


	<div id="mid_container">
		<div class="mid_content">
			<div class="left" >
			<!--<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;"><span style="position:relative;top:10px;"><img width="27" height="32" alt="my-posts" src="../images/mypost.png"></span>
							<span style="font:14px arial;font-weight:normal;color:#666666;padding-top:-10px;">MY POSTS</span>
							</div>
							
							<div class="user_group" style="float:right">
								<h3>OVER 700 MILLION PROFILES</h3>
							</div>
						</div><!--top_bar-->
					<div class="post_area_bg" style="padding-top:0px;">
								<div class="orang_left"></div>
								<div class="orang_mid">
									<h4>Category POST AREA</h4>
									
									</div>
								<div class="orang_rit"></div>
								
						</div>
				<div id="post_contents" >
		          <ul class="pagination1">
			
					<?php
					$html='';
					//if(isset($category_id)) $_GET['cid']=$category_id; 
					       if(isset($_SESSION['userid'])){
					        if(isset($category_id))
							$select=mysql_query("SELECT * FROM public_post where   postid not in 
							(SELECT postid FROM report_abused_list 	where userid =".$_SESSION['userid'].") 
							and  group_id=0	AND  placeid=0 and cid=".$category_id." and status=0 order by  postid desc");
							else
							$select=mysql_query("SELECT * FROM public_post where   postid not in 
							(SELECT postid FROM report_abused_list 	where userid =".$_SESSION['userid'].") 
							and  group_id=0	AND  placeid=0 and  status=0 order by  postid desc");
							}
							else{
							  if(isset($category_id))
							$select=mysql_query("SELECT * FROM public_post where  group_id=0	AND  placeid=0 and cid=".$category_id." and status=0 order by  postid desc");
							else
							$select=mysql_query("SELECT * FROM public_post where group_id=0	AND  placeid=0 and  status=0 order by  postid desc");
							}
							
							
							
							
							if($select){
							   while($row=mysql_fetch_array($select)){
								$agreed='';
								$disagreed='';
								$agree_status='';
								 $selectuser=mysql_query("SELECT user_name,name,reg_status,last_name from users where userid='".$row['from']."'");
								 $user=mysql_fetch_array($selectuser);
								if($row['from']=='' || $row['from']=='0')  $from='Anonymous';
								else 
								{	//$from=$user['user_name'];
									if($user['reg_status']==0)
										$from=$user['name'].' '.$user['last_name'];
									else
										$from=$user['name'];
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
									
									//$report_abuse='onclick="notValidUser()"';
									$agree_click='';
									$disagree_click='';
									$agreeClick='onclick="notValidUser()"';
									$disagreeClick='onclick="notValidUser()"';
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
									/*$html.='<li id="list_'.$row['postid'].'"><div id="article">
														<div class="post_user-main">
															<div class="user_post-icon"></div>
															<div class="userpost-name">
																 <div class="userpost-title">'.$category.'</div>
																<div class="user-post-id">From: <span class="id-text">'.$from.'</span></div>
															 </div>
															 <div class="userpost-city">Posted: '.$date.','.$location.'</div>
														 </div>
														
														
																<div class="postcontent-main">
																 <div class="postcontent">
																	  '.$row['comment'].'
																 </div>';
																  
									}
											
									echo $html;*/
						$postuser_img='';
								$query = mysql_query("SELECT profile_img,name,last_name from users where userid='".$row['from']."'");
									if($p_row=mysql_fetch_array($query)){
									   {
										$postuser_img=$p_row['profile_img'];
										if($p_row['last_name']!='')
										$name_link=$p_row['name'].' '.$p_row['last_name'];				
										else
										$name_link=$p_row['name'];
									
									}
									$name_link= str_replace(" ","-",$name_link);
								}
								if($postuser_img!='') {
								$postuserPic='<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$postuser_img.'" />';
								}
								else{
								$postuserPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';
								}
						
						if(isset($_SESSION['userid']) && $row['from']!=0){
							$pic_link=$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row['from'];
						}
						else $pic_link='javascript:void(0)';
						$category_link= str_replace(" ","-",$category);
						$cat_name = str_replace(" ","-",$this->home_model->getCategory($row['cid']));
						$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );		
						$user_title='<a href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'">'.$category.'</a>';
						$comment_posted_share= htmlspecialchars($row['comment']);
						$comment_posted= $this->home_model->autolink($row['comment']);
							
									$html.='<li id="list_'.$row['postid'].'">';
									if(isset($_SESSION['userid']) && $row['userid']==$_SESSION['userid']){
										$html.='<div class="delete-post'.$row['postid'].'" id="delete_post_icon" onclick="deleteCatOwnPost('.$row['postid'].')"> 
												<img src="'.$GLOBALS['base_url'].'images/close-btn.jpg" width="15" height="15" alt="delete" title="delete">
										</div>';
									 }
										$html.='<div id="article">
														<div class="post_user-main" >
															
															<div class="user_post-icon"></div>
															<div class="userpost-name">
																 <div class="userpost-title">'.$user_title.'</div>
																<div class="user-post-id" '.$style.'>From: <span class="id-text">'.$from.'</span></div>
															 </div>
															 <div class="userpost-city">Posted: '.$date.','.$location.'</div>
														 </div>
														
																<div class="profilepicpost" style="float:left">
																		<a class="link_user" href="'.$pic_link.'">'.$postuserPic.'</a>
																</div>
																<div class="postcontent-main">
																 <div class="postcontent">
																	  '.$comment_posted.'
																 </div>
																  <div class="postcontent-aggre-main">
																		 <div class="circle" id="agree_circle'.$row['postid'].'">'.$agree_cnt.'</div>
																		 <div class="people-agree">people Agree</div>
																		 <div class="circle" id="disagree_circle'.$row['postid'].'">'.$disagree_cnt.'</div>
																		  <div class="people-agree">people disAgree</div>';
																		  $html.=' <div class="report-abues reLink" ><a  class="reLink" href="javascript:void(0)"' .$report_abuse.'>Report Abuse</a></div>';
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
																															  
													$url_twit=$GLOBALS['base_url'].''.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'];
													  $twittercomment=$category.':'.$comment_posted_share;
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
														description='.htmlspecialchars($comment_posted_share).'&
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
												$reply_agree_cnt=0;
												$reply_disagree_cnt=0;
												$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=1");
												$agreecnt=mysql_fetch_array($selectreplyCnt );
												$reply_agree_cnt=$agreecnt['cnt'];
												
												$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=0");
												$dagreecnt=mysql_fetch_array($selectreplyCnt );
												$reply_disagree_cnt=$dagreecnt['cnt'];
												$comment_replied= $this->home_model->autolink($row1['comment']);
												$name_link='';
												$name_link=$this->home_model->getFullName($row1['userid']);
												$name_link= str_replace(" ","-",$name_link);
																			
												
											$html.='<div id="replyComment" >
								
												<div class=profilepicreply>
												<a class="link_user" href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row1['userid'].'">
												'.$userPic.'</a>
												</div>
												<div class="commentreplyview">'.$comment_replied.'</div>
												<div class="agreereplyCount" >
													 <div class="circle" id="agreereply_circle'.$row1['id'].'" >'.$reply_agree_cnt.'</div>
																 <div class="people-agree">people Agree</div>
																 <div class="circle" id="disagreereply_circle'.$row1['id'].'">'.$reply_disagree_cnt.'</div>
																  <div class="people-agree">people disAgree</div>
												</div>
												<div class="agreereply" >
												  <span class="agreeReply'.$row1['id'].'">'.$agree_link.'  </span> | 
												   <span class="disagreeReply'.$row1['id'].'">'.$disagree_link.' </span>	 '.
												   $delete_link.'
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
													<div class="postreply" onclick="postReply('.$row['postid'].');">Comment</div>
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
 <?php
 	require("right-nav.php");
 ?>
</div>
</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
<script language="javascript">
function refreshPost(){
	        $('#post_contents').html('<p align="center"><img src="<?php echo $GLOBALS['base_url']; ?>images/ajax-loader.gif"  /></p>');
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
			$('li#list_'+id).html('<p align="center"><img src="<?php echo $GLOBALS['base_url']; ?>images/ajax-loader.gif"  /></p>');
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
function deleteCatOwnPost(id){
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
</script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/posts.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	
});

</script>
