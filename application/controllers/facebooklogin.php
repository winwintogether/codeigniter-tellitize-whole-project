<?php
class facebooklogin extends CI_Controller {

 public function __construct(){

 parent::__construct();
   $this->load->model('home_model','',TRUE);
   $this->load->helper(array('form', 'url'));
   $this->load->library('form_validation');
   parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
   $this->load->library('Facebook', array("appId"=>"1415309858717428", "secret"=>"5895cc16843b78d6f9a7e4097463dcc4"));
   $this->user = $this->facebook->getUser();
 }

 public function index() {
    $logout = $this->facebook->getLogouturl(array("next"=>base_url()."facebooklogin/logout"));

 //echo "<a href='$logout'>Logout</a>";

     if($this->user) {

         try{

             $user_profile = $this->facebook->api('/me');
             $_SESSION['fbUserid']       = $user_profile['id'];
             $_SESSION['username']       = $user_profile['name'];
             $_SESSION['userlastname']   = $user_profile['last_name'];
             $_SESSION['useremail']      = $user_profile['email'];
             $_SESSION['oauth_provider'] = 'facebook';
             $user_id=$this->home_model->facebookRegister();

            if($user_id > 0)
            {
                $_SESSION['userid']=$user_id;
                redirect(base_url().'home', 'refresh');
            }
            else
        {       session_destroy();
                redirect('home', 'refresh');
            }

     }catch(FacebookApiException $e){
         print_r($e);
         $user = null;
     }
     }

     if($this->user == 0){
         //echo $this->user;

         $data['url'] = $login = $this->facebook->getLoginUrl(array("scope"=>"email"));
         header( 'Location: ' . $login);
         exit;
     }
 }

 public function logout() {

 session_destroy();

 redirect(base_url().'facebooklogin');

 }



}
?>