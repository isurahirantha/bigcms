<?php session_start(); ?> 
<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>			

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
		echo "<ul class=\"catnav\">";
			$category_set=get_all_category();
				while ($categoryTbl=mysql_fetch_array($category_set)){
				#we keep a categoryTbl category as a link, 
				#then we will be able to use it later to custermize navigation
					
					echo "<li><a href=\"index.php?cid=".urlencode($categoryTbl['id'])."  \">{$categoryTbl['category']}</a></li>";

						#inside while loop to categorytbl,now we start subjectstbl while loop
						$subject_set=get_all_subject_by_category_id($categoryTbl['id']);
						echo "<ul class=\"subnav\">";
						while($subjectsTbl=mysql_fetch_array($subject_set)){
							if($sel_category_set['id']==$categoryTbl['id']||$sel_subject_set['category_id']==$categoryTbl['id']){
							echo "<li><a href=\"index.php?sid=".urlencode($subjectsTbl['id'])."  \"> {$subjectsTbl['menu_name']} </a></li>";
							}
							#inside while loop to subjectstbl,now we start pageTbl while loop
								$pages_set=get_pages_for_subject_id($subjectsTbl['id']);
									echo "<ul class=\"pagenav\">";
									while($pagesTbl=mysql_fetch_array($pages_set)){

									if($sel_subject_set['id']==$subjectsTbl['id']||$sel_page_set['subject_id']==$subjectsTbl['id'])	{
									echo "<li><a href=\"index.php?pid=".urlencode($pagesTbl['id'])."  \"> {$pagesTbl['menu_name']} </a></li>";
									}

								}echo "</ul>"; #end of pagesTbl loop
							}echo "</ul>"; #end of subjectsTbl loop
						}#end of categoryTbl loop
				echo "</ul>";
				?>

				

<?php
				#<ul class="subnav">
				#<ul class=\"pagenav\">
?>
			</nav>

			<section id="main_section">

				<article id="ms_article">
					<header>
						<hgroup>
					<?php if(!is_null($sel_subject_set)){?>
					<h1><?php echo $sel_subject_set['menu_name'];?></h1>
					<?php }elseif(!is_null($sel_category_set)){?>
					<h1><?php echo $sel_category_set['category']; ?></h1>
					<?php }elseif(!is_null($sel_page_set)){?>
					<h1><?php echo $sel_page_set['menu_name']; ?></h1>
						</hgroup>
					</header>
					<p>
					<?php echo $sel_page_set['content']; ?>
					<?php }else{?>
					<h2>Select a Subject or page to edit</h2>
					<?php } ?>

					

					</p>
					<footer>
						<p><a href="#"></a></p>
					</footer>
				</article>	

				<article id="ms_article">
					<div class="form-comments">
							<?php 
							if(isset($sel_page_set['id'])){
								$sel_pid=$sel_page_set['id'];
							}else{
								$sel_pid=NULL;
							}
							?>
						<?php
							if(isset($sel_pid)){		
								echo "
								<form action='comments.php' method='post'>
								<h2>User Contributes:</h2>
								<lable>Your name:</lable>
								<input type='text' name='contributer'>
								<lable>Your Email:</lable>
								<input type='email' name='con_email'>
								<input type='hidden' name='sel_pid' value='$sel_pid'>
								<textarea class='commenttext' cols='85' rows='5' name='comment'></textarea>
								<input type='submit' name='submit'value='POST'>
								</form>
								";
							}
						?>
					</div>
				</article>
	
<?php 
					if(isset($sel_page_set['id'])){			

							$result_query=get_comments_by_pid($sel_page_set['id']);
							while($comment_results = mysql_fetch_array($result_query)){
							echo "
							<article id='ms_article'>
							<div class='form-comments-show'>
							";
							echo "<p><b>",$comment_results['contributer'],"</b></p>";
							echo "<p><blockquote>",$comment_results['comment'],"</blockquote></p>";
							echo "<p>",$comment_results['date'],"</p>";
							echo "
							</div>
							</article>	
							
							";
							}
						}//end comment
						 
?>
 </section>
<?php include("includes/side_news.php");?>
<?php include("includes/side_search.php");?>
<?php include("includes/thefooter.php");?>