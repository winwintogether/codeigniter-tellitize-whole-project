<?php

$env = ($env = getenv('ENV')) ? $env : 'dev';

$config = array(
	'dev' => array(
		'APP_ID' => '419226068158588',
		'APP_SECRET' => 'a0376b42506093ec2d171196af1103bc',
		'REDIRECT_URI' => 'http://tellitize.com/facebooklogin/'
	),
	'prod' => array(
	)
);

$config = $config[$env];
