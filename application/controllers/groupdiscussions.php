<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groupdiscussions extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	    $this->load->library('session');
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		 $this->load->model('group_model','',TRUE); 
		 $this->load->model('ip2locationlite','',TRUE); 
		
	 }
	 public function index(){             
		    if(!isset($_SESSION['userid'])){
			 $this->load->helper(array('form', 'url'));
		     $this->load->library('form_validation');
		 	 redirect('home', 'refresh');
		 }
		 else
	  		if(isset($_GET['groupid'])) $this->seoUrlIndex($_GET['groupid']);
	   
	 }
	public function seoUrlIndex($id)
	{  
        die('hiii');
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 if(!isset($_SESSION['userid'])){
		 	redirect('home', 'refresh');
		 }
		 else{
				
				 $IP = $_SERVER['REMOTE_ADDR'];
					$SSID = htmlentities (SID);
					// If IP address exists
					// Get country (and City) via  api.hostip.info
					if (!empty ($IP)) {
					if(file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP))
					$location=file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP);
					$data['country']= $this->home_model->get_string_between($location,"Country:","City");
					$data['city']=$this->home_model->get_string_between($location,"City:","IP");
					} 
					$data['category'] = $this->home_model->getAllCategory();
				  $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
					
				  $data['category_list'] = $this->home_model->getCategoryList();	
					
				  $data['place_list'] = $this->home_model->getPlaceList();
				   if(!isset($_GET['groupid'])){$_GET['groupid']=$id;}
				  if(isset($_GET['groupid']))
				  {
					  $data['groupid']=$_GET['groupid'];
					  $data['groupUsers'] = $this->group_model->getUserList($_GET['groupid']);
					  $data['groupUsersList'] = $this->group_model->getAllUserList($_GET['groupid']);
					  $data['article']=$this->group_model->article($_GET['groupid']);
					  
				 } 
				 else{
					 $data['groupid']=0;
					  $data['groupUsers'] = '';
					  $data['groupUsersList'] = '';
					  $data['article']='';
				 }
				  $this->load->view('gorup_discussion_view',$data);
		}		  
					
	}
	
}	
?>