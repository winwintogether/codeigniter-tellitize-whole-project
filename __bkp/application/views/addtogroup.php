<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddtoGroup extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
	 }
	public function index()
	{  
        session_start();
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 $data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);
		 $data['group'] = $this->myprofile_model->getgroup($_SESSION['userid']);
		 $data['category_list'] = $this->home_model->getCategoryList();	
			
		 $data['place_list'] = $this->home_model->getPlaceList();
		$this->load->view('addtogroup_view',$data);
					
	}
	
}
?>

