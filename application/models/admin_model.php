<?php
class Admin_model extends CI_Model {
 function admin_model() 
 {
  $login=$this->input->post('login');
  $password=md5($this->input->post('password'));
  $this->db->where('admin_username',$login);
  $this->db->where('admin_password',$password);
  $query=$this->db->get("admin_login");
  $res=$query->num_rows();
  return $res;  
 }
 function user_management()
 {
 $this->load->database();
 $query=$this->db->query("SELECT userid,email,user_name,name,age,location,about_me,reg_date,reg_status From users WHERE status=1;");
 return $query->result_array();
 }
 function inactivate_user($id)
 {
 $this->load->database();
$data=array(
'status'=>2);
 $this->db->where('userid',$id);
 $query=$this->db->update('users',$data);
 
 }
 function category_add()
 {
 $this->load->database();
 $data=array(
 'cate_name'=>$this->input->post('cat_name'),
 'cate_description'=>$this->input->post('cat_description'),
 'status'=>$this->input->post('cat_status'));
  $query=$this->db->insert('category',$data);
  return $query;
 }
 function category_list()
 {
 $this->load->database();
 $query=$this->db->query("Select cid,cate_name,cate_description From category;");
 return $query->result_array();
 } 
 function category_update($id)
 {
 $cat_name="cat_name_".$id;
 $cat_desc="cat_desc_".$id;
 
 $this->load->database();
 $data=array(
   'cate_name'=>$this->input->post($cat_name),
   'cate_description'=>$this->input->post($cat_desc));
 $this->db->where('cid',$id);
 $query=$this->db->update('category',$data);
 return $query;
 }
 function category_delete($id)
 {
 $this->load->database();
 $this->db->where('cid',$id);
 $query=$this->db->delete('category');
 return $query;
 }
 function post_management()
 {
 $this->load->database();
 $query=$this->db->query("select count(public_post.userid),users.user_name,users.userid from public_post,users where users.userid=public_post.userid group by users.userid order by user_name;");
 return $query->result_array(); 
 }
 function view_post($id)
 {
 $this->load->database();
$this->db->select("public_post.comment,public_post.post_date,public_post.postid,public_post.userid,users.name");
$this->db->from("public_post");
$this->db->where("public_post.userid",$id);
$this->db->join("users","users.userid=public_post.userid");
$query=$this->db->get();
 $res=$query->result_array();
 return $res;
 }
 function delete_post($id)
 {
 $this->load->database();
 $this->db->where('postid',$id);
 $query=$this->db->delete('public_post');
 
 $this->db->where('postid',$id);
 $query=$this->db->delete('post_details');
 return $query;
 }
  function delete_user($id)
 {
	 $this->load->database();
	 $this->db->where('userid',$id);
	 $query=$this->db->delete('users');
	 return $query;
 }
 
 function words_management()
 {
	 $this->load->database();
	 $query=$this->db->query("SELECT id from badwords_list");
	 $res=$query->num_rows();
  	return $res;  
 }
 function words_list_view()
 {
	 $this->load->database();
	 $query=$this->db->query("SELECT * from badwords_list");
	 $words='<ul><li style="text-align:center"><h4>Bad Words list</h4></li>';
	foreach ($query->result_array() as $row){
		$word_list=explode( ',', $row['words'] );
	
		foreach($word_list as $w){
	
		$words.='<li>'.$w.'</li>';
	 }
	  
	}
	 $words.='</ul>';
	return $words;
 }
 
  function words_add()
 {
   $this->load->database();
 $data=array(
  'id'=>'1',
  'words'=>$this->input->post('words'));
  $query=$this->db->insert('badwords_list',$data);
  return $query;
 }
  function words_update()
 {
   $this->load->database();
 $this->load->database();
  $query=$this->db->query("SELECT * from badwords_list where id=1");
 $res=$query->row_array();
 $word=$res['words'].','.$this->input->post('words');
	$data=array(
			'words'=>$word);
 $this->db->where('id','1');
 $query=$this->db->update('badwords_list',$data);
 }
 function view_abused_post(){
 	//$query=$this->db->query("SELECT * from public_post where status=1");
	//return $query->result_array();
	$this->load->database();
$this->db->select("public_post.comment,public_post.post_date,public_post.postid,public_post.userid,users.name");
$this->db->from("public_post");
$this->db->where("report_abused_list.status","1");
$this->db->where("public_post.status","0");
$this->db->join("report_abused_list","report_abused_list.postid=public_post.postid");
$this->db->join("users","users.userid=public_post.userid");
$query=$this->db->get();
 $res=$query->result_array();
 return $res;
 }
 function update_abused_post($id)
 {
 $this->load->database();
  $query=$this->db->query('update public_post set status=1 where postid='.$id);
 return $query;
 }
 
} 
?>