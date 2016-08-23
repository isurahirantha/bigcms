<?php require_once("includes/police.php");?>

<?php require_once("includes/connection.php");?>
<?php require_once("includes/connectioni.php");?>
<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/admin_functions.php");?>

<?php confirm_user(); ?>
<?php $ses_user_id=$_SESSION['user_id'];?>

<?php require_once("includes/dashboard/header.php");?>
<?php
     admin_url_intval_check($ses_user_id);
?>
<?php 
if(isset($_POST['submit'])){
$error = array();
$required_info = array('menu_name','key_words');
$error = array_merge($error,check_required_fields($required_info));
    if(empty($error)){
        $menu_name = escape(htmlentities(trim($_POST['menu_name'])));
        $key_words =escape(htmlentities(trim($_POST['key_words'])));
        $visible =$_POST['visible'];
        $user_id=escape($_SESSION['user_id']);
        //$preference =escape(htmlentities($_POST['preference']));
        $subject_id=escape($_GET['sid']);

        $sqlcom = "UPDATE subjects SET keyword='{$key_words}',menu_name='{$menu_name}', visible={$visible} WHERE id={$subject_id}";
            if(mysqli_query($connectioni,$sqlcom)){
                $message= "Subject updation successful!";
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
}

?>

<?php 
    find_selected_sid_pid($ses_user_id);
?>

<div class="big_dash">  
            <!--navigation -->
            <nav class="left_side_menu">
            <?php #show selected category
            if($cat_set = admin_category_menu($ses_user_id)){echo "<li>", $cat_set['category'],"</li>";} ?>

            <?php admin_navi($ses_user_id); ?>
            <br>
                <script type="text/javascript">
                function goto_url(){
                    window.location="new_page.php?sid= <?php echo $sel_sid['id']; ?>";
                }
                </script>
                <button class="button" onclick="goto_url();">+New page</button>
            <?php //add_subject_button(); show add page instead?>
            </nav>          

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
<!--Content Area Begin-->
<!--subject Edit Area Begin-->
            <?php 
            $new_page=false;
            ?>
            <!-- #error or message show -->
            <?php if(isset($message)||!empty($error)){echo "<div class='errormsg' id='msgerror'><p>Hello, ",$_SESSION['username']," !<p>";}?>
            <?php if(isset($message)){echo"<p>", $message,"</p>";} ?>
            <?php if(isset($message)||!empty($error)){ echo "<code>", show_error($error),"</code><button class='addbtn' id='errcls'>&#8730;</button></div>";} ?>
            <script type="text/javascript" src="js/errcls.js"></script>
            <!-- #error or message show over-->
            <form action="edit_sub.php?sid=<?php echo urlencode($sel_sid['id']);?> " method="post" class="dark-css-form">
            <?php include("includes/subj_form.php"); ?>
            </form>
<!--subject Edit Area Over-->
<!--Content Area Over-->

            </section>
            <aside id="side_news">
            </aside>

<?php require_once("includes/dashboard/footer.php");?>
        
