<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		$this->load->library('session');
	 }
	public function index()
	{  
        
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		  if(isset($_SESSION['userid']))
		{
			 $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
				
			  $data['category_list'] = $this->home_model->getCategoryList();	
				
			  $data['place_list'] = $this->home_model->getPlaceList();
			$this->load->view('inbox_view',$data);
		}
		else{
			 redirect('home', 'refresh');
		}		
					
	}
	
}
?>