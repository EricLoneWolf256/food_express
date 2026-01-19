<?php 
    include('config/constants.php');
    // Destroy Session
    session_destroy(); // Unsets $_SESSION['user']
    
    // Redirect to Login Page
    header('location:'.SITEURL.'login.php');
?>
