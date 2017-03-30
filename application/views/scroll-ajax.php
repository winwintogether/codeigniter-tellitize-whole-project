<?php
//error_reporting(0);
session_start();
require('config.php');
if(isset($_GET['mode']) AND $_GET['mode']=='getLastPosts'){
		$last_post_id=$_GET['lastID'];
		if(isset($_SESSION['userid'])){
			if(isset($_GET['groupid'])){
				$select = mysql_query(
						"SELECT * FROM public_post where postid <=".$last_post_id. " and postid not in 
						(SELECT postid FROM report_abused_list 
						  where userid =".$_SESSION['userid'].") AND  group_id=".$_GET['groupid']." order by  postid desc limit 10
						");
								
				$article_id='group_article';
				$reply_comment_class='class="group_reply_comment"';
				$people_agree='Agree';
				$people_disagree='DisAgree';
			}
		
			else{
				$select=mysql_query("SELECT * FROM public_post where postid <=".$last_post_id. " and postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].")and group_id=0 order by  postid desc limit 10
							");
				$article_id='article';
				$reply_comment_class='';
				$people_agree='People Agree';
				$people_disagree='People DisAgree';
			}
			
		}
		else{
		$select = mysql_query("SELECT * FROM public_post where postid <=".$last_post_id."  and group_id=0 order by  postid desc limit 10");
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
			{	
				if($user['reg_status']==0)
				$from=$user['user_name'];
				else
					$from=$user['name'];
			}
			$share_btncode=' <a href="javascript:void(0)" onclick="notValidUser()";>share</a>';
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
						$profilPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$base_url.'/ajax/uploads/'.$profile_img.'" />';
					}
				else{$profilPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';}
			}
			}
			else{
				$agreeClick='onclick="notValidUser()"';
				$disagreeClick='onclick="notValidUser()"';
				$report_abuse='onclick="notValidUser()"';
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
						
																<a class="addthis_button"  href="http://www.addthis.com/bookmark.php" addthis:url="http://www.tellitize.com/" 
																  addthis:title="'.$category.', '.$row['comment'].'"  addthis:description=" '.$row['comment'].'">share</a>
														</div>';
						$user_title='<a href="'.$GLOBALS['base_url'].'index.php/userpost?postid='.$row['postid'].'">'.$category.'</a>';
			 }
			 else
			 $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';
					$postuser_img='';
							$query = mysql_query("SELECT profile_img from users where userid='".$row['from']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$postuser_img=$p_row['profile_img'];
									
									}
							}
							if($postuser_img!='') {
							$postuserPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$postuser_img.'" />';
							}
							else{
							$postuserPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
							}
					
					if(isset($_SESSION['userid']) && $row['from']!=0){
						$pic_link=$GLOBALS['base_url'].'index.php/viewprofile?profileid='.$row['from'];
					}
					else $pic_link='javascript:void(0)';
				$html.='<div class="contents_list" id="'.$row['postid'].'">
						<div id="'.$article_id.'">
									<div class="post_user-main">
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
												  '.$row['comment'].'
											 </div>
											  <div class="postcontent-aggre-main">
													 <div class="circle" id="agree_circle'.$row['postid'].'">'.$agree_cnt.'</div>
													 <div class="people-agree">'.$people_agree.'</div>
													 <div class="circle" id="disagree_circle'.$row['postid'].'">'.$disagree_cnt.'</div>
													 <div class="people-agree">'.$people_disagree.'</div>
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
							$delete_link='  |   <span class="deletReply'.$row1['id'].'" href="javascript:void(0);">
							<a onclick="deleteReply('.$row1['id'].','.$row['postid'].');" href="javascript:void(0);">Delete </a>
							</span>';
							else 
							$delete_link='';
						
							//if replies 
							$agree_link=' <a onclick="agreeReply('.$row1['id'].');"  href="javascript:void(0);">Agree </a>';
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
							$query = mysql_query("SELECT profile_img from users where userid='".$row1['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$usr_img=$p_row['profile_img'];
									
									}
							}
							if($usr_img!='') {
							$userPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$html.='<div id="replyComment" '.$reply_comment_class.'>
								
									<div class=profilepicreply><a class="link_user" href="'.$GLOBALS['base_url'].'index.php/viewprofile?profileid='.$row1['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$row1['comment'].'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row1['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree">people Agree</div>
													 <div class="circle" id="disagreereply_circle'.$row1['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">people disAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row1['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row1['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';
				}	
				$html.='</div>';		
				  //reply comment	
					$html.='<div id="replyComment">
							<form name="replyPost" id="replyPost">
								<div class=profilepicreply>'.$profilPic.'</div>
								<div class="commentreply"><textarea class="input-tetlize commentreplyArea" name="commentreplyArea" id="commentreplyArea'.$row['postid'].'"></textarea></div>
								<div class="postreply" onclick="postReply('.$row['postid'].');"><img alt="comment" src="images/comment.png"></div>
							</form>	
								</div>		';
					}	$html.='</div>';				
				}		
				$val = array("success" => "yes","status" =>$insert,"html"=>$html);
				$output = json_encode($val);
				echo $output;
			}
			else{
				$val = array("success" => "no","status" =>$insert);
				$output = json_encode($val);
				echo $output;
			}	
	
}



?>