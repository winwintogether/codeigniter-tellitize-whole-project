<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/admin-page.css" rel="stylesheet" />	
<div id="header">
<?php $this->load->view('header'); ?>
</div>


<div id="mid_container">
			<div class="mid_content">
				<div id="myprofile">
				  <div class="admin_logout"><a href="<?php echo base_url()."index.php/admin/logout"; ?>">Logout</a></div>
				  <div class="admin_contents">
                    <h2>welcome admin</h2>	
				  </div>
				  <div class="admin_links">
				    <a href="<?php echo base_url()."index.php/admin/user_management"; ?>" class="link_admin">User Management</a>
					<a href="<?php echo base_url()."index.php/admin/post_management"; ?>" class="link_admin">Post Management</a>
					<a href="<?php echo base_url()."index.php/admin/category_management_preview"; ?>" class="link_admin">Category Management</a>
				  </div>				  	
				</div>						
			</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>