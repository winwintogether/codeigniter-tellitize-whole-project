<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FacebookBase
{
	protected function http_request($url)
	{
		$ch = curl_init();
		
		$opts = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_CONNECTTIMEOUT => 10
		);
			
		curl_setopt_array($ch, $opts);

		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
}

class Facebook extends FacebookBase
{
	public function __construct()
	{
		$ci =& get_instance();
		$this->config = $ci->config;
		
		$this->config->load('facebook');
	}
	
	public function get_login_url($scope = array('email'))
	{
		return vsprintf('https://graph.facebook.com/oauth/authorize?client_id=%s&redirect_uri=%s&scope=%s', array(
			$this->config->item('APP_ID'), $this->config->item('REDIRECT_URI'), join($scope, ',')
		));
	}
	
	public function getAPI($code)
	{
		$response = parse_str($this->http_request('https://graph.facebook.com/oauth/access_token?' . http_build_query(array(
			'client_id' => $this->config->item('APP_ID'),
			'client_secret' => $this->config->item('APP_SECRET'),
			'redirect_uri' => $this->config->item('REDIRECT_URI'),
			'code' => $code
		))));
		if (!empty($access_token))
			return new FacebookAPI($access_token);
		else
			throw new Exception($response);
	}
}

class FacebookAPI extends FacebookBase
{
	protected $access_token;
	
	public function __construct($access_token)
	{
		$this->access_token = $access_token;
	}
	
	public function call($path)
	{
		$response = $this->http_request('https://graph.facebook.com/' . $path . '?' . http_build_query(array('access_token' => $this->access_token)));
		return json_decode($response, true);
	}
}
