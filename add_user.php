<?php require_once("includes/public_functions.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/connectioni.php");?>
<?php
if(isset($_POST['submit'])&&($_SERVER["REQUEST_METHOD"]=="POST")){
$error = array();
    $required_info = array('fname','lname','goodat','email','password','gender','agree');
    $error=array_merge($error, check_required_fields($required_info));

    $error=array_merge($error, validate_email($_POST['email']));//<60 character long mail is valid

    $required_lengths = array("fname"=>30,"lname"=>30,"goodat"=>50);
    $error = array_merge($error, check_required_length($required_lengths));

        if(empty($error)){
        /**
        *Query to insert values
        *reg() function is used to insert values
        */
            if(reg()===true){
                redirect_to("index.php");
            }

        }else{
            //print_r($error);
        }
}


?>
<?php include("includes/header.php"); ?>
<?php include("includes/reg_condition.php");?>
<?php include("includes/reg_form.php");?> 




<?php include("includes/thefooter.php"); ?>