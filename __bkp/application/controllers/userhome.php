<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userhome extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	  // $this->load->model('user_model','',TRUE); 
	 }
	public function index()
	{session_start();
		$this->load->helper('form'); 
		
	// Check if the cookie exists
if(isSet($_COOKIE['cookiename']))
	{
	parse_str($_COOKIE['cookiename']);

	// Make a verification

	if(($usr == 'dhanya') && ($hash == md5('dhanya')))
		{
		// Register the session
		$_SESSION['userid']= 2;
		}
	}
		
		//$this->load->library('form_validation');
		$this->load->view('userhome');
	}
		
	
}

