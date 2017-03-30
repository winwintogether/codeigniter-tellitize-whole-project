<?php
require('config.php');
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select user_name  from  users where user_name LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['user_name'];
	echo "$cname\n";
}
?>