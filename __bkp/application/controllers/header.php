<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/home.css" rel="stylesheet" />	
<style type="text/css">
.fb-login-button{background:none;}
</style>


<?php 
   //to view no:of posts
    if(isset($_SESSION['userid'])){
		$this->load->model('home_model');
		$this->load->model('myprofile_model','',TRUE);		
		$postcount=$this->myprofile_model->getCountOfPosts($_SESSION['userid']);
		//to view notification count	
		$notification_count=$this->myprofile_model->getCountOfNotifications($_SESSION['userid']);
	   //to view messages count	
		$messages_count=$this->myprofile_model->getCountOfMessages();
		
	   //username and pic in common header	
		$query = $this->myprofile_model->get($_SESSION['userid']);
			$username= $query['user_name'];
			$email = $query['email'];
			$name= $query['name'];			
			$profile_img = $query['profile_img'];
	}	
	
	//twitter login
	if(!isset($_SESSION['userid'])){$username='';} else $username=$_SESSION['userid'];
	if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
       // header("Location: login-twitter.php");
		    redirect('twitterlogin', 'refresh');
    }
    
}
?>

<div id="headwrap">
	<a href="<?php echo $GLOBALS['base_url']; ?>"><div id="logo">
	</div></a>

	<?php $status=0;
	if(isset($_SESSION['userid'])){$status=1;} else if(isset($_SESSION['fbUserid'])) {$status=1;}
	else if(isset($_SESSION['twitUserid'])) {$status=1;} else {$status=0;}
	if($status!=1)
			{
			?>	<div style="position:absolute; margin-left:800px; margin-top:40px; display:<?php if($username) { echo ''; } else { echo ''; }  ?>" id="name"><?php $this->load->view('layouts/facebook');?></div>  
	<div id="rightmain">
		

		<div class="right-top-main">
			     
				  <div id="display_error">
					<ul style="clear:left;width:300px;overflow:hidden;margin:0px;padding:0px;display:none;float:left"  class= "log_er">
						<li style="color:#CC0000;padding-left:5px;float:left">Invalid Username or password</li>
				
					</ul>
                     <div class="faqs"><a href="<?php echo $GLOBALS['base_url']; ?>faq" class="faqs_link"></a></div>
				</div>	
               
			
			<?php  
			
			echo validation_errors();
			 echo form_open('verifylogin',array('name' => 'login' ,'id'=>'loginForm' ))?>
			 
			<div class="right-first">
			<input class="input" type="text" name="login_username" value="<?php //echo $user; ?>" id="loginUsername" style="border:hidden" onkeypress="loginKeyPress(event);">
			</div>
			<div class="search-second">
			<input class="input" type="password" name="login_pw" value="<?php //echo $password; ?>" id="loginPw" style="border:hidden" onkeypress="loginKeyPress(event);"/>
			</div>
			<div class="login-btn">
			<a href="#">
			<div id="login">
		 
			<img width="91" height="33" alt="login-btn" src="<?php echo $GLOBALS['base_url']; ?>/images/login-btn.png"  onclick="verifyLogin();" id="log">
			</div>
			</a>
			</div>
            <div class="social_login">
				<?php $this->load->view('layouts/facebook');?>
                <div class="facebook">
                <a class="fb" href="#" onclick="FBlogin()" >
                <img width="32" height="32" alt="facebook-icon" src="<?php echo $GLOBALS['base_url']; ?>/images/facebook_icon.png" style="margin-top:10px;">
                </a>
                </div>
                <div class="twitter">
                 <a href="?login&oauth_provider=twitter">
                <img width="32" height="32" alt="twitter-icon" src="<?php echo $GLOBALS['base_url']; ?>/images/twitter_icon.png" style="margin-top:10px;">
                </a>
                </div>
            </div>
			
		</div><!-- right-top-main -->
		<div class="Remember-main">
			<div class="FL">
			<input type="checkbox" name="remember" value="1">
			</div>
			<div class="remembet-text">Remember Me</div>
			<div class="Forget-pass Link" style="margin-left:80px;">
				<a href="javascript:void(0)" class="Link">Forgot password</a>
			</div>
            <div class="join-arrow">
			<img width="10" height="9" alt="join-arrow" src="<?php echo $GLOBALS['base_url']; ?>/images/arrow.png">
			
			<a class="join-text" href="<?php echo $GLOBALS['base_url']; ?>signup" >Join for free</a>
			</div>
	 </div>
	 <?php echo form_close(); 
	 
	 ?>
  </div><!-- rightmain-->
	
	
<?php }
	else{  
	
	/*
		echo '<div style="float:right"><a href="'.$GLOBALS['base_url'].'logout" class="join-text">LOGOUT</a></div>
				<div style="float:right;padding-right:10px;">
						<a href="'.$GLOBALS['base_url'].'myprofile" class="join-text">MY PROFILE</a>
		
				</div>';*/
	?>
	<div id="hed_aftrLogin">
	<div id="left_pic"><?php 
	if($profile_img!='') {echo '<img  alt="user photo" width="39" height="42" alt="user-img-small" class="bdr" src="'.$GLOBALS['base_url'].'/ajax/uploads/'.$profile_img.'" />';}
	else{
	echo '<img  src="../images/user-photo.jpg" width="39" height="42" alt="user-img-small" class="bdr"/>';
	}
	
	?>
	
	</div>
	<div id="rit_pic">
		<div class="welcome_top">
			<span class="orange">Welcome!</span>
			<span><?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></span>
		</div>
		<ul class="menus">
			<li class="menu1"><a href="<?php echo $GLOBALS['base_url']; ?>myposts">MY POST</a><span class="circle"><?php if(isset($postcount)) echo $postcount;?></span></li>
			<li class="menu2"><a href="<?php echo $GLOBALS['base_url']; ?>myprofile">My profile</a></li>
			<li class="menu3"><a href="<?php echo $GLOBALS['base_url']; ?>notifications"> notification</a><span class="circle"><?php if(isset($notification_count)) echo $notification_count;?></span></li>
			<li class="menu4"><a href="<?php echo $GLOBALS['base_url']; ?>message">Messages</a><span class="circle"><?php if(isset($messages_count)) echo $messages_count;?></span></li>
			<li class="menu5"><a href="<?php echo $GLOBALS['base_url']; ?>logout">Logout</a></li>
		</ul>
	</div>
	
	</div>
	<?php
	}

?>
 	<div class="clear"></div>
	
	<div id="menu-main">
		
		<div class="menu-inner-main">
				<div class="search_txt">Search to see If You have been Tellitize</div>
				<div class="search-menu">
					<a href="#">
						<img width="28" height="31" alt="search-icon" src="<?php echo $GLOBALS['base_url']; ?>/images/search-icon.png">
					</a>
				</div>
				<div class="Navigation-main">
				   <form name="search" action="<?php echo $GLOBALS['base_url'];?>search" name="search-form" id="search-form" method="post">
					<div class="navi-input-boxes">
					<input class="input2" type="text" size="12" value="FIRST NAME" name="s_first_name" onfocus="if(this.value  == 'FIRST NAME') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'FIRST NAME'; } " id="s_first_name">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="LAST NAME" name="s_last_name" onfocus="if(this.value  == 'LAST NAME') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'LAST NAME'; } " id="s_last_name">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="AGE" name="s_age" onfocus="if(this.value  == 'AGE') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'AGE'; } " id="s_age">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="LOCATION" name="s_location" onfocus="if(this.value  == 'LOCATION') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'LOCATION'; } " id="s_location">
					</div>
					<!--<div class="navi-input-boxes">
					<input class="input2" type="text" value="Zip Code" name="s_zipcode" onfocus="if(this.value  == 'Zip Code') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'Zip Code'; } " id="s_zipcode">
					</div>-->
					
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="tattos" name="s_others" onfocus="if(this.value  == 'tattos') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'tattos'; } " id="s_others">
					</div>
                    <div class="navi-input-box-last">
					<input class="input2" type="text" value="NICK NAME" name="s_nick_name" onfocus="if(this.value  == 'NICK NAME') { this.value = ''; } " 
									onblur="if(this.value == '') { this.value = 'NICK NAME'; } " id="s_nick_name">
					</div>
					</form>
				</div>
				<div class="search-btn">
					<a href="javascript:void(0);">
					<img width="72" height="26" alt="search-btn" src="<?php echo $GLOBALS['base_url']; ?>/images/search-btn.png" onclick="
					 searchNow();">
					</a>
				</div>
			</div><!--Navigation-main-->
	</div><!--menu-inner-main-->
	</div><!--menu-main-->
<div id="fbaccess"></div>

<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/home.js" type="text/javascript"> </script>

<script language="javascript">

 function loginKeyPress(e)
    {
        // look for window.event in case event isn't passed in
        if (typeof e == 'undefined' && window.event) { e = window.event; }
        if (e.keyCode == 13)
        {
		   verifyLogin();
        }
    }
function login(){
	dataString = $('form[name=login]').serialize();
			
	
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=login_user",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {    
				//alert("login success");
				$('#loginForm').submit();
				}
				else if(data.success == "no")
			    {    
					$('.log_er').show();
				}
			
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
		
}
</script>