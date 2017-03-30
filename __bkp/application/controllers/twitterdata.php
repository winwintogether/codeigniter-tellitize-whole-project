<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Twitterdata extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('home_model','',TRUE); 
	 }
	public function index()
	{  
		$this->load->view('twitter/twitteroauth.php');
		define('GD8e8qsoJgh5IW0ww1Kqg', 'Twitter Key');
		define('5jYnI1zav13ZgNCnqnMH6M09EdwLVkg4doWARA0Kmm0', 'Twitter Secret Key');
		session_start();
		if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])) {
			$twitteroauth = new TwitterOAuth('GD8e8qsoJgh5IW0ww1Kqg','5jYnI1zav13ZgNCnqnMH6M09EdwLVkg4doWARA0Kmm0', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			// Save it in a session var
			$_SESSION['access_token'] = $access_token;
			// Let's get the user's info
			$user_info = $twitteroauth->get('account/verify_credentials');
			
			if (isset($user_info->error)) 
				{echo "er";
					//redirect('twitterlogin', 'refresh');
					$this->load->view('login-twitter');
					
				} 
			else 
			     
				{ $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
				 $_SESSION['twitUserid']=$user_info->id;
				 $_SESSION['username']  = $user_info->name;
				
 			$_SESSION['oauth_id'] =  $_SESSION['twitUserid'];
           
            $_SESSION['oauth_provider'] = 'twitter';
				//insert details to db and set sessions for twitter
				$_SESSION['userid']=$this->home_model->twitRegister();	
				 //$this->load->view('home_view');
				  redirect('home', 'refresh');
			    }
		}
		else {echo "empty";
			// Something's missing, go back to square 1
			$this->load->view('login-twitter');
		   }
	}
		
}

