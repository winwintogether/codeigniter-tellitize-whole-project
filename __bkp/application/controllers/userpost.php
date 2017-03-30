<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userpost extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		 $this->load->library('session');
	 }
	public function index(){
	  if(isset($_GET['postid'])) $this->seoUrlIndex($_GET['postid']);
	 
	 }
	public function seoUrlIndex($id)
	{  
        
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 
		    $data['postid']=$id;
			if(isset($_SESSION['userid']))	{	
			$data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
			$data['place_list'] = $this->home_model->getPlaceList();
			}			
			$data['category_list'] = $this->home_model->getCategoryList();	
			
			
			$this->load->view('userpost',$data);
					
	}
	
}
?>