<?php
$url = 'http://usa.bulksms.com/eapi/submission/send_sms/2/2.0';
	
	//$msisdn =	'919432186513';
	// $msisdn =	'919433270131';// seema
	//$msisdn =	'447889629675';// sir no.
	$msisdn = 'Tellitize';// client no
	$smsusername = '18596409345';
    $smspass = 'mtdew1258';
	$smsMessage='test message here';
	
	
	$data = 'username='.$smsusername.'&password='.$smspass.'&message='.urlencode($smsMessage).'&msisdn='.urlencode($msisdn);

	$response = do_post_request($url, $data);

	print $response;

	function do_post_request($url, $data, $optional_headers = 'Content-type:application/x-www-form-urlencoded') {
		$params = array('http'      => array(
			'method'       => 'POST',
			'content'      => $data,
			));
		if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		}
	
		$ctx = stream_context_create($params);


		$response = @file_get_contents($url, false, $ctx);
		if ($response === false) {
			print "Problem reading data from $url, No status returned\n";
		}
	
		return $response;
	}
$text = 'If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the Web.';
//echo trimText($text,160);
function trimText($Comment,$textLimit)
{
   if(strlen($Comment)> $textLimit)
   {
       $Comment = substr($Comment, 0, $textLimit);
   }
   return $Comment;
}

$phone = ' 22  324 333 444 ';
// echo $NOTrimphone = str_replace(" ","",$phone); 
function removeExtraSpace($phone)
{
   $phone = str_replace(" ","",$phone); 
   return $phone;
}

/* $dateArrY = array();
$dateArrAll = array();
$dateArrAll[0] = "09-16-14,09-19-14";
$dateArrAll[1] = "10-15-14,09-10-14";
$dateArrAll[2] = "09-24-14,09-11-14,09-10-14";
for($j=0;$j<count($dateArrAll);$j++){
	$datearr = array();
	$datearr = explode(',', $dateArrAll[$j]);
	//print_r($datearr);
	//echo count($datearr); exit;
	 if(count($datearr)>0)
	{
		for($i=0;$i<count($datearr);$i++){
			if(!in_array($datearr[$i],$dateArrY)){
				$dateArrY[] = trim($datearr[$i]);
			}
			
		}
	} 
} */
//print_r($dateArrY);

//echo "806d3ee7484433ac798a5e6bdfcabd74 ==========<br>".md5('Dg71Cg77');
/*  $tags = '21,22,7';
 //$tags = '21,22';
 //$tags = '21';
 $tagarr= explode(',',$tags);
// print_r($tagarr);
if(count($tagarr)>0)
{
	$tagId='';
	for($j=0;$j<count($tagarr);$j++){
		$tagId .=$tagarr[$j] .'==';
	}	
}
echo $tagId; */
?>	