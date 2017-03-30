<?php session_start(); if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Placediscussions extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	    $this->load->model('myprofile_model','',TRUE); 
		 $this->load->model('place_model','',TRUE); 
		 $this->load->library('session');
	 }
	 
	 public function index(){
	  if(isset($_GET['placeid'])) $this->seoUrlIndex($_GET['placeid']);
	 
	 }
	public function seoUrlIndex($id)
	{  
         $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 if(isset($_SESSION['userid'])){
				 $IP = $_SERVER['REMOTE_ADDR'];
					$SSID = htmlentities (SID);
					// If IP address exists
					// Get country (and City) via  api.hostip.info
					if (!empty ($IP)) {
					if(file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP))
					$location=file_get_contents ('http://api.hostip.info/get_html.php?ip='.$IP);
					$data['country']= $this->home_model->get_string_between($location,"Country:","City");
					$data['city']=$this->home_model->get_string_between($location,"City:","IP");
					} 
					$data['category'] = $this->home_model->getAllCategory();
				
					
				  if(!isset($_GET['placeid'])){$_GET['placeid']=$id;}
				  if(isset($_GET['placeid']))
				  {
					  $data['placeid']=$_GET['placeid'];
					  $data['placeUsers'] = $this->place_model->getUserList($_GET['placeid']);
					  $data['placeUsersList'] = $this->place_model->getAllUserList($_GET['placeid']);
					  $data['article']=$this->place_model->article($_GET['placeid']);
					  
				 } 
				 else 
					 { 	 $data['placeid']=0;
						 $data['placeUsers'] ='';
						 $data['placeUsersList'] ='';
						 $data['article']='';
					  }
				  $this->load->view('place_discussion_view',$data);
		}
		 else{
		 redirect('home', 'refresh');
		 }
					
	}
	
}
?>