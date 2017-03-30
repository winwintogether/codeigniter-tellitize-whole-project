<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
  
	 public function index()
	 {
	 $this->load->helper(array('form', 'url'));
	  $this->load->library("session");
     $data['login']=array("name"=>"login","id"=>"login","class"=>"input_txt");
     $data['password']=array("name"=>"password","id"=>"password","class"=>"input_txt");
     $data['submit']=array("name"=>"submit","id"=>"submit","class"=>"login-bt","value"=>"");
     $data['msg']="";
	$this->load->view('admin/admin',$data); 
	}
    
	function process()
    {
	 $this->load->library("session");
	
     $data['login']=array("name"=>"login","id"=>"login","class"=>"input_txt");
     $data['password']=array("name"=>"password","id"=>"password","class"=>"input_txt");
     $data['submit']=array("name"=>"submit","id"=>"submit","class"=>"login-bt","value"=>"");
     $this->load->model("admin_model");
     $res=$this->admin_model->admin_model();
     if($res==0)
      {
	   $this->load->helper(array('form', 'url'));
       $data['msg']="Incorrect Username / Password!!!";
       $this->load->view('admin/admin',$data); 
      }
     else
      {
	   $login=$this->input->post('login');
       $password=md5($this->input->post('password'));
	   $session_data=array("username"=>$login,"password"=>$password);
       $this->session->set_userdata($session_data);
	   $this->load->helper(array('form', 'url'));
       $this->load->view("admin/controlpanel");
      }
     }
	 function controlpanel()
	 {
	  $this->load->library("session");
	  if($this->session->userdata("username"))
	    {
	 $this->load->helper(array('form', 'url'));
	 $this->load->view("admin/controlpanel");
	 	}
	  else
	   {
	    redirect('admin/index');
	   }
	 }
	
     function logout()
     {
		$newdata = array(
		'username'   =>'',
		'password' => '',
		'is_logged_in' => FALSE,
		);
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		$this->index();
	}	
	function user_management()
	{
	$this->load->helper(array('form', 'url'));
	if($this->session->userdata("username"))
	{
	
	$this->load->model('admin_model');
	$data['res']=$this->admin_model->user_management();
	$this->load->view('admin/user_management',$data);
	}
	else
	{
	redirect('admin/index');
	}
	}
	function inactivate_user()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {
	$id=$this->input->post("cid");
	$this->load->model('admin_model');
	$this->admin_model->inactivate_user($id);
	$data['res']=$this->admin_model->user_management();
	$this->load->view('admin/user_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }			
	}
	function delete_user()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {
	$id=$this->input->post("cid");
	$this->load->model('admin_model');
	$this->admin_model->delete_user($id);
	$data['res']=$this->admin_model->user_management();
	$this->load->view('admin/user_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }			
	}
	
	function category_management()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {
     $data['cat_name']=array("name"=>"cat_name","id"=>"cat_name","class"=>"input_txt");
     $data['cat_description']=array("name"=>"cat_description","id"=>"cat_description","class"=>"txt-area");
     $data['submit']=array("name"=>"submit","id"=>"submit","class"=>"cat-add","value"=>"Add ");
     $data['msg']="";	
	$this->load->view('admin/category_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }
	}
	function category_add ()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {
	$this->load->model('admin_model');
    $this->admin_model->category_add();
	$data['msg']="Category added successfully!!";
	
     $data['cat_name']=array("name"=>"cat_name","id"=>"cat_name","class"=>"input_txt");
     $data['cat_description']=array("name"=>"cat_description","id"=>"cat_description","class"=>"txt-area");
     $data['submit']=array("name"=>"submit","id"=>"submit","class"=>"cat-add","value"=>"Add ");
	$this->load->view('admin/category_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }

	}
	function category_management_preview()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {	
	$this->load->view('admin/category_management_preview');
	  }
	  else
	  {
	  redirect('admin/index');
	  }	
	}
	function category_list()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {
	 $this->load->model('admin_model');
	 $data['cat_list']=$this->admin_model->category_list(); 	
	$this->load->view('admin/category_list',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }	
	}
	function category_update()
	{
	$this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	if($this->session->userdata("username"))
	  {
	  	if($this->input->post("submit"))
        {
	     $id=$this->input->post("cid");
	     $this->load->model('admin_model');
	     $this->admin_model->category_update($id);
	     $this->load->model('admin_model');
	     $data['cat_list']=$this->admin_model->category_list(); 	 
	     $this->load->helper(array('form', 'url'));
	     $data["msg"]="Category Updated";
	     $this->load->view('admin/category_list',$data);
	    }
	   elseif($this->input->post("delete"))
	    {
         $id=$this->input->post("cid");
	     $this->load->model('admin_model');
	     $this->admin_model->category_delete($id);
	     $data['cat_list']=$this->admin_model->category_list($id);
	     $this->load->helper(array('form', 'url'));
	     $data["msg"]="Category Deleted";
	     $this->load->view('admin/category_list',$data);			
		}
	  
	  }
	  else
	  {
	  redirect('admin/index');
	  }		 
	}
   
   function post_management()
   {
   $this->load->helper(array('form','url'));
   $this->load->library("session");
   if($this->session->userdata("username"))
	  {   
   $this->load->model('admin_model');
   $data['res']=$this->admin_model->post_management();   
   $this->load->view('admin/post_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }	   
   }	
   function view_posts()
   {
	$this->load->helper(array('form','url'));
    $this->load->library("session");
    if($this->session->userdata("username"))
	  { 	
	$id=$this->input->post("cid");
	$this->load->model("admin_model");
	$data['result']=$this->admin_model->view_post($id);
	$this->load->view('admin/view_post',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }		
   }
   function post_delete()
   {
   $this->load->helper(array('form','url'));
   $this->load->library("session");
   if($this->session->userdata("username"))
	  { 	   
   $id=$this->input->post("cid");
   $viewid=$this->input->post("viewid");
   $this->load->model('admin_model');
   $this->admin_model->delete_post($id);
   $this->load->helper(array('form','url'));
   $this->load->model('admin_model');
   $data['result']=$this->admin_model->view_post($viewid);
   $this->load->view('admin/view_post',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }	      
   }
   
   function words_management()
   {
	  $this->load->helper(array('form', 'url'));
	  $this->load->library("session");
	  if($this->session->userdata("username"))
		  {
			$this->load->model("admin_model");		
			 $data['words']=array("name"=>"words","id"=>"words","class"=>"txt-area");
			 $data['submit']=array("name"=>"submit","id"=>"submit","class"=>"words-add","value"=>"Add ");
			 $data['msg']="";
			 
			$this->load->view('admin/words_management',$data);
		  }
	  else
		  {
		  redirect('admin/index');
		  }
   }
   function words_add(){
   
		$this->load->model("admin_model");
		$this->load->helper(array('form', 'url'));
		
		$this->load->library("session");
		  
		$data['words']=array("name"=>"words","id"=>"words","class"=>"txt-area");
		$data['submit']=array("name"=>"submit","id"=>"submit","class"=>"words-add","value"=>"Add ");
		$res=$this->admin_model->words_management();
		if($res==0)
			{
				$res=$this->admin_model->words_add();		  
				$data['msg']='Words added';
			}
		else
			{  
				$res=$this->admin_model->words_update();
				$data['msg']='Words Updated';
			  
			 }
			 $this->load->view('admin/words_management',$data);
   }
   
     function abuses_management(){
   $this->load->helper(array('form','url'));
    $this->load->library("session");
    if($this->session->userdata("username"))
	  { 	
	
	$this->load->model("admin_model");
	$data['result']=$this->admin_model->view_abused_post();
	$this->load->view('admin/abuses_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }		
		
	}
	
	function abuse_delete()
   {
   $this->load->helper(array('form','url'));
   $this->load->library("session");
   if($this->session->userdata("username"))
	  { 	   
   $id=$this->input->post("cid");
   $viewid=$this->input->post("viewid");
   $this->load->model('admin_model');
   $this->admin_model->update_abused_post($id);
   $this->load->helper(array('form','url'));
   $this->load->model('admin_model');
   $data['result']=$this->admin_model->view_abused_post();
	$this->load->view('admin/abuses_management',$data);
	  }
	  else
	  {
	  redirect('admin/index');
	  }	      
   }
   
}

?>