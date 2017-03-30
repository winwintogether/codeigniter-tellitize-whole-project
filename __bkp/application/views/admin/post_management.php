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
					<span style="float:right;padding-right:100px;font-weight:bold">
						<a href="<?php echo base_url()."index.php/admin/words_management"; ?>">Manage words</a>
                        <span style="padding-left:20px;">
						<a href="<?php echo base_url()."index.php/admin/abuses_management"; ?>">Report Abuses</a>
					</span>
					</span>
				  </div>
				  <div class="admin_links">
<table width="494" border="0" cellpadding="0" cellspacing="0" class="post_managnt_tbl">
  <tr>
    <th width="175" scope="col">User's Name</th>
    <th width="203" scope="col">No.of Posts</th>
    <th width="94" scope="col">View Posts</th>
  </tr>
  <?php $color="1" ?>
  <?php foreach ($res as $list) { 
  if($color%2==0) { 
  $bg="#fff"; }
  else {
  $bg="#ccc"; }?>
  <?php echo  form_open("admin/view_posts"); ?>
  <tr bgcolor="<?php echo $bg; ?>">
    <td><div align="center"><?php echo $list['user_name']; ?></div></td>
    <td><div align="center"><?php echo $list['count(public_post.userid)']; ?></div></td>
    <td><div align="center"><input type="submit" name="delete" value="View post" ><input type="hidden" name="cid" id="cid" value="<?php echo $list['userid']; ?>" ></div></td>
  </tr>
  <?php echo form_close(); ?>
  <?php $color++; }?>
</table>

                 

				  </div>
<p><a href="<?php echo base_url()."index.php/admin/controlpanel"; ?>" class="link_admin">back</a></p>				  				  	
				</div>						
			</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>