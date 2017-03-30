<?php

/*$connect=mysql_connect("localhost", "root", "") or die("Could not connect");
mysql_select_db("tellitize",$connect) or die("Could not select database");
$base_url='http://localhost/tellitize_new/';

$connect=mysql_connect("localhost", "yoursweb_admin", "adminPwD123@") or die("Could not connect");
mysql_select_db("yoursweb_tellitize",$connect) or die("Could not select database");
$base_url='http://yours-website.com/tellitize/';*/

$connect    = mysql_connect("50.63.106.154","tellidbase1212","XenaDog12!!");
mysql_select_db("tellidbase1212",$connect) or die("Could not select database");
$base_url='http://www.tellitize.com/';


function autolink($string)
	{
	$content_array = explode(" ", $string);
	$output = '';
	
	foreach($content_array as $content)
	{
	//starts with http://
	if(substr($content, 0, 7) == "http://" || substr($content, 0, 8) == "https://")
	$content = '<a href="' . $content . '">' . $content . '</a>';
	
	//starts with www.
	if(substr($content, 0, 4) == "www.")
	$content = '<a href="http://' . $content . '">' . $content . '</a>';
	
	$output .= " " . $content;
	}
	
	$output = trim($output);
	return $output;
	}
?>