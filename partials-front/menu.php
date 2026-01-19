<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Express</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <h1>FoodExpress</h1>
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
                    <?php if(isset($_SESSION['user'])) { ?>
                        <li><a href="<?php echo SITEURL; ?>my-orders.php">My Orders</a></li>
                        <li><a href="<?php echo SITEURL; ?>logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo SITEURL; ?>login.php">Login</a></li>
                        <li><a href="<?php echo SITEURL; ?>signup.php">Sign Up</a></li>
                    <?php } ?>
                    <li><a href="<?php echo SITEURL; ?>cart.php">Cart</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
