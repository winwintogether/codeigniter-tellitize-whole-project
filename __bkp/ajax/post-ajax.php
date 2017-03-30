<?php
//error_reporting(0);
session_start();
require('config.php');
//notifications send if any other user reply or like a comment or reply


if(isset($_GET['mode']) AND $_GET['mode']=='agreePost'){
	
	$lik=$_POST['lik'];
	if($lik==1) $dislik=0; else $dislik=1;
	//checking if already liked /disliked 
	$sel=mysql_query("SELECT id from post_likes where userid='".$_SESSION['userid']."' AND like_status ='".$lik."' AND postid='".$_POST['postid']."'");
	
	$row=mysql_num_rows($sel);
	if($row){
	$val = array("success" => "no","status" =>'liked');
			$output = json_encode($val);
			echo $output;
			exit();
		}
	
			$sel=mysql_query("SELECT id from post_likes where userid='".$_SESSION['userid']."' AND like_status ='".$dislik."' AND postid='".$_POST['postid']."'");
			$row=mysql_num_rows($sel);
			if($row)
			{
				$update=mysql_query("Update post_likes set like_status ='".$lik."' where  userid='".$_SESSION['userid']."'AND postid='".$_POST['postid']."'");
				if($update)
					{	
						$row_like=mysql_fetch_array($sel);
						 $notifyid=$row_like['id'];
							  // notifications
							 $selectUser=mysql_query("SELECT userid FROM public_post where postid='".$_POST['postid']."'");
							 if ($row_user=mysql_fetch_array($selectUser) ) {	$userid=$row_user['userid']; }
							 if($userid!=$_SESSION['userid'])
							 $Querynotify=mysql_query("INSERT INTO  notifications (
										`id` ,
										`notify_id` ,
										`notification_on` ,
										`userid` ,									
										`date`
										)
										VALUES (
										NULL ,'".$notifyid."','like_post','".$userid."','".date("y/m/d")."'
										)");
					
							$sel=mysql_query("SELECT count(*) as c from post_likes where  postid='".$_POST['postid']."' and like_status =1");
							$cnt=mysql_fetch_array($sel);
							$cnt_lik=$cnt['c'];
							$sel=mysql_query("SELECT count(*) as c from post_likes where  postid='".$_POST['postid']."' and like_status =0");
							$cnt=mysql_fetch_array($sel);
							$cnt_dislik=$cnt['c'];
							$val = array("success" => "yes","status" =>$update,"agree" =>$cnt_lik,"disagree" =>$cnt_dislik);
							$output = json_encode($val);
							echo $output;exit();
					}
				else{
							$val = array("success" => "no","status" =>$update);
							$output = json_encode($val);
							echo $output;exit();
					}
			}		
			else{
				
				
				$in="INSERT INTO  post_likes (
									`id` ,
									`postid` ,
									`userid` ,
									`like_status` ,
									`date`
									)
									VALUES (
									NULL ,'".$_POST['postid']."','".$_SESSION['userid']."','".$lik."','".date("y/m/d")."'
									)";
													  
				if(mysql_query($in)){
						 $notifyid=mysql_insert_id();
						  // notifications
						 $selectUser=mysql_query("SELECT userid FROM public_post where postid='".$_POST['postid']."'");
						 if ($row_user=mysql_fetch_array($selectUser) ) {	$userid=$row_user['userid']; }
				         if($userid!=$_SESSION['userid'])
						 $Querynotify=mysql_query("INSERT INTO  notifications (
									`id` ,
									`notify_id` ,
									`notification_on` ,
									`userid` ,									
									`date`
									)
									VALUES (
									NULL ,'".$notifyid."','like_post','".$userid."','".date("y/m/d")."'
									)");
						$sel=mysql_query("SELECT count(*) as c from post_likes where  postid='".$_POST['postid']."' and like_status =1");
						$cnt=mysql_fetch_array($sel);
						$cnt_lik=$cnt['c'];
						$sel=mysql_query("SELECT count(*) as c from post_likes where  postid='".$_POST['postid']."' and like_status =0");
						$cnt=mysql_fetch_array($sel);
						$cnt_dislik=$cnt['c'];
						$val = array("success" => "yes","status" =>$insert,"agree" =>$cnt_lik,"disagree" =>$cnt_dislik);
								$output = json_encode($val);
								echo $output;exit();
							}
						else{
								$val = array("success" => "no","status" =>$insert);
								$output = json_encode($val);
								echo $output;exit();
							}
			
	 		}		
}


if(isset($_GET['mode']) AND $_GET['mode']=='reportAbuse'){
	$in="INSERT INTO  report_abused_list (
									`id` ,
									`postid` ,
									`userid` ,
									`status` ,
									`date`
									)
									VALUES (
									NULL ,'".$_POST['postid']."','".$_SESSION['userid']."','1','".date("y/m/d")."'
									)";
													  
				if(mysql_query($in)){
						$val = array("success" => "yes","status" =>$insert);
						$output = json_encode($val);
						echo $output;exit();
					}
				else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;exit();
					}
}


if(isset($_GET['mode']) AND $_GET['mode']=='postReply'){
	$html='';
	$html_cnt='';
	$comment_posted = htmlentities($_POST['comment']);
	$in="INSERT INTO  post_replies (
									`id` ,
									`postid` ,
									`userid` ,
									`comment` ,
									`date`
									)
									VALUES (
									NULL ,'".$_POST['postid']."','".$_SESSION['userid']."','".$comment_posted."','".date("y/m/d")."'
									)";
	//$id=mysql_insert_id();												  
				if(mysql_query($in)){
				         $notifyid=mysql_insert_id();
						  // notifications
						 $selectUser=mysql_query("SELECT userid FROM public_post where postid='".$_POST['postid']."'");
						 if ($row_user=mysql_fetch_array($selectUser) ) {	$userid=$row_user['userid']; }
				         if($userid!=$_SESSION['userid'])
						 $Querynotify=mysql_query("INSERT INTO  notifications (
									`id` ,
									`notify_id` ,
									`notification_on` ,
									`userid` ,									
									`date`
									)
									VALUES (
									NULL ,'".$notifyid."','reply','".$userid."','".date("y/m/d")."'
									)");
						//no: of comments
						$Countquery =mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$_POST['postid']."'");
						if ($row_count=mysql_fetch_array($Countquery) ) {	$count=$row_count['cnt']; }
						if($count>5) 
						{ $html_cnt.='<div class="view_all view_all'.$_POST['postid'].'">
										<a href="javascript:void(0)" onclick="viewreplies('.$_POST['postid'].');">View all '.$count.' comments</a>
										</div>';
						}
				        $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$_POST['postid']."' order by id desc limit 5 ");
						$html.='<div class="viewList'.$_POST['postid'].'">';
						while($row=mysql_fetch_array($selectreplies)){
						
								//delete link only for user who posts or replied
									$user_post=0;
									//if replied user
									{if($row['userid']==$_SESSION['userid']) $user_post=1;}
									
									//if posted user
									$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$row['postid']."'");
									if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
									if($user_post==1)
									$delete_link='  |   <span class="deletReply'.$row['id'].'">
									<a onclick="deleteReply('.$row['id'].','.$row['postid'].');" href="javascript:void(0);" >Delete </a>
									</span>';
									else 
									$delete_link='';
								
									//if replies 
									$agree_link=' <a onclick="agreeReply('.$row['id'].');" href="javascript:void(0);">Agree </a>';
									$disagree_link=' <a onclick="disagreeReply('.$row['id'].');" href="javascript:void(0);">Disgree </a>';
									$selectReplylikes = mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row['id']."'");
									while($replyStatus=mysql_fetch_array($selectReplylikes)){
									
										   $like_status=$replyStatus['like_status'];
										   if($like_status==1){ $agree_link="<a>Agreed</a>";
										   }
										   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
										   }
										}
								
						
						
							$usr_img='';
							$query = mysql_query("SELECT profile_img from users where userid='".$row['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$usr_img=$p_row['profile_img'];
									
									}
							}
							if($usr_img!='') {
							$userPic='<img  alt="user photo" width="39" height="42" alt="thumb-img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="thumb-img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_replied= autolink($row['comment']);
							$html.='<div id="replyComment" >
								
									<div class=profilepicreply>'.$userPic.'</div>
									<div class="commentreplyview">'.$comment_replied.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree">people Agree</div>
													 <div class="circle" id="disagreereply_circle'.$row['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">people disAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';
						}
						$html.='</div>';
						$val = array("success" => "yes","status" =>$insert,"html"=>$html,"view"=>$html_cnt);
						$output = json_encode($val);
						echo $output;exit();
					}
				else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;exit();
					}
}
if(isset($_GET['mode']) AND $_GET['mode']=='postReplyGroup'){
	$html='';
	$html_cnt='';
	$comment_posted = htmlentities($_POST['comment']);
	$in="INSERT INTO  post_replies (
									`id` ,
									`postid` ,
									`userid` ,
									`comment` ,
									`date`
									)
									VALUES (
									NULL ,'".$_POST['postid']."','".$_SESSION['userid']."','".$comment_posted."','".date("y/m/d")."'
									)";
	//$id=mysql_insert_id();												  
				if(mysql_query($in)){
				         $notifyid=mysql_insert_id();
						  // notifications
						 $selectUser=mysql_query("SELECT userid FROM public_post where postid='".$_POST['postid']."'");
						 if ($row_user=mysql_fetch_array($selectUser) ) {	$userid=$row_user['userid']; }
				         if($userid!=$_SESSION['userid'])
						 $Querynotify=mysql_query("INSERT INTO  notifications (
									`id` ,
									`notify_id` ,
									`notification_on` ,
									`userid` ,									
									`date`
									)
									VALUES (
									NULL ,'".$notifyid."','reply','".$userid."','".date("y/m/d")."'
									)");
						//no: of comments
						$Countquery =mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$_POST['postid']."'");
						if ($row_count=mysql_fetch_array($Countquery) ) {	$count=$row_count['cnt']; }
						if($count>5) 
						{ $html_cnt.='<div class="view_all view_all'.$_POST['postid'].'">
										<a href="javascript:void(0)" onclick="viewreplies('.$_POST['postid'].');">View all '.$count.' comments</a>
										</div>';
						}
				        $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$_POST['postid']."' order by id desc limit 5 ");
						$html.='<div class="viewList'.$_POST['postid'].'">';
						while($row=mysql_fetch_array($selectreplies)){
						
								//delete link only for user who posts or replied
									$user_post=0;
									//if replied user
									{if($row['userid']==$_SESSION['userid']) $user_post=1;}
									
									//if posted user
									$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$row['postid']."'");
									if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
									if($user_post==1)
									$delete_link='  |   <span class="deletReply'.$row['id'].'">
									<a onclick="deleteReply('.$row['id'].','.$row['postid'].');" href="javascript:void(0);" >Delete </a>
									</span>';
									else 
									$delete_link='';
								
									//if replies 
									$agree_link=' <a onclick="agreeReply('.$row['id'].');" href="javascript:void(0);">Agree </a>';
									$disagree_link=' <a onclick="disagreeReply('.$row['id'].');" href="javascript:void(0);">Disgree </a>';
									$selectReplylikes = mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row['id']."'");
									while($replyStatus=mysql_fetch_array($selectReplylikes)){
									
										   $like_status=$replyStatus['like_status'];
										   if($like_status==1){ $agree_link="<a>Agreed</a>";
										   }
										   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
										   }
										}
								
						
						
							$usr_img='';
							$query = mysql_query("SELECT profile_img from users where userid='".$row['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$usr_img=$p_row['profile_img'];
									
									}
							}
							if($usr_img!='') {
							$userPic='<img  alt="user photo" width="39" height="42" alt="thumb-img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="thumb-img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_replied= autolink($row['comment']);
							$html.='<div id="replyComment" class="group_reply_comment">
								
									<div class=profilepicreply>'.$userPic.'</div>
									<div class="commentreplyview">'.$comment_replied.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree">Agree</div>
													 <div class="circle" id="disagreereply_circle'.$row['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">disAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';
						}
						$html.='</div>';
						$val = array("success" => "yes","status" =>$insert,"html"=>$html,"view"=>$html_cnt);
						$output = json_encode($val);
						echo $output;exit();
					}
				else{
						$val = array("success" => "no","status" =>$insert);
						$output = json_encode($val);
						echo $output;exit();
					}
}
if(isset($_GET['mode']) AND $_GET['mode']=='viewReplies'){
	$html='';
	//view comment
					 $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$_POST['postid']."' order by id desc ");
						$html.='<div class="viewList'.$_POST['postid'].'">';
						while($row1=mysql_fetch_array($selectreplies)){
							//delete link only for user who posts or replied
							$user_post=0;
							//if replied user
							$selectUserreply=mysql_query("SELECT userid from post_replies where  id='".$row1['id']."'");
							if($ruser_r=mysql_fetch_array($selectUserreply)){if($ruser_r['userid']==$_SESSION['userid']) $user_post=1;}
							
							//if posted user
							$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$_POST['postid']."'");
							if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
							if($user_post==1)
							$delete_link='  |   <span class="deletReply'.$row1['id'].'">
							<a onclick="deleteReply('.$row1['id'].','.$row1['postid'].');" href="javascript:void(0);">Delete </a>
							</span>';
							else 
							$delete_link='';
						
							//if replies 
							$agree_link=' <a onclick="agreeReply('.$row1['id'].');" href="javascript:void(0);">Agree </a>';
							$disagree_link=' <a onclick="disagreeReply('.$row1['id'].');" href="javascript:void(0);">Disgree </a>';
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
							$userPic='<img  alt="user photo" width="39" height="42" alt="thumb-img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="thumb-img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_reply= autolink($row1['comment']);
							$html.='<div id="replyComment">
								
									<div class=profilepicreply>'.$userPic.'</div>
									<div class="commentreplyview">'.$comment_reply.'</div>
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
	$val = array("success" => "yes","status" =>$insert,"html"=>$html);
						$output = json_encode($val);
						echo $output;exit();
	
}
if(isset($_GET['mode']) AND $_GET['mode']=='viewRepliesGroup'){
	$html='';
	//view comment
					 $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$_POST['postid']."' order by id desc ");
						$html.='<div class="viewList'.$_POST['postid'].'">';
						while($row1=mysql_fetch_array($selectreplies)){
							//delete link only for user who posts or replied
							$user_post=0;
							//if replied user
							$selectUserreply=mysql_query("SELECT userid from post_replies where  id='".$row1['id']."'");
							if($ruser_r=mysql_fetch_array($selectUserreply)){if($ruser_r['userid']==$_SESSION['userid']) $user_post=1;}
							
							//if posted user
							$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$_POST['postid']."'");
							if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
							if($user_post==1)
							$delete_link='  |   <span class="deletReply'.$row1['id'].'">
							<a onclick="deleteReply('.$row1['id'].','.$row1['postid'].');" href="javascript:void(0);">Delete </a>
							</span>';
							else 
							$delete_link='';
						
							//if replies 
							$agree_link=' <a onclick="agreeReply('.$row1['id'].');" href="javascript:void(0);">Agree </a>';
							$disagree_link=' <a onclick="disagreeReply('.$row1['id'].');" href="javascript:void(0);">Disgree </a>';
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
							$userPic='<img  alt="user photo" width="39" height="42" alt="thumb-img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="thumb-img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_reply= autolink($row1['comment']);
							$html.='<div id="replyComment" class="group_reply_comment">
								
									<div class=profilepicreply>'.$userPic.'</div>
									<div class="commentreplyview">'.$comment_reply.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row1['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree">Agree</div>
													 <div class="circle" id="disagreereply_circle'.$row1['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">DisAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row1['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row1['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';
						}
						$html.='</div>';
	$val = array("success" => "yes","status" =>$insert,"html"=>$html);
						$output = json_encode($val);
						echo $output;exit();
	
}
//replies agree/disagree
if(isset($_GET['mode']) AND $_GET['mode']=='agreeReply'){
	
	$lik=$_POST['lik'];
	if($lik==1) $dislik=0; else $dislik=1;
	//checking if already liked /disliked 
	$sel=mysql_query("SELECT id from reply_likes where userid='".$_SESSION['userid']."' AND like_status ='".$lik."' AND  reply_id='".$_POST['replyid']."'");
	
	$row=mysql_num_rows($sel);
	if($row){
	$val = array("success" => "no","status" =>'liked');
			$output = json_encode($val);
			echo $output;
			exit();
		}
	
			$sel=mysql_query("SELECT id from reply_likes where userid='".$_SESSION['userid']."' AND like_status ='".$dislik."' AND  reply_id='".$_POST['replyid']."'");
			$row=mysql_num_rows($sel);
			if($row)
			{
				$update=mysql_query("Update reply_likes set like_status ='".$lik."' where  userid='".$_SESSION['userid']."'AND  reply_id='".$_POST['replyid']."'");
				if($update)
					{	
						$row_id=mysql_fetch_array($sel);
						$notifyid=$row_id['id'];
							 // notifications
							 $selectUser=mysql_query("SELECT userid FROM post_replies where id='".$_POST['replyid']."'");
							 if ($row_user=mysql_fetch_array($selectUser) ) {	$userid=$row_user['userid']; }
							 if($userid!=$_SESSION['userid'])
							 $Querynotify=mysql_query("INSERT INTO  notifications (
										`id` ,
										`notify_id` ,
										`notification_on` ,
										`userid` ,									
										`date`
										)
										VALUES (
										NULL ,'".$notifyid."','like_reply','".$userid."','".date("y/m/d")."'
										)");	
					
							$sel=mysql_query("SELECT count(*) as c from reply_likes where  reply_id='".$_POST['replyid']."' and like_status =1");
							$cnt=mysql_fetch_array($sel);
							$cnt_lik=$cnt['c'];
							$sel=mysql_query("SELECT count(*) as c from reply_likes where  reply_id='".$_POST['replyid']."' and like_status =0");
							$cnt=mysql_fetch_array($sel);
							$cnt_dislik=$cnt['c'];
							$val = array("success" => "yes","status" =>$update,"agree" =>$cnt_lik,"disagree" =>$cnt_dislik);
							$output = json_encode($val);
							echo $output;exit();
					}
				else{
							$val = array("success" => "no","status" =>$update);
							$output = json_encode($val);
							echo $output;exit();
					}
			}		
			else{
				
				
				$in="INSERT INTO  reply_likes (
									`id` ,
									`reply_id` ,
									`userid` ,
									`like_status` ,
									`date`
									)
									VALUES (
									NULL ,'".$_POST['replyid']."','".$_SESSION['userid']."','".$lik."','".date("y/m/d")."'
									)";
													  
				if(mysql_query($in)){
				
				 		$notifyid=mysql_insert_id();
						  // notifications
						 $selectUser=mysql_query("SELECT userid FROM post_replies where id='".$_POST['replyid']."'");
						 if ($row_user=mysql_fetch_array($selectUser) ) {	$userid=$row_user['userid']; }
				         if($userid!=$_SESSION['userid'])
						 $Querynotify=mysql_query("INSERT INTO  notifications (
									`id` ,
									`notify_id` ,
									`notification_on` ,
									`userid` ,									
									`date`
									)
									VALUES (
									NULL ,'".$notifyid."','like_reply','".$userid."','".date("y/m/d")."'
									)");
									
						$sel=mysql_query("SELECT count(*) as c from reply_likes where  reply_id='".$_POST['replyid']."' and like_status =1");
						$cnt=mysql_fetch_array($sel);
						$cnt_lik=$cnt['c'];
						$sel=mysql_query("SELECT count(*) as c from reply_likes where  reply_id='".$_POST['replyid']."' and like_status =0");
						$cnt=mysql_fetch_array($sel);
						$cnt_dislik=$cnt['c'];
						$val = array("success" => "yes","status" =>$insert,"agree" =>$cnt_lik,"disagree" =>$cnt_dislik);
								$output = json_encode($val);
								echo $output;exit();
							}
						else{
								$val = array("success" => "no","status" =>$insert);
								$output = json_encode($val);
								echo $output;exit();
							}
			
	 		}		
}


//delete replies
if(isset($_GET['mode']) AND $_GET['mode']=='deleteReply'){
$html_cnt='';
$html='';
	$delete=mysql_query("Delete from post_replies where id=".$_POST['replyid']);
	if($delete){
	
						//no: of comments
						
						$Countquery =mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$_POST['pid']."'");
						if ($row_count=mysql_fetch_array($Countquery) ) {	$count=$row_count['cnt']; }
						if($count>5) 
						{ $html_cnt.='<div class="view_all view_all'.$_POST['postid'].'">
										<a href="javascript:void(0)" onclick="viewreplies('.$_POST['pid'].');">View all '.$count.' comments</a>
										</div>';
						}
				        $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$_POST['pid']."' order by id desc limit 5 ");
						$html.='<div class="viewList'.$_POST['pid'].'">';
						while($row=mysql_fetch_array($selectreplies)){
						
								//delete link only for user who posts or replied
									$user_post=0;
									//if replied user
									{if($row['userid']==$_SESSION['userid']) $user_post=1;}
									
									//if posted user
									$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$row['postid']."'");
									if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
									if($user_post==1)
									$delete_link='  | <span class="deletReply'.$row['id'].'">
									<a onclick="deleteReply('.$row['id'].','.$_POST['pid'].');" href="javascript:void(0);">Delete </a>
									</span>';
									else 
									$delete_link='';
								
									//if replies 
									$agree_link=' <a onclick="agreeReply('.$row['id'].');"  href="javascript:void(0);">Agree </a>';
									$disagree_link=' <a onclick="disagreeReply('.$row['id'].');"  href="javascript:void(0);">Disgree </a>';
									$selectReplylikes = mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row['id']."'");
									while($replyStatus=mysql_fetch_array($selectReplylikes)){
									
										   $like_status=$replyStatus['like_status'];
										   if($like_status==1){ $agree_link="<a>Agreed</a>";
										   }
										   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
										   }
										}
								
						
						
							$usr_img='';
							$query = mysql_query("SELECT profile_img from users where userid='".$row['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$usr_img=$p_row['profile_img'];
									
									}
							}
							if($usr_img!='') {
							$userPic='<img  alt="user photo" width="39" height="42" alt="thumb-img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="thumb-img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_replied= autolink($row['comment']);
							$html.='<div id="replyComment">
								
									<div class=profilepicreply>'.$userPic.'</div>
									<div class="commentreplyview">'.$comment_replied.'</div>
										<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree">people Agree</div>
													 <div class="circle" id="disagreereply_circle'.$row['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">people disAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';
						}
						$html.='</div>';
						$val = array("success" => "yes","status" =>$delete,"html"=>$html,"view"=>$html_cnt);
						$output = json_encode($val);
						echo $output;exit();
					}
	else{
						$val = array("success" => "no","status" =>$delete);
						$output = json_encode($val);
						echo $output;exit();
					}
}
//delete replies group
if(isset($_GET['mode']) AND $_GET['mode']=='deleteReplyGroup'){
$html_cnt='';
$html='';
	$delete=mysql_query("Delete from post_replies where id=".$_POST['replyid']);
	if($delete){
	
						//no: of comments
						
						$Countquery =mysql_query("SELECT count(*) as cnt FROM post_replies where postid='".$_POST['pid']."'");
						if ($row_count=mysql_fetch_array($Countquery) ) {	$count=$row_count['cnt']; }
						if($count>5) 
						{ $html_cnt.='<div class="view_all view_all'.$_POST['postid'].'">
										<a href="javascript:void(0)" onclick="viewreplies('.$_POST['pid'].');">View all '.$count.' comments</a>
										</div>';
						}
				        $selectreplies=mysql_query("SELECT * from post_replies where  postid='".$_POST['pid']."' order by id desc limit 5 ");
						$html.='<div class="viewList'.$_POST['pid'].'">';
						while($row=mysql_fetch_array($selectreplies)){
						
								//delete link only for user who posts or replied
									$user_post=0;
									//if replied user
									{if($row['userid']==$_SESSION['userid']) $user_post=1;}
									
									//if posted user
									$selectUserpost=mysql_query("SELECT userid from public_post where 	postid='".$row['postid']."'");
									if($ruser_p=mysql_fetch_array($selectUserpost)){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
									if($user_post==1)
									$delete_link='  | <span class="deletReply'.$row['id'].'">
									<a onclick="deleteReply('.$row['id'].','.$_POST['pid'].');" href="javascript:void(0);">Delete </a>
									</span>';
									else 
									$delete_link='';
								
									//if replies 
									$agree_link=' <a onclick="agreeReply('.$row['id'].');"  href="javascript:void(0);">Agree </a>';
									$disagree_link=' <a onclick="disagreeReply('.$row['id'].');"  href="javascript:void(0);">Disgree </a>';
									$selectReplylikes = mysql_query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$row['id']."'");
									while($replyStatus=mysql_fetch_array($selectReplylikes)){
									
										   $like_status=$replyStatus['like_status'];
										   if($like_status==1){ $agree_link="<a>Agreed</a>";
										   }
										   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
										   }
										}
								
						
						
							$usr_img='';
							$query = mysql_query("SELECT profile_img from users where userid='".$row['userid']."'");
								if($p_row=mysql_fetch_array($query)){
								   {
									$usr_img=$p_row['profile_img'];
									
									}
							}
							if($usr_img!='') {
							$userPic='<img  alt="user photo" width="39" height="42" alt="thumb-img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="thumb-img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_replied= autolink($row['comment']);
							$html.='<div id="replyComment" class="group_reply_comment">
								
									<div class=profilepicreply>'.$userPic.'</div>
									<div class="commentreplyview">'.$comment_replied.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree"> Agree</div>
													 <div class="circle" id="disagreereply_circle'.$row['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">disAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$row['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$row['id'].'">'.$disagree_link.' </span>	   '.
									   $delete_link.'
									</div>
									
									</div>		';
						}
						$html.='</div>';
						$val = array("success" => "yes","status" =>$delete,"html"=>$html,"view"=>$html_cnt);
						$output = json_encode($val);
						echo $output;exit();
					}
	else{
						$val = array("success" => "no","status" =>$delete);
						$output = json_encode($val);
						echo $output;exit();
					}
}


//delete replies
if(isset($_GET['mode']) AND $_GET['mode']=='deletePost'){
		$delete=mysql_query("Delete from public_post where postid=".$_POST['id']);
		$deletereplies=mysql_query("Delete from post_replies where postid=".$_POST['id']);
				if($delete){
							$val = array("success" => "yes","status" =>$delete);
							$output = json_encode($val);
							echo $output;exit();
					}
				else{
							$val = array("success" => "no","status" =>$delete);
							$output = json_encode($val);
							echo $output;exit();
					}
}

if(isset($_GET['mode']) AND $_GET['mode']=='viewPostsAbout'){
	$html='<input type="hidden" name="nameuser" value="'.$_GET['name'].' " id="nameuser">
			<input type="hidden" name="emailuser" value="'.$_GET['email'].' " id="emailuser">';
	//$selectQuery=mysql_query("select * from post_details where first_name='".$_GET['name']."' OR email='".$_GET['name']."'" );
	//while($row=mysql_fetch_array($selectQuery){
	//$html='';
	
	
			if(isset($_GET['groupid'])){
							$select=mysql_query("SELECT * FROM public_post where postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].") And postid in(select postid from post_details where first_name='".$_GET['name']."' 
							OR email='".$_GET['email']."') AND  group_id=".$_GET['groupid']." AND  placeid=0 and status=0 order by  postid desc limit 10
							");
							
			$article_id='group_article';
			$reply_comment_class='class="group_reply_comment"';
			$people_agree='Agree';
			$people_disagree='DisAgree';
			}
		else if(isset($_GET['placeid'])){
							$select=mysql_query("SELECT * FROM public_post where postid not in 
							(SELECT postid FROM report_abused_list 
							where userid =".$_SESSION['userid'].") And postid in(select postid from post_details where first_name='".$_GET['name']."' 
							OR email='".$_GET['email']."') AND  placeid=".$_GET['placeid']." and status=0 order by  postid desc limit 10
							");
							
			$article_id='group_article';
			$reply_comment_class='class="group_reply_comment"';
			$people_agree='Agree';
			$people_disagree='DisAgree';
			}
		
		else{
			$select=mysql_query("SELECT * FROM public_post where postid not in 
						(SELECT postid FROM report_abused_list 
						where userid =".$_SESSION['userid'].")and group_id=0 AND  placeid=0 and status=0 order by  postid desc limit 10
						");
						
			$article_id='article';
			$reply_comment_class='';
			$people_agree='People Agree';
			$people_disagree='People DisAgree';
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
			{	
				if($user['reg_status']==0)
				$from=$user['name'].''.$user['last_name'];
				else
					$from=$user['name'];
			}
			$share_btncode=' <a href="javascript:void(0)" onclick="notValidUser()";>share</a>';
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
						$profilPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$base_url.'/ajax/uploads/'.$profile_img.'" />';
					}
				else{$profilPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';}
			}
			}
			else{
				$agreeClick='onclick="notValidUser()"';
				$disagreeClick='onclick="notValidUser()"';
				//$report_abuse='onclick="notValidUser()"';
				$agree_click='';
				$disagree_click='';
			}
			$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
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
				
				if($postAbout=mysql_fetch_array($selectPostAbout))
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
						   	$category=$postAbout['first_name'];							
						}
						else $category='';						
						
				}
	       		if($category=='') $style='style="padding-top:6px"';
				else $style="";
				$category_link= str_replace(" ","-",$category);
				if(isset($_SESSION['username'])) {
					$commentonpost=htmlentities($row['comment']);
					$share_btncode='<div class="addthis_toolbox addthis_default_style " >
						
									<a class="addthis_button"  href="http://www.addthis.com/bookmark.php" addthis:url="http://118.94.177.106:8165/" 
									 addthis:title="'.$category.', '.$commentonpost.'"  addthis:description=" '.$commentonpost.'">share</a>
									</div>';
														
										$selectcat=mysql_query("select cate_name from category where cid in(select cid from public_post where postid=".$row['postid'].")");
									if($row_cat=mysql_fetch_array($selectcat)){					
									$cat_name = str_replace(" ","-",$row_cat['cate_name']);
									$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );	
									}	
									$user_title='<a href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'">'.$category.'</a>';					
									
			 }
			 else  $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';
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
							$postuserPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$postuser_img.'" />';
							}
							else{
							$postuserPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
							}
					
					if(isset($_SESSION['userid']) && $row['from']!=0){
						$pic_link=$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row['from'];
					}
					else $pic_link='javascript:void(0)';
				$comment_posted= autolink($row['comment']);
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
												  '.$comment_posted.'
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
							$userPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
							}
							else{
							$userPic='<img  src="'.$base_url.'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
							}
							$reply_agree_cnt=0;
							$reply_disagree_cnt=0;
							$selectreplyCnt = mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=1");
							$agreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_agree_cnt=$agreecnt['cnt'];
							
							$selectreplyCnt  =  mysql_query("SELECT count(*) as cnt from reply_likes where  reply_id='".$row1['id']."' AND like_status=0");
							$dagreecnt=mysql_fetch_array($selectreplyCnt );
							$reply_disagree_cnt=$dagreecnt['cnt'];
							$comment_reply= autolink($row1['comment']);
							$html.='<div id="replyComment" '.$reply_comment_class.'>
								
									<div class=profilepicreply>
									<a class="link_user" href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row1['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$comment_reply.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$row1['id'].'">'.$reply_agree_cnt.'</div>
													 <div class="people-agree">'.$people_agree.'</div>
													 <div class="circle" id="disagreereply_circle'.$row1['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">'.$people_disagree.'</div>
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
								<div class="postreply" onclick="postReply('.$row['postid'].');">Comment</div>
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
	
	
	//}
}

if(isset($_GET['mode']) AND $_GET['mode']=='emailPost'){
		$html='';
				if(isset($_GET['postid']) ){
					$postid=$_GET['postid'];
				    if( $_GET['status']==1){					
					$select=mysql_query("select email,name from users where userid=".$_SESSION['userid']."");
					$row=mysql_fetch_array($select);
					$html.='<ul ><li id="email_left">From :</li>
					<li id="email_rit">'.$row['email'].'<input type="hidden" name="from_email" id="from_email" value="'.$row['email'].'"></li>
					</ul>';
				}
				    $selectpost=mysql_query("SELECT * FROM public_post where status=0 and postid=".$postid);
					$post=mysql_fetch_array($selectpost);
					$html.='<ul><li id="email_left">To :</li><li id="email_rit"><input type="text" name="to_email" id="to_email"></li></ul>
						<ul><li id="email_left">Message</li>
						<li id="email_rit">'.$post['comment'].'<input type="hidden" name="msg_area" value="'.$post['comment'].'"></li>
						</ul>
						<div id="sent_btn" onClick="sendEmail('.$postid.');"></div>';	
				
					$val = array("success" => "yes","status" =>"1","html"=>$html);
					$output = json_encode($val);
					echo $output;
				}
			else{
				$val = array("success" => "no","status" =>"0");
				$output = json_encode($val);
				echo $output;
			}
				
}
if(isset($_GET['mode']) AND $_GET['mode']=='sendEmail'){
    if(isset($_GET['post_id'])){
			$selectPostAbout = mysql_query("SELECT * from post_details where  postid='".$_GET['post_id']."'");
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
				$category = str_replace(" ","-",$category);
				$title_post = preg_replace("![^a-z0-9]+!i", "-",$category );			
			$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$to=$_POST['to_email'];
			$subject='Message from Tellitize';
			$selectcat=mysql_query("select cate_name from category where cid in(select cid from public_post where postid=".$_GET['post_id'].")");
				if($row_cat=mysql_fetch_array($selectcat)){					
						$cat_name = str_replace(" ","-",$row_cat['cate_name']);
						$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );	
				}										
			$view_url=$base_url.''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $title_post).'/'.$_GET['post_id'];
			$msg='<a href="'.$base_url.'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$base_url.'images/tellitizeLogo.png">
								 </a>
				<p>'.$_POST['msg_area'].'</p>';
			$msg.='<p>Please click here to review and respond : '.  $view_url.'</p>';
			if(isset($_POST['from_email']))
			$headers.= "From:".$_POST['from_email'] ;
			else
			$headers.= "From: info@tellitize.com" ;
			if(mail($to,$subject,$msg ,$headers)){
										$purpose='post email:'.$headers;
										$insert=mysql_query("INSERT INTO `mail_status` (`userid`,`emailid`,`purpose`)	
										VALUES ('".$_SESSION['userid']."','".$to."',' ')");
										if($insert) $mailsuccess='mailsent';								
										$val = array("success" => "yes","status" =>$mailsuccess);
										$output = json_encode($val);
										echo $output;
										
									}
									else {
									$mailsuccess='mailfailed';
									$val = array("success" => "no","status" =>$mailsuccess);
										$output = json_encode($val);
										echo $output;
								}
		}
		else {
									
									$val = array("success" => "no","status" =>"");
										$output = json_encode($val);
										echo $output;
								}
}
?>