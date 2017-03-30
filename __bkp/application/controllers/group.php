<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('myprofile_model','',TRUE); 
	   $this->load->library('session');
	 }
	 public function index()
	{
		
		 $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	   
		if(isset($_SESSION['userid']))
		{
			$query = $this->myprofile_model->get($_SESSION['userid']);
			$data['username'] = $query['user_name'];
			$data['email'] = $query['email'];
			$data['name'] = $query['name'];
			$data['location'] = $query['location'];
			$data['password'] = $query['password'];
			$data['about_me'] = $query['about_me'];
			$data['age'] = $query['age'];
			$data['search_tags'] = $query['search_tags'];
			$data['reg_status'] = $query['reg_status'];
			$data['profile_img'] = $query['profile_img'];
			$data['group_filed']='';
			//group page for add/edit
			if(isset($_GET['group-id'])){
				$data['group_filed']=$this->myprofile_model->getgroupSelected($_GET['group-id']);
				$data['result']='Updated...';
				
			}
			else{
				$data['group_filed']='<li style="clear:left">
																		<h1>Group Name</h1>
																		<h2><input type="text" name="gname" value=""  id="gname" class="input_txt"/></h2>				
																	</li>
																	<li style="clear:left">
																		<h1>Description</h1>
																		<h2>
																		<textarea name="g_desc" id="g_desc" class="input_ta"></textarea>
																		</h2>				
																	</li>
																	<li style="clear:left">
																	<div id="doneButton" >
																			<img width="138" height="33" alt="sign-up-account" src="../images/save-edit.jpg"  onClick="validateGroup();">
																			</div>
																	</li>';
			$data['result']='New group created...';
			}	
			$this->load->view('creategroup',$data);
		}
		else{
			 redirect('home', 'refresh');
		}
		
	}
	
}

?>