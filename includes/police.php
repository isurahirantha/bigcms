<?php 
session_start();

function login(){
	return isset($_SESSION['user_id']);
}

function confirm_user(){
	if(!login()){
		redirect_to("index.php");
	}
}

?>