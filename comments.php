<!--just a programme-->
<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>	
<?php
if(isset($_POST['contributer'])){
	$com_error = array();
	$com_fields = array("contributer","con_email","comment");
	foreach($com_fields as $required_com_fields){
		if(empty($_POST[$required_com_fields])){
			$com_error[]=$_POST[$required_com_fields]."Field Empty";
		}
	}
	if(filter_var($_POST['con_email'],FILTER_VALIDATE_EMAIL)===false){
		$com_error[]=$_POST['con_email']."Is Not A Valied Email";
	}


		#if error occured
		if(!empty($com_error)){
			redirect_to("index.php?pid=".$_POST['sel_pid']."");//if there will not be a sel_pid;) ;) pajathai neda. so redirct_to() default value eka..
		}else{
			#if No error occured
			$contributer=escape($_POST['contributer']);
			$con_email =escape($_POST['con_email']);
			$comment =escape($_POST['comment']);
			$page_id = $_POST['sel_pid'];
			$date = date("Y-m-d");



			$query="INSERT INTO contributes(
				page_id, comment, contributer_email , contributer, date
				)VALUES(
				{$page_id}, '{$comment}', '{$con_email}', '{$contributer}', '{$date}'
				) ";
			$query = mysql_query($query,$connection);
			confirm_query($query);
			redirect_to("index.php?pid=".$_POST['sel_pid']."");

		}


}
$ip=getIp();
$name = gethostbyaddr($ip);
echo "Hello <b>",$name,"<br>From:",$ip,"</b>";
echo "<br>you will be redirected.<br>Please Wait....";
echo"<meta http-equiv=\"Refresh\" content=\"5;url=index.php\" />";
?>

<?php 
	mysql_close($connection);
?>