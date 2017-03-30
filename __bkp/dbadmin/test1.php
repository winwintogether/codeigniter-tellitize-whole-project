<?php
$to      = 'testmail.senabi@gmail.com';
$subject = 'Tellitize';
$message='<a href="http://www.tellitize.com/" title="tellitize.com" ><img border="0" alt="tellitize.com" src="http://www.tellitize.com/images/tellitizeLogo.png"></a>
		  <p style="font:14px arial;line-height:20px;">Registration success with tellitize.Click here to verify your email id.</p>
		  <p>http://www.tellitize.comconfirmation?user=79&verification-key=22e5e07e8c230e9fe75238281217e2d6</p><p><b>Best,</b></p><p><b>Tellitize Support Team</b></p>';
$headers = 'From: info@tellitize.com' . "\r\n";
$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers.= "From: info@tellitize.com" ;  

mail($to, $subject, $message, $headers);
?> 