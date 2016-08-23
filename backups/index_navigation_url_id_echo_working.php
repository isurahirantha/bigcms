<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>			



<?php
if(isset($_GET['sid'])){
	$sel_sid = $_GET['sid'];
	$sel_pid =NULL;
	$sel_cid =NULL;
}elseif(isset($_GET['pid'])){
	$sel_pid = $_GET['pid'];
	$sel_sid =NULL;
	$sel_cid =NULL;
}elseif(isset($_GET['cid'])){
	$sel_cid = $_GET['cid'];
	$sel_sid =NULL;
	$sel_pid =NULL;
}else{
	$sel_cid =NULL;
	$sel_sid =NULL;
	$sel_pid =NULL;
}
#must make none selected variable to NULL,
#otherwise below display codes not work properly
#bcoz argument is (is_null)..OK!
?>


			<?php include("includes/header.php");?><!--inside the big wrapper 1part -->
			<nav id="side_menu"><!--inside the big wrapper 2part -->
				
				<ul class="catnav">
				<?php 
					$category_set=get_all_category();
						while ($categoryTbl=mysql_fetch_array($category_set)){
							#we keep a categoryTbl category as a link, 
							#then we will be able to use it later to custermize navigation
						echo "<li><a href=\"index.php?cid=".urlencode($categoryTbl['id'])."  \">{$categoryTbl['category']}</a></li>";						
									#inside while loop to categorytbl,now we start subjectstbl while loop
										$subject_set=get_all_subject_by_category_id($categoryTbl['id']);
										echo "<ul class=\"subnav\">";
										while($subjectsTbl=mysql_fetch_array($subject_set)){
											echo "<li><a href=\"index.php?sid=".urlencode($subjectsTbl['id'])."  \"> {$subjectsTbl['menu_name']} </a></li>";
											#inside while loop to subjectstbl,now we start pageTbl while loop
												$pages_set=get_pages_for_subject_id($subjectsTbl['id']);
												echo "<ul class=\"pagenav\">";
												while($pagesTbl=mysql_fetch_array($pages_set)){
													echo "<li><a href=\"index.php?pid=".urlencode($pagesTbl['id'])."  \"> {$pagesTbl['menu_name']} </a></li>";
												}echo "</ul>"; #end of pagesTbl loop
										}echo "</ul>"; #end of subjectsTbl loop
						}#end of categoryTbl loop
				
				?>

				</ul>

<?php
				#<ul class="subnav">
				#<ul class=\"pagenav\">
?>
			</nav>

			<section id="main_section">

				<article id="ms_article">
					<header>
						<hgroup>
							<h1></h1>
							<h2></h2>
						</hgroup>
					</header>
					<p>
					<?php if(!is_null($sel_sid)){?>
					<h1><?php echo $sel_sid;?></h1>
					<?php }elseif(!is_null($sel_cid)){?>
					<h1><?php echo $sel_cid; ?></h1>
					<?php }elseif(!is_null($sel_pid)){?>
					<h1><?php echo $sel_pid; ?></h1>
					<?php }else{?>
					<h2>Select a Subject or page to edit</h2>
					<?php } ?>
					</p>
					<footer>
						<p><a href="#"></a></p>
					</footer>
				</article>				
			</section>


<?php include("includes/side_news.php");?>
<?php include("includes/side_search.php");?>
<?php include("includes/thefooter.php");?>