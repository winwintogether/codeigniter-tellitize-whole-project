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

                 <table width="600" border="0" cellpadding="0" cellspacing="0" class="category_list_tbl">
				 
  <tr bgcolor="#FE9D00">
    <th scope="col"><div align="center">Category Name </div></th>
    <th scope="col"><div align="center">Category Description </div></th>
    <th scope="col"><div align="center">Update</div></th>
    <th scope="col"><div align="center">Delete</div></th>
  </tr>
    <?php $color="1"; ?>
  <?php foreach($cat_list as $lists) { 
  if($color%2==0)
  {
  $bg="#cccccc";
  }
  else
  {
  $bg="#ffffff";
  }
  ?>
  <?php echo  form_open("admin/category_update"); ?> <tr bgcolor='<?php echo $bg; ?>'>
      <td><div align="center"><input type="text" value="<?php echo $lists['cate_name'] ?>" name="cat_name_<?php echo $lists['cid'] ; ?>" style="border:none" /></div></td>
    <td><div align="center"><input type="text" value="<?php echo $lists['cate_description'] ?>" name="cat_desc_<?php echo $lists['cid'] ; ?>" style="border:none" /></div></td>
    <td><div align="center"><input type="submit" name="submit" value="Update" ><input type="hidden" name="cid" id="cid" value="<?php  echo $lists['cid'];?>" ></div></td>
    <td><div align="center"><input type="submit" name="delete" value="Delete" ><input type="hidden" name="cid" id="cid" value="<?php  echo $lists['cid'];?>" ></div></td>
	  </tr>

  <?php echo form_close(); ?>
  <?php $color++; } ?>
</table>
<p><?php if(isset($msg)) echo $msg; ?></p>
				  </div>
<p><a href="<?php echo base_url()."index.php/admin/category_management_preview"; ?>" class="link_admin">back</a></p>				  				  	
				</div>						
			</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>