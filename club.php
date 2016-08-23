<?php require_once("includes/police.php");?>
<?php require_once("includes/connectioni.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php confirm_user(); ?>
<?php $ses_user_id=$_SESSION['user_id'];?>
<?php $username=$_SESSION['username'];?>

<?php if(isset($_POST['submit'])){insert_user_post($ses_user_id,$username);} ?>
<?php if(isset($_POST['reply'])){insert_post_replies($username,$ses_user_id);}?>

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
<!-- ******************************************* -->

<div class="theme">

	<div class="photo_theme">
	<img src='usersfolder/user1/page1/theme.jpg' width='795px' height='200px'>
	</div>

	<div class="photo">
	<img src='usersfolder/user1/page1/5a75e57b2a194c6d5e3544f64cdd46a5.jpg' width='200px' height='200px'>
	</div>

			<div class="welcome_msg">
			<?php
			$userdata=getUserData($ses_user_id);
			echo nl2br(htmlentities($userdata['belief']));
			?>
			</div>

		<form action="club.php?id=<?php echo urlencode($ses_user_id);?>" method="post">
		<label>
		<span>Speak to your friends:</span>
			<textarea id="post" placeholder='what is on your mind?' name="posttext"></textarea></br>
			<span>&nbsp;</span>
			<input id="postbtn" type="submit" name="submit" value="post">
		</label>
		<script type="text/javascript">
			$("#postbtn").click(function(){
				var text = $("#post").val();
				if(text==""){
					alert('Form should not be empty');
					return false;
				}
			});
		</script>
		</form>

			
			<?php

			$public=false;
			get_post($ses_user_id,$public=false);

			?>
		<script type="text/javascript">
		$("#replybtn").click(function(){
			var reptext = $("#replytext").val();
			if(reptext==""){
				alert('Reply Form should not be empty');
				return false;
			}
		});
		</script>
			

</div>
<aside class="side">
	side news
</aside>

<?php require_once("includes/dashboard/footer.php");?>