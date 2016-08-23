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
	<?php get_selected_voted();?>
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
							#contributers form
							if(isset($sel_pid)){echo contributes($sel_pid);}
						?>
					</div>
				</article>
			<?php 
					$commenter_ip=getIp();
					if(isset($sel_page_set['id'])){			

							$result_query=get_comments_by_pid($sel_page_set['id']);
							while($comment_results = mysql_fetch_array($result_query)){
							echo "<article class='comment_article'>";
							echo "<div class='main'>";
						#here we show comments commenter's name date
							echo "<u><b><p>",$comment_results['contributer'],"</p></b></u>";
							echo "<p>",strip_tags(nl2br($comment_results['comment']),"<ul><li><a><b><u><table><tr><th><td>"),"</p>";
							echo "<p>",$comment_results['date'],"</p>";
							echo "</div>";
						#here we show count of like and dislikes
							echo "<div>";
							$comment_id=$comment_results['id'];
							echo "Likes:<span>&nbsp;&nbsp;",show_user_likes($comment_id),"&nbsp;&nbsp;</span>";
							echo "&nbsp;&nbsp;Dislikes:<span>&nbsp;&nbsp;",show_user_likesAND_delt_above_five_dislike($comment_id),"&nbsp;&nbsp;</span>";
							echo "</div>";
						#A form with, jqery dislike and like button, send comment id to comments.php and if dislikes==10, related comment will automatically deleted.
						#here is the like dislike radio button form
						if(isset($commenter_ip)){
								$sel_pid=$sel_page_set['id'];
							echo "<div>
									<form action='index.php?pid=$sel_pid' method='post'>
									Like:<input type ='radio' name='votes' value='likes'>
									Dislike:<input type ='radio' name='votes' value='dislikes'>
									<input type ='hidden' name='commenter_ip' value='$commenter_ip'>
									<input type ='hidden' name='comment_id' value='$comment_id'>
									<input type ='submit' name='submit' value='submit'>
									</form>
								</div>";
						}
						#end of the like dislike radio button form
							echo "</article>";
							}
						}//end comment
						 
			?>
 </section>

<?php include("includes/side_news.php");?>
<?php include("includes/side_search.php");?>
<?php include("includes/thefooter.php");?>