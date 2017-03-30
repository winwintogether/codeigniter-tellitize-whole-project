<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/message.css" rel="stylesheet" />

<div id="header">
<?php $this->load->view('header'); ?>
</div>

<div id="mid_container">
			<div class="mid_content">
				<div id="message">
						<div class="message">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>Inbox and sent message</h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
							<div class="message_wrap">
								<div id="left_msg">
									
									 <ul>
										<li ><a href="<?php echo $GLOBALS['base_url']; ?>inbox">Inbox</a></li>
										<li class="compose"><a href="<?php echo $GLOBALS['base_url']; ?>message">Compose</a></li>
										<li><a href="<?php echo $GLOBALS['base_url']; ?>sent">Sent</a></li>
									  </ul>
									
								</div><!--left_msg-->
								<div id="rit_msg">
								<?php
									  echo form_open('message',array('name' => 'messageForm' ,'id'=>'messageForm','autocomplete'=>'off')); 
								 ?>
									<div class="sent-message">
                              
										  <div class="new-mess1">NEW MESSAGE</div>
										  
									 	 <div class="sent-message03">
										   <div class="sent-to">To</div>
										   <div class="sent-toinn01">
										   	<input type="text" class="to-input" name="to_user" id="to_user" autocomplete="off" onkeyup="check();" value="<?php echo $to_name;?>" >
										   </div>
										   <span class="not_exist" style="display:none">User does not exist</span>
										  
										   <div class="sent-to">Message</div>
										   <div class="sent-toinn01">
										   <textarea style="border:0px none; font-family:Arial; font-size:12px; font-weight:normal; color:#565656; padding:3px; min-width:517px;max-width:517px;" 
										   rows="" cols="" name="message_txt" id="message_txt"></textarea>
										   </div>
										</div>
                                   
                              </div>
							  <div class="buttons">
							  	 <a href="javascript:void(0)" onclick="sendMessage();" >
								 	<img width="72" height="26" border="0" alt="send-btn" src="<?php echo $GLOBALS['base_url']; ?>images/send-btn.png">
								 </a>
								  <a href="<?php echo $GLOBALS['base_url']; ?>"><img width="72" height="26" border="0" alt="Cancel-btn" src="<?php echo $GLOBALS['base_url']; ?>images/cancel.png"></a>
							  </div>
							   <div id="msg_result">Message sent...</div>
							   <?php echo form_close(); ?>
								</div><!--rit_msg-->
							</div><!--message_wrap-->
						   
												
				</div><!--message-->
						  
		</div>
</div>			

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>


<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/message.js" type="text/javascript"> </script>

<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/jquery.autocomplete.css">

<script type="text/javascript">
$().ready(function() {
	$("#to_user").autocomplete("<?php echo $GLOBALS['base_url']; ?>/ajax/get_user_list.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
function check(){
$('.ac_input').css("color","#565656");
$('.not_exist').hide();
}
</script>

