<!--login.php-->
<?php session_start();?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php require_once("includes/connectioni.php");?>

<?php
if(isset($_POST['login'])&&isset($_POST['password'])){

	if(!empty($_POST['email'])&&!empty($_POST['password'])){
	$email = iescape($_POST['email']);
	$password = iescape($_POST['password']);

	$sql="SELECT id,fnme,lnme,email,hash_password FROM users WHERE email='{$email}' LIMIT 1";
	$sql=mysqli_query($connectioni,$sql);
		if(mysqli_num_rows($sql)==1){
				//login check
					while($usertbl = mysqli_fetch_assoc($sql)){

						if(password_verify($password,$usertbl['hash_password'])){
							$verified_userId=$usertbl['id'];
							$found_fname=$usertbl['fnme'];
							$found_lname=$usertbl['lnme'];
							$verified_user=$found_fname." ".$found_lname;
							$_SESSION['user_id']=$verified_userId;
							$_SESSION['username']=$verified_user;

							redirect_to("cms.php");
						}else{
						$lgnmsg ="SORRY,PASSWORD NOT EXSIST!<br>";
						$lgnmsg.="<a href='#' id=\"pw_reset\">I forgot my password</a>";
						}
					}//end while

		}else{//if no rows 
			$lgnmsg = "SORRY, USER DOES NOT EXSIST!<br>";
			$lgnmsg.="<a href='#' id=\"pw_reset\">I forgot my password</a>";
		}//
	}else{
		$lgnmsg ="ACCESS DENINED!<br>ENTER VALID PASSWORD AND EMAIL TO LOGIN..!<br>";
		$lgnmsg.="<a href='#' id=\"pw_reset\">I forgot my password</a>";
	}//if user inputs are empty


}//if ligin button clicked
?>
<?php
if(isset($_POST['emailcheck'])){
	$emailcheck=$_POST['emailcheck'];
	validate_email($emailcheck);
	if(email_availability($emailcheck)){
		$lgnmsg ="You can reset password";
		//codes to reset password goes here
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>User authentication section</title>
	 <link rel="stylesheet" href="cssheets/authenticate.css"/>
	 <link rel="stylesheet" href="cssheets/admincss.css"/>
	 <script type="text/javascript" src="js/jquery.js"></script>\
	 <script type="text/javascript">
	 $(document).ready(function(){
	 $("#pw_reset").click(function(){
	 	$("#pw_reset_form").fadeIn(-400);
	 	$("#login").fadeOut(-400);
	 });
	 $("#backtologin").click(function(){
	 	$("#login").fadeIn(-400);
	 	$("#pw_reset_form").fadeOut(-400);
	 });
	 });

	</script>
</head>
<body>
<div class="headerof_login">
<img src="imgs/Smiley-03-june.gif" width="50px" height="50px">
<?php
if(!empty($lgnmsg)){
	echo $lgnmsg;
}
?>
<?php if(isset($_GET['left'])){
	if($_GET['left']==1){
		echo "You are Logged out,<br>";
		echo "you are currently identified as : <strong>",getIp(),"</strong>";
		echo "<hr>";
		echo " please login to continue!";
	}
}elseif(!isset($lgnmsg)){
		echo "<h1>WELCOME TO BIGIMF</h1>";
	}
?>		
</div>	
<div class="maindiv">

				<fieldset class="dark-css" id="login">
				<h1>LOGIN</h1>
						<form id="login"action="login.php" method="post">
						<label>
						<span>User Email</span>
						<input id="" type="text" placeholder="email" name="email" required>
						</label>
						<label>
						<span>User Password</span>
						<input type="password" placeholder="password" name="password" required>
						</label>
						<label>
						<input type="submit" name="login" value="login" id="lgnbtn" class="button">
						</label>
						</form>
						<br>
						<button id="pw_reset" class="button">FORGOT PASSWORD</button>
				</fieldset>

				<fieldset class="dark-css" id="pw_reset_form">
				<h1>CHANGE PASSWORD</h1>
						<form id="login"action="login.php" method="post">
						<label>
						<span>User Email</span>
						<input id="" type="text" placeholder="email" name="emailcheck" required>
						</label>
						<label>
						<input type="submit" name="reset" value="RESET PASSWORD" id="resetbtn" class="button">
						</label>
						</form>
						<br>
						<button id="backtologin" class="button">back to login</button>
				</fieldset>
</div>
</body>
</html>