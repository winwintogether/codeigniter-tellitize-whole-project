<?php
class Group_model extends CI_Model{
	function Group_model(){
		//parent::Model();
	}
	function getUserList($id){
	$group_userid='';
		$html='<ul>';
		//$query = $this->db->query("SELECT user_name,userid from  users where userid in (select userid  from group_userlist where groupid=".$id.")");
		$query = $this->db->query("SELECT id,name,emailid from group_userlist where groupid=".$id);
		foreach ($query->result_array() as $row)
			{
				$group_username="'".$row['name']."'";
				$group_useremail="'".$row['emailid']."'";
				if($row['emailid']!='') {
						$query = $this->db->query("SELECT userid from  users where email='".$row['emailid']."'");
						 if ($query->num_rows()){
							foreach ($query->result_array() as $user){
								$userid=$user['userid'];
							}
							$user_link=$GLOBALS['base_url'].'viewprofile?profileid='.$userid;
						}
						else{
							$user_link='javascript:void(0)';
						 }
				}
					else{
							$user_link='javascript:void(0)';
						 }
				 $html.='<li>
								<a href="'.$user_link.'" class="userlist">'.$row['name'].'</a>
								<a href="javascript:void(0)" class="postimg" onClick="showPostArea('.$group_username.','.$group_useremail.');">
									<img width="16" height="16" alt="post" src="'.$GLOBALS['base_url'].'images/tellitize-small-logo.png" >
								</a>
								<a href="javascript:void(0)" class="postimg" onClick="showPostsAbout('.$group_username.','.$group_useremail.','.$id.');">
									<img width="16" height="16" alt="view-post" src="'.$GLOBALS['base_url'].'images/post-icon.jpg" >
								</a>
							</li>';
			 }
		$html.='<ul>';	
		return $html; 
	}
	function getAllUserList($id){
		$html='<select name="group_user" id="group_user" class="toppost">
										<option value="0">Select</option>';
		$query = $this->db->query("SELECT name,emailid from group_userlist where groupid=".$id);
		foreach ($query->result_array() as $row)
			{
				$html.='<option value="'.$row['emailid'].'">'.$row['name'].'</option>';
		
			 }
		$html.='</select> ';
		return $html;
	}
	
	function article($id){
		$html='';
	
		
			$query = $this->db->query(
					"SELECT * FROM public_post where postid not in 
					(SELECT postid FROM report_abused_list 
					where userid =".$_SESSION['userid'].") AND  group_id=".$id." order by  postid desc limit 10
					");
		
		foreach ($query->result_array() as $row)
		{	$agreed='';
			$disagreed='';
			$agree_status='';
            if($row['from']=='' || $row['from']=='0') $from='Anonymous';
			else 
			{	$from=$this->home_model->getUsername($row['from']);
			}
			$share_btncode=' <a href="javascript:void(0)" onclick="notValidUser()";>share</a>';
			if(isset($_SESSION['username'])){
				$agreeClick='onclick="agreePost('.$row['postid'].');"';
				$disagreeClick='onclick="disagreePost('.$row['postid'].');"';
				$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
				
				//check agreed or disagreed
				
				$agree_click='';
					$disagree_click='';
				$selectQuery = $this->db->query("SELECT like_status from post_likes where userid=".$_SESSION['userid']." and postid='".$row['postid']."'");
				foreach ($selectQuery->result_array() as $agreeStatus)
				{
					$agree_status=$agreeStatus['like_status'];
					$agreed='';
					$disagreed='';
					if($agree_status==1)  { $agree_click="style=display:none";
					$agreed=' <a href="javascript:void(0)"  id="agreebtn'.$row['postid'].'" class="disable_agree"></a>';
					}
					
					if( $agree_status==0) { $disagree_click="style=display:none"; 
					$disagreed=' <a href="javascript:void(0)"  id="disagreebtn'.$row['postid'].' " class="disable_disagree"></a>';
					}
					
					/*$agree_status=$agreeStatus['like_status'];
					
					if($agree_status==1) {$agree_click="style=display:none";}
					else {$disagree_click="style=display:none";}*/
					
				}
				$profile_img=$this->home_model->getPic($_SESSION['userid']);
			if($profile_img!='') {$profilPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$profile_img.'" />';}
			else{$profilPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';}
			}
			else{
				$agreeClick='onclick="notValidUser()"';
				$disagreeClick='onclick="notValidUser()"';
				$report_abuse='onclick="notValidUser()"';
				$agree_click='';
				$disagree_click='';
				$profilPic='';
			}
			$agree_cnt=0;
			$disagree_cnt=0;
			$select = $this->db->query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=1");
			foreach ($select->result_array() as $agree)
			{
				$agree_cnt=$agree['c'];
			}
			$select = $this->db->query("SELECT count(*) as c from post_likes where  postid='".$row['postid']."' AND like_status=0");
			foreach ($select->result_array() as $dagree)
			{
				$disagree_cnt=$dagree['c'];
			}
			
			
				
			$date=$row['post_date'];
			$date=explode( '-', $date );
			$date=$date[1].'-'.$date[2].'-'.$date[0];
			$location=$row['location'];
			/*$category=$this->getCategory($row['cid']);
			//$pod=$this->getPOD($row['placeid']);
	        if($category=='') $style='style="padding-top:6px"';
			else $style="";*/
			$category='';
	        $selectPostAbout = $this->db->query("SELECT * from post_details where  postid='".$row['postid']."'");
			foreach ($selectPostAbout->result_array() as $postAbout)
			{
				/*if($postAbout['group_post_about']!=0){
					$category=$this->home_model->getUsername($postAbout['group_post_about']);
				}
				else{*/
					$about=$postAbout['post_about'];
					if($about=='person')
					$category=$postAbout['first_name']." ".$postAbout['last_name'];
					if($about=='place')
					$category=$postAbout['place'];
					if($about=='other')
					$category=$postAbout['other_description'];
					if($about=='group' || $about=='pod')
					{
					  /* if($postAbout['email']!='')
						$category=$this->home_model->getNameInPost($postAbout['email']);
					   else $category=$postAbout['first_name'];*/
					    $category=$postAbout['first_name'];
					}	
					
				//}	
			}
	       if($category=='') $style='style="padding-top:6px"';
			else $style="";
	         if(isset($_SESSION['username'])) {
			 	$share_btncode='<div class="addthis_toolbox addthis_default_style " >

  										<a class="addthis_button"  href="http://www.addthis.com/bookmark.php" addthis:url="http://www.tellitize.com/" 
										  addthis:title="'.$category.','.$row['comment'].'"  addthis:description=" '.$row['comment'].'">share</a>
								</div>';
				$user_title='<a href="'.$GLOBALS['base_url'].'index.php/userpost?postid='.$row['postid'].'">'.$category.'</a>';
			 }
			 else
			 $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';
			 $postuser_img='';
					$postuser_img=$this->home_model->getPic($row['from']);
					if($postuser_img!='') {
					$postuserPic='<img  alt="photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$postuser_img.'" />';
					}
					else{
					$postuserPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
					}
					if(isset($_SESSION['userid']) && $row['from']!=0){
						$pic_link=$GLOBALS['base_url'].'index.php/viewprofile?profileid='.$row['from'];
					}
					else $pic_link='javascript:void(0)';
			$html.='<div class="contents_list" id="'.$row['postid'].'">
					     <div id="group_article">
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
													 <div class="people-agree">Agree</div>
													 <div class="circle" id="disagree_circle'.$row['postid'].'">'.$disagree_cnt.'</div>
													  <div class="people-agree">disAgree</div>
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
													 													  
													 /* $html.='<div class="share"><a class="addthis_button" 
													  href="http://www.addthis.com/bookmark.php" addthis:url="http://www.tellitize.com/"   addthis:title="'.$category.'"      addthis:description=" '.$row['comment'].'">share</a></div>*/
													  $html.='<div class="share">'.$share_btncode.'</div>
										 </div>
									</div>
								</div>';
								
							
				if(isset($_SESSION['userid'])){
				//no: of comments
				$Countquery = $this->db->query("SELECT count(*) as cnt FROM post_replies where postid='".$row['postid']."'");
					foreach ($Countquery->result_array() as $row_count) {	$count=$row_count['cnt']; }
					if($count>5) 
					{ 
					 $html.='<div class="view_all view_all'.$row['postid'].'"><a href="javascript:void(0)" onclick="viewreplies('.$row['postid'].');">View all '.$count.' comments</a></div>';
					}
					else{
						$html.='<div class="view_all view_all'.$row['postid'].'"></div>';

					}
				//view comment
				$selectreplies=$this->db->query("SELECT * from post_replies where  postid='".$row['postid']."' order by id desc limit 5 ");
				$html.='<div class="viewList'.$row['postid'].'">';
				foreach ($selectreplies->result_array() as $rReply){
				
				//delete link only for user who posts or replied
				$user_post=0;
				//if replied user
				$selectUserreply=$this->db->query("SELECT userid from post_replies where  id='".$rReply['id']."'");
				foreach ($selectUserreply->result_array() as $ruser_r){if($ruser_r['userid']==$_SESSION['userid']) $user_post=1;}
				
				//if posted user
				$selectUserpost=$this->db->query("SELECT userid from public_post where 	postid='".$row['postid']."'");
				foreach ($selectUserpost->result_array() as $ruser_p){if($ruser_p['userid']==$_SESSION['userid']) $user_post=1;}
				if($user_post==1)
				$delete_link='  |   <span class="deletReply'.$rReply['id'].'">
				<a onclick="deleteReply('.$rReply['id'].','.$row['postid'].');" href="javascript:void(0);" >Delete </a>
				</span>';
				else 
				$delete_link='';
				
				
				//if replies 
				$agree_link=' <a onclick="agreeReply('.$rReply['id'].');" href="javascript:void(0);">Agree </a>';
				$disagree_link=' <a onclick="disagreeReply('.$rReply['id'].');" href="javascript:void(0);">Disgree </a>';	
				
				$selectReplylikes = $this->db->query("SELECT like_status from reply_likes where userid=".$_SESSION['userid']." and reply_id ='".$rReply['id']."'");
				
				foreach ($selectReplylikes->result_array() as $replyStatus)
					{
					   $like_status=$replyStatus['like_status'];
					   if($like_status==1){ $agree_link="<a>Agreed</a>";
					   }
					   else  if($like_status==0){ $disagree_link="<a>Disagreed</a>";
					   }
					}
					
					$usr_img='';
					$usr_img=$this->home_model->getPic($rReply['userid']);
					if($usr_img!='') {
					$userPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
					}
					else{
					$userPic='<img  src="../images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
					}
					$reply_agree_cnt=0;
					$reply_disagree_cnt=0;
					$selectreplyCnt = $this->db->query("SELECT count(*) as cnt from reply_likes where  reply_id='".$rReply['id']."' AND like_status=1");
					foreach ($selectreplyCnt->result_array() as $agreecnt)
					{
						$reply_agree_cnt=$agreecnt['cnt'];
					}
					$selectreplyCnt = $this->db->query("SELECT count(*) as cnt from reply_likes where  reply_id='".$rReply['id']."' AND like_status=0");
					foreach ($selectreplyCnt->result_array() as $dagreecnt)
					{
						$reply_disagree_cnt=$dagreecnt['cnt'];
					}
					$html.='<div id="replyComment" class="group_reply_comment" >
								
									<div class=profilepicreply><a class="link_user" href="'.$GLOBALS['base_url'].'index.php/viewprofile?profileid='.$rReply['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$rReply['comment'].'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$rReply['id'].'" >'.$reply_agree_cnt.'</div>
													 <div class="people-agree">Agree</div>
													 <div class="circle" id="disagreereply_circle'.$rReply['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">DisAgree</div>
									</div>
									<div class="agreereply" >
									  <span class="agreeReply'.$rReply['id'].'">'.$agree_link.'  </span> | 
									   <span class="disagreeReply'.$rReply['id'].'">'.$disagree_link.' </span>	 '.
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
				}$html.='</div>';				
				}
							return $html;
	}
 
}	
?>