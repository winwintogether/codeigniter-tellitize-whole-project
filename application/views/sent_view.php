<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/jquery.quick.pagination.min.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>functions/javascript/message.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("ul.pagination1").quickPagination();
	//$("ul.pagination2").quickPagination({pagerLocation:"both"});
	//$("ul.pagination3").quickPagination({pagerLocation:"both",pageSize:"3"});
});
function viewMore(id){
	 $('#date_view_'+id).slideToggle();
}
</script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/message.css" rel="stylesheet" />

	<div id="mid_container">
		<div class="mid_content">
			<div id="left_msg" style="float:left;margin-left:2px;margin-right:5px;margin-top:80px;width:215px;" >
									
									  <ul>
									  	<li><a href="<?php echo $GLOBALS['base_url']; ?>inbox">Inbox</a></li>
										<li><a href="<?php echo $GLOBALS['base_url']; ?>message">Compose</a></li>
										<li class="sent"><a href="<?php echo $GLOBALS['base_url']; ?>sent">Sent</a></li>
									  </ul>
									
			</div><!--left_msg-->
			<div class="left" style="width:490px;">
			<div class="top_bar" style="margin-top:1px;margin-bottom:1px;">
							<div class="mypost_icon" style="float:left;margin-left:5px;">
								<span style="position:relative;top:10px;">
									<img width="27" height="32" alt="message" src="images/message-top-icon.png">
								</span>
							<span style="font:14px arial;font-weight:normal;color:#666666;padding-top:-10px;">SENT MESSAGES</span>
							</div>
							
							<div class="user_group" style="float:right">
								<h3>SEND ANONYMOUS EMAILS</h3>
							</div>
						</div><!--top_bar-->
					<div class="post_area_bg" style="padding-top:0px;">
								<div class="orang_left"></div>
								<div class="orang_mid" style="width:467px;">
										<h4>VIEW MESSAGE</h4>
																			
									</div>
								<div class="orang_rit"></div>
								
						</div>
				<div id="post_contents" style="width:467px;" >
		          <ul class="pagination1">
			
					
						
						<?php
						$selectQuery=mysql_query("SELECT * from messages where  `from`='".$_SESSION['userid']."' order by id desc");
						 while($row=mysql_fetch_array($selectQuery)){
						 $usr_img='';
						$query = mysql_query("SELECT profile_img,name,last_name from users where userid='".$row['to_user']."'");
						$name_link='';
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
							$date=explode('-',$row['date']);
							$date=$date[2].'-'.$date[1].'-'.$date[0];
							 ?>
							<li id="message_container" class="message_box<?php echo $row['id'];?>">
					     <div style="float:left"><?php echo $userPic; ?></div>
						 <div style="float:left;font:12px arial;padding-left:5px;width:80%;height:80%;overflow:hidden">
						 	<h4 class="orange">
								<a href="<?php echo $GLOBALS['base_url']; ?>view-profile/<?php echo $name_link; ?>/<?php echo $row['to_user']; ?>">
									<?php  $username=$this->home_model->getUsername($row['to_user']); echo $username;?>
								</a>
							</h4>
							<div class="message_body" id="message_body<?php echo $row['id'];?>"><h5><?php echo $row['message'];?> </h5></div>
							<div class="message_body_full" id="date_view_<?php echo $row['id'];?>" style="display:none;">
								<h4 class="orange" style="float:right;margin:0px 0px 0px 20px;padding-right:0px;">
									<a href="<?php echo $GLOBALS['base_url']; ?>index.php/message?replyid=<?php echo $row['from']; ?>">Reply</a>
								</h4>
								<span class="date_view"><?php echo $date;?></span>
							</div>
						 </div>
						 <div class="expand_delete">
						 <!--	<a href="javascript:void(0)" class="expand_view_more_class" onClick="viewMore(<?php echo $row['id'];?>);" > onClick="viewMore();"-->
							<a href="javascript:void(0)" onClick="viewMore(<?php echo $row['id'];?>);">
								<img width="18" height="18" border="0"  src="<?php echo $GLOBALS['base_url']; ?>images/mess-viewmore.png">
							</a>
							<a href="javascript:void(0)" onClick="deleteMsg(<?php echo $row['id'];?>);">
								<img width="16" height="16" border="0" alt="message-close" src="<?php echo $GLOBALS['base_url']; ?>images/message-close.png" >
							</a>
						 </div>
						 </li>
						 <?php
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