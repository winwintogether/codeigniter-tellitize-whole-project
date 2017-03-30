<?php
class Myprofile_model extends CI_Model{
	function Myprofile_model(){
		//parent::Model();
	}
	function get($id){
		$this->load->database();
		$query=$this->db->get_where('users',array('userid'=>$id));
		return $query->row_array(); 
	}
	function getgroup(){
		$html='';
		$queryEmail=$this->db->query("SELECT email from users where userid='".$_SESSION['userid']."'");
		foreach ($queryEmail->result_array() as $email){
			$email=$email['email'];
		}
		$query = $this->db->query("SELECT * from  group_list where id in (select groupid  from group_userlist where emailid='".$email."')");
		$html='<select name="group" id="group" class="input_txt">
										<option value="0">Select</option>';
		foreach ($query->result_array() as $row)
		{
		 
		$html.='<option value="'.$row['id'].'">'.$row['group_name'].'</option>';
									
		}	
		$html.='</select> ';
		return $html;
	}
	function getgroupList(){
		$html='';
		
		$queryEmail=$this->db->query("SELECT email from users where userid='".$_SESSION['userid']."'");
		foreach ($queryEmail->result_array() as $email){
			$email=$email['email'];
		}
		$query = $this->db->query("SELECT * from  group_list where id in (select groupid  from group_userlist where emailid='".$email."')");
		foreach ($query->result_array() as $row)
		{
		$queryuser = $this->db->query("SELECT userid FROM group_list where id='".$row['id'] ."'");
		 foreach ($queryuser->result_array() as $r){
		     $group_name ='';
			 if($r['userid']==$_SESSION['userid']){
			   $group_name = str_replace(" ","-",$row['group_name']);
			 	$html.='<li id="grouplist'.$row['id'].'" class="discussion"  onmouseover="showEdit('.$row['id'].');" onmouseout="hideEdit('.$row['id'].');">
					<a id="group'.$row['id'].'" href="'.$GLOBALS['base_url'].'group-discussions/group-name/'.  $group_name.'" >'.$row['group_name'].'</a>
					<span style="float:right;display:none" class="edit_delete'.$row['id'].'">
						<a href="'.$GLOBALS['base_url'].'group?group-id='.$row['id'].'"><img width="45" height="19" alt="edit" src="'.$GLOBALS['base_url'].'images/edit-btn.jpg"></a>
						<a href="javascript:void(0);" onclick="deleteGroup('.$row['id'].');"><img width="45" height="19" alt="delete" src="'.$GLOBALS['base_url'].'images/delete-btn.jpg"></a>
					</span>
				</li>';
			 }else{
			 	$html.='<li id="grouplist'.$row['id'].'" >
					<a id="group'.$row['id'].'"  href="'.$GLOBALS['base_url'].'group-discussions/group-name/'.  $group_name.'">'.$row['group_name'].'</a>
					
				</li>';
			 }
		 	
		 }
		
									
		}	
		
		return $html;
	}
	
	function getgroupSelected($id){
		$query = $this->db->query("SELECT * FROM group_list where id='".$id."'");
		
		foreach ($query->result_array() as $row){
			
			$group='<li style="clear:left">
						<h1>Group Name</h1>
						<h2><input type="text" name="gname" value="'. $row['group_name'].'"  id="gname" class="input_txt"/>
							<input type="hidden" name="groupid" value="'. $row['id'].'"  />
						</h2>				
					</li>
					<li style="clear:left">
						<h1>Description</h1>
						<h2>
							<textarea name="g_desc" id="g_desc" class="input_ta">'. $row['description'].'</textarea>
						</h2>				
					</li>
					<li style="clear:left">
						<div id="doneButton" >
						<img width="138" height="33" alt="sign-up-account" src="'.$GLOBALS['base_url'].'images/save-edit.jpg"  onClick="validateGroup();">
						</div>
					</li>';
					return $group;
		}
	
	}
	
	function getCountOfPosts($id){
		$query = $this->db->query("SELECT count(*) as cnt FROM public_post where userid='".$id ."'");
		foreach ($query->result_array() as $row)
		{
		 
		$count=$row['cnt'];
									
		}
		return $count;
}
	function getCountOfNotifications($id){
		$query = $this->db->query("SELECT count(*) as cnt FROM notifications where userid='".$id ."' AND read_status=0");
		foreach ($query->result_array() as $row)
		{
		 
		$count=$row['cnt'];
									
		}
		return $count;
}	
	
	function getTaglist(){
		$query = $this->db->query("SELECT search_tags FROM users where userid='".$_SESSION['userid'] ."'");
		$tag_list='';
		foreach ($query->result_array() as $row){
			$tag=$row['search_tags'];
		}
		$tag=explode(',',$tag);
		$count=count($tag);
		for($i=0;$i<$count;$i++){
		 $tag_name="'".$tag[$i]."'";
			$tag_list.='<div class="tag-name-main">
								 <div class="tag-name">'.$tag[$i].'</div>
													 
								 <div class="close-btn"><a href="javascript:void(0);" onclick="deleteTag('.$tag_name.')">
										<img src="'.$GLOBALS['base_url'].'images/close-btn.jpg" width="15" height="15" alt="close-btn"></a>
								 </div>
						 </div>';
			
		}
		return $tag_list;
	}
}	
?>