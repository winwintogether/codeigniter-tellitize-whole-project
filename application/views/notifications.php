<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/notify.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	//$("ul.pagination2").quickPagination({pagerLocation:"both"});
	//$("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
});

function discardGroupUser(id){
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=discardGroupUser&id="+id,
			cache: false,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('#notification'+id).hide();
			  }
			
				else {
						alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
function approveGroupUser(id,userid){

	$.ajax({
	
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=approveGroupUser&id="+id+"&userid="+userid,
			cache: false,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				$('#notification'+id).hide();
			  }
			  else if(data.status == "exist")
			  {    
				
				alert("already approved a user");
			  }
			
				else {
						alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
function discardPodUser(id){
	$.ajax({
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=discardPodUser&id="+id,
			cache: false,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				$('#notification'+id).hide();
			  }
			
				else {
						alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
function approvePodUser(id,userid){

	$.ajax({
	
		   type: "POST",
			url: base_url+"ajax/user-ajax.php?mode=approvePodUser&id="+id+"&userid="+userid,
			cache: false,
			dataType: "json",
			success: function(data) {
			if(data.success == "yes")
			  {    
				
				$('#notification'+id).hide();
			  }
			  else if(data.status == "exist")
			  {    
				
				alert("already approved a user");
			  }
			
				else {
						alert(" Occured internal Error.please check network connection" );
				}
			}
	});
}
</script>

	<div id="mid_container">
		<div class="mid_content">
			<div class="left" >
			<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;margin-top:10px;"><span style="position:relative;top:5px;"><img width="16" height="19" alt="notification-icon" src="images/notifications-top-icon.png"></span>
							<span style="font:14px arial;font-weight:normal;color:#666666;padding-top:-10px;margin-left:5px;">NOTIFICATIONS</span>
							</div>
							
							<div class="user_group" style="float:right">
								<h3>OVER 700 MILLION PROFILES</h3>
							</div>
						</div><!--top_bar-->
			<div class="post_area_bg" style="padding-top:0px;">
								<div class="orang_left"></div>
								<div class="orang_mid">
									<h4>NOTIFICATIONS</h4>									
									</div>
								<div class="orang_rit"></div>
								
						</div>
				<div id="post_contents">
		          <ul class="pagination1">
				  		<?php
							$selectDatewise=mysql_query("SELECT date,id FROM notifications where userid =".$_SESSION['userid']."  group by  date 
							order by id desc");
							//echo "SELECT date,id FROM notifications where userid =".$_SESSION['userid']."  group by  date order by notifications.id desc";
							while($rowdate=mysql_fetch_array($selectDatewise))
							{
									$date=$rowdate['date'];
									$today='20'.date('y-m-d');//echo $date;//"&nbsp".$today."<br>";
									$yesterday=strtotime ( '-1 day' , strtotime ( $today ) ) ;
									$yesterday = date ( 'Y-m-d' , $yesterday );
									if($date==$today) {$day='Today';}
									else if($date==$yesterday) {$day='Yesterday';}
									else
									$day=$this->notification_model->changeDateFormat($date);
									
										 ?>
										 <div class="notific-daywise"><?php echo $day; ?></div>
										<?php
									
											$select=mysql_query("SELECT * FROM notifications where userid =".$_SESSION['userid']." and date='".$date."'");
											
											//echo "SELECT * FROM notifications where userid =".$_SESSION['userid']." and date='".$date."'";
											if($select){
												 while($row=mysql_fetch_array($select)){
												 ?>
												
												<li class="notifiblock-main" id="notification<?php echo $row['id'];?>">
													<div class="notifiread-main">
														<div class="notifiread-left">
															<img width="16" height="14" alt="notification-usericon" src="../images/notifi-user-icon.png">
														</div>
														<div class="notifiread-right">
															 <?php
															 
																	$comment='';
																	$from_user='';
																	$notification_on=$row['notification_on'];
																	if($notification_on=='reply')
																	{
																		$selectDetails=mysql_query("SELECT * FROM post_replies where id =".$row['notify_id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getFullName($row_details['userid'])	;
																			$from_user_id=$row_details['userid'];
																			$date=$this->home_model->getDate($row_details['date'])	;
																			$post_comment=$row_details['comment'];
																			$comment_inr='Commented on your post' ;
																			$post_id=$row_details['postid'];
																			
																		}
																		
																	}
																	if($notification_on=='like_post'){
																		$selectDetails=mysql_query("SELECT * FROM post_likes where id =".$row['notify_id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getFullName($row_details['userid'])	;
																			$from_user_id=$row_details['userid'];
																			$date=$this->home_model->getDate($row_details['date'])	;
																			$postQuery=mysql_query("SELECT comment FROM public_post where postid =".$row_details['postid']." ");
																			$post=mysql_fetch_array($postQuery);
																			$post_comment=$post['comment'];
																			$comment_inr='likes your post' ;
																			$post_id=$row_details['postid'];
																			
																		}
																		
																	}
																	if($notification_on=='add-to-group'){
																			$date=$this->home_model->getDate($row['date'])	;
																			$groupquery=mysql_query("select owner_id,groupid from group_userlist 
																			where id='".$row['notify_id']."'");
																			$group_notify=mysql_fetch_array($groupquery);
																			$selgrpname=mysql_query("select group_name from group_list 
																			where id='".$group_notify['groupid']."'");
																			$grpname=mysql_fetch_array($selgrpname);
																			$from_user=$this->home_model->getFullName($group_notify['owner_id'])	;
																			$from_user_id=$group_notify['owner_id'];
																			$post_comment='';
																			$comment_inr='Added you to the group '.$grpname['group_name'] ;
																			$post_id='';
																			$gp_link=str_replace(" ","-",$grpname['group_name']);
																		
																		
																	}
																	if($notification_on=='add-to-pod'){
																			$date=$this->home_model->getDate($row['date'])	;
																			$placequery=mysql_query("select owner_id,placeid from discussionplace_userlist 
																			where id='".$row['notify_id']."'");
																			$pl_notify=mysql_fetch_array($placequery);
																			$selplname=mysql_query("select place from place_of_discussion 
																			where id='".$pl_notify['placeid']."'");
																			$plpname=mysql_fetch_array($selplname);
																			$from_user=$this->home_model->getFullName($pl_notify['owner_id'])	;
																			$from_user_id=$pl_notify['owner_id'];
																			$post_comment='';
																			$comment_inr='Added you to the POD '.$plpname['place'] ;
																			$post_id='';
																			$gp_link=str_replace(" ","-",$plpname['place']);
																		
																		
																	}
																	if($notification_on=='group'){
																		$selectDetails=mysql_query("SELECT * FROM notification_for_group_or_pod 
																		where notification_id =".$row['id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getFullName($row['notify_id'])	;
																			$from_user_id=$row['notify_id'];
																			//$date=$this->home_model->getDate($row_details['date'])	;
																			$name_link=$this->home_model->getFullName($from_user_id)	;
																		    $name_link= str_replace(" ","-",$name_link);
																			$name_link =preg_replace("![^a-z0-9]+!i", "-",$name_link);
																			$groupQuery=mysql_query("SELECT group_name,id FROM group_list where id in
																			(select groupid from group_userlist where id=".$row_details['userlist_id'].")");
																			$group=mysql_fetch_array($groupQuery);
																			
																			$post_comment='';
																			$comment_inr='is a new Tellitize user.Confirm Is this the group user you added in 
																					'.$group['group_name'];
																			$post_id='';
																			
																		}
																		
																	}
																	if($notification_on=='pod'){
																		$selectDetails=mysql_query("SELECT * FROM notification_for_group_or_pod 
																		where notification_id =".$row['id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getFullName($row['notify_id'])	;
																			$from_user_id=$row['notify_id'];
																			//$date=$this->home_model->getDate($row_details['date'])	;
																			$name_link=$this->home_model->getFullName($from_user_id)	;
																		    $name_link= str_replace(" ","-",$name_link);
																			$name_link =preg_replace("![^a-z0-9]+!i", "-",$name_link);
																			$podQuery=mysql_query("SELECT place,id FROM place_of_discussion where id in
																				(select placeid from discussionplace_userlist 
																				where id=".$row_details['userlist_id'].")");
																			$pod=mysql_fetch_array($podQuery);
																			
																			$post_comment='';
																			$comment_inr='is a new Tellitize user.Confirm Is this the POD user you added in 
																					'.$pod['place'];
																			$post_id='';
																			
																		}
																		
																	}
																	if($notification_on=='join-group'){
																		$comment_inr='';
																		$post_id='';$post_comment='';
																		
																	   $sel=mysql_query("select userid,name,groupid from group_userlist where id=".$row['notify_id']);
																	   if($row_details=mysql_fetch_array($sel)){
																	       $groupSel=mysql_query("select group_name from group_list where id=".$row_details['groupid']);
																		    $group_name=mysql_fetch_array($groupSel);
																			/*$selectn=mysql_query("select name,last_name from users 
																			where userid=".$row_details['userid']);
																			$row=mysql_fetch_array($selectn);
																				 if($row['last_name']!='')
																					 $name=$row['name'].' '.$row['last_name'];				
																				 else
																					 $name=$row['name'];*/
																				$name=$this->home_model->getFullName($row_details['userid']);
																				$name= str_replace(" ","-",$name);
																				$name =preg_replace("![^a-z0-9]+!i", "-",$name);

																			//$name= str_replace(" ","-",$row_details['name']);
																	$name='<a href="view-profile/'.$name.'/'.$row_details['userid'].'" 
																			class="link_user">'.$row_details['name'].'</a>';
																	   		
																	   		$comment_inr=$name.' joined in the group ' .$group_name['group_name'];
																	   }
																			
																	}
																	if($notification_on=='join-pod'){
																	
																		$comment_inr='';
																		$post_id='';$post_comment='';
																		
																	   $sel=mysql_query("select userid,name,placeid from discussionplace_userlist 
																	   where id=".$row['notify_id']);
																	   if($row_details=mysql_fetch_array($sel)){
																	       $placeSel=mysql_query("select place from  `place_of_discussion`  
																		   where id=".$row_details['placeid']);
																		    $place_name=mysql_fetch_array($placeSel);
																			$name=$this->home_model->getFullName($row_details['userid'])	;
																			$name= str_replace(" ","-",$name);

																			//$name= str_replace(" ","-",$row_details['name']);
																	$name='<a href="view-profile/'.$name.'/'.$row_details['userid'].'" 
																			class="link_user">'.$row_details['name'].'</a>';
																	   		$comment_inr=$name.' joined in the POD ' .$place_name['place'];
																	   }
																			
																	}
																	
																	if($notification_on=='like_reply'){
																		$selectDetails=mysql_query("SELECT * FROM reply_likes where id =".$row['notify_id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getFullName($row_details['userid'])	;
																			$from_user_id=$row_details['userid'];
																			$date=$this->home_model->getDate($row_details['date'])	;
																			$postQuery=mysql_query("SELECT comment,postid FROM post_replies where id =".$row_details['reply_id']." ");
																			$post=mysql_fetch_array($postQuery);
																			$post_comment=$post['comment'];
																			$comment_inr='likes your reply' ;
																			$post_id=$post['postid'];
																			
																		}
																	}
																	
																
																	$category='';
																$selectPostAbout = mysql_query("SELECT * from post_details where  postid='".$post_id."'");
																while ($postAbout=mysql_fetch_array($selectPostAbout))
																{
																	
																	$about=$postAbout['post_about'];
																	if($about=='person')
																	$category=$postAbout['first_name']." ".$postAbout['last_name'];
																	if($about=='place')
																	$category=$postAbout['place'];
																	if($about=='other')
																	$category=$postAbout['other_description'];
																	
																}
															  $category_link= str_replace(" ","-",$category);
																?>
																<?php
																if($notification_on=='group' || $notification_on=='pod'){
																	echo '<a class="link_user" 
																href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$from_user_id.'">
																	'.$from_user.'
																</a>';
																}
																else if($notification_on=='add-to-group' || $notification_on=='add-to-pod'){
																
																	echo '<a class="link_user" 
																href="'.$GLOBALS['base_url'].''.$gp_link.'">
																	'.$from_user.'
																</a>';
																}
																else
																{
																?>
																<a class="link_user" 
																href="<?php echo $GLOBALS['base_url']; ?><?php echo  preg_replace("![^a-z0-9]+!i", "-", $category_link); ?>/<?php echo $post_id; ?>">
																	<?php echo $from_user; ?>
																</a>
                                                                <?php } ?>
																<span class="notifican_comment"><?php echo $comment_inr.' '.$post_comment; ?>:</span>
																<?php
																if($notification_on=='group'){
																echo '<a href="javascript:void(0);" 
																onclick="approveGroupUser('.$row['id'].','.$row['notify_id'].');" class="notify_approval">
																Approve</a>
															 <a href="javascript:void(0);" onclick="discardGroupUser('.$row['id'].');" class="notify_approval">
																Discard</a>';
																}
																if($notification_on=='pod'){
																echo '<a href="javascript:void(0);" 
																onclick="approvePodUser('.$row['id'].','.$row['notify_id'].');" class="notify_approval">
																Approve</a>
																<a href="javascript:void(0);" onclick="discardPodUser('.$row['id'].');" class="notify_approval">
																Discard</a>';
																}
																?>
																<span class="grey">  (<?php echo$date; ?>)</span>
                                                                
														</div>
													</div>	
													
												</li>
													<?php
													
												 }
											}
										
								}		 
						?>
				  		
						</div><!--notifiblock-main ends here -->
				 </ul>

		 <div class="clearing"></div>
		
	
  </div>
 <?php
 	require("right-nav.php");
 ?>
</div>
</div>