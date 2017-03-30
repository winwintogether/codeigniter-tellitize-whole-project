<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussionplace extends CI_Controller {
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('myprofile_model','',TRUE); 
	   $this->load->library('session');
	 }
	 public function index()
	{
		
		 $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if(isset($_SESSION['userid']))
		{
		
			if(isset($_GET['place-id'])){
				$selectplace=$this->db->query("SELECT * FROM place_of_discussion where id='".$_GET['place-id']."'");
				foreach ($selectplace->result_array() as $row){
					$data['place']=$row['place'];
					$data['description']=$row['description'];
				}							
									
			}
			else{
				$data['place']='';
				$data['description']='';
			}
			$this->load->view('create_discussion',$data);
			
		}
		else{
			 redirect('home', 'refresh');
		}
		
	}
	
}

?>