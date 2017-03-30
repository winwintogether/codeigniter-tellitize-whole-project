<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('myprofile_model','',TRUE); 
	 }
	 public function index()
	{
		$this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		$this->load->view('signup');
	}
	
}

?>