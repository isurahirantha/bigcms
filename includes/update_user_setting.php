<?php
if(isset($_POST['fnme'])){
	$fnme = $_POST['fnme'];
	if(isempty($fnme)===true){
		echo NULL;
	}else{
	$firstname = iescape(trim($_POST['fnme']));
	$column ="fnme";
	update_query($column,$firstname,$ses_user_id);
}
}
//
if(isset($_POST['lnme'])){
	$lnme = $_POST['lnme'];
	if(isempty($lnme)===true){
	echo NULL;
	}else{
	$lastname = iescape(trim($_POST['lnme']));
	$column ="lnme";
	update_query($column,$lastname,$ses_user_id);
}
}
//
if(isset($_POST['hbd'])){
	$hbd = $_POST['hbd'];
	if(isempty($hbd)===true){
	echo NULL;
	}else{
	$hbd = $_POST['hbd'];
	$column ="HBD";
	update_query($column,$hbd,$ses_user_id);
}
}
//
//
if(isset($_POST['website'])){
	$website = $_POST['website'];
	if(isempty($website)===true){
	echo NULL;
	}else{
	$website = iescape(trim($_POST['website']));
	$column ="website";
	update_query($column,$website,$ses_user_id);
}
}
//
if(isset($_POST['university'])){
	$university = $_POST['university'];
	if(isempty($university)===true){
		echo NULL;
	}else{
	$university = iescape(trim($_POST['university']));
	$column ="university";
	update_query($column,$university,$ses_user_id);
}
}
//
if(isset($_POST['school'])){
	$school = $_POST['school'];
	if(isempty($school)===true){
		echo NULL;
	}else{
	$school = iescape(trim($_POST['school']));
	$column ="school";
	update_query($column,$school,$ses_user_id);
}
}
//
if(isset($_POST['belief'])){
	$belief = $_POST['belief'];
	if(isempty($belief)===true){
		echo NULL;
	}else{
	$belief = iescape(trim($_POST['belief']));
	$column ="belief";
	update_query($column,$belief,$ses_user_id);
}
}
//
if(isset($_POST['aboutme'])){
	$aboutme = $_POST['aboutme'];
	if(isempty($aboutme)===true){
		echo NULL;
	}else{
	$aboutme = iescape(trim($_POST['aboutme']));
	$column ="about_me";
	update_query($column,$aboutme,$ses_user_id);
}
}
?>