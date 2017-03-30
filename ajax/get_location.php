<?php
$IP         	= $_SERVER['REMOTE_ADDR'];
$url            = "http://www.geoplugin.net/php.gp?ip=".$IP;
$geoplugin      = unserialize(file_get_contents($url));
$country_name   = strtoupper($geoplugin['geoplugin_countryName']);
$state_name     = strtoupper($geoplugin['geoplugin_region']);
$city_name      = strtoupper($geoplugin['geoplugin_city']);
$location       = $city_name.", ".$state_name.", ".$country_name;
echo $location;

?>