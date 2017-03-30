<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	 function __construct()
 {
   parent::__construct();
   $this->load->model('home_model','',TRUE); 
 }
	public function index()
	{
		$this->load->helper('form');
		
		$this->load->library('form_validation');
		$this->load->view('home_view');
	}
	function process(){
    $this->load->helper(array('form', 'url'));
	 
	 $this->home_model->register();
	                              
   // $this->load->view('home_view');
    redirect('home_view', 'refresh');
                   }
}

