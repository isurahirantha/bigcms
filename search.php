<?php require_once("includes/connectioni.php");?>
<?php
if(isset($_POST['string'])&&!empty($_POST['string'])){

	$keyword = $_POST['string'];

	$sql="SELECT id, menu_name,keyword, content FROM pages WHERE menu_name LIKE '%$keyword%' OR content LIKE '%$keyword%' OR keyword LIKE '%$keyword%' ORDER BY id LIMIT 5";
	$sql = mysqli_query($connectioni,$sql);
	if(!$sql){
		die(mysqli_error($connectioni));
	}
	if(mysqli_num_rows($sql)!=0){
		while($rows = mysqli_fetch_array($sql)){
			echo "<span>",$rows['id'],"<br>";
			//$url ="http://127.0.0.1/xampp/";
			echo $rows['keyword']," <br> ";
			echo $rows['menu_name'],"<br>";
			echo $rows['content'],"<br></span>";
		}
	}
}

?>