<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/admin-page.css" rel="stylesheet" />	
<div id="header">
<?php $this->load->view('header'); ?>
</div>

<div id="mid_container">
			<div class="mid_content">
				<div id="myprofile">
				  <div class="admin_logout"><a href="<?php echo base_url()."index.php/admin/logout" ?>">Logout</a></div>
				  <div class="admin_contents">
                    <h2>welcome admin</h2>	
				  </div>
				  <div class="admin_links">
                     <h4>Category management</h4>
	
					 
					 <table width="" border="0" class="category_management_tbl">
					 <?php echo form_open("admin/category_add"); ?>
  <tr>
    <td><label style="float:right">Category Name :</label></td>
    <td><?php echo form_input($cat_name); ?></td>
  </tr>
  <tr>
    <td><label style="float:right">Category Description :</label></td>
    <td><?php echo form_textarea($cat_description); ?></td>
  </tr>
  <tr>
   <input type="hidden" value="1" name="cat_status"/>
    <td colspan="2"><?php echo form_submit($submit); ?></td>
	</tr>
	<tr>
	  <td colspan="2"><p><?php echo $msg; ?></p></td>
    <?php echo form_close(); ?>

  </tr>
</table>
<p><a href="<?php echo base_url()."index.php/admin/category_management_preview"; ?>" class="link_admin">back</a></p>

				  </div>				  	
				</div>						
			</div>
</div>





<div id="footer">
<?php $this->load->view('footer'); ?>
</div>