<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>			

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
					

					</p>
					<footer>
						<p><a href="#"></a></p>
					</footer>
				</article>				
			</section>

<?php include("includes/side_news.php");?>
<?php include("includes/side_search.php");?>
<?php include("includes/thefooter.php");?>