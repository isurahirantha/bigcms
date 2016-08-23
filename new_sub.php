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
        $visible =escape(htmlentities($_POST['visible']));
        $user_id=escape($_SESSION['user_id']);
        $category_id =escape(htmlentities($_POST['preference']));

            $sqlcom = "INSERT INTO subjects(user_id,category_id,keyword,menu_name,visible)
             VALUES({$user_id},{$category_id},'{$key_words}', '{$menu_name}',{$visible}) ";

            if(first_subject($category_id)){
            $sql ="UPDATE scopes SET user_id={$user_id} , editor_preference ={$category_id} WHERE user_id={$user_id} AND editor_preference ={$category_id}";
            }else{
            $sql= "INSERT INTO scopes(user_id,editor_preference) VALUES({$user_id},{$category_id})";
            }
            #user selected a category id at first loging, 
            #there is a category selection form in new subject page also.
            #so, after first login, user have to selecte a category id
            #then ,when creating a new subject user can see another category selection form similer to former one
            #so we want to update existing user selected category 
            #becoz we do not want add another same category.(we avoiding that by updating exsisting selection)
            #but user want to add another subject relate to another category,
            #we INSERT it insted to update.

        if(mysqli_query($connectioni,$sqlcom)&&mysqli_query($connectioni,$sql)){
            $message= "Subject added!";
        }else{
                if(count($error)==1){
                    $word = "area!";
                    }else{
                    $word ="areas!";
                    }
                    $message = "Please review following ".$word;       
                }

    }
    }//end submit

?>


<?php 
    find_selected_sid_pid($ses_user_id);
?>

<div class="big_dash">  
            <!--navigation -->
            <nav class="left_side_menu">
            <?php #show selected category
            if($cat_set = admin_category_menu($ses_user_id)){echo "<li>", $cat_set['category'],"</li>";} ?>
            <button class="button" onclick="window.location='cms.php'; ">Cancel</button>
            <br>
            <?php admin_navi($ses_user_id); ?>
         

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
            $new_page=true;
            ?>
            <!-- #error or message show -->
            <?php if(isset($message)||!empty($error)){echo "<div class='errormsg' id='msgerror'><p>Hello, ",$_SESSION['username']," !<p>";}?>
            <?php if(isset($message)){echo"<p>", $message,"</p>";} ?>
            <?php if(isset($message)||!empty($error)){ echo "<code>", show_error($error),"</code><button class='addbtn' id='errcls'>&#8730;</button></div>";} ?>
            <script type="text/javascript" src="js/errcls.js"></script>
            <!-- #error or message show over-->
            <form action="new_sub.php" method="post" class="dark-css-form">
            <?php include("includes/subj_form.php"); ?>
            </form>
<!--subject Edit Area Over-->
<!--Content Area Over-->

            </section>
            <aside id="side_news">
            </aside>

<?php require_once("includes/dashboard/footer.php");?>
        
