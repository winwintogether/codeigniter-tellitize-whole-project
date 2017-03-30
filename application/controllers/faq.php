<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	  
	 }
	public function index(){
	
        session_start();
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');		   
		 $this->load->view('faq_view');
					
	}
	
}
?>

