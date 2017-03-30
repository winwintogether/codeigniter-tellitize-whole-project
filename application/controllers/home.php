<?php session_start();

class Home extends CI_Controller {

	function __construct()
	{
            parent::__construct();
            $this->load->model('home_model','',TRUE);
	    $this->load->model('myprofile_model','',TRUE);
            $this->load->library('session');
            $this->load->library('layout');
            $this->load->library('templatelayout');
            $this->load->model('ip2locationlite','',TRUE);
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
	}

	public function index()
	{
            $IP = $_SERVER['REMOTE_ADDR'];
           

            $location=$this->ip2locationlite->getCity($IP);
            $data['country']=$location['countryName'];
            $data['city']=$location['cityName'].','.$location['regionName'];
            $data['category'] = $this->home_model->getAllCategory();
            $data['category_list'] = $this->home_model->getCategoryList();
            if(isset($_SESSION['userid'])) {
                $query = $this->myprofile_model->get($_SESSION['userid']);
		$data['profile_img'] = $query['profile_img'];
		$data['reg_status'] = $query['reg_status'];
		if($data['reg_status']!=0){
                    $_SESSION['username']= $query['name'];
		}
		$data['group'] = $this->myprofile_model->getgroup($_SESSION['userid']);
		$data['group_list'] = $this->myprofile_model->getgroupList($_SESSION['userid']);

		//$data['category_list'] = $this->home_model->getCategoryList();
		$data['place'] = $this->home_model->getAllPlace();
		$data['place_list'] = $this->home_model->getPlaceList();
            }

            if(isSet($_COOKIE['cookiename']))
            {
                parse_str($_COOKIE['cookiename']);
		$data['user']       = $usr;
		$data['password']   = $hash;
		$this->load->view('home_view',$data);
            }
            else
            {
                $data['user']       = '';
		$data['password']   = '';
		$data['article']    = $this->home_model->article();
		$this->load->view('home_view',$data);
            }
	}

    function process(){
        $email      = $this->input->post('email');
        $user_name  = $this->input->post('username');

        $i_check_email  = $this->home_model->check_email($email);

        if($i_check_email)
        {
            $_SESSION['errormsg']   = 'Email can not be same. Please choose another email.';
            redirect('signup');
            exit();
        }
        else
        {
            $i_check_user_name  = $this->home_model->check_username($user_name);
            if($i_check_user_name)
            {
                $_SESSION['errormsg']   = 'Username can not be same. Please select another username.';
                redirect('signup');
                exit();
            }
            else
            {
                $this->home_model->register();
                //$_SESSION['successmsg']   = 'Successfully registered.Check your mail for verification.';
                //redirect('signup');
                //session_start();
                redirect('myprofile');
                exit();
            }
        }

	redirect('home', 'refresh');
    }

	function login(){


		$username = addslashes($this->input->post('login_username'));
		$password= $this->input->post('login_pw');
		$remember= $this->input->post('remember');
		
		if ($remember==1) {
  $password_hash = $password; // will result in a 32 characters hash
$cookie_time = (3600 * 24 * 30);
	setcookie ('cookiename', 'usr='.$username.'&hash='.$password_hash, time() + $cookie_time);



   // $this->input->set_cookie($username,);
}
		$result = $this->home_model->login($username, $password);

		   if($result)
		   {

			 $sess_array = array();
			 foreach($result as $row)
			 {
			 	 $_SESSION['userid'] = $row->userid;
				 $_SESSION['username'] = $row->user_name;
			     $sess_array = array(
				 'id' => $row->userid,
				 'email' => $row->email,
				 'username' => $row->user_name
			   );
			   $this->session->set_userdata('logged_in', $sess_array);
			 }

		   }
	   $this->load->helper(array('form', 'url'));
	  // redirect('userhome', 'refresh');
	  redirect('home', 'refresh');
    }
	function logout() {

	   $this->load->helper(array('form', 'url'));
	   $this->session->unset_userdata('logged_in');
	    unset($_SESSION['id']);
    	unset($_SESSION['username']);
   	    unset($_SESSION['oauth_provider']);
	   session_destroy();
	   if(isSet($_COOKIE['cookiename']))
			{
			// remove 'site_auth' cookie
			$cookie_time = (3600 * 24 * 30);
			setcookie ('cookiename', '', time() - $cookie_time);
			}
	   redirect('home', 'refresh');
    }

function aboutus(){

    $this->data['title'] = 'About Us';
    $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
    $this->templatelayout->get_header();
    $this->templatelayout->get_footer();
    $this->elements['middle']='about-us';
    $this->elements_data['middle'] = $this->data;
    $this->layout->setLayout('front_layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);

}

function termsofuse(){

    $this->data['title'] = 'Terms of Use';
    $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
    $this->templatelayout->get_header();
    $this->templatelayout->get_footer();
    $this->elements['middle']='terms-of-use';
    $this->elements_data['middle'] = $this->data;
    $this->layout->setLayout('front_layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);
}

function contactus(){

    $this->data['errormsg']       = '';
    $this->data['successmsg']     = '';
    $this->data['msg_class']      = '';
    $this->data['display_option'] = 'none';

    if(isset($_SESSION['errormsg']) != '')
    {
        $this->data['msg']              = $_SESSION['errormsg'];
        $_SESSION['errormsg']           = '';
        $this->data['msg_class']        = 'errormsg';
        $this->data['display_option']   = 'block';
    }
    else if(isset($_SESSION['successmsg']) != '')
    {
        $this->data['msg']              = $_SESSION['successmsg'];
        $_SESSION['successmsg']         = '';
        $this->data['msg_class']        = 'successmsg';
        $this->data['display_option']   = 'block';
    }
    else
    {
        $this->data['msg']            = '';
        $this->data['successmsg']     = '';
        $this->data['msg_class']      = '';
        $this->data['display_option'] = 'none';
    }


    $this->data['title'] = 'Contact Us';
    $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
    $this->templatelayout->get_header();
    $this->templatelayout->get_footer();
    $this->elements['middle']='contact-us';
    $this->elements_data['middle'] = $this->data;
    $this->layout->setLayout('front_layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);

    /*
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->view('contact-us');
    */
}

function do_contactus()
{

}


function privacypolicy(){

    $this->data['title'] = 'Privacy Policy';
    $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
    $this->templatelayout->get_header();
    $this->templatelayout->get_footer();
    $this->elements['middle']='privacy-policy';
    $this->elements_data['middle'] = $this->data;
    $this->layout->setLayout('front_layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);

}
function faq(){

    $this->data['title'] = 'FAQ';
    $this->data['description']  = "Tellitize is the first tell all website to allow you to send anonymous emails and messages as well as post anonymously or publicly. Perception is everything.";
    $this->templatelayout->get_header();
    $this->templatelayout->get_footer();
    $this->elements['middle']='faq_view';
    $this->elements_data['middle'] = $this->data;
    $this->layout->setLayout('front_layout');
    $this->layout->multiple_view($this->elements,$this->elements_data);

}

}


?>