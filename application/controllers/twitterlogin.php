<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitterlogin extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	  // $this->load->model('home_model','',TRUE); 
	 }
	public function index()
	{  
        
				$this->load->view('login-twitter');
			}
		
	
	
}

