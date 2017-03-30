<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/myprofile.js" type="text/javascript"> </script>
<script language="javascript">
function createPlace(){
	dataString = $('form[name=discussion]').serialize();
			
	
		$.ajax({
			type: "POST",
			url: "<?php echo $GLOBALS['base_url']; ?>ajax/user-ajax.php?mode=create_discussion&id="+<?php if(isset($_GET['place-id']))echo $_GET['place-id']; else echo 0;?>,
			cache: false,
			data: dataString,
			dataType: "json",
			success: function(data) {
             if(data.success == "yes")
			  {    
					if(data.status=="updated"){
					$('#add_result').html('');
					$('#add_result').html('Updated...');
					$('#add_result').show();
					}
					else{
					$('#add_result').show();
					$('#place').val('');
					$('#p_desc').val('');
				   
					}
					 $("#discussion").attr("action","placediscussions?placeid="+data.place);
					$('#discussion').submit();
				}
				else if(data.status=="exist"){
				$('#add_result').show();
				$('#add_result').html('');
				$('#add_result').html('Already exist');
				 $("#gname").css("border","1px solid red");	
				 return false;
				}
				
				else {
					alert(" Occured internal Error.please check network connection" );
				}
			}
		});
}
</script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/myprofile.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/message.css" rel="stylesheet" />
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
<div id="mid_container">
			<div class="mid_content">
				<div id="message">
						<div class="message">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>Place of Discussion </h4>
										
										</div>
									<div class="orang_rit"></div>									
							</div>
							<div class="message_wrap">
								
								<div id="rit_msg">
								
												 <?php echo form_open('discussionplace',array('name' => 'discussion' ,'id'=>'discussion')); ?>
												 <div id="right-main" style="float:left;margin:10px 50px;">
												 		<ul>
																		
																	<li style="clear:left">
																		<h1>Place of Discussion</h1>
																		<h2><input type="text" name="place" id="place" class="input_txt" value="<?php echo $place;?>"/></h2>				
																	</li>
																	
																	<li style="clear:left">
																		<h1>Description</h1>
																		<h2>
																		<textarea name="p_desc" id="p_desc" class="input_ta"><?php echo $description;?></textarea>
																		</h2>				
																	</li>
																	<li style="clear:left">
																	<div id="doneButton" style="padding-left:55px;" >
																			<img width="138" height="33" alt="sign-up-account" src="<?php echo $GLOBALS['base_url']; ?>images/save-edit.jpg"  onClick="validateDiscussion();">
																			</div>
																	</li>
														</ul>
														</div>	
														<div id="add_result">Place of discussion created...</div>			
												 <?php echo form_close(); ?>
											 </div><!--rit_msg-->
							</div><!--message_wrap-->
						   
												
				</div><!--message-->
						  
		</div>
</div>