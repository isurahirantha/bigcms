<?php
require("constanti.php");
$connectioni = mysqli_connect(DB_SERVERi,DB_USERi,"",DB_NAMEi);
if(!$connectioni){
	die("Error in connection : ".mysqli_connect_error());
}
?>