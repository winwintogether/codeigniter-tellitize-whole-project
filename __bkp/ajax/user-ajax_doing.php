<?php
//error_reporting(0);
session_start();
require('config.php');
if(isset($_GET['mode']) AND $_GET['mode']=='save_user'){
	
	$select="SELECT * FROM users WHERE  user_name='".$_POST['username']."'";
	$sql=mysql_query("SELECT * FROM users WHERE  user_name='".$_POST['username']."'");
	$row=mysql_num_rows($sql);
	if($row){
	$val = array("success" => "no","status" =>$select);
			$output = json_encode($val);
			echo $output;
		}
	else{
			$val = array("success" => "yes","status" =>$select);
			$output = json_encode($val);
			echo $output;
		}		
}

if(isset($_GET['mode']) AND $_GET['mode']=='update_user'){
	
	$select="SELECT * FROM users WHERE  user_name='".$_POST['username']."' and userid!='".$_SESSION['userid']."'";
	$sql=mysql_query("SELECT * FROM users WHERE  user_name='".$_POST['username']."' and userid!='".$_SESSION['userid']."'" );
	$row=mysql_num_rows($sql);
	if($row){
	
	$val = array("success" => "no","status" =>$select);
			$output = json_encode($val);
			echo $output;
		}
	else{
	
			$update=mysql_query("Update users SET user_name='".$_POST['username']."',email='".$_POST['email']."',name='".$_POST['name']."',age='".$_POST['age']."',about_me='".$_POST['aboutme']."',search_tags='".$_POST['tags']."' ,zipcode='".$_POST['zipcode']."',nickname='".$_POST['nickname']."',scars='".$_POST['scars']."',tattoos='".$_POST['tattoos']."',highschool='".$_POST['highschool']."',college='".$_POST['college']."',relationshp_status='".$_POST['relation_status']."',state='".$_POST['state']."',city='".$_POST['city']."' where userid='".$_SESSION['userid']."'");
						
					  
			if($update){
				$val = array("success" => "yes","status" =>$update);
				$output = json_encode($val);
				echo $output;
			}
			else{
				$val = array("success" => "db","status" =>$update);
				$output = json_encode($val);
				echo $output;
			}	
		}		
}

if(isset($_GET['mode']) AND $_GET['mode']=='login_user'){
   $select="SELECT * FROM users WHERE  user_name='".$_POST['login_username']."' AND password= md5('".$_POST['login_pw']."') AND status=1";
	$sql=mysql_query("SELECT * FROM users WHERE  user_name='".$_POST['login_username']."' AND password= md5('".$_POST['login_pw']."')AND status=1");
	$row=mysql_num_rows($sql);
	$result=mysql_fetch_array($sql);
	 
	if($row){
	 
	$val = array("success" => "yes","status" => $_SESSION['userid']);
			$output = json_encode($val);
			echo $output;
		}
	else{
			$val = array("success" => "no","status" => $select);
			$output = json_encode($val);
			echo $output;
		}
}

if(isset($_GET['mode']) AND $_GET['mode']=='saveComment'){
	
	  $selectWords=mysql_query("select words from badwords_list where id=1");
				$words=mysql_fetch_array($selectWords);
				if($words){
				$word_list=explode( ',', $words['words'] );
				}
				
				$wordpost=explode( ' ', $_POST['commentArea'] );
				$result = array_diff($word_list, $wordpost);
				$result=count($result);$result2=count($wordpost);
				if($result==$result2) 
				{
	  
	             }
	  
	   if(isset($_SESSION['userid']))
		 {$result_post=0;
		        $from=$_POST['postasuser'];
				
				$in="INSERT INTO `public_post` (
						`postid` ,
						`cid` ,
						`from` ,
						`comment` ,
						`post_date` ,
						`location`,
						`group_id`,
						`userid`,
						`placeid`
						)
						VALUES (
						NULL ,'".$_POST['category']."','".$from."','".$_POST['commentArea']."','".date("y/m/d")."','".$_POST['location']."','".$_POST['group']."','".$_SESSION['userid']."'
						,'".$_POST['places']."')";
						$insert=mysql_query($in);
						  
				if($insert){
				    $post_id=mysql_insert_id();
					//post place name
					if(isset($_POST['place_name']) and $_POST['post_about']=='place'){
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`place`
						)
						VALUES (
						'".$post_id."','place','".$_POST['place_name']."'
						)");
						if(isset($_POST['email'])){
							$to = $_POST['email'];
							$subject = "You have been Tellitized";
							//$msg  = $_POST['commentArea'];
							$msg = ' Your name has been entered on our site in the REVEAL A CRUSH category.
Please click here to see your message.' .$base_url.'
Tellitize Support Team';
							
							$headers = "From: info@tellitize.com" ;
						
							mail($to,$subject,$msg ,$headers);
						}
					}
					if(isset($_POST['other_desc']) and $_POST['post_about']=='other' ){
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`other_description`
						)
						VALUES (
						'".$post_id."','other','".$_POST['other_desc']."'
						)");
						if(isset($_POST['email'])){
							$to = $_POST['email'];
							$subject = "You have been Tellitized";
							//$msg  = $_POST['commentArea'];
							$msg = ' Your name has been entered on our site in the REVEAL A CRUSH category.
Please click here to see your message.' .$base_url.'
Tellitize Support Team';
							
							$headers = "From: info@tellitize.com" ;
						
							mail($to,$subject,$msg ,$headers);
						}
					}
					if(isset($_POST['first_name']) and $_POST['post_about']=='person'){
						$in=mysql_query("INSERT INTO `post_details` (
						`postid` ,
						`post_about` ,
						`first_name` ,
						`last_name` ,
						`email` 						
						)
						VALUES (
						'".$post_id."','person','".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."'
						)");
						if(isset($_POST['email'])){
							$to = $_POST['email'];
							$subject = "You have been Tellitized";
							//$msg  = $_POST['commentArea'];
							$msg = ' Your name has been entered on our site in the REVEAL A CRUSH category.
Please click here to see your message.' .$base_url.'
Tellitize Support Team';
							
							$headers = "From: info@tellitize.com" ;
						
							mail($to,$subject,$msg ,$headers);
						}
						
					}
						
					$val = array("success" => "yes","status" =>$insert,"result2"=>$result2,"result"=>$result);
					$output = json_encode($val);
					echo $output;
				}
				else{
					$val = array("success" => "no","status" =>$insert);
					$output = json_encode($val);
					echo $output;
				}	
		}
		else{
			$val = array("success" => "no","status" =>"notauser");
					$output = json_encode($val);
					echo $output;
		}		
}


if(isset($_GET['mode']) AND $_GET['mode']=='viewComment'){
		if(isset($_SESSION['userid'])){
		$select=mysql_query("SELECT * FROM public_post where postid not in 
					(SELECT postid FROM report_abused_list 
					where userid =".$_SESSION['userid'].")order by  postid desc limit 10
					");
		}	
		else{
		$select=mysql_query("SELECT * FROM public_post order by  postid desc limit 10");
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
				else{$profilPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';}
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
						
																<a class="addthis_button"  href="http://www.addthis.com/bookmark.php" addthis:url="http://www.tellitize.com/" 
																  addthis:title="'.$category.', '.$row['comment'].'"  addthis:description=" '.$row['comment'].'">share</a>
														</div>';
									 }
				$html.='<div id="article">
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
					if($count>2) 
					{ $html.='<div class="view_all view_all'.$row['postid'].'"><a href="javascript:void(0)" onclick="viewreplies('.$row['postid'].');">View all '.$count.' comments</a></div>';}else{
						$html.='<div class="view_all view_all'.$row['postid'].'"></div>';
					}
				     //view comment
					 $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$row['postid']."' order by id desc limit 2 ");
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
							$userPic='<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';
							}
							$html.='<div id="replyComment" >
								
									<div class=profilepicreply><a class="link_user" href="'.$GLOBALS['base_url'].'index.php/viewprofile?profileid='.$row1['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$row1['comment'].'</div>
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
								<div class="postreply" onclick="postReply('.$row['postid'].');">Comment</div>
							</form>	
								</div>		';
					}				
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

if(isset($_GET['mode']) AND $_GET['mode']=='create_group'){
   if(isset($_POST[groupid]))
   {
   		$in="Update group_list SET group_name='".$_POST['gname']."',description='".$_POST['g_desc']."' where id='".$_POST['groupid']."' AND userid='".$_SESSION['userid']."'";
		$update=mysql_query($in);
							  
					if($update){
						$val = array("success" => "yes","status" =>$update);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$update);
						$output = json_encode($val);
						echo $output;
					}	
   }
   else{
		$in="INSERT INTO `group_list` (
							`id` ,
							`group_name` ,
							`description` ,
							`userid` ,
							`date` 
							)
							VALUES (
							NULL ,'".$_POST['gname']."','".$_POST['g_desc']."','".$_SESSION['userid']."','".date("y/m/d")."'
							)";
							$insert=mysql_query($in);
							  
					if($insert){
						$val = array("success" => "yes","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}	
		}			
}

if(isset($_GET['mode']) AND $_GET['mode']=='deleteGroup'){
$delete=mysql_query("Delete from group_list where id='".$_GET['id']."'");
	if($delete){
						$val = array("success" => "yes","status" =>$delete);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$delete);
						$output = json_encode($val);
						echo $output;
					}	
}


if(isset($_GET['mode']) AND $_GET['mode']=='create_discussion'){
	$in="INSERT INTO `place_of_discussion` (
						`id` ,
						`place` ,
						`description` ,
						`userid` ,
						`date` 
						)
						VALUES (
						NULL ,'".$_POST['place']."','".$_POST['p_desc']."','".$_SESSION['userid']."','".date("y/m/d")."'
						)";
						$insert=mysql_query($in);
						  
				if($insert){
					$val = array("success" => "yes","status" =>$insert);
					$output = json_encode($val);
					echo $output;
				}
				else{
					$val = array("success" => "no","status" =>$in);
					$output = json_encode($val);
					echo $output;
				}	
}
if(isset($_GET['mode']) AND $_GET['mode']=='saveGroup'){
	$selUser=mysql_query("SELECT userid from users where user_name='".$_POST['username']."'");
	$userid=mysql_fetch_array($selUser);
	$selecexistuser=mysql_query("SELECT count(*) as cnt from group_userlist where userid='".$userid['userid']."' AND groupid='".$_POST['group']."'");
	$selecexistus="SELECT count(*) as cnt from group_userlist where userid='".$userid['userid']."' AND groupid='".$_POST['group']."'";
	$r=mysql_fetch_array($selecexistuser);
	//$exist=$exist['cnt'];
	if($r['cnt']>0){
		$val = array("success" => "no","status" =>"exist");
						$output = json_encode($val);
						echo $output;
						exit();
	}
	else{
		$in="INSERT INTO `group_userlist` (
							`id` ,
							`userid` ,
							`groupid` 
							)
							VALUES (
							NULL ,'".$userid['userid']."','".$_POST['group']."'
							)";
							$insert=mysql_query($in);
							  
					if($insert){
						$val = array("success" => "yes","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}	
		}			
}

if(isset($_GET['mode']) AND $_GET['mode']=='saveDiscussionUser'){
	$selUser=mysql_query("SELECT userid from users where user_name='".$_POST['username']."'");
	$userid=mysql_fetch_array($selUser);
	$selecexistuser=mysql_query("SELECT count(*) as cnt from discussionplace_userlist where userid='".$userid['userid']."' AND placeid='".$_POST['places']."'");
	$selecexistus="SELECT count(*) as cnt from discussionplace_userlist where userid='".$userid['userid']."' AND placeid='".$_POST['places']."'";
	$r=mysql_fetch_array($selecexistuser);
	//$exist=$exist['cnt'];
	if($r['cnt']>0){
		$val = array("success" => "no","status" =>"exist");
						$output = json_encode($val);
						echo $output;
						exit();
	}
	else{
		$in="INSERT INTO `discussionplace_userlist` (
							`id` ,
							`userid` ,
							`placeid` 
							)
							VALUES (
							NULL ,'".$userid['userid']."','".$_POST['places']."'
							)";
							$insert=mysql_query($in);
							  
					if($insert){
						$val = array("success" => "yes","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}
					else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;
					}	
		}			
}
?>