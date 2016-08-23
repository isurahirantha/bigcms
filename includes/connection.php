<?php
require("constant.php");
$connection = mysql_connect(DB_SERVER,DB_USER,"");
if(!$connection){
	die("Could not connect to server:".mysqli_error());
}
$db_select = mysql_select_db(DB_NAME,$connection);
if(!$db_select){
	die("Could not connect to database:".mysqli_error());
}

?>
