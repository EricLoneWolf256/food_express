<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard - Food Express</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="manage-food.php">My Foods</a></li>
                <li><a href="manage-order.php">My Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section Ends -->
