<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {
        
        function __construct()
	{
            parent::__construct();
            $this->load->model('myprofile_model','',TRUE); 
            $this->load->library('session');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->load->library('layout');
            $this->load->library('templatelayout');
            $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
	}
	
        public function index()
	{
            if(isset($_SESSION['userid']))
            {
                $query = $this->myprofile_model->get($_SESSION['userid']);
		$this->data['username'] = $query['user_name'];
		$this->data['email'] = $query['email'];
		$this->data['name'] = $query['name'];
		$this->data['location'] = $query['location'];
		$this->data['password'] = $query['password'];
		$this->data['about_me'] = $query['about_me'];
		$this->data['age'] = $query['age'];
		$this->data['search_tags'] = $query['search_tags'];
		$this->data['reg_status'] = $query['reg_status'];
		$this->data['profile_img'] = $query['profile_img'];
		$this->data['group_filed']='';
		//group page for add/edit
		if(isset($_GET['group-id'])){
                    $this->data['group_filed']=$this->myprofile_model->getgroupSelected($_GET['group-id']);
                    $this->data['result']='Updated...';
		}
                else{
                    $this->data['group_filed']='<li style="clear:left"><h1>Group Name</h1>
                                            <h2><input type="text" name="gname" value=""  id="gname" class="input_txt"/></h2>				
                                          </li>
                                          <li style="clear:left">
                                            <h1>Description</h1>
                                            <h2>
                                                <textarea name="g_desc" id="g_desc" class="input_ta"></textarea>
                                            </h2>				
                                          </li>
                                          <li style="clear:left">
                                            <div id="doneButton" style="padding-left:98px">
                                                <img width="138" height="33" alt="sign-up-account" src="images/save-edit.jpg"  onClick="validateGroup();">
                                            </div>
                                          </li>';
                    $this->data['result']='New group created...';
		}	
		
                if(isset($_GET['group-id']) != '')
                {
                    $this->data['title'] = 'Edit Group';
                }
                else
                {
                    $this->data['title'] = 'Create Group';
                }
                
                $this->templatelayout->get_header();
                $this->templatelayout->get_footer();
                $this->elements['middle']='creategroup';
                $this->elements_data['middle'] = $this->data;
                $this->layout->setLayout('front_layout');
                $this->layout->multiple_view($this->elements,$this->elements_data);
                //$this->load->view('creategroup',$this->data);
            }
            else{
                redirect('home', 'refresh');
            }
	}
	
}
?>