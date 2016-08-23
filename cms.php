<?php require_once("includes/police.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>
<?php confirm_user(); ?>
<?php $ses_user_id=$_SESSION['user_id'];?>
<?php require_once("includes/dashboard/header.php");?>
<?php
	 admin_url_intval_check($ses_user_id);
?>

<?php 
	find_selected_sid_pid($ses_user_id);
?>
			<?php #if user hasn't select a subject section
				  #and if user just slected a subject section
				  #then quickly update 'editor_preference' in usr table
				  insert_selected_editor_preference();?>
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

			<?php #check user alredy select a subject section
					if(allow()){
				  #and if not, then show select option form
					check_editors_preference();
					}

			?>
			
<!--Content Area Begin-->

			<?php if(!is_null($sel_pid)){?>

				<h1><?php echo strtoupper($sel_pid['menu_name']); ?></h1>
				<hr>
				<div class="content">
					<?php $contentString=$sel_pid['content'];?>
					<?php $content=getString($contentString); ?>
					<?php //$content=str_replace(array('♀','♂'), '', $content); ?>
					<?php echo nl2br($content); ?>

				<?php //echo nl2br($sel_pid['content']); ?>
				</div>


				<br>
				<?php if (!empty($sel_pid['youtube_link'])){
					echo "<div class=\"vedio\">", 
					strip_tags($sel_pid['youtube_link'],"<iframe></iframe><embed></embed>"),
					"</div>";} 
				?>
				<br>
				<div class='codes'>
				<?php if (!empty($sel_pid['source_code'])){
					echo "<code><pre>", $sel_pid['source_code'],"</pre></code>";} 
				?>
				</div>
				
				<div class="date"><?php echo $sel_pid['posted_date']; ?></div>

					<script type="text/javascript">
					function goto_url(){
						window.location="edit_page.php?pid= <?php echo $sel_pid['id']; ?>";
					}
					</script>
					<button class="button" onclick="goto_url();">Edit_page</button>	

				<?php }elseif(allow()===false){ ?>
				<h1><?php echo "Select page or subject to edit"; ?></h1>
				<?php }else{
					NULL;
				}
			?>

<!--Content Area Over-->
			</section>

			<aside id="side_news">
			</aside>

<?php require_once("includes/dashboard/footer.php");?>
		
