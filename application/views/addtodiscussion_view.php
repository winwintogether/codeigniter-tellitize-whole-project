<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery-1.7.1.min.js" type="text/javascript"> </script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/discussion.js" type="text/javascript"> </script>
<script type="text/javascript" src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/jquery.autocomplete.css">
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/message.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/discussion.css" rel="stylesheet" />
<script type="text/javascript">
$().ready(function() {

	$("#username").autocomplete("<?php echo $GLOBALS['base_url']; ?>/ajax/get_user_list.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
});
function check(){
	$('.ac_input').css("color","#565656");
	$('.not_exist').show();
	$('.not_exist').hide();
}
</script>

<div class="modalOverlay" style="display:none"></div>

<div id="mid_container">
			<div class="mid_content">
				<div id="message">
						<div class="message">
									<div class="orang_left"></div>
									<div class="orang_mid">
										<h4>Places of Discussion </h4>
										</div>
									<div class="orang_rit"></div>									
							</div>
							<div class="message_wrap">
								
								<div id="rit_msg">
								<?php
									  echo form_open('addtodiscussion',array('name' => 'adddiscussion' ,'id'=>'adddiscussion')); 
								 ?>
									<div class="sent-message">
                              
										  <div class="new-mess1">ADD PEOPLE</div>
										  
									 	 <div class="sent-message03">
										   <div class="sent-to">Name</div>
										   <div class="sent-toinn01">
										  	 <input type="text" class="to-input" name="name" id="name" value="<?php echo $name;?>">
										   
										   </div>
										    <div class="sent-to">Email </div>
										   <div class="sent-toinn01">
										  	 <input type="text" class="to-input" name="email" id="email" value="<?php echo $email;?>">
										   
										   </div>
										   <div class="sent-to">Select Place of Discussion</div>
										   <div class="sent-toinn01">
										   <?php echo $place;?>
										   </div>
										</div>
                                   
                              </div>
							  <div class="buttons">
							  	 <a href="javascript:void(0)" onclick="addToGroup();" class="add-btn">
								 ADD
								 </a>
								  
							  </div>
							   <div id="add_result">Added to POD...</div>
							    <div id="exist_result">Already added in the group</div>
							   <?php echo form_close(); ?>
								</div><!--rit_msg-->
							</div><!--message_wrap-->
						   
												
				</div><!--message-->
						  
		</div>
</div>

<!--<tellitize userlist pop up starts here...-->
<div id="userListPOD">
</div>

<!-- user exist list pop up-->
<div id="userExistPOD">
	<div  id="close_list" onclick="closePODexistlist();">
								<img src="<?php echo $GLOBALS['base_url']; ?>images/popup-close.jpg" alt="close"/>
	</div>
	<div style="padding:20px;"><p>A user with this name already exists.</p><!--A member with the name is already exist in the group-->
			<p>
				<!--<a href="javascript:void(0);" onclick="saveExistDiscussionUser()">Skip</a> to add as a new member.-->
				<a href="javascript:void(0);" onclick="saveExistDiscussionUser()">Add</a> name anyway or <a href="javascript:void(0);" onclick="searchUser()">Search</a> User List
			</p>
	</div>
</div>




