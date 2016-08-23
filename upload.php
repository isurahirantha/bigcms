<?php
session_start();
$file_formats = array("jpg", "png", "gif", "bmp");
$ses_user_id=$_SESSION['user_id'];
$filepath = "usersfolder/user{$ses_user_id}/page{$ses_user_id}/";

if ($_POST['submitbtn']=="Submit") {

 $name = $_FILES['imagefile']['name']; // filename to get file's extension
 $size = $_FILES['imagefile']['size'];
 
 if (strlen($name)) {
 	$extension = substr($name, strrpos($name, '.')+1);
 	if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
 		if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
 			$imagename = md5(uniqid() . time()) . "." . $extension;
 			$tmp = $_FILES['imagefile']['tmp_name'];
 				if (move_uploaded_file($tmp, $filepath . $imagename)) {
 					upload_profilepic($ses_user_id,$imagename);
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
