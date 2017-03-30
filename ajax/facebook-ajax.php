<?php
$fbUserid=$_POST['email'];
/*$connect=mysql_connect("localhost", "tellitize", "r6h5tzKZzvxAwTww") or die("Could not connect");
//$connect=mysql_connect("localhost", "root", "") or die("Could not connect");
mysql_select_db("tellitize",$connect) or die("Could not select database");
$sql=mysql_query('select email from users where email="'.$email.'"');
$row=mysql_num_rows($sql);
if($row){
echo json_encode(array('result' => '1'));
}
else{
echo json_encode(array('result' => '0'));
}*/
session_start();
if(isset($fbUserid)){
$_SESSION['fbUserid']=$fbUserid;
$connect=mysql_connect("50.63.106.154", "tellidbase1212", "XenaDog12!!") or die("Could not connect");
mysql_select_db("tellidbase1212",$connect) or die("Could not select database");
$sql=mysql_query('select email,userid,reg_status, user_name from users where email="'.$_SESSION['fbUserid'].'"');
$row=mysql_num_rows($sql);
if($row){
  $user=mysql_fetch_array($sql);
  $_SESSION['userid']= $user['userid'];
  if($user['reg_status']==0){
 	 $_SESSION['username']=$_POST['name'];
	 $_SESSION['reg_status_fb']=1;
	 $_SESSION['username_fb']=$_POST['pass'];
  }
}
else{
	$in="INSERT INTO `users` (
					`userid` ,
					`user_name` ,
					`email` ,
					`reg_date` ,
					`reg_status` ,
					`name`					
					)
					VALUES (
					NULL ,'".$_POST['pass']."','".$_POST['email']."','".date("y/m/d")."','1','".$_POST['name']."'
					)";
					$insert=mysql_query($in);
					$_SESSION['userid']=mysql_insert_id();
}


echo json_encode(array('result' => '1'));

}
else{
echo json_encode(array('result' => '0'));
}
?>