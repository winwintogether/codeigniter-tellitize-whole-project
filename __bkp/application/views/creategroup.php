<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />

<style type="text/css">
li{
	list-style:none;
}
li h1{float:left;font:12px arial;padding:0px;margin:5px 10px;}
li h2{
	float:left;font:12px arial;padding:0px;margin:5px 10px;
}
#add_result{
	display:none;
	clear:both;
	font:12px arial;
	font-weight:bold;
	color:#FE8A13;
}

</style>
<div id="header">
<?php $this->load->view('header'); ?>
</div>
<div id="mid_container">
			<div class="mid_content">
				<div id="message">
						<div class="message">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>Group </h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
							<div class="message_wrap">
								
								<div id="rit_msg">
												 <?php echo form_open('group',array('name' => 'group' ,'id'=>'group')); ?>
												 <div id="right-main" style="float:left;margin:10px 50px;width:100%;">
												 		<ul style="width:100%;">
																		
																	<?php
																	 echo $group_filed;
																	?>
														</ul>
														</div>	
														   <div id="add_result"><?php echo $result;?></div>			
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
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/myprofile.js" type="text/javascript"> </script>
<script language="javascript">
function createGroup(){
	dataString = $('form[name=group]').serialize();
			
	
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=create_group",
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {    
				$('#add_result').show();
				$('#gname').val('');
				$('#g_desc').val('');
				$("#group").attr("action","groupdiscussions?groupid="+data.group);
				$('#group').submit();
				}
				else if(data.status=="exist"){
				$('#add_result').show();
				$('#add_result').html('');
				$('#add_result').html('Already exist');
				 $("#gname").css("border","1px solid red");	
				 return false;
				}
				else {
				
					alert("Occured internal Error.please check network connection" );
				}
			}
		});
}



</script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/message.css" rel="stylesheet" />