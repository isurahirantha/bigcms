<?php
function select_editor_preference(){
	# this function is the category selection area, when user comes to first time to dashboard
	# he or she can see this.once user selected one category, then user will never get this area.
	#again.
				global $connection;
				echo "				
				<div class='select_cat'>
				<h1 data-toggle='tooltip' data-placement='top' title='WELCOME'class='ayubo'>ආයුබෝවන්!</h1>
				පාඩම් සැකසීමට කලින් මෙම වගුව කියවන්න.
				එක් එක් අංශයන්ට අයත්වන විෂයයන් පහත වගුවේ දක්වා ඇත.
				ඔබගේ අංශය තෝරාගැනීමට පහත වගුව උපකාරී වනු ඇතැයි සිතමි.
				ස්තුතියි!<hr>
				Refer these tabular data before begin.
				Subjects related to each sections have been entered to below table.
				This may be helpful to find your section.Thank You!
				</div>
				<table width='500px' >
				<tr>
				<th data-toggle='tooltip' data-placement='top' title='මානව ශාස්ත්‍ර'>Humanities </th>
				<th data-toggle='tooltip' data-placement='top' title='සාමජිය විද්‍යා '>Social Sciences </th>
				<th data-toggle='tooltip' data-placement='top' title='පරිගණක විද්‍යා '>Computer Science </th>
				<th data-toggle='tooltip' data-placement='top' title='විද්‍යා '>Science </th>
				<th data-toggle='tooltip' data-placement='top' title='කළමනාකරණ'>Management</th>
				<th data-toggle='tooltip' data-placement='top' title='භාෂා '>Languages </th>
				<th data-toggle='tooltip' data-placement='top' title='වෙනත් '>Other </th>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>Cooking</td>
				</tr>
				</table>
				<div class='form'>
				<p>ඔබ පාඩම් සැකසීමට කැමති අංශය තෝරන්න,වෙනස් කල නොහැක &nbsp;<span class='glyphicon glyphicon-warning-sign'></span>&nbsp;</p>
				<p>Choose the section you prefer to make lessons, Unchangable &nbsp;<span class='glyphicon glyphicon-warning-sign'></span>&nbsp;</p>
				<form action='cms.php' method='post'>
				<select name='preference'>";
				$query = "SELECT id, category, editor_preference FROM category";
				$query = mysql_query($query,$connection);
				echo "<option value=\"Default\">Choose....</option> ";
				while($cat_set = mysql_fetch_array($query)){
					$cat_id=$cat_set['id'];
					$cat_name =$cat_set['category'];
					echo "<option value=\"{$cat_id}\">{$cat_name}</option> ";
				}
				echo "
				</select>
				<input type='submit' value='Enter' name='enter' class='button'>
				</form>
				</div>";
			
}

function check_editors_preference(){
#check wether user already has selected a category,by using user's id 
				global $connection;
				global $ses_user_id;
				$query = "SELECT editor_preference FROM scopes WHERE user_id = {$ses_user_id}";
				$ok_query = mysql_query($query,$connection);
				$ok_preference=mysql_fetch_array($ok_query);
				if($ok_preference['editor_preference']==0||$ok_preference['editor_preference']==NULL){
				echo  select_editor_preference();//show the tbl form with select category
				}
}

function allow(){
#check wether user already has selected a category,by using user's id 
				global $connection;
				$ses_user_id = $_SESSION['user_id'];
				$query = "SELECT editor_preference FROM scopes WHERE user_id = {$ses_user_id}";
				$ok_query = mysql_query($query,$connection);
				$ok_preference=mysql_fetch_array($ok_query);
				if($ok_preference['editor_preference']==0||$ok_preference['editor_preference']==NULL){
					return true;
				}else{
					return false;
				}
}
function add_subject_button(){
#check wether user already has selected a category,by using user's id 
#and if selected (allow()===true) show button
#and if not selected (allow()===false) show disable-dbutton
		if(!allow()){
			$newbutton = "<button class=\"button\" onclick=\"window.location='new_sub.php'; \">New subject</button>";
			return $newbutton;
		}else{
			$newbutton= "<button class=\"button\" onclick=\"alert('Please choose a category, Thank you!') \">New subject</button>";
			return $newbutton;
		}
}

function insert_selected_editor_preference(){
#at first login user have to select a category
			$ses_user_id=$_SESSION['user_id'];
			global $connection;
			if(isset($_POST['enter'])){
				$preference=$_POST['preference'];
				$query = "INSERT INTO scopes(user_id,editor_preference) VALUES({$ses_user_id},{$preference})";//this must happen too on the "new_sub.php"
				$ok_query=mysql_query($query,$connection);
				confirm_query($ok_query);
				//mkdir
				if(!file_exists("user".$ses_user_id)){
					#a folder for each user
					mkdir("usersfolder\\user".$ses_user_id,0777);
					chmod("usersfolder\\user".$ses_user_id,0777);
					#lessons pictures for all users..inside the above folder
					mkdir("usersfolder\\user{$ses_user_id}\\page".$ses_user_id,0777);
					chmod("usersfolder\\user{$ses_user_id}\\page".$ses_user_id,0777);
				}

			}
}

function admin_category_menu($ses_user_id){
	# for get user selected subject category to dashboard
	global $connection;
			$query ="SELECT user_id, editor_preference FROM scopes WHERE user_id={$ses_user_id}";
			$query=mysql_query($query,$connection);
			confirm_query($query);
		while($scope = mysql_fetch_array($query)){
			$scope_id=$scope['editor_preference'];
			$scope_id;
			$sql = "SELECT category FROM category WHERE id ={$scope_id}";
			$sql=mysql_query($sql,$connection);
			confirm_query($sql);
			while($category_name = mysql_fetch_array($sql)){
			echo "<li class='cat'><span>↪</span>",$category_name['category'],"</li>";
			}//2ndloop			
	}//1stloop			
}


function get_all_subject_by_uid($ses_user_id){
	#for get subjects which attached to user_id.
	#navigation
global $connection;
$query =" SELECT * FROM subjects WHERE user_id = {$ses_user_id} ORDER BY id ASC ";
$query =mysql_query($query,$connection);
$query =confirm_query($query);
return $query;
}

function get_all_pages_by_sid($sid){
	#for get all pages by userid attached subject_id.
	#navigation
global $connection;
	$query = "SELECT * FROM pages WHERE subject_id = {$sid} ORDER BY id ASC ";
	$query =mysql_query($query,$connection);
	$query =confirm_query($query);
	return $query;		
}
//පරිශීලකගේ අංකයට අදාල පිටු පමණක් පෙන්වයි.
//show user authenticated subject and pages where session user id
function check_sid_and_uid_valid_to_get_sub($sid,$ses_user_id){
//show user authenticated subject  where session user id
	global $connection;
		$query = "SELECT * FROM subjects WHERE id ={$sid} AND user_id = {$ses_user_id}";
		$query = mysql_query($query,$connection);
		confirm_query($query);
			if(mysql_num_rows($query)==0){
				return false;
			}	else{
				return true;
			}
}
function give_this_user_authenticated_subject($ses_user_id){
//show user authenticated subject  where session user id
		if(!check_sid_and_uid_valid_to_get_sub($_GET['sid'],$ses_user_id)){
			redirect_to("index.php?message=".urlencode('Not Allowed')."");
		}
}

function check_pid_and_uid_valid_to_get_page($pid,$ses_user_id){
#show user authenticated pages  where session user id
	global $connection;
		$query = "SELECT * FROM pages WHERE id ={$pid} AND user_id = {$ses_user_id}";
		$query = mysql_query($query,$connection);
		confirm_query($query);
			if(mysql_num_rows($query)==0){
				return false;
			}	else{
				return true;
			}
}
function give_this_user_authenticated_page($ses_user_id){
#show user authenticated pages  where session user id
		if(!check_pid_and_uid_valid_to_get_page($_GET['pid'],$ses_user_id)){
			redirect_to("index.php?message=".urlencode('Not Allowed')."");
		}
}
//end of choosing user authenticated subject and page

function admin_navi($ses_user_id){
echo "<div class='nav_bg'>";
echo "<ul class='navsub'>";
$query=get_all_subject_by_uid($ses_user_id);
while($subjects = mysql_fetch_array($query)){

	echo "<li><a href=edit_sub.php?sid=".urlencode($subjects['id']).">".$subjects['menu_name']."</a></li>";
	//when user click on subject, that sub_id will be passes in to edit_sub.php via url
	echo "<ul class='navpage'>";
		$pageset=get_all_pages_by_sid($subjects['id']);
		while($pages = mysql_fetch_array($pageset)){
			echo "<li><a href=\"cms.php?pid=".urlencode($pages['id'])."\">",$pages['menu_name'],"</a></li>";
		}echo "</ul>";
	}//end sub while
	echo "</ul>";
	echo "<div>";
}

function admin_url_intval_check($ses_user_id){
	if(isset($_GET['sid'])){
		if(!is_numeric($_GET['sid'])||intval($_GET['sid'])==0||!filter_var($_GET['sid'],FILTER_VALIDATE_INT)){
			redirect_to("index.php?message=".urlencode('do not mess with us')."");
		}	
	}elseif(isset($_GET['pid'])){
		if(!is_numeric($_GET['pid'])||intval($_GET['pid'])==0||!filter_var($_GET['pid'],FILTER_VALIDATE_INT)){
			redirect_to("index.php?message=".urlencode('do not mess with us')."");
		}		
	}else{
		#if get value is a valid number then do this find_selected_cid_sid_pid();
		find_selected_sid_pid($ses_user_id);
	}
}

function find_selected_sid_pid($ses_user_id){
	global $sel_sid;
	global $sel_pid;
	if(isset($_GET['sid'])){
		give_this_user_authenticated_subject($ses_user_id);
		$sel_sid = get_subject_by_id($_GET['sid']);
		$sel_pid = NULL;
	}elseif(isset($_GET['pid'])){
		give_this_user_authenticated_page($ses_user_id);
		$sel_pid = get_pages_by_id($_GET['pid']);
		$sel_sid =NULL;
	}else{
		$sel_sid = NULL;
		$sel_pid =NULL;
	}
}
function first_subject($category_id){
global $connectioni;
$ses_user_id =$_SESSION['user_id'];
$query="SELECT * FROM scopes ";
$query.="WHERE user_id={$ses_user_id} AND editor_preference = {$category_id}";
$resultQuery=mysqli_query($connectioni,$query);
	if(mysqli_affected_rows($connectioni)!=0){
		return true;
	}else{
		return false;
	}
}
function getUserData($ses_user_id){
	global $connectioni;
	$sql = "SELECT * FROM users WHERE id = {$ses_user_id} LIMIT 1";
	$sql = mysqli_query($connectioni,$sql);
	if($sql){
		$userinfo = mysqli_fetch_array($sql);
		if(isset($userinfo)){
			return $userinfo;
		}else{
			return NULL;
		}
	}else{
		die(mysqli_error($connectioni));
	} 
}
//functions to update user settings

	function isempty($value){
		if(empty($value)){
			return true;
		}
	}
	function confirm_sql_query($sql){
		global $connectioni;
		$sql = mysqli_query($connectioni,$sql);
		if(!$sql){
			die("Sorry,Process cannot be done right now.".mysqli_error($connectioni));
		}
		if(mysqli_affected_rows($connectioni)!=0){
			echo "update successfully";
		}else{
			echo "unable to update";
		}
	}
	function update_query($column,$data,$ses_user_id){
	$sql = "UPDATE users SET $column = '{$data}' WHERE id ={$ses_user_id} LIMIT 1";
	confirm_sql_query($sql);
	}
//over/functions to update user settings

//insert user posts

	function insert_user_post($ses_user_id,$username){
		global $connectioni;
		$posttext = iescape($_POST['posttext']);
		$date = date("Y-m-d");
		$sql = "INSERT INTO userpost(user_id,username,post,date)
				VALUES({$ses_user_id},'{$username}','{$posttext}','{$date}')";
		$sql = iconfirm_query($sql);
		if(mysqli_affected_rows($connectioni)==1){
			return true;
		}else{
			return null;
		}
	}

	function insert_post_replies($username,$ses_user_id){
		global $connectioni;
		$replytext = iescape($_POST['replytext']);
		$post_id =iescape($_POST['post_id']);
		$date = date("Y-m-d");
		$sql = "INSERT INTO post_reply(user_id,post_id,username,replytext,date)
				VALUES({$ses_user_id},'{$post_id}','{$username}','{$replytext}','{$date}')";
		$sql = iconfirm_query($sql);
		if(mysqli_affected_rows($connectioni)==1){
			return true;
		}else{
			return null;
		}		
	}
	function get_post_reply($post_id){
				global $connectioni;
					$sql = "SELECT * FROM post_reply WHERE post_id = {$post_id} ORDER BY id DESC";
				

				$sql = iconfirm_query($sql);

				if(mysqli_num_rows($sql)!=0){
					while($reply_rows = mysqli_fetch_array($sql)){
						$reply_id=$reply_rows['id'];
						
						echo "<div id='usernamereply'>",htmlentities($reply_rows['username']),"</div>";
						echo "<div class=\"post\">";
						echo strip_tags(nl2br($reply_rows['replytext']),"<a><li><b><br><img><iframe><embeded>");
						echo "<p>",$reply_rows['date'],"</p>";
						//insert_post_replies_form($post_id);
						echo "</div>";
						
					}
				}

			}

 function insert_post_replies_form($post_id){
 	echo "
 		<form id='postreply' action='club.php' method='post'>
		<label>
		<p>Reply to your friends:</p>
			<textarea id='replytext' placeholder='what is on your mind?' name='replytext'></textarea></br>
			<input type='hidden' name='post_id' value='{$post_id}'>
			<span>&nbsp;</span>
			<input id='replybtn' type='submit' name='reply' value='Reply'>
		</label>

		</form>
		 	";
 }

			function get_post($ses_user_id,$public=false){
				global $connectioni;
				if($public===false){
					$sql = "SELECT * FROM userpost WHERE user_id = {$ses_user_id} ORDER BY id DESC";
				}elseif($public===true){
					$sql = "SELECT * FROM userpost ORDER BY id DESC";
				}

				$sql = iconfirm_query($sql);

				if(mysqli_num_rows($sql)!=0){
					while($post_rows = mysqli_fetch_array($sql)){
						$post_id=$post_rows['id'];
						//echo "<hr>";
						echo "<div class=\"post\">";
						echo "<div id='username'><strong>",htmlentities($post_rows['username'])," shared a post</strong></div>";
						echo "<strong>",strip_tags(nl2br($post_rows['post']),"<a><li><b><img><iframe><embeded>"),"</strong>";
						echo "<p>",$post_rows['date'],"</p>";
						get_post_reply($post_id);
						insert_post_replies_form($post_id);
						echo "</div>";
					}
				}

			}
//user post show
			
			function iconfirm_query($sql){
				global $connectioni;
				$sql = mysqli_query($connectioni,$sql);
				if(!$sql){
					die(mysqli_error($connectioni));
				}else{
					return $sql;
				}
			}

//insert profile pic
		function update_profile_pic($userid,$image_name){
			global $connectioni;
			$sql = "UPDATE users SET profile_picture='{$image_name}' WHERE id={$userid} LIMIT 1";
			iconfirm_query($sql);
		}
		function show_profile_pic($user_id){
			global $connectioni;
			$sql = "SELECT profile_picture FROM users WHERE id = {$user_id} LIMIT 1";
			$sql = iconfirm_query($sql);
			$pic = mysqli_fetch_assoc($sql);
			$picname = $pic['profile_picture'];

				if($pic['profile_picture']==""){
					echo "<img src='imgs/user_default.png' >"."<br/>";
				}else{
					echo "<img src='usersfolder/user{$user_id}/{$picname}' >"."<br/>";
				}
		}
?>
