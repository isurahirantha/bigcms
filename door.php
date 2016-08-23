<?php require_once("includes/connectioni.php");?>

<?php 
$city = "'s Hertogenbosch";
function escape($value){
	global $connectioni;
		$magic_quote_active = get_magic_quotes_gpc();
		$version_check = function_exists("mysqli_real_escape_string");

		if($version_check){
				if($magic_quote_active){
					$value = stripslashes($value);
				}
			$values = mysqli_real_escape_string($connectioni,$value);
		}else{
			if(!$magic_quote_active){
				$value = addslashes($value);
			}
		}
		return $value;
}
?>
in the time i was using mysql_real_escape_string() function with this function i could insert strings that has quotes(') , to the mysql database.
but PHP Version 5.5 there is no get_magic_quotes_gpc() function, As well as now i can't insert strings that has quotes(') , to the mysql database with above escape() function.

When I try to print values using my escape() function, it outputs 's Hertogenbosch
<?php
echo  escape($city); // prints 's Hertogenbosch
?>

and When I try to print same variable using mysqli_real_escape_string() function, it outputs \'s Hertogenbosch
<?php
echo  mysqli_real_escape_string($connectioni,$city); // prints \'s Hertogenbosch
?>
I need a way to check the php version and use the suitable function..help me..