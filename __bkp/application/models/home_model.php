<?php
class Home_model extends CI_Model{
	function Home_model(){
		//parent::Model();
	}
	function register(){
	 	 $this->load->database(); 
		 $confirm_code=md5(uniqid(rand()));  
        $data = array(
		'userid' => '',
        'user_name' =>addslashes($this->input->post('username')),
        'password' => md5($this->input->post('password')),
        'email' =>$this->input->post('email'),
		'name' =>addslashes($this->input->post('first_name')),
		'last_name' =>addslashes($this->input->post('last_name')),
		'confirm_code' =>$confirm_code,
		'reg_date' => date("Y-m-d H:i:s"),
        );
        $this->db->insert('users',$data);
		$userid=mysql_insert_id();
		$to=$this->input->post('email');
		$subject="Tellitize";
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers.= "From: info@tellitize.com" ;  
		$msg='<a href="'.$GLOBALS['base_url'].'" title="tellitize.com" >
                   					 <img border="0" alt="tellitize.com" src="'.$GLOBALS['base_url'].'images/tellitizeLogo.png">
								 </a>
								<p style="font:14px arial;line-height:20px;">Registration success with tellitize.Click here to verify your email id.
								 </p>
								 <p>'.$GLOBALS['base_url'].'confirmation?user='.$userid.'&verification-key='.$confirm_code.'</p>
								 
								<p><b>Best,</b></p>
								<p><b>Tellitize Support Team</b></p>';
		$email=$this->input->post('email'); 	  
		if(mail($to,$subject,$msg ,$headers)){
				$insert=mysql_query("INSERT INTO `mail_status` (userid,emailid ,purpose)	VALUES ('".$userid."','".$email."','register')");
							
			}
		$fullName= addslashes($this->input->post('first_name')).' '.addslashes($this->input->post('last_name'));
		//$fullName=strtolower($fullName);
		//sent notification about group
		
		$selectGroupUser=$this->db->query("select * from group_userlist where name='".$fullName."' and userid=0");
		foreach ($selectGroupUser->result_array() as $row){
		
			if($row['emailid']!=''){
				
				if($row['emailid']==$email){
					$insertNoti=$this->db->query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$userid."','group','".$row['owner_id']."','". date("Y-m-d")."',0)");
					$notification_id=mysql_insert_id();
					//notification details about group
					$insertNotiGroup=$this->db->query("Insert into notification_for_group_or_pod(notification_id,userlist_id)
								Values('".$notification_id."','".$row['id']."')");
				}
			}
			else{
				$insertNoti=$this->db->query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$userid."','group','".$row['owner_id']."','". date("Y-m-d")."',0)");
				$notification_id=mysql_insert_id();
				//notification details about group
				$insertNotiGroup=$this->db->query("Insert into notification_for_group_or_pod(notification_id,userlist_id)
							Values('".$notification_id."','".$row['id']."')");
			}
		}
		
		//sent notification about POD
		$selectPodUser=$this->db->query("select * from discussionplace_userlist where name='".$fullName."' and userid=0");
		foreach ($selectPodUser->result_array() as $row){
		
			if($row['emailid']!=''){
				
				if($row['emailid']==$email){
					$insertNoti=$this->db->query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$userid."','pod','".$row['owner_id']."','". date("Y-m-d")."',0)");
					$notification_id=mysql_insert_id();
					//notification details about group
					$insertNotiGroup=$this->db->query("Insert into notification_for_group_or_pod(notification_id,userlist_id)
								Values('".$notification_id."','".$row['id']."')");
				}
			}
			else{
				$insertNoti=$this->db->query("Insert into notifications(notify_id,notification_on,userid,date,read_status)
							Values('".$userid."','pod','".$row['owner_id']."','". date("Y-m-d")."',0)");
				$notification_id=mysql_insert_id();
				//notification details about group
				$insertNotiGroup=$this->db->query("Insert into notification_for_group_or_pod(notification_id,userlist_id)
							Values('".$notification_id."','".$row['id']."')");
			}
		}
		
		
	}
  function login($username, $password)
	 {
	   $this -> db -> select('userid, user_name, email, password');
	   $this -> db -> from('users');
	   $this -> db -> where('user_name = ' . "'" . $username . "'");
	   $this -> db -> where('password = ' . "'" . MD5($password) . "'");
	   $this -> db -> where('reg_status = ' . "'0'");
	   $this -> db -> limit(1);
	
	   $query = $this -> db -> get();
	
	   if($query -> num_rows() == 1)
	   {
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
	 }	
	 function twitRegister(){
	 	 $this->load->database();   
        $data = array(
		'userid' => '',
		'user_name' =>$_SESSION['twitUserid'],
        'name' =>$_SESSION['username'],
        'reg_date' => date("Y-m-d"),
		'reg_status'=> '2',
        );
        $this->db->insert('users',$data);
		$user_id=mysql_insert_id();
		return $user_id;
	}
	
	function article(){
		$html='';
	
		if(isset($_SESSION['userid'])){
			$query = $this->db->query(
					"SELECT * FROM public_post where postid not in 
					(SELECT postid FROM report_abused_list 
					where userid =".$_SESSION['userid'].") and  group_id=0	AND  placeid=0 and status=0 order by  postid desc limit 10
					");
		}
		else{
		$query = $this->db->query("SELECT * FROM public_post where  group_id=0 AND  placeid=0 and status=0 order by  postid desc limit 10");
		}
		foreach ($query->result_array() as $row)
		{	$agreed='';
			$disagreed='';
			$agree_status='';
            if($row['from']=='' || $row['from']=='0') $from='Anonymous';
			else 
			{	$from=$this->getFullName($row['from']);
			}
			$share_btncode=' <a href="javascript:void(0)" onclick="notValidUser()";>share</a>';
			if(isset($_SESSION['username'])){
				$agreeClick='onclick="agreePost('.$row['postid'].');"';
				$disagreeClick='onclick="disagreePost('.$row['postid'].');"';
				//$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
				
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
				$profile_img=$this->getPic($_SESSION['userid']);
			if($profile_img!='') {$profilPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$profile_img.'" />';}
			else{$profilPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';}
			}
			else{
				$agreeClick='onclick="notValidUser()"';
				$disagreeClick='onclick="notValidUser()"';
				//$report_abuse='onclick="notValidUser()"';
				$agree_click='';
				$disagree_click='';
				$profilPic='';
			}
			$report_abuse='onclick="reportAbuse('.$row['postid'].');"';
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
			$category_link= str_replace(" ","-",$category);
	         //if(isset($_SESSION['username'])) {
			 
			    $commentonpost=htmlentities($row['comment']);
			 	/*$share_btncode='	
				<div class="addthis_toolbox addthis_default_style" addthis:url="'.$GLOBALS['base_url'].'" 
										  addthis:title="'.$category.'"  addthis:description=" '.$commentonpost.'" >

  										<a class="addthis_button"  href="javascript:void(0)" href="javascript:void(0);">share</a>
								</div>';*/
				
				$cat_name = str_replace(" ","-",$this->getCategory($row['cid']));
				$cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );		
				$user_title='<a href="'.$GLOBALS['base_url'].''.$cat_name.'/'.preg_replace("![^a-z0-9]+!i", "-", $category_link).'/'.$row['postid'].'">'.$category.'</a>';
			 /*}
			 else
			 $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';*/
			 $postuser_img='';
					$postuser_img=$this->getPic($row['from']);
					if($postuser_img!='') {
					$postuserPic='<img  alt="photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$postuser_img.'" />';
					}
					else{
					$postuserPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
					}
					if(isset($_SESSION['userid']) && $row['from']!=0){
						 $name_link='';
						$name_link=$this->getFullName($row['from']);
						$name_link= str_replace(" ","-",$name_link);
						$pic_link=$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$row['from'];
					}
					else $pic_link='javascript:void(0)';
			//$comment_posted= preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', '<a href="\0">\4</a>',$row['comment'] );
			$comment_posted= $this->autolink($row['comment'] );
			$html.='<div class="contents_list" id="'.$row['postid'].'">';
			if(isset($_SESSION['userid']) && $row['userid']==$_SESSION['userid']){
					$html.='<div class="delete-post'.$row['postid'].'" id="delete_post_icon" onclick="deleteOwnPost('.$row['postid'].')"> 
												<img src="'.$GLOBALS['base_url'].'images/close-btn.jpg" width="15" height="15" alt="delete" title="delete">
										</div>';
					}	
					    $html.=' <div id="article">
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
													 													  
													 /* $html.='<div class="share"><a class="addthis_button" 
													  href="http://www.addthis.com/bookmark.php" addthis:url="http://118.94.177.106:8165/"   addthis:title="'.$category.'"      addthis:description=" '.$row['comment'].'">share</a></div>*/
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
					$usr_img=$this->getPic($rReply['userid']);
					if($usr_img!='') {
					$userPic='<img  alt="user photo" width="39" height="42" alt="img" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$usr_img.'" />';
					}
					else{
					$userPic='<img  src="'.$GLOBALS['base_url'].'images/user-photo.jpg" width="39" height="42" alt="img" class="bdr"/>';
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
					$name_link='';
					$name_link=$this->getFullName($rReply['userid']);
					$name_link= str_replace(" ","-",$name_link);
					//$comment_replied= preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', '<a href="\0">\4</a>',$rReply['comment'] );
					$comment_replied= $this->autolink($rReply['comment'] );
					$html.='<div id="replyComment" >
								
									<div class=profilepicreply>
									<a class="link_user" href="'.$GLOBALS['base_url'].'view-profile/'.$name_link.'/'.$rReply['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$comment_replied.'</div>
									<div class="agreereplyCount" >
										 <div class="circle" id="agreereply_circle'.$rReply['id'].'" >'.$reply_agree_cnt.'</div>
													 <div class="people-agree">people Agree</div>
													 <div class="circle" id="disagreereply_circle'.$rReply['id'].'">'.$reply_disagree_cnt.'</div>
													  <div class="people-agree">people disAgree</div>
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
 
	 function getUsername($userid){
	 $username='';
		$query = $this->db->query("SELECT user_name,reg_status,name from users where userid='".$userid."'");
			foreach ($query->result_array() as $row)
			   {
			   	if($row['reg_status']==0)
				$username=$row['user_name'];
				else
				$username=$row['name'];
				}
				return $username;
	 }
	  function getPic($userid){
	 	$profile_img='';
		$query = $this->db->query("SELECT profile_img from users where userid='".$userid."'");
			foreach ($query->result_array() as $row)
			   {
				$profile_img=$row['profile_img'];
				
				}
				return $profile_img;
	 }
	  function getEmail($userid){
		 $email='';
		$query = $this->db->query("SELECT email from users where userid='".$userid."'");
			foreach ($query->result_array() as $row)
			   {
			   	$email=$row['email'];
				}
				return $email;
	 }
	  function getFullName($userid){
		 $name='';
		$query = $this->db->query("SELECT name,last_name from users where userid='".$userid."'");
			foreach ($query->result_array() as $row)
			   {
			    if($row['last_name']!='')
			   	 $name=stripslashes($row['name']).' '.stripslashes($row['last_name']);				
				else
				 $name=stripslashes($row['name']);
				}
				return $name;
	 }
	 
	function getAllCategory(){
		$html='';
		$query = $this->db->query("SELECT cate_name,cid from category");
		$html='<select name="category" id="category" class="toppost">
										<option value="0">Select</option>';
		foreach ($query->result_array() as $row)
		{
		 
		$html.='<option value="'.$row['cid'].'">'.$row['cate_name'].'</option>';
									
		}	
		$html.='</select> ';
		return $html;
	}
	 
	 
	 function getPOD($id){
	  	$place='';
		$query = $this->db->query("SELECT place from place_of_discussion where id='".$id."'");
			foreach ($query->result_array() as $row)
			   {
				$place=$row['place'];
				
				}
				return $place;
	 }
	 
	 function getCategory($cid){
	  	$cate_name='';
		$query = $this->db->query("SELECT cate_name from category where cid='".$cid."'");
			foreach ($query->result_array() as $row)
			   {
				$cate_name=$row['cate_name'];
				
				}
				return $cate_name;
	 }
	 function getCategoryList(){
		$html='';
		$query = $this->db->query("SELECT cate_name,cid from category");
		
		foreach ($query->result_array() as $row)
		{
		 $cat_name = str_replace(" ","-", $row['cate_name']);
		 $cat_name = preg_replace("![^a-z0-9]+!i", "-",$cat_name );	
		 $html.='<li><a href="'.$GLOBALS['base_url'].''.$cat_name.'">'.$row['cate_name'].'</a></li>';
									
		}	
		
		return $html;
	}
	function getAllPlace(){
	  	$html='';
		$queryEmail=$this->db->query("SELECT email from users where userid='".$_SESSION['userid']."'");
		foreach ($queryEmail->result_array() as $email){
			$email=$email['email'];
		}
		$query = $this->db->query("SELECT * from  place_of_discussion where id in (select placeid  from discussionplace_userlist where emailid='".$email."')");
		$html='<select name="places" id="places" class="toppost">
										<option value="0">Select</option>';
		foreach ($query->result_array() as $row)
		{
		 
		$html.='<option value="'.$row['id'].'">'.$row['place'].'</option>';
									
		}	
		$html.='</select> ';
		return $html;
	 }
	 function getPlaceList(){
		$html='';
		$queryEmail=$this->db->query("SELECT email from users where userid='".$_SESSION['userid']."'");
		foreach ($queryEmail->result_array() as $email){
			$email=$email['email'];
		}
		$query = $this->db->query("SELECT * from  place_of_discussion where id in (select placeid  from discussionplace_userlist where emailid='".$email."')");
		
		foreach ($query->result_array() as $row)
		{
		
		$queryuser = $this->db->query("SELECT userid FROM place_of_discussion where id='".$row['id'] ."'");
		 $place ='';
		 foreach ($queryuser->result_array() as $r){
		    $place = str_replace(" ","-",$row['place']);
			$place =preg_replace("![^a-z0-9]+!i", "-",$place);
			 if($r['userid']==$_SESSION['userid']){
			 	$html.='<li id="placelist'.$row['id'].'" class="discussion"  onmouseover="showEditPlace('.$row['id'].');" 
				 onmouseout="hideEditPlace('.$row['id'].');">
					<a id="group'.$row['id'].'" href="'.$GLOBALS['base_url'].''. $place.'" >'.$row['place'].'</a>
					<span style="float:right;display:none" class="edit_deletePlace'.$row['id'].'">
						<a href="'.$GLOBALS['base_url'].'discussionplace?place-id='.$row['id'].'" id="editorDelete">
							<img width="45" height="19" alt="edit" src="'.$GLOBALS['base_url'].'images/edit-btn.jpg">
						</a>
						<a href="javascript:void(0);" onclick="deletePlace('.$row['id'].');" id="editorDelete">
							<img width="45" height="19" alt="delete" src="'.$GLOBALS['base_url'].'images/delete-btn.jpg">
						</a>
					</span>
				</li>';
			 }
			else{			
			 $html.='<li><a href="'.$GLOBALS['base_url'].''. $place.'" >'.$row['place'].'</a></li>';
		 }
			
	  }								
  }	
		
		return $html;
	}
	
	 
	 
	 function get_string_between($string, $start, $end){

		$string = " ". $string;
		
		$ini = strpos($string,$start);
		
		if ($ini == 0) return "";
		
		$ini += strlen($start);
		
		$len = strpos($string, $end, $ini) - $ini;
		
		return substr($string, $ini, $len);

	}
	function getDate($date){
		$html='';		
		$date=explode( '-', $date );
		$html=$date[2].'-'.$date[1].'-'.$date[0];		
		return $html;
	}
	

	function confirmEmail($key,$id){
		
		$query = $this->db->query("SELECT confirm_code,email_status from users where  userid=".$id) ;
			foreach ($query->result_array() as $row)
			{
			   if($row['email_status']!=1)
			    {
					   if($row['confirm_code']==$key)
					   {
						$update=$this->db->query("Update users set confirm_code='0',email_status='1' where userid=".$id);
					  }
					 else if($row['confirm_code']==0){
					   }
					 else{
							$update=$this->db->query("Update users set email_status='2' where userid=".$id);	
					 }	
				}	 
		
		 }
		 return 1;
	}
	
	function getNameInPost($email){
		$name='';
		$query = $this->db->query("SELECT name from group_userlist where emailid='".$email."'");
			foreach ($query->result_array() as $row)
			   {
			   	$name=$row['name'];
				}
				return $name;
	} 
	function autolink($string)
	{
	$content_array = explode(" ", $string);
	$output = '';
	
	foreach($content_array as $content)
	{
	//starts with http://
	if(substr($content, 0, 7) == "http://" || substr($content, 0, 8) == "https://")
	$content = '<a href="' . $content . '">' . $content . '</a>';
	
	
	//starts with www.
	if(substr($content, 0, 4) == "www.")
	$content = '<a href="http://' . $content . '">' . $content . '</a>';
	
	$output .= " " . $content;
	}
	
	$output = trim($output);
	return $output;
	}
	
	
# This function removes special charactes from a url 
function clean_url($text)
{
$text=strtolower($text);
$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
$text = str_replace($code_entities_match, $code_entities_replace, $text);
return $text; 
} 

}
?>