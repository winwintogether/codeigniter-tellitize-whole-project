<link type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/functions/css/admin-page.css" rel="stylesheet" />	
<div id="header">
<?php $this->load->view('header');
$words_list=$this->admin_model->words_list_view();	  ?>
</div>

<div id="mid_container">
			<div class="mid_content">
				
				  <div class="admin_logout"><a href="<?php echo base_url()."index.php/admin/logout" ?>">Logout</a></div>
				  <div class="admin_contents">
                    <h2>welcome admin</h2>	
				  </div>
				  <div class="admin_links">
                  	<div id="admin_left" style="float:left;width:50%;">
                       <h4>Post management</h4>
                            
                                             
                        <table width="" border="0" class="category_management_tbl">
                             <?php echo form_open("admin/words_add"); ?>
                          <tr>
                            <td></td>
                            <td>Enter comma separated words</td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><?php echo form_textarea($words); ?></td>
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
                     </div>
                   <div id="admin_rit">
                   <?php echo $words_list; ?>
                   
                   </div>

		</div>	

                  <p><a href="<?php echo base_url()."index.php/admin/controlpanel"; ?>" class="link_admin">back</a></p>
              			  	
								
			
</div>


</div>


<div id="footer" style="clear:both">
<?php $this->load->view('footer'); ?>
</div>