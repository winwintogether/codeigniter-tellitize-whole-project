<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/home.css" rel="stylesheet" />	

<div id="headwrap">
	<div id="logo">
	</div>
	<div id="rightmain">
		

		<div class="right-top-main">
			     
				  <div id="display_error">
					<ul style="clear:left;width:300px;overflow:hidden;margin:0px;padding:0px;display:none"  class= "log_er">
						<li style="color:#CC0000;padding-left:5px;float:left">Invalid Username or password</li>
				
					</ul>
				</div>	
			
			<?php  echo validation_errors();
			 echo form_open('verifylogin',array('name' => 'login' ,'id'=>'loginForm')); ?>
			 
			<div class="right-first">
			<input class="input" type="text" name="login_username" value="<?php //echo $user; ?>" id="loginUsername" style="border:hidden">
			</div>
			<div class="search-second">
			<input class="input" type="password" name="login_pw" value="<?php //echo $password; ?>" id="loginPw" style="border:hidden" />
			</div>
			<div class="login-btn">
			<a href="#">
			<div id="login">
			<img width="91" height="33" alt="login-btn" src="<?php echo $GLOBALS['base_url']; ?>/images/login-btn.png" onClick="verifyLogin();">
			</div>
			</a>
			</div>
			
			<?php echo form_close(); ?>
		</div><!-- right-top-main -->
		<div class="Remember-main">
			<div class="FL">
			<input type="checkbox" name="remember" value="1">
			</div>
			<div class="remembet-text">Remember Me</div>
			<div class="Forget-pass Link" style="margin-left:80px;">
				<a href="javascript:void(0)">Forgot password</a>
			</div>
	 </div>
  </div><!-- rightmain-->
	<div id="join">
			<div class="join-arrow">
			<img width="10" height="9" alt="join-arrow" src="<?php echo $GLOBALS['base_url']; ?>/images/arrow.png">
			
			<a class="join-text" href="<?php echo $GLOBALS['base_url']; ?>/index.php/signup" >Join for free</a>
			</div>
			<div class="facebook">
			<a href="#">
			<img width="28" height="28" alt="facebook-icon" src="<?php echo $GLOBALS['base_url']; ?>/images/facebook-icon.png" style="margin-top:10px;">
			</a>
			</div>
			<div class="twitter">
			<a href="#">
			<img width="28" height="28" alt="twitter-icon" src="<?php echo $GLOBALS['base_url']; ?>/images/twitter-icon.png" style="margin-top:10px;">
			</a>
			</div>
	</div><!--join-->
	

 	<div class="clear"></div>
	<div id="menu-main">
		<div class="menu-inner-main">
				<div class="search-menu">
					<a href="#">
						<img width="28" height="31" alt="search-icon" src="<?php echo $GLOBALS['base_url']; ?>/images/search-icon.png">
					</a>
				</div>
				<div class="Navigation-main">
					<div class="navi-input-boxes">
					<input class="input2" type="text" size="12" value="FIRST NAME" name="FIRST NAME">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="LAST NAME" name="LAST NAME">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="AGE" name="AGE">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="LOCATION" name="LOCATION">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="Zip Code" name="TATTOS">
					</div>
					<div class="navi-input-boxes">
					<input class="input2" type="text" value="NICK NAME" name="NICK NAME"> 
					</div>
					<div class="navi-input-box-last">
					<input class="input2" type="text" value="Others" name="NICK NAME">
					</div>
				</div>
				<div class="search-btn">
					<a href="#">
					<img width="72" height="26" alt="search-btn" src="<?php echo $GLOBALS['base_url']; ?>/images/search-btn.png">
					</a>
				</div>
			</div><!--Navigation-main-->
	</div><!--menu-inner-main-->
	</div><!--menu-main-->
	

<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/home.js" type="text/javascript"> </script>
<script language="javascript">

function login(){
	dataString = $('form[name=login]').serialize();
			
	
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>/ajax/user-ajax.php?mode=login_user",
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