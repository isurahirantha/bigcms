<?php require_once("includes/police.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php confirm_user(); ?>
<?php $ses_user_id=$_SESSION['user_id'];?>
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

			<section id="main_section">
<!--Content Area Begin-->

	<h1><?php echo "HEllo, ", $_SESSION['username'], "!<br> WELCOME TO OUR HELP DESK";?></h1>

<!--Content Area Over-->
			</section>

			<aside id="side_news">

			</aside>

<?php require_once("includes/dashboard/footer.php");?>