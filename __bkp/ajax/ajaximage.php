<?php
require('config.php');
session_start();
$path = "uploads/";
$imag_path=$base_url."ajax/".$path;

	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","JPG","PNG","GIF","BMP");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
					if($size<(1024*1024))
						{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
								mysql_query("UPDATE users SET  	profile_img='$actual_image_name' WHERE userid='".$_SESSION['userid']."'");
									
									echo "<img src='".$imag_path.$actual_image_name."'  class='preview'>"; 
								}
							else
								echo "failed";
						}
						else
						echo "Image file size max 1 MB";					
						}
						else
						echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
?>