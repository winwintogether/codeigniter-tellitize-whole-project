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
				    <a href="<?php echo base_url()."index.php/admin/category_management"; ?>" class="link_admin">Add category</a>
					<a href="<?php echo base_url()."index.php/admin/category_list"; ?>" class="link_admin">List categories</a>

				  </div>
<p><a href="<?php echo base_url()."index.php/admin/controlpanel"; ?>" class="link_admin">back</a></p>				  				  	
				</div>						
			</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>