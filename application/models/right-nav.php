<style type="text/css">
#mid_container #discussion ul.discussions li.discussion:hover{
	
	height:25px;
}
</style>
<div class="rit">
					<div class="group_user">
					<?php if(isset($_SESSION['userid'])) { ?>
					
						<div id="discussion">
							<div class="top_bar"><span class="discussion_hed">Places of Discussion</span></div>
							<ul class="discussions">
								<?php  if(isset($place_list)) echo $place_list; ?>
								
								<div style="float:right;margin-top:10px">
								<a href="<?php echo $GLOBALS['base_url']; ?>discussionplace"><img width="45" height="19" alt="add" src="<?php echo $GLOBALS['base_url']; ?>images/add-btn.jpg"></a>
								<?php
								if($place_list!=''){
								?>
								<a href="<?php echo $GLOBALS['base_url']; ?>addtodiscussion"><img width="69" height="19" alt="add-people" src="<?php echo $GLOBALS['base_url']; ?>images/add-people.jpg"></a>
								<?php }?>
								</div>
							</ul>
							<div class="top_bar" style="margin-top:7px;"><span class="discussion_hed">Categories</span></div>
							
							<ul class="discussions">
								<?php if(isset($category_list)) echo $category_list; ?>
							</ul>
							<div class="top_bar" style="margin-top:7px;"><span class="discussion_hed">Group</span></div>
							<ul class="discussions">
								<?php if(isset($group_list)) echo $group_list; ?>
								<div style="float:right;margin-top:10px;">
									<a href="<?php echo $GLOBALS['base_url']; ?>group" ><img width="45" height="19" alt="add" src="<?php echo $GLOBALS['base_url']; ?>images/add-btn.jpg"></a>
									<?php
									if($group_list!=''){
									?>
									<a href="<?php echo $GLOBALS['base_url']; ?>addtogroup"><img width="69" height="19" alt="add-people" src="<?php echo $GLOBALS['base_url']; ?>images/add-people.jpg"></a>
									<?php }?>
								</div>
							</ul>
						</div>
					<?php
					
					}
					else{
					?>
							
									<img width="188" height="285" alt="img-groups" src="<?php echo $GLOBALS['base_url']; ?>images/left-men-img.jpg">
							</div>
							<a href="<?php echo $GLOBALS['base_url']; ?>signup" ><div class="join_free"></div></a>
							<div class="about">
								
								<span class="Black">About</span>
								<span class="orange">Tellitize</span>
								<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
								Vestibulum quis ligula id sem semper posuere. Nunc cursus venenatis lacus, eu pulvinar arcu ornare id.
								 Sed in posuere mi. Fusce eu faucibus nunc. 
								 Aliquam tortor urna, tincidunt in vulputate vitae, malesuada condimentum nisi. 
								 Ut ligula nulla, tincidunt vitae vestibulum ac, pulvinar quis eros. Donec arcu mauris, sodales at sollicitudin quis, pulvinar ut felis. 
								 Aenean pharetra, nisi at rutrum dictum, tortor nisi faucibus lorem, a facilisis nisl purus et neque.</div>
		
		<?php } ?>
							</div>
							</div>

<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/group.js" type="text/javascript"> </script>