<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		$this->load->library('session');
		session_start();
	 }
	public function index()
	{  
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		  if(isset($_SESSION['userid']))
		  {
			 if(isset($_GET['replyid'])){
				
				$data['to_name']=$this->home_model->getUsername($_GET['replyid']);
			 }
			 else $data['to_name']='';
			 $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
				
			  $data['category_list'] = $this->home_model->getCategoryList();	
				
			  $data['place_list'] = $this->home_model->getPlaceList();
			$this->load->view('message_view',$data);
		}
		else{redirect('home', 'refresh');
		}	
					
	}
	
}
?>