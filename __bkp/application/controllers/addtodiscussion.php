<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addtodiscussion extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		$this->load->library('session');
	 }
	 public function index(){
	         if(!isset($_SESSION['userid'])){
			 $this->load->helper(array('form', 'url'));
		     $this->load->library('form_validation');
		 	 redirect('home', 'refresh');
		 }
		 else{
				 if(isset($_GET['profileid'])) $this->seoUrlIndex($_GET['profileid']);
				 else{
					
				 $this->load->helper(array('form', 'url'));
				 $this->load->library('form_validation');
				 $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
				 $data['place'] = $this->home_model->getAllPlace();
				 $data['category_list'] = $this->home_model->getCategoryList();	
					
				 $data['place_list'] = $this->home_model->getPlaceList();
				
					 $data['email']='';
					 $data['name']='';
				
				$this->load->view('addtodiscussion_view',$data);
				 }
		 }
	  }
	  
    public function seoUrlIndex($id)
	
	{  
       		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 if(isset($_SESSION['userid']))
		{
			 $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
			 $data['place'] = $this->home_model->getAllPlace();
			 $data['category_list'] = $this->home_model->getCategoryList();	
				
			 $data['place_list'] = $this->home_model->getPlaceList();
			 if(isset($id)){
				 $profileid=$id;
				 $data['email']=$this->home_model->getEmail($profileid);
				 $data['name']=$this->home_model->getFullName($profileid);
			}	 
			 else {
				 $data['email']='';
				 $data['name']='';
			 }
			$this->load->view('addtodiscussion_view',$data);
		}
		else{
			 redirect('home', 'refresh');
		}	
					
	}
	
}
?>