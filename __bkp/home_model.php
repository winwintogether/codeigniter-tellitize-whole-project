<?php
class Home_model extends CI_Model{
	function Home_model(){
		//parent::Model();
	}
	function register(){
	 	 $this->load->database();   
        $data = array(
		'userid' => '',
        'user_name' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'email' =>$this->input->post('email'),
		'reg_date' => date("Y-m-d H:i:s"),
        );
        $this->db->insert('users',$data);
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
					where userid =".$_SESSION['userid'].") and  group_id=0	AND  placeid=0 order by  postid desc limit 10
					");
		}
		else{
		$query = $this->db->query("SELECT * FROM public_post where  group_id=0 AND  placeid=0 order by  postid desc limit 10");
		}
		foreach ($query->result_array() as $row)
		{	$agreed='';
			$disagreed='';
			$agree_status='';
            if($row['from']=='' || $row['from']=='0') $from='Anonymous';
			else 
			{	$from=$this->getUsername($row['from']);
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
				$profile_img=$this->getPic($_SESSION['userid']);
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
										  addthis:title="'.$category.','.$row['comment'].'"  addthis:description=" '.$row['comment'].'">share</a>
								</div>';
				$user_title='<a href="'.$GLOBALS['base_url'].'index.php/userpost?postid='.$row['postid'].'">'.$category.'</a>';
			 }
			 else
			 $user_title='<a href="javascript:void(0)" onClick="notValidUser();">'.$category.'</a>';
			 $postuser_img='';
					$postuser_img=$this->getPic($row['from']);
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
					     <div id="article">
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
					$usr_img=$this->getPic($rReply['userid']);
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
					$html.='<div id="replyComment" >
								
									<div class=profilepicreply><a class="link_user" href="'.$GLOBALS['base_url'].'index.php/viewprofile?profileid='.$rReply['userid'].'">
									'.$userPic.'</a>
									</div>
									<div class="commentreplyview">'.$rReply['comment'].'</div>
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
		 
		$html.='<li><a href="'.$GLOBALS['base_url'].'category?cid='.$row['cid'].'">'.$row['cate_name'].'</a></li>';
									
		}	
		
		return $html;
	}
	function getAllPlace(){
	  	$html='';
		$query = $this->db->query("SELECT id,place from  place_of_discussion where id in (select placeid from discussionplace_userlist where userid=".$_SESSION['userid'].")");
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
		$query = $this->db->query("SELECT id,place from  place_of_discussion where id in (select placeid from discussionplace_userlist where userid=".$_SESSION['userid'].")");
		foreach ($query->result_array() as $row)
		{
		 
		$html.='<li><a href="'.$GLOBALS['base_url'].'placediscussions?placeid='.$row['id'].'" >'.$row['place'].'</a></li>';
									
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
	
	
}
?>