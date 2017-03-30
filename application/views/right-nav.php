<style type="text/css">
#mid_container #discussion ul.discussions li.discussion:hover{
	
	height:25px;
}
</style>
<?php
	if(isset($_SESSION['userid']))	{	
			$group_list = $this->myprofile_model->getgroupList($_SESSION['userid']);
			$place_list = $this->home_model->getPlaceList();
			}	
	$category_list = $this->home_model->getCategoryList();
	
	if(isset($_SESSION['userid']))	{		
?>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/tooltip/jquery-1.8.3.js"></script>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/tooltip/jquery-ui.js"></script>
<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/tooltip/jquery-ui.css" rel="stylesheet" />
<script>
$(function() {
	$( document ).find('.tooltip_div').tooltip({
      position: {
        my: "center bottom-20",
        at: "right+20",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
           	.addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  });
</script>
<style>
  .ui-tooltip, .arrow:after {
    background: #443F3C;
    border: 1px solid white;
  }
  .ui-tooltip {
    color: white;
    font: 11px Arial;
    box-shadow: 0 0 7px black;
	width:200px;
  }
</style>
<?php
}
?>
<div class="rit">
					<div class="group_user">
					  <?php if(isset($_SESSION['userid'])) { ?>
					
						<div id="discussion">
							<div class="top_bar">
								<span class="discussion_hed">Places of Discussion</span>
								<?php
									$title = "Here at Tellitize, you may add your High School, Employer, or any other place that your daily life consist of. We have termed these as Places of Discussions (PODS). Groups may also be added. A group is anything that cannot be classifed as a Place. Such as a belief or organization.
In each Group or POD you add, you may also add names of people that you know whom are associated with that Group or POD. You may Tellitize them from within the Groups and PODS. Emails will be generated to them if you know their email address. Also, when a person with the same name joins Tellitize, it will ask them if they are associated with they Group or POD and they have the ability to Join as well. You will be alerted by email when this occurs. ";
								?>
								<div class="tooltip_div">
									<img src="<?php echo $GLOBALS['base_url']; ?>images/help.png" title="<?php echo $title;?>">
								</div>
							</div>
							<ul class="discussions">
									<?php  if(isset($place_list)) echo $place_list; ?>
                                    
                                    <div style="float:right;margin-top:10px">
                                    <a href="<?php echo $GLOBALS['base_url']; ?>discussionplace">
                                    <img width="45" height="19" alt="add" src="<?php echo $GLOBALS['base_url']; ?>images/add-btn.jpg"></a>
                                    <?php
                                    if($place_list!=''){
                                    ?>
                                    <a href="<?php echo $GLOBALS['base_url']; ?>addtodiscussion">
                                    <img width="69" height="19" alt="add-people" src="<?php echo $GLOBALS['base_url']; ?>images/add-people.jpg"></a>
                                    <?php }?>
                                    </div>
							</ul>
							<div class="top_bar" style="margin-top:7px;"><span class="discussion_hed">Categories</span></div>
							
							<ul class="discussions">
								<?php if(isset($category_list)) echo $category_list; ?>
							</ul>
							<div class="top_bar" style="margin-top:7px;">
								<span class="discussion_hed">Group</span>
								<div class="tooltip_div">
									<img src="<?php echo $GLOBALS['base_url']; ?>images/help.png" title="<?php echo $title;?>">
								</div>
							</div>
							<ul class="discussions">
								<?php if(isset($group_list)) echo $group_list; ?>
								<div style="float:right;margin-top:10px;">
									<a href="<?php echo $GLOBALS['base_url']; ?>group" >
                                    <img width="45" height="19" alt="add" src="<?php echo $GLOBALS['base_url']; ?>images/add-btn.jpg"></a>
									<?php
									if($group_list!=''){
									?>
									<a href="<?php echo $GLOBALS['base_url']; ?>addtogroup">
                                    <img width="69" height="19" alt="add-people" src="<?php echo $GLOBALS['base_url']; ?>images/add-people.jpg"></a>
									<?php }?>
								</div>
							</ul>
						</div>
                       
					<?php
					
					}
					else{
					?>
							
									<img width="188" height="210" alt="img-groups" src="<?php echo $GLOBALS['base_url']; ?>images/left-men-img.jpg">
							<div style="width:195px;">
                            <div class="top_bar category">
                                    <span class="discussion_hed">Categorize your Messages </span>
                             </div>
                            <ul class="catList">
                                    <?php if(isset($category_list)) echo $category_list; ?>
                            </ul>
                      </div>
							<a href="<?php echo $GLOBALS['base_url']; ?>signup" ><div class="join_free"></div></a>
							<div class="about">
								
								<span class="Black">About</span>
								<span class="orange">Tellitize</span>
								<div class="small_rit_nav_txt">Everyone's day usually consists of other people, places, and a host of topics. <br/> <br/> Here at TelliTize, you may speak your mind about these people and places. You can post as YOURSELF or ANONYMOUSLY so that nobody will ever know who created the post. Constructive criticism is sometimes very productive and we intend our website to help people be the best they can be. They may not realize they are doing things wrong. Whether it be in the workplace, or in everyday life. Let's bring their shortcomings and strong points to light so they can see their public perception. . TelliTize somebody today! 
                           
							</div>
                            
							</div>
                       
                      
		
		<?php } ?>
        </div>
</div>
<script src="<?php echo $GLOBALS['base_url']; ?>/functions/javascript/group.js" type="text/javascript"> </script>