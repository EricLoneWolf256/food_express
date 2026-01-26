<?php 
    //Authorization - Access Control
    //Check whether the user is logged in or not
    if(!isset($_SESSION['restaurant_user'])) //If user session is not set
    {
        //User is not logged in
        //Redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Restaurant Panel.</div>";
        header('location:'.SITEURL.'restaurant/login.php');
    }
?>
