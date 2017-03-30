<div id="header"> 
<?php $this->load->view('header'); ?>
</div>
<?php


if(isset($_SESSION['userid']) || isset($_SESSION['fbUserid'])){

?>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/home.css" rel="stylesheet" />	
<div id="container">
<div style="float:right">
	<a href="<?php echo $GLOBALS['base_url']; ?>index.php/myprofile">MY PROFILE</a>
		
</div>
</div>
<?php
}
?>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
