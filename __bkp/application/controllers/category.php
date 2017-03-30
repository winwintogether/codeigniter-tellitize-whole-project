<?php  session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE);
		$this->load->library('session'); 
	 }
	 public function index(){
	  if(isset($_GET['cid'])) $this->seoUrlIndex($_GET['cid']);
	 
	 }
	 
	public function seoUrlIndex($id)
	{  
        
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		    if(!isset($_GET['cid'])){$data['category_id']=$id;}
			else $data['category_id']=$_GET['cid'];
			if(isset($_SESSION['userid'])){
			$data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
		
			$data['place_list'] = $this->home_model->getPlaceList();
		}
			
			$data['category_list'] = $this->home_model->getCategoryList();	
			
			$this->load->view('category_posts',$data);
					
	}
	
	
}
?>