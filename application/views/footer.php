<div id="footer-wrapper">
<div class="footer-main">
<div class="footerLeft">
<div class="link-footer Link02">
<a class="Link02" href="<?php echo $GLOBALS['base_url']; ?>">Home</a>
|
<a class="Link02" href="<?php echo $GLOBALS['base_url']; ?>about-us">About Us</a>
|
<a class="Link02" href="<?php echo $GLOBALS['base_url']; ?>privacy-policy">Privacy Policy</a>
|
<a class="Link02" href="<?php echo $GLOBALS['base_url']; ?>terms-of-use">Terms of Use</a>
|
<a class="Link02" href="<?php echo $GLOBALS['base_url']; ?>contact-us">Contact Us</a>&nbsp;
</div>
<div class="copyright">Copyright &copy; Tellitize 2012. All Rights Reserved</div>

</div>
<div style="float:left; width:25%; text-align:right;">
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Ftellitize&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:21px;" allowTransparency="true"></iframe>
<a href="https://twitter.com/tellitize" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @tellitize</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
</div>
</div>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.blockUI.js"></script>
<script type="text/javascript">
var sc_project=8102551; 
var sc_invisible=1; 
var sc_security="ae11dd52"; 
</script>
<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script><noscript><div class="statcounter"><a title="web analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/8102551/0/ae11dd52/1/"
alt="web analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
<input type="hidden" name="user_session_id" id="user_session_id" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['userid'];} else { echo 0;}?>">
<input type="hidden" name="session_id" id="session_id" value="<?php echo session_id();?>">
<?php
$var=explode('?',$_SERVER['REQUEST_URI']);
$page=preg_replace('/.*\/([^\/])/','$1',$var[0]);
unset($var);
//echo $page;
?>
<input type="hidden" name="page_name" id="page_name" value="<?php echo $page;?>">
	<div class="baloon">
		<div class="baloon_pop_up_close"><img src="<?php echo base_url();?>images/fancy_close.png" ></div>
		<div>
			<form name="ballon_popup_frm" id="ballon_popup_frm">
				<div class="question_main_div">
					<span class="question_span">Would You Like To:</span>
					<?php
						$i		= 1;
						$j		= 1;
						$query 	= mysql_query("SELECT * FROM popup_questions ORDER BY rand()");
						if($query){
							while($row=mysql_fetch_array($query)){
								if($i==1)
								{
									$display_option = '';
					?>
									<div class="question_div" style="display:<?php echo $display_option;?>;">
					<?php
								}
								else
								{
									$display_option = 'none;';
								}
								
								if($i==6)
								{
					?>
								</div>
								<div class="question_div" style="display:<?php echo $display_option;?>;">
					<?php
								$i=1;
								}
					?>
						
							<input type="radio" class="ballon_popup_radio" value="next"><span class="text_radio"><?php echo $row['question'];?></span>
					<?php
								$i++;
								$j++;
							}
							
						}
						
					?>
					</div>
						
				
					<div id="link_div" style="width:100%; float:left;">
						<div style="margin-top:5px; margin-left:15px; margin-bottom:5px; float:left;">
							<a class="thanks_skip" id="don_show">Don't show again</a>
						</div>
						<div style="margin-top:5px; margin-bottom:5px; float:left;">
							<a class="thanks_skip" id="more_options">More Options</a>
						</div>
						<div style="margin-top:5px; margin-bottom:5px; float:left;">
							<a class="thanks_skip" id="back_options">Back</a>
						</div>
						<div style="margin-top:5px; margin-bottom:5px; float:right;">
							<a class="thanks_skip" id="thanks_skip">Skip</a>
						</div>
					</div>
				</div>				
				<div id="register_account" style="padding:20px; display:none; ">
					<div style="display:block; text-align:left; padding:5px; font-family:arial;"><input type="radio" name="register_or_account" value="register" class="register_account_radio"><span class="text_radio">Register</span></div>
					<div style="display:block; text-align:left; padding:5px; font-family:arial;"><input type="radio" name="register_or_account" value="account" class="register_account_radio"><span class="text_radio">Already have an account</span></div>
				</div>
				
				
			</form> 
		</div>
	</div>
</body>
</html>