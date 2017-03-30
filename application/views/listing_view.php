<?php //$path	= $_SERVER['DOCUMENT_ROOT']."/tellitize_new/application/";?>
<?php $path	= $_SERVER['DOCUMENT_ROOT']."/tellitize/application/";?>
<div>
<h4>Folder Listing</h4>
	<ul>
	<?php
		foreach($files as $files_folder)
		{
	?>
		<li>
			<?php 
				
				if(is_dir($path.$files_folder))
				{ 
			?>
				<a href="listing/subfolders/<?php echo $files_folder;?>"><?php echo $files_folder;?></a>	
			<?php		
				}
				else
				{
			?>
				<a href="listing/download_file/<?php echo $files_folder;?>"><?php echo $files_folder;?></a>
			<?php
				}
			?>
		</li>
	<?php } ?>
	</ul>
	<h4>File Upload</h4>
	<form name="uploadFileFrm" id="uploadFileFrm" action="<?php echo $GLOBALS['base_url'];?>/listing/upload_files" method="post" enctype="multipart/form-data">
		<input type="file" name="upload_file" id="upload_file">
		<input type="hidden" name="uploaded_path" value="<?php echo $uploaded_path;?>">
		<input type="submit" name="upload" id="upload" value="Upload">
	</form>
</div>