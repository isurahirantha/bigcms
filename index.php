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
		# called by public_navigation()function
		echo public_navigation();
		#<ul class="subnav">
		#<ul class=\"pagenav\">
		?>		
	</nav>

<section id="main_section">

			<article id="ms_article">

				<?php 
				if(!is_null($sel_page_set)){?>

					<h1><?php echo strtoupper($sel_page_set['menu_name']); ?></h1>

					<div class="content">
					<?php $contentString=$sel_page_set['content'];?>
					<?php $content=getString($contentString); ?>
					<?php //$content=str_replace(array('♀','♂'), '', $content); ?>
					<?php echo nl2br($content); ?>
					<?php //echo nl2br($sel_page_set['content']); ?>
					</div>
 
					<?php if(!empty($sel_page_set['youtube_link'])){
					echo "<div class='vedio'>", strip_tags($sel_page_set['youtube_link'],"<iframe></iframe><embed></embed>"),"</div>";}
					?>
					<div class='codes'>
					<?php if(!empty($sel_page_set['source_code'])){
					echo "<pre>",wordwrap($sel_page_set['source_code']),"</pre>";}
					?>
					</div>
					<div class="date"><small>
					කර්තෘ:&nbsp;<a href='users.php?id=<?php echo urlencode($sel_page_set['user_id']);?>'>
					<?php echo $sel_page_set['editor']; ?></a>
					<br>
					<?php echo "පල කළේ:&nbsp;", $sel_page_set['posted_date']; ?>
					</small></div>
					


					<!--hell-->
					
					<?php }elseif(!is_null($sel_category_set)){?>
					<h1><?php echo $sel_category_set['category'];?></h1>
					<div class="content"><?php echo $sel_category_set['about']; ?></div>
					<?php if(!empty($sel_page_set['youtube_link'])){
					echo "<div class='vedio'>", $sel_page_set['youtube_link'],"</div>";}
					?>

					<!--hell-->

					<?php }else{?>
					<?php NULL; ?>
				<?php } ?>


			</article>	
				<!--nsert contributes form-->
				<?php validate_votes();?>
				
							<?php 
								if(isset($sel_page_set['id'])){
									$sel_pid=$sel_page_set['id'];
								}else{
									$sel_pid=NULL;
							}
							?>
						<?php
							#insert contributes form
							if(isset($sel_pid)){
								echo "<article id='ms_article'>
									  <div class='form-comments'>",contributes($sel_pid),"</div></article>";}
						?>
					
				
					<?php 
					#here is the area to show contributes and like dislike radio button form
					$commenter_ip=getIp();
					echo show_contributes_votes($sel_pid,$commenter_ip);//end comment	 
					?>
 </section>
<?php include("includes/side_search.php");?>
<?php include("includes/side_news.php");?>

<?php include("includes/thefooter.php");?>