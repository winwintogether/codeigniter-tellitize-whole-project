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
				     <h4>User details</h4>
                     <table width="800" border="0" style="border:1pt #ccc solid" class="user_details_tbl">
					
					
  <tr>
    <th scope="col">id</th>
    <th scope="col">email</th>
    <th scope="col">username</th>
    <th scope="col">name</th>
    <th scope="col">age</th>
    <th scope="col">location</th>
    <th scope="col">about me</th>
    <th scope="col">Registration date</th>
	<th scope="col">Delete User</th>
  </tr> <?php $color="1"; ?>
  <?php foreach ($res as $list) {   if($color%2==0)
  {
  $bg="#cccccc";
  }
  else
  {
  $bg="#ffffff";
  } ?>
  <?php echo  form_open("admin/delete_user"); ?>
  <tr bgcolor='<?php echo $bg; ?>' >
    <td><div align="center"><?php echo $list['userid'] ?></div></td>
    <td><div align="center"><?php echo $list['email'] ?></div></td>
    <td><div align="center"><?php if( $list['reg_status']==0 )echo $list['user_name'] ?></div></td>
    <td><div align="center"><?php echo $list['name'] ?></div></td>
    <td><div align="center"><?php echo $list['age'] ?></div></td>
    <td><div align="center"><?php echo $list['location'] ?></div></td>
    <td><div align="center"><?php echo $list['about_me'] ?></div></td>
    <td><div align="center"><?php $date=$list['reg_date'];
			$date=explode( '-', $date );
			$date=$date[1].'-'.$date[2].'-'.$date[0];echo $date; ?></div></td>
	<td><div align="center"><input type="submit" name="delete" value="Delete" ><input type="hidden" name="cid" id="cid" value="<?php echo $list['userid'] ?>" ></div></td>		
  </tr>
   <?php echo form_close(); ?> 
   <?php $color++; } ?>
  <?php  ?>
</table>
<p><a href="<?php echo base_url()."index.php/admin/controlpanel"; ?>" class="link_admin">back</a></p>

				  </div>				  	
				</div>						
			</div>
</div>

<div id="footer">
<?php $this->load->view('footer'); ?>
</div>
