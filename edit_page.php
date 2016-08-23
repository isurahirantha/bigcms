<?php require_once("includes/police.php");?>

<?php require_once("includes/connection.php");?>
<?php require_once("includes/connectioni.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>

<?php confirm_user(); ?>
<?php $ses_user_id=$_SESSION['user_id'];?>

<?php
#if user go to http:www.bigcms.edit_page.php
if(!isset($_GET['pid'])){ redirect_to("cms.php");}

if(intval($_GET['pid'])==0){redirect_to("cms.php");}

?>  
<?php
     admin_url_intval_check($ses_user_id);
?>

<!--edit page--> 
<?php
    if(isset($_POST['submit'])){

    $error = array();
    $required_info = array('lesson_name','key_words','content');
    $error = array_merge($error,check_required_fields($required_info));
    if(!isset($_POST['visible'])){$error[]='Visible is not Set';}
        if(empty($error)){
           $lesson_name = iescape(htmlentities(trim($_POST['lesson_name'])));
           $key_words =iescape(htmlentities(trim($_POST['key_words'])));
           $content=iescape(trim($_POST['content']));
           //$content=getString($content);
           $position =iescape(htmlentities($_POST['position']));
           $visible =iescape(htmlentities($_POST['visible']));
           $user_id=iescape($_SESSION['user_id']);
           $username=iescape($_SESSION['username']);
           $page_id =iescape($_GET['pid']);
           $youtube_link = iescape($_POST['vedio']);
           $source_code =iescape(htmlentities(trim($_POST['source_code'])));
           $date = date("Y-m-d");
            $sqlcom ="
                UPDATE pages
                SET  keyword = '{$key_words}', menu_name='{$lesson_name}',content='{$content}' , position = {$position} , visible = {$visible} ,youtube_link='{$youtube_link}',source_code='{$source_code}',editor='{$username}',posted_date='{$date}'
                WHERE id = {$page_id} LIMIT 1
                ";
                if(mysqli_query($connectioni,$sqlcom)){
                    $message= "Page updation successful!";
                }else{
                    die("error: ".mysqli_error($connectioni));
                }

        } else{ 
            //error
                if(count($error)==1){
                $word = "area!";
                }else{
                $word ="areas!";
                }
                $message = "Please review following ".$word;       
             }

    }//end submit
?>
<!--edit page over--> 
<?php require_once("includes/dashboard/header.php");?>

<?php 
    find_selected_sid_pid($ses_user_id);
?>

<div class="big_dash">  
<!--navigation begin-->
            <nav class="left_side_menu">
            <?php #show selected category name
            if($cat_set = admin_category_menu($ses_user_id)){echo "<li>", $cat_set['category'],"</li>";} ?>
            <hr>
        <!-- Js word maker begin-->
            <?php include("includes/word_processor.php");?>
        <!-- Js word maker over-->
            <hr>
            <button class="button" onclick="window.location='cms.php'; ">Cancel</button>
            <hr>
        <!--sidemenu-->
            <?php admin_navi($ses_user_id); ?>
            <br>
            <?php //add_subject_button();//edit page,we dont need this ?>
            </nav>          
<!--navigation over-->

            <section id="_main_section">
            <?php #if user hasn't select a subject section
                  #and if user just slected a subject section
                  #then quickly update 'editor_preference' in usr table
                  insert_selected_editor_preference();?>
            <?php #check user alredy select a subject section
                    if(allow()){
                  #and if not, then show select option form
                    check_editors_preference();
                }
            ?>

<!--Content Edit Area Begin-->

            <?php 
            $new_page=false;
            ?>
            <!-- #error or message show -->
            <?php if(isset($message)||!empty($error)){echo "<div class='errormsg' id='msgerror'><p>Hello, ",$_SESSION['username']," !<p>";}?>
            <?php if(isset($message)){echo"<p>", $message,"</p>";} ?>
            <?php if(isset($message)||!empty($error)){ echo "<code>", show_error($error),"</code><button class='addbtn' id='errcls'>&#8730;</button></div>";} ?>
            <script type="text/javascript" src="js/errcls.js"></script>
            <!-- #error or message show over-->
            <form action="edit_page.php?pid= <?php echo urlencode($sel_pid['id']);?> " method="post" class="dark-css-form">
            <?php include("includes/page_form.php"); ?>
            </form>
<!--Content Edit Area Over-->

            </section>

            <aside id="side_news">
            </aside>

<?php require_once("includes/dashboard/footer.php");?>
        
