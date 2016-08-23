<?php require_once("includes/police.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/connectioni.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php confirm_user(); ?>
<?php $ses_user_id=$_SESSION['user_id'];?>

<?php
require_once("includes/update_user_setting.php");
?>
<?php require_once("includes/dashboard/profile_pic.php");?>

<?php require_once("includes/dashboard/header.php");?>

<div class="big_dash">	
			<!--navigation -->
			<nav class="left_side_menu">
			<?php #show selected category
			 admin_category_menu($ses_user_id);
			?>
			<?php admin_navi($ses_user_id); ?>
			<br>
			<?php $newbutton=add_subject_button();?>
			<?php echo $newbutton;?>
			</nav>			

			<!--<section id="main_section">-->
<!--Content Area Begin-->

<?php $userInfo =getUserData($ses_user_id); ?>

  <fieldset class="dark-css-form">
  <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/animations.js"></script>
 <h1 id="anim" >Edit your Profile</h1>
<div class="themeimg">
<blockquote>
"
<?php if(isset($userInfo['belief'])){
	echo strip_tags(nl2br(trim($userInfo['belief'])),"<a><li><br>");
	}else{
		echo"There is always another way to success, you just want to open the gates by yourself";
		}
?>	
"
</blockquote>
</div>
<div class="profileimg">
	<?php 
	show_profile_pic($ses_user_id);
	?>
</div>
<br>
 <form action="setting.php" method="post" enctype="multipart/form-data">
	 <label >
		<span>Profile Picture</span>
		<input id="picture" type="file" class="input" name="profile_pic">
		<input type="submit" id="pic_save" name="save" value="Save" class="usersettingbutton">
	 </label>
 </form>
<br>

 <form action="setting.php" method="post">
	 <label >
		<span>First Name</span>
		<input id="fnme" type="text" class="input" name="fnme" value="<?php if(isset($userInfo['fnme'])){echo trim($userInfo['fnme']);}else{echo "First Name";} ?>">
		<input type="submit" id="savefnme" name="Save" value="Save" class="usersettingbutton">
	 </label>
 </form>

 <form action="setting.php" method="post">
	 <label>
		<span>Last Name</span>
		<input id="lnme" type="text" class="input" name="lnme" value="<?php if(isset($userInfo['lnme'])){echo trim($userInfo['lnme']);}else{echo "Last Name";} ?>">
		<button id="savelnme" class="usersettingbutton">Save</button>
	 </label>
 </form>

<form action="setting.php" method="post">
 <label>
	<span>Birth Day</span>
	<input id="hbd" type="text" class="input" name="HBD" value="<?php if(isset($userInfo['HBD'])){echo $userInfo['HBD'];}else{echo "Birth Day";} ?>">
	<button id="savehbd" class="usersettingbutton">Save</button>
</label>
</form>

<form action="setting.php" method="post">
<label>
	<span>Your website</span>
	<input id="website" type="text" class="input" name="website" value="<?php if(isset($userInfo['website'])){echo trim($userInfo['website']);}else{echo "http://www.yourwebsite.com";} ?>">
	<button id="savewebsite" class="usersettingbutton">Save</button>
 </label>
</form>

<form action="setting.php" method="post">
 <label>
	<span>University</span>
	<input id="uni" type="text" class="input" name="university" value="<?php if(isset($userInfo['university'])){echo trim($userInfo['university']);}else{echo "university";} ?>">
	<button id="saveuniversity" class="usersettingbutton">Save</button>
 </label>
</form>

<form action="setting.php" method="post">
<label>
	<span>School</span>
	<input id="sch" type="text" class="input" name="school" value="<?php if(isset($userInfo['school'])){echo trim($userInfo['school']);}else{echo "school";} ?>">
	<button id="saveschool" class="usersettingbutton">Save</button>
 </label>
 </form>

<form action="setting.php" method="post">
 <label>
	<span>Belief</span>
	<textarea id="belief" class="input" name="belief" ><?php if(isset($userInfo['belief'])){echo strip_tags(nl2br(trim($userInfo['belief'])),"<a><li><br>");}else{echo"There is always another way to success, you just want to open the gates by yourself";}?></textarea>
	<button id="savebelief" class="usersettingbutton">Save</button>
 </label>
</form>

<form action="setting.php" method="post">
 <label>
	<span>About you</span>
	<textarea id="aboutme" class="input" name="aboutme"><?php if(isset($userInfo['about_me'])){echo  strip_tags(nl2br(trim($userInfo['about_me'])),"<a><li><br>");}else{echo"About you..";} ?></textarea>
	<button id="saveaboutme" class="usersettingbutton">Save</button>
 </label>
</form>

 </fieldset>	
<script type="text/javascript" src="js/usersetting.js"></script>
<!--Content Area Over-->
		</section>

			<aside id="side_news">
			</aside>

<?php require_once("includes/dashboard/footer.php");?>
