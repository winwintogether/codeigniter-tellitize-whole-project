<?php defined('BASEPATH') OR exit('No direct script access allowed');

class FacebookLogin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model','',TRUE);
        $this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
     }
    public function index()
	{
		session_start();
                $this->load->library('facebook');
		//echo $this->facebook->get_login_url();
		$code = $this->input->get('code');
                if (!empty($code)) {
			try {
				$profile = $this->facebook->getAPI($code)->call('/me');
				if (empty($profile)) {
					echo "Profile error";
				} else {


						//$this->load->model('user');
						
						
						//$user = $this->user->get_or_create($profile['email']);
						
						$_SESSION['fbUserid'] 	= $profile['id'];
						$_SESSION['username']  		= $profile['name'];
						$_SESSION['oauth_provider'] = 'facebook';
						$user_id=$this->home_model->facebookRegister();
						
						if($user_id > 0)
						{
						$_SESSION['userid']=$user_id;
						
						
						redirect('home', 'refresh');
						
						}
						else
						{
						session_destroy();
						redirect('home', 'refresh');
						
						}


					/*$user['facebook_username'] = $profile['username'];
					$user['first_name'] = $profile['first_name'];
					$user['last_name'] = $profile['last_name'];*/
					//$this->user->save($user)->login($user);
					//redirect('/user_area');

				}
			} catch(Exceptiion $e) {
				// handle error
                 $e->getMessage() ;
			}
		} else if ($error_reason = $this->input->get('error_reason')) {
            // string error message from Facebook
			echo $error_reason;
		}

		redirect('/');
	}
        
}
