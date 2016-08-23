<?php require_once("includes/connection.php");?>
<?php require_once("includes/public_functions.php");?>			

			<?php include("includes/header.php");?><!--inside the big wrapper 1part -->
			<nav id="side_menu"><!--inside the big wrapper 2part -->
				
				<ul class="catnav">
				<?php 
				$query = "SELECT *"." ";
				$query.="FROM category"." ";
				$query.="ORDER BY id"." ";
				$query.="ASC ";
				
				$category_set = mysql_query($query,$connection);
				if(!$category_set){
						die(mysql_error());
				}else{
						while ($categoryTbl=mysql_fetch_array($category_set)){
						echo "<li><a href=\"\">{$categoryTbl['category']}</a></li>";						
									#inside while loop to categorytbl,now we start subjectstbl while loop
									$query="SELECT * FROM subjects"." ";
									$query.="WHERE category_id = ".$categoryTbl['id']." ";
									$query.=" ORDER BY position ASC ";
									$subject_set = mysql_query($query,$connection);
									if(!$subject_set){
										die(mysql_error());
									}else{
										echo "<ul class=\"subnav\">";
										while($subjectsTbl=mysql_fetch_array($subject_set)){
											echo "<li><a href=\"#\"> {$subjectsTbl['menu_name']} </a></li>";
											#inside while loop to subjectstbl,now we start pageTbl while loop
											$query="SELECT * FROM pages"." ";
											$query.="WHERE subject_id=".$subjectsTbl['id']." ";
											$query.=" ORDER BY position ASC ";
											$pages_set = mysql_query($query,$connection);
											if(!$pages_set){
												die(mysql_error());
											}else{
												echo "<ul class=\"pagenav\">";
												while($pagesTbl=mysql_fetch_array($pages_set)){
													echo "<li><a href=\"#\"> {$pagesTbl['menu_name']} </a></li>";
												}echo "</ul>"; #end of pagesTbl loop
											}#end of pagesTbl query confirmation

										}echo "</ul>"; #end of subjectsTbl loop
									}#end of subjectsTbl query confirmation
						}#end of categoryTbl loop
				}#end of categoryTbl query confirmation
				
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