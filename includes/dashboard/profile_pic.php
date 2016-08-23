<?php
//session_start();
$file_formats = array("jpg", "png", "gif", "bmp");
$ses_user_id=$_SESSION['user_id'];
$filepath = "usersfolder/user{$ses_user_id}/";

if (isset($_POST['save'])) {

 $name = $_FILES['profile_pic']['name']; // filename to get file's extension
 $size = $_FILES['profile_pic']['size'];
 
 if (strlen($name)) {
 	$extension = substr($name, strrpos($name, '.')+1);
 	if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
 		if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
 			$imagename = md5(uniqid() . time()) . "." . $extension;
 			$tmp = $_FILES['profile_pic']['tmp_name'];
 				if (move_uploaded_file($tmp, $filepath . $imagename)) {
 					//upload the file name to database
 					update_profile_pic($ses_user_id,$imagename);
 					redirect_to("setting.php");
 				} else {
 					echo "Could not move the file.";
 				}
 		} else {
 			echo "Your image size is bigger than 2MB.";
 		}
 	} else {
 			echo "Invalid file format.";
 	}
 } else {
 	echo "Please select image..!";
 }
 exit();
}
 
?>
