<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Freecontactformprocess extends CI_Controller {
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	   $this->load->library('session');
	 }
	 public function index()
	{
		
		 $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	   
		
			$this->load->view('freecontactformprocess');
		
		
	}
	
}

?>