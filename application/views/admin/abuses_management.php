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
				     <h4>Abused Posts</h4>
					
           <table width="734" border="0" border="0" cellpadding="0" cellspacing="0" class="post_managnt_tbl "> 
		  
  <tr>
    <th width="261" scope="col">Comments</th>
    <th width="151" scope="col">Posted on</th>
	<th width="133" scope="col">Posted By</th>
	<th width="161" scope="col">Delete Post</th>
  </tr>
   <?php $color="1"; ?>
   <?php foreach($result as $view) {
    if($color%2==0)
  {
  $bg="#fff";
  }
  else
  {
  $bg="#ccc";
  }
   ?>
   <?php echo  form_open("admin/abuse_delete"); ?>
  <tr bgcolor="<?php echo $bg; ?>">
    <td><?php echo $view['comment']; ?></td>
    <td><div align="center"><?php echo $view['post_date']; ?></div></td>
	<td><div align="center"><?php echo $view['name']; ?></div></td>
	<td><div align="center"><input type="submit" name="delete" value="Delete" ><input type="hidden" name="cid" id="cid" value="<?php echo $view['postid']; ?>" ><input type="hidden" name="viewid" id="viewid" value="<?php echo $view['userid']; ?>" ></div></td>
  </tr>
  <?php echo form_close(); ?> 
  <?php $color++; } ?>
</table>

					  
<p><a href="<?php echo base_url()."index.php/admin/post_management"; ?>" class="link_admin">back</a></p>

				  </div>				  	
				</div>						
			</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
