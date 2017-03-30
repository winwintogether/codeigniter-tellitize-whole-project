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
		 $group_name ='';
		 foreach ($queryuser->result_array() as $r){
		    
			 if($r['userid']==$_SESSION['userid']){
			   $group_name = str_replace(" ","-",$row['group_name']);
			   $group_name =preg_replace("![^a-z0-9]+!i", "-",$group_name); 
			 	$html.='<li id="grouplist'.$row['id'].'" class="discussion"  onmouseover="showEdit('.$row['id'].');" onmouseout="hideEdit('.$row['id'].');">
					<a id="group'.$row['id'].'" href="'.$GLOBALS['base_url'].''.  $group_name.'" >'.$row['group_name'].'</a>
					<span style="float:right;display:none" class="edit_delete'.$row['id'].'">
						<a href="'.$GLOBALS['base_url'].'group?group-id='.$row['id'].'"><img width="45" height="19" alt="edit" src="'.$GLOBALS['base_url'].'images/edit-btn.jpg"></a>
						<a href="javascript:void(0);" onclick="deleteGroup('.$row['id'].');"><img width="45" height="19" alt="delete" src="'.$GLOBALS['base_url'].'images/delete-btn.jpg"></a>
					</span>
				</li>';
			 }else{
			 	$group_name = str_replace(" ","-",$row['group_name']);
			 	$html.='<li id="grouplist'.$row['id'].'" >
					<a id="group'.$row['id'].'"  href="'.$GLOBALS['base_url'].''.  $group_name.'">'.$row['group_name'].'</a>
					
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
		$query = $this->db->query("SELECT count(*) as cnt FROM public_post where userid='".$id ."' and status=0");
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
	function getCountOfMessages()
        {
            $query = $this->db->query("SELECT count(*) as cnt FROM messages where to_user='".$_SESSION['userid'] ."' AND read_status = 0");
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
                if($tag[$i]!=''){
                    $tag_name="'".$tag[$i]."'";
                    $class   = "class_".$tag_name;
                    $tag_list.='<div class="tag-name-main">
                                    <div class="tag-name">'.$tag[$i].'</div>
                                    <input type="hidden" value="'.$tag_name.'" class="'.$tag_name.'">
                                    <div class="close-btn">
                                        <a href="javascript:void(0);" onclick="deleteTag('.$tag_name.')">
                                            <img src="'.$GLOBALS['base_url'].'images/close-btn.jpg" width="15" height="15" alt="close-btn">
                                        </a>
                                    </div>
				</div>';
			
		}
	}
		return $tag_list;
	}
 function getTagSuggetion(){
 	$first_name_status=0;
	$last_name_status=0; 
	$city_status=0;
	$nickname_status=0;	
	$state_status=0;
	$relation_status=0;
	$zipcode_status=0;	
	$email_status=0;
	$scars_status=0;
	$highschool_status=0;	
	$college_status=0;	
	$tattoo_status=0;
	$query = $this->db->query("SELECT * FROM users where userid='".$_SESSION['userid'] ."'");
	$my_tags='';
	$query_tags = $this->db->query("SELECT search_tags FROM users where userid='".$_SESSION['userid'] ."'");
        $tag_list='';
        foreach ($query_tags->result_array() as $row){
            $tag    = $row['search_tags'];
        }
	$tag=explode(',',$tag);
	$count=count($tag);
	foreach ($query->result_array() as $row){
            for($i=0;$i<$count;$i++){
                $tag_name=$tag[$i];
                if($row['name']==$tag_name)
                    $first_name_status=1;
                if($row['last_name']==$tag_name)
                    $last_name_status=1; 
                if($row['city']==$tag_name)
                    $city_status=1;	
                if($row['state']==$tag_name)
                    $state_status=1;	
                if($row['zipcode']==$tag_name)
                    $zipcode_status=1;	
                if($row['email']==$tag_name)
                    $email_status=1;	
                if($row['scars']==$tag_name)
                    $scars_status=1;	
                if($row['nickname']==$tag_name)
                    $nickname_status=1;	
                if($row['highschool']==$tag_name)
                    $highschool_status=1;	
                if($row['college']==$tag_name)
                    $college_status=1;	
                if($row['relationshp_status']==$tag_name)
                    $relation_status=1;	
                //if($row['city']==$tag_name)tattoos
                //$city_status=1;				
            }
			
            if($row['name']!='' && $first_name_status==0) 
                $my_tags.= '<option value="'.$row['name'].'" id="tag_1">'.$row['name'].'</option>'; //First Name:
            if($last_name_status==0 && $row['last_name']!='') 
                $my_tags.= '<option value="'.$row['last_name'].'" id="tag_2">'.$row['last_name'].'</option>';	//Last Name:			
            if($row['city']!='' && $city_status==0 ) 
                $my_tags.= '<option value="'.$row['city'].'" id="tag_3">'.$row['city'].'</option>'; //City:
            if($row['state']!='' && $state_status==0) 
                $my_tags.= '<option value="'.$row['state'].'" id="tag_4">'.$row['state'].'</option>'; //State:
            if($row['zipcode']!='' && $zipcode_status==0) 
                $my_tags.= '<option value="'.$row['zipcode'].'" id="tag_5">'.$row['zipcode'].'</option>'; //Zipcode:
            if($row['email']!='' && $email_status==0) 
                $my_tags.= '<option value="'.$row['email'].'" id="tag_6">'.$row['email'].'</option>'; //Email:
				
            $tattoo_tag=explode(',',$row['tattoos']);
            $t_count=count($tattoo_tag);
            $tag_value = 6;
            for($j=0;$j<$t_count;$j++){
                $tattoo_status=0;
                for($k=0;$k<$count;$k++){
                    if($tattoo_tag[$j]==$tag[$k])
                        $tattoo_status=1;	
                }
                if($row['tattoos']!='' && $tattoo_status==0) 
                    $my_tags.= '<option value="'.$tattoo_tag[$j].'" id="tag_'.$tag_value.'">'.$tattoo_tag[$j].'</option>'; //Tattoos:

            }			
            if($row['scars']!='' && $scars_status==0) 
                $my_tags.= '<option value="'.$row['scars'].'" id="tag_'.($tag_value+1).'">'.$row['scars'].'</option>'; //Scars:
            if($row['nickname']!='' && $nickname_status==0) 
                $my_tags.= '<option value="'.$row['nickname'].'" id="tag_'.($tag_value+2).'">'.$row['nickname'].'</option>'; //Nick Name:
            if($row['highschool']!='' && $highschool_status==0)
                $my_tags.= '<option value="'.$row['highschool'].'" id="tag_'.($tag_value+3).'">'.$row['highschool'].'</option>'; //Highschool:
            if($row['college']!='' && $college_status==0) 
                $my_tags.= '<option value="'.$row['college'].'" id="tag_'.($tag_value+4).'">'.$row['college'].'</option>'; //College:
            if($row['relationshp_status']!='' && $relation_status==0) 
                $my_tags.= '<option value="'.$row['relationshp_status'].'" id="tag_'.($tag_value+5).'">'.$row['relationshp_status'].'</option>'; //Relationship status:
	}
	return $my_tags;
    }
}	

?>