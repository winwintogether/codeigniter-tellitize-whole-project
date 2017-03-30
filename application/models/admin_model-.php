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
 $query=$this->db->query("SELECT userid,email,user_name,name,age,location,about_me,reg_date From users;");
 return $query->result_array();
 } 

} 
?>