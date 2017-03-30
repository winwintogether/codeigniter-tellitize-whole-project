<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends CI_Controller {
	function __construct()
	 {
	   parent::__construct();
	 //  $this->load->model('myprofile_model','',TRUE); 
	 }
	 public function index()
	{
		session_start();
		$this->load->helper('form');		
		
		$this->load->view('facebook_test');
	}
	
}

?>