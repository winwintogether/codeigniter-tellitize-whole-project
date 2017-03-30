<?php

  //include init file
  require 'init.php';

  if ($CONFIG['debug_mode'] == true) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
  }

  //set memory for successfull parsing
  ini_set("memory_limit","340M");

  //include parser file and create parser object
  require 'simple_html_dom.php';   
  $html = new simple_html_dom();

  $request = $_SERVER['REQUEST_URI'];
  if ($CONFIG['subfolder'] != '') {
    $request = str_replace($CONFIG['subfolder'] . '/' , '', $request);
  }

  if ($request != '/') {
    $url = "http://" . $CONFIG['site'] . $request;
  }else{
    $url = "http://" . $CONFIG['site'];
  }

  if ($CONFIG['load_mode'] == '1') {
    $headers = array (
      'Host: '.(preg_replace('#^/|^http://|(/.+)$|/$#Ui',null,$url)),
      'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.3)',
      'Referer: '.$url,
      'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
      'Keep-Alive: 115',
      'Connection: keep-alive',
      );

    $data = curl_init($url);
      curl_setopt($data, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($data, CURLOPT_HEADER, 1);
      curl_setopt($data, CURLOPT_HTTPHEADER, $headers);

    if (!empty($_POST)) {
      curl_setopt($data, CURLOPT_POST, '1');
      curl_setopt($data, CURLOPT_POSTFIELDS, $_POST);
    }

    $code = curl_exec($data);
    $type = @curl_getinfo($data);
    curl_close($data);

    /*
    $pos = strpos($code, 'DOCTYPE');
    if ($pos !== false) {
        if (preg_match('|^(.*)<!DOCTYPE|sei', $code, $arr)) $headertmp = $arr[1];
    }else{
      if (preg_match('|^(.*)<html|sei', $code, $arr)) $headertmp = $arr[1];
    }
    */

    if (preg_match('|^(.*)<html|sei', $code, $arr)) $headertmp = $arr[1];
    $code = str_replace($headertmp, '', $code);

    $html->load($code);
  }

  if ($CONFIG['load_mode'] == '2') {
    $html->load_file($url);
  }

  // delete domain entry in links
  $links = $html->find('a');
  foreach ($links as $link) {
  	$url_parts = parse_url($link->href);
    if ($CONFIG['subfolder'] != '') {
      $link->href = "http://" . $CONFIG['my_domain'] . '/' . $CONFIG['subfolder'] . $url_parts['path'];
    }else{
      $link->href = $url_parts['path'];
    }
  }
  
  $images = $html->find('img');
  foreach ($images as $img) {
  	$img_parts = parse_url($img->src);
		$pos = strpos($img->src, 'http:');
		if ($pos === false) {
		    $img->src = "http://" . $CONFIG['site'] . $img_parts['path'];
    }
  }

  if ($CONFIG['insertafter'] != '') {
    $insertafter = $html->find($CONFIG['insertafter']);
    foreach ($insertafter as $el) {
      $el->outertext = $el->outertext . $CONFIG['inserttext'];
    }
  }

  if ($CONFIG['live_counter'] != '') {
    $html .= $CONFIG['live_counter'];
  }

  if ($CONFIG['include_file'] == true) {
    $html .= $CONFIG['include_file_path'];
  }


  echo $html;

?>