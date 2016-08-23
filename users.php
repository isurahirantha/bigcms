


<?php require_once("includes/connectioni.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php url_intval_check(); ?>
<?php find_selected_cid_sid_pid(); ?>
<!--	
	global $sel_category_set;
	global $sel_subject_set;
	global $sel_page_set;
	these are global variables
-->


	<?php include("includes/header.php");?><!--inside the big wrapper 1part -->
	<nav id="side_menu"><!--inside the big wrapper 2part -->		
		<?php 
		# called by public_navigation()function
		echo public_navigation();
		#<ul class="subnav">
		#<ul class=\"pagenav\">
		?>		
	</nav>

<div id="user_main_section">				
<!-- ******************************************* -->
<?php
if(isset($_GET['id'])){
	check_url_id($_GET['id']);
}
$userid=$_GET['id'];
?>
<?php $userInfo =getUserData($_GET['id']); ?>
<div class="theme">
	<div class="photo_theme">
	<img src='usersfolder/user1/page1/5a75e57b2a194c6d5e3544f64cdd46a5.jpg' >
	</div>

	<div class="photo">
	<?php show_profile_pic($userid); ?>
	</div>
<p id="my_talk"> "<?php if(isset($userInfo['belief'])){echo strip_tags(nl2br(trim($userInfo['belief'])),"<a><li><br>");}else{echo NULL;}?>"<p>

<article id="ms_user">
<p id="title">First Name:<p>
<p id="content"><?php if(isset($userInfo['fnme'])){echo trim($userInfo['fnme']);}else{echo "First Name";} ?><p>
<br>
<p id="title">Last Name :<p>
<p id="content"><?php if(isset($userInfo['lnme'])){echo trim($userInfo['lnme']);}else{echo "Last Name";} ?><p>
<br>
<p id="title">Birth Day :<p>
<p id="content"><?php if(isset($userInfo['HBD'])){echo $userInfo['HBD'];}else{echo "Birth Day";} ?><p>
<br>
<p id="title">Website &nbsp;:<p>
<p id="content"><a href="<?php if(isset($userInfo['website'])){echo trim($userInfo['website']);}else{echo 'http://www.yourwebsite.com';} ?>">
<?php if(isset($userInfo['website'])){echo trim($userInfo['website']);}else{echo "http://www.yourwebsite.com";} ?></a><p>
<br>
<p id="title">University :<p>
<p id="content"><?php if(isset($userInfo['university'])){echo trim($userInfo['university']);}else{echo "university";} ?><p>
<br>
<p id="title">School &nbsp;:<p>
<p id="content"><?php if(isset($userInfo['school'])){echo trim($userInfo['school']);}else{echo "school";} ?><p>
<br>
<p id="title">Belief &nbsp;:<p>
<p id="content"> "<?php if(isset($userInfo['belief'])){echo strip_tags(nl2br(trim($userInfo['belief'])),"<a><li><br>");}else{echo NULL;}?>"<p>
</article>

<fieldset class="dark-css cssboder" >
<h1>Message to Editor / කර්තෘට ඔබේ අදහස් කියන්න </h1>
<form action="users.php" method="post" >
	<label>
		<span>Email</span>
		<input type="text" name="mail" id="mail" placeholder="your@mail.com" required>
	</label>
	<label>
		<span>Message</span>
		<textarea cols="30" rows="15" placeholder="your message"></textarea>
	</label>
	<label>
		<input type="submit" value="SEND" class="button">
	</label>
</form>
</fieldset>
</section>


<?php include("includes/thefooter.php");?>