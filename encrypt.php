<?php
function encrypte($value){
	$value =$value." "."useriswin";
	$value =bin2hex($value);
	$value = hash('adler32', $value);
	return $value;
}
function encrypte_b($value){
	$value =$value." "."useriswin";
	$value =bin2hex($value);
	$value = hash('crc32', $value);
	return $value;
}
function encrypte_c($value){
	$value =$value." "."useriswin";
	$value =bin2hex($value);
	$value = hash('sha1', $value);
	return $value;
}
function encrypte_d($value){
	$value =$value." "."useriswin";
	$value =bin2hex($value);
	$value = hash('md5', $value);
	return $value;
}
function urlenco($id){
	$value =sqrt($id);
	$value = $value*1992;
	return $value;
}
function urldico($id){
	$id =$id/1992;
	$value =$id * $id;
	return $value;
}
$id=12;
$dic=urlenco($id);
echo urlencode($dic);
echo "<br>";
echo urldico($dic);
echo "<br>";
echo "<h1> ENCRIPTIONS php </h1>";

$pass = "dreamman1992";
echo $pass,' <b>adler32</b>:<br>';
$start = microtime(true);
$value=encrypte($pass);
echo $value;
$end = microtime(true);
$execution_time = $end-$start;
echo "<br>";
echo "execution_time  &#9829; : ",$execution_time," seconds";
echo "<hr>";
//echo "execution_time Cussing &#9829; : ",sprintf("%.6f",$execution_time)," seconds";
//echo "<hr>";
//echo "execution_time Cussing &#9829; : ",sprintf("%.9f",$execution_time)," seconds";
//echo "<hr>";

$pass = "dreamman1992";
echo $pass,' <b>crc32</b>:<br>';
$start = microtime(true);
$value=encrypte_b($pass);
echo $value;
$end = microtime(true);
$execution_time = $end-$start;
echo "<br>";
echo "execution_time  &#9829; : ",$execution_time," seconds";
echo "<hr>";

$pass = "dreamman1992";
echo $pass,' <b>sha1</b>:<br>';
$start = microtime(true);
$value=encrypte_c($pass);
echo $value;
$end = microtime(true);
$execution_time = $end-$start;
echo "<br>";
echo "execution_time  &#9829; : ",$execution_time," seconds";
echo "<hr>";

$pass = "dreamman1992";
echo $pass,' <b>md5</b>:<br>';
$start = microtime(true);
$value=encrypte_d($pass);
echo $value;
$end = microtime(true);
$execution_time = $end-$start;
echo "<br>";
echo "execution_time  &#9829; : ",$execution_time," seconds";
echo "<hr>";

echo "<h1> ENCRIPTIONS latest 5.5php </h1>";

$start = microtime(true);
$valuee = password_hash($pass,PASSWORD_DEFAULT);
$end = microtime(true);
echo $pass,"<br>";
echo "passoword_hash():- ", $valuee;
echo "<br> password_verify():";
if(password_verify($pass,$valuee)){
	echo "-matched<br>";
}else{
	echo "-not matched<br>";
}
echo "execution_time  &#9829: ",$end-$start," seconds<hr>";

    $size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
    $iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
    echo "<br><b>size</b>:<br>:  mcrypt_get_iv_size ",$size,"<br><b>iv</b>:<br>:  mcrypt_create_iv:  ",$iv; 
?>
<?php
/**
 * This code will benchmark your server to determine how high of a cost you can
 * afford. You want to set the highest cost that you can without slowing down
 * you server too much. 8-10 is a good baseline, and more is good if your servers
 * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
 * which is a good baseline for systems handling interactive logins.
 */
echo "<hr>";
$timeTarget = 0.05; // 50 milliseconds 

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Appropriate Cost Found: " . $cost . "\n";
?> 