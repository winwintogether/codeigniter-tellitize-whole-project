<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fblogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function index()
 {
  $uname= $this->uri->segment(3);
  $pass= $this->uri->segment(2);
  $page= $this->uri->segment(4);
  $result = $this->user->fblogin($uname, $pass);

   if($result)
   {
     session_start();
     $sess_array = array();
     foreach($result as $row)
     {
	   $_SESSION['iid'] = $row->id;
       $sess_array = array(
         'id' => $row->id,
		 'guide' => $row->guide,
         'username' => $row->username
       );
       $this->session->set_userdata('logged_in', $sess_array);
	   if($page){
	   redirect('details/'.$page);
	   }
	   else{
	    redirect('home');
	   }
     }
     return TRUE;
   }
   
 }


}
?>
