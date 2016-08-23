<?php
//require("constanti.php");
$connectioni = mysqli_connect('localhost','root',"",'bigcms');
if(!$connectioni){
	die("Error in connection : ".mysqli_connect_error());
}
?>
<?php
function email_availability($email){
global $connectioni;
$sql = "SELECT email FROM users WHERE email = '{$email}'";
$sql = mysqli_query($connectioni,$sql);
if(!$sql){
	die(mysqli_error($connectioni));
}
	if(mysqli_num_rows($sql)!=0){
		$result = "That email Already taken";
		return true;
	}else{
		return false;
	}
}

?>
<?php
if(isset($_POST['email'])){
	$email =$_POST['email'];
	if(!empty($email)){
		if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
			echo "That doesn't appear to be valid email..!";
		}elseif(email_availability($email)===true){
		echo "That email Already taken";
		return false;
		}else{
			echo "Valid email address..!";
		}
	}
}
?>