<?php
function get_all_category(){
	global $connection;
	$query = "SELECT *"." ";
					$query.="FROM category"." ";
					$query.="ORDER BY id"." ";
					$query.="ASC ";
					
					$category_set = mysql_query($query,$connection);
					if(!$category_set){
							die(mysql_error());
					}else{	
						return $category_set;
					}
}

function get_all_subject_by_category_id($cid){
	global $connection;
	#inside while loop to categorytbl,now we start subjectstbl while loop
		$query="SELECT * FROM subjects"." ";
			$query.="WHERE category_id = ".$cid." ";
			$query.="AND visible=1"." ";
				$query.=" ORDER BY id ASC ";
						$subject_set = mysql_query($query,$connection);
						if(!$subject_set){
							die(mysql_error());
							}else{
								return $subject_set;
							}
}

function get_pages_for_subject_id($sid){
	global $connection;
	#inside while loop to subjectstbl,now we start pageTbl while loop
		$query="SELECT * FROM pages"." ";
			$query.="WHERE subject_id=".$sid." ";
			$query.="AND visible=1"." ";
				$query.=" ORDER BY id ASC ";
						$pages_set = mysql_query($query,$connection);
							if(!$pages_set){
								die(mysql_error());
							}else{
								return $pages_set;
							}
}

function redirect_to($location=NULL){
	if($location!=NULL){
	header("Location:{$location}");
	exit;
	}
}

function url_intval_check(){
	if(isset($_GET['cid'])){
		if(!is_numeric($_GET['cid'])||intval($_GET['cid'])==0||!filter_var($_GET['cid'],FILTER_VALIDATE_INT)){
			redirect_to("index.php");
		}
	}elseif(isset($_GET['sid'])){
		if(!is_numeric($_GET['sid'])||intval($_GET['sid'])==0||!filter_var($_GET['sid'],FILTER_VALIDATE_INT)){
			redirect_to("index.php");
		}	
	}elseif(isset($_GET['pid'])){
		if(!is_numeric($_GET['pid'])||intval($_GET['pid'])==0||!filter_var($_GET['pid'],FILTER_VALIDATE_INT)){
			redirect_to("index.php");
		}		
	}else{
#if get value is a valid number then do this find_selected_cid_sid_pid();
		find_selected_cid_sid_pid();
		 
	}
}
function get_default_page_by_sel_sid($sid){
 $pages_set=get_pages_for_subject_id($sid);
 $default_page=mysql_fetch_array($pages_set);
	 if($default_page){
	 	return $default_page;
	 }else{
	 	return null;
	 }
}
function find_selected_cid_sid_pid(){
	global $sel_category_set;
	global $sel_subject_set;
	global $sel_page_set;

		if(isset($_GET['sid'])){
			$sel_subject_set =get_subject_by_id($_GET['sid']);
			$sel_page_set =get_default_page_by_sel_sid($sel_subject_set['id']);
			$sel_category_set =NULL;
		}elseif(isset($_GET['pid'])){
			$sel_page_set = get_pages_by_id($_GET['pid']);
			$sel_subject_set =NULL;
			$sel_category_set =NULL;
		}elseif(isset($_GET['cid'])){
			$sel_category_set = get_category_by_id($_GET['cid']);
			$sel_subject_set =NULL;
			$sel_page_set =NULL;
		}else{
			$sel_category_set =NULL;
			$sel_subject_set =NULL;
			$sel_page_set =NULL;
		}	
}

function confirm_query($query){
	if(!$query){
		die(mysql_error());
	}else{
		return $query;
	}
}

function get_subject_by_id($sel_sid){
	# i use this on public navi and also admin navi
	global $connection;
		$query= "SELECT * "." ";
		$query.="FROM subjects"." ";
		$query.="WHERE id={$sel_sid}"." ";
		$query.="LIMIT 1 ";
		$result = mysql_query($query,$connection);
		$subject_set=confirm_query($result);
		$subject_set = mysql_fetch_array($subject_set);
		if($subject_set){
			return $subject_set;
		}
}
function get_comments_by_pid($sel_pid){
	global $connection;
	$query = "SELECT * ";
	$query.= "FROM contributes ";
	$query.= "WHERE page_id={$sel_pid} ";
	$query.= "ORDER BY id DESC ";
	$result_query = mysql_query($query,$connection);
	confirm_query($result_query);
		if(isset($result_query)){
			return $result_query;
		}else{
			return NULL;
		}
		
	}


function get_pages_by_id($sel_pid){
	# i use this on public navi and also admin navi
	global $connection;
		$query= "SELECT * "." ";
		$query.="FROM pages"." ";
		$query.="WHERE id={$sel_pid}"." ";
		$query.="LIMIT 1 ";
		$result = mysql_query($query,$connection);
		$page_set=confirm_query($result);
		$page_set = mysql_fetch_array($page_set);
		if($page_set){
			return $page_set;
		}
}
function get_category_by_id($sel_cid){
	global $connection;
		$query= "SELECT * "." ";
		$query.="FROM category"." ";
		$query.="WHERE id={$sel_cid}"." ";
		$query.="LIMIT 1 ";
		$result = mysql_query($query,$connection);
		$category_set=confirm_query($result);
		$category_set = mysql_fetch_array($category_set);
		if($category_set){
			return $category_set;
		}
}

function public_nav(){

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
											echo "<li><a href=\"index.php?sid=".urlencode($subjectsTbl['id'])."  \"> {$subjectsTbl['menu_name']} </a></li>";
											#inside while loop to subjectstbl,now we start pageTbl while loop
												$pages_set=get_pages_for_subject_id($subjectsTbl['id']);
												echo "<ul class=\"pagenav\">";
												while($pagesTbl=mysql_fetch_array($pages_set)){
													echo "<li><a href=\"index.php?pid=".urlencode($pagesTbl['id'])."  \"> {$pagesTbl['menu_name']} </a></li>";
												}echo "</ul>"; #end of pagesTbl loop
										}echo "</ul>"; #end of subjectsTbl loop
						}#end of categoryTbl loop
				echo "</ul>";
}

function getIp(){

        $ip = $_SERVER['REMOTE_ADDR'];     
        if($ip){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            return $ip;
        }
        // There might not be any data
        return false;
}
function validate_votes(){
	global $commenter_ip;
	global $connection;
		if(isset($_POST['votes'])){
		$votes=$_POST['votes'];
		$comment_id =$_POST['comment_id'];
		$commenter_ip =$_POST['commenter_ip'];
		
$val_query = "SELECT * FROM comment_validate WHERE commenter_ip = '{$commenter_ip}' AND comment_id ={$comment_id} ";
$val_query = mysql_query($val_query,$connection);
$val_query=confirm_query($val_query);
if(mysql_num_rows($val_query)==1){
	while($val_query_set = mysql_fetch_array($val_query)){
			if($val_query_set['commenter_ip']==$commenter_ip && $val_query_set['comment_id']==$comment_id && $val_query_set['votes'] == 'likes' || $val_query_set['votes']=='dislikes'){
				$query= mysql_query("UPDATE comment_validate SET votes='{$votes}' WHERE commenter_ip='{$commenter_ip}' AND comment_id = {$comment_id} LIMIT 1",$connection);
				//confirm_query($query);
			}
	}//loop
}else{//numrow==0
		$query ="INSERT INTO comment_validate(comment_id, votes, commenter_ip) VALUES({$comment_id},'{$votes}','{$commenter_ip}')";
		$com_query=mysql_query($query,$connection);
		confirm_query($com_query);
		}

	}//if(isset($_POST['votes']))

}

function get_selected_votedd(){
	global $commenter_ip;
	global $connection;
		if(isset($_POST['votes'])){
		$votes=$_POST['votes'];
		$comment_id =$_POST['comment_id'];
		$commenter_ip =$_POST['commenter_ip'];
		}
		
		if(isset($commenter_ip)){
		$query ="INSERT INTO comment_validate(comment_id, votes, commenter_ip) VALUES({$comment_id},'{$votes}','{$commenter_ip}')";
		$com_query=mysql_query($query,$connection);
		confirm_query($com_query);

	}
}


function show_user_likes($comment_id){
	global $connection;
	$query = "SELECT votes FROM comment_validate WHERE comment_id=$comment_id AND votes = 'likes'";
	$count_like = mysql_query($query,$connection);
	confirm_query($count_like);
	$count_like=mysql_num_rows($count_like);
	return $count_like;
}
function show_user_likesAND_delt_above_five_dislike($comment_id){
	global $connection;
	$query = "SELECT votes FROM comment_validate WHERE comment_id ={$comment_id} AND votes ='dislikes'";
	$count_dislikes = mysql_query($query,$connection);
	confirm_query($count_dislikes);
	$count_dislikes=mysql_num_rows($count_dislikes);
	if($count_dislikes==10){
		mysql_query("DELETE FROM contributes WHERE id ={$comment_id} LIMIT 1",$connection);
		mysql_query("DELETE FROM comment_validate WHERE comment_id ={$comment_id}",$connection);
	}else{
	return $count_dislikes;
	}
}
function contributes($sel_pid){
			$output = "<form class='comment' action='comments.php' method='post'>
					<h2>User Contributes:</h2>
					<lable>Your name:</lable>
					<input type='text' name='contributer' placeholder='සෝමරත්න'>
					<lable>Your Email:</lable>
					<input type='email' name='con_email' placeholder='example@mail.com'>
					<input type='hidden' name='sel_pid' value='$sel_pid'>
					<textarea class='commenttext' cols='85' rows='5' name='comment' placeholder='ඔබගේ දායකත්වයන් , Your contribuions'></textarea>
					<p><input type='submit' name='submit'value='POST' class='btncomment'></p>
					</form>
					";
					return $output;	
}
function show_contributes_votes($sel_pid,$commenter_ip){
					if(isset($sel_pid)){			

							$result_query=get_comments_by_pid($sel_pid);
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
								$sel_pid=$sel_pid;
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
}

function public_navigation(){
	global $sel_category_set;
	global $sel_subject_set;
	global $sel_page_set;
		$output= "<ul class=\"catnav\">";
			$category_set=get_all_category();
				while ($categoryTbl=mysql_fetch_array($category_set)){
				#we keep a categoryTbl category as a link, 
				#then we will be able to use it later to custermize navigation
					
		$output.= "<li><a href=\"index.php?cid=".urlencode($categoryTbl['id'])."  \">{$categoryTbl['category']}</a></li>";

						#inside while loop to categorytbl,now we start subjectstbl while loop
						$subject_set=get_all_subject_by_category_id($categoryTbl['id']);
		$output.= "<ul class=\"subnav\">";
						while($subjectsTbl=mysql_fetch_array($subject_set)){
							if($sel_category_set['id']==$categoryTbl['id']||$sel_subject_set['category_id']==$categoryTbl['id']){
		$output.= "<li><a href=\"index.php?sid=".urlencode($subjectsTbl['id'])."  \"> {$subjectsTbl['menu_name']} </a></li>";
							}
							#inside while loop to subjectstbl,now we start pageTbl while loop
								$pages_set=get_pages_for_subject_id($subjectsTbl['id']);
		$output.= "<ul class=\"pagenav\">";
									while($pagesTbl=mysql_fetch_array($pages_set)){

									if($sel_subject_set['id']==$subjectsTbl['id']||$sel_page_set['subject_id']==$subjectsTbl['id'])	{
		$output.= "<li><a href=\"index.php?pid=".urlencode($pagesTbl['id'])."  \"> {$pagesTbl['menu_name']} </a></li>";
									}
								}#end of pagesTbl loop
		$output.= "</ul>"; 
							}#end of subjectsTbl loop
		$output.= "</ul>"; 
						}#end of categoryTbl loop
		$output.= "</ul>";

		return $output;
}
function escape($value){
		$magic_quote_active = get_magic_quotes_gpc();
		$php_version_enough = function_exists("mysql_real_escape_string");

		if($php_version_enough){
				if($magic_quote_active){
					$value = stripslashes($value);
				}
			$value = mysql_real_escape_string($value);
		}else{
			if(!$magic_quote_active){
				$value = addslashes($value);
			}
		}
		return $value;
}
function iescape($value){
	global $connectioni;
		$magic_quote_active = get_magic_quotes_gpc();
		$php_version_enough = function_exists("mysqli_real_escape_string");

		if($php_version_enough){
				if($magic_quote_active){
					$value = stripslashes($value);
				}
			$value = mysqli_real_escape_string($connectioni,$value);
		}else{
			if(!$magic_quote_active){
				$value = addslashes($value);
			}
		}
		return $value;
}

function email_availability($email){
global $connectioni;
$sql = "SELECT email FROM users WHERE email = '{$email}'";
$sql = mysqli_query($connectioni,$sql);
if(!$sql){
	die(mysqli_error($connectioni));
}
	if(mysqli_num_rows($sql)!=0){
		//$result = "That email Already taken";
		return true;
	}else{
		return false;
	}
}

function validate_email($email){
	$error =array();
        if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
            $error[]=$email.""."-Not a valid email";
        }else{
        	if(email_availability($email)===true){
        	$error[]=$email.""."-That email Already taken";
        	}
        }
        return $error;
}



function check_required_length($required_lengths){
        $error =array();
        foreach($required_lengths as $field_name => $maximum_len){
            if(strlen(trim($_POST[$field_name]))>$maximum_len){
                $error[]=$field_name.""."Too long";
            }
        }
        return $error;
}

function check_required_fields($required_info){
        $error =array();
        foreach($required_info as $required_field){
            if(!isset($_POST[$required_field])||empty($_POST[$required_field])){
                $error[]=$required_field."".": is empty(හිස්)";
            }
        }
        return $error;
}
/**
*register
*/
function reg(){
global $connection;
         $firstname = escape($_POST['fname']);
         $lastname  = escape($_POST['lname']);
         $good_at   = escape($_POST['goodat']);
         $email     = escape($_POST['email']);
         $password  = escape($_POST['password']);
         $gender    = escape($_POST['gender']);
         $agree     = escape($_POST['agree']);
#queries to insert in to table
        $hash_password = password_hash($password,PASSWORD_DEFAULT);
$query = "INSERT INTO users(fnme,lnme,good_at,email,hash_password,gender,term_and_conditions)
		VALUES('{$firstname}','{$lastname}','{$good_at}','{$email}','{$hash_password}','{$gender}','{$agree}')
			";
		$query = mysql_query($query,$connection);
		if(confirm_query($query)){
			return true;
		}
}

//function to show errors
function show_error($error){
	if(!empty($error)){
	$output= "<p class=\"message\"> ";
	
			foreach($error as $errors){
				$output.= "- ".$errors."</br>";
			}
			$output.= "</p>";
	}
			if(isset($output)){
				return $output;
				}else{
					return NULL;
					}
}
/*
function getString($contentString){
	$rawvals = array();
	$entityVals = array();
	preg_match_all('/♀([^}]+)♂/',$contentString,$matches);
	$matchString = $matches[1];
	foreach($matchString as $rawval ){
		$rawvals[]=$rawval;
	}
	foreach($matchString as $entityVal){
		$entityVal = addslashes(htmlentities($entityVal));
		$entityVal = "<code>".$entityVal."</code>";//i should try iframe instead of <code>
		$entityVals[]=$entityVal;
	}
	$content = str_replace($rawvals, $entityVals, $contentString);
	$content=str_replace(array('♀','♂'), '', $content);
	$content=stripslashes($content);
	return $content;
}
*/
function getString($contentString){
	$rawvals = array();
	$entityVals = array();
	preg_match_all('/^♀([^}]+)♂/',$contentString,$matches);
	$matchString = $matches[1];
	foreach($matchString as $rawval ){
		$rawvals[]=$rawval;
	}
	foreach($matchString as $entityVal){
		$entityVal = addslashes(htmlentities($entityVal));
		$entityVal = "<code>".$entityVal."</code>";//i should try iframe instead of <code>
		$entityVals[]=$entityVal;
	}
	$content = str_replace($rawvals, $entityVals, $contentString);
	$content=str_replace(array('♀','♂'), '', $content);
	$content=stripslashes($content);
	return $content;
}

function check_url_id($id){
	if(!is_numeric($id)||intval($id)==0){
		redirect_to("index.php");
	}elseif(!filter_var($id,FILTER_VALIDATE_INT)){
		redirect_to("index.php");
	}
}
?>