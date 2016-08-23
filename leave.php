<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php

//find session
	session_start();
//unset session
	$_SESSION[]=array();
//destroy session cookie
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()+(60*60*60*24*7),'/');
	}
//destroy session
	session_destroy();
//redirect to login page
	
		redirect_to("login.php?left=1");
	

?>