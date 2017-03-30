<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	function __construct()
	 {
	 	
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		  $this->load->model('notification_model','',TRUE); 
		  $this->load->library('session');
	 }
	public function index()
	{  
          
		  $this->load->helper(array('form', 'url'));
		  $this->load->library('form_validation');
		  session_start();
		  if(isset($_SESSION['userid'])){
			  $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
				
			  $data['category_list'] = $this->home_model->getCategoryList();	
				
			  $data['place_list'] = $this->home_model->getPlaceList();
			
			   $update= $this->notification_model->update();
			  $this->load->view('notifications',$data);
		}
		else{
		 redirect('home', 'refresh');
		 }
					
	}
	
}
?>