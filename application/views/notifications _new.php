<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Tellitize</title>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/posts.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/notify.css" rel="stylesheet" />

</head>
<body>

<div id="header">
<?php $this->load->view('header'); $base_url=$GLOBALS['base_url'];?>
</div>


	<div id="mid_container">
		<div class="mid_content">
			<div class="left" >
			<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;margin-top:10px;"><span style="position:relative;top:5px;"><img width="16" height="19" alt="notification-icon" src="../images/notifications-top-icon.png"></span>
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
												
												<li class="notifiblock-main">
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
																			$from_user=$this->home_model->getUsername($row_details['userid'])	;
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
																			$from_user=$this->home_model->getUsername($row_details['userid'])	;
																			$from_user_id=$row_details['userid'];
																			$date=$this->home_model->getDate($row_details['date'])	;
																			$postQuery=mysql_query("SELECT comment FROM public_post where postid =".$row_details['postid']." ");
																			$post=mysql_fetch_array($postQuery);
																			$post_comment=$post['comment'];
																			$comment_inr='likes your post' ;
																			$post_id=$row_details['postid'];
																			
																		}
																		
																	}
																	if($notification_on=='group'){
																		$selectDetails=mysql_query("SELECT * FROM notification_for_group_or_pod where notification_id =".$row['id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getUsername($row['notify_id'])	;
																			$from_user_id=$row['notify_id'];
																			//$date=$this->home_model->getDate($row_details['date'])	;
																			$name_link=$this->home_model->getFullName($from_user_id)	;
																		    $name_link= str_replace(" ","-",$name_link);
																			$groupQuery=mysql_query("SELECT group_name,id FROM group_list where id in
																			(select groupid from group_userlist where id=".$row_details['userlist_id'].")");
																			$group=mysql_fetch_array($groupQuery);
																			
																			$post_comment='';
																			$comment_inr='is a new Tellitize user.Confirm Is this the group user you added in 
																					'.$group['group_name'];
																			$post_id='';
																			
																		}
																		
																	}
																	
																	if($notification_on=='like_reply'){
																		$selectDetails=mysql_query("SELECT * FROM reply_likes where id =".$row['notify_id']." ");
																		if($row_details=mysql_fetch_array($selectDetails))
																		{
																			$from_user=$this->home_model->getUsername($row_details['userid'])	;
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
																if($notification_on=='group'){
																	echo '<a class="link_user" 
																href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$from_user_id.'">
																	'.$from_user.'
																</a>';
																}
																else
																{
																?>
																<a class="link_user" 
																href="<?php echo $GLOBALS['base_url']; ?>post/<?php echo  $category_link; ?>/<?php echo $post_id; ?>">
																	<?php echo $from_user; ?>
																</a>
                                                                <?php } ?>
																<span class="notifican_comment"><?php echo $comment_inr.' '.$post_comment; ?></span>
																<span class="grey"> : (<?php echo$date; ?>)</span>
                                                                <?php
																if($notification_on=='group'){
																echo '<a href="" onclick="">Approve</a>&nbsp;&nbsp;<a href="" onclick="">Discard</a>';
																}
																?>
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
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>

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

