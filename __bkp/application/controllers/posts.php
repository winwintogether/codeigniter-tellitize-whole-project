<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		 $this->load->library('session');
	 }
	public function index()
	{  
        session_start();
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		
		$this->load->view('userposts');
					
	}
	
}
?>