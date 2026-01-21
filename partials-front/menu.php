<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Express</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo">
                    <h1>FoodExpress<span style="color:var(--text-dark)">.</span></h1>
                </a>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Menu</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
                    <?php if(isset($_SESSION['user'])) { ?>
                        <li><a href="<?php echo SITEURL; ?>my-orders.php">Orders</a></li>
                        <li><a href="<?php echo SITEURL; ?>cart.php">Cart</a></li>
                        <li><a href="<?php echo SITEURL; ?>logout.php" class="btn-primary" style="padding: 5px 15px; color: white;">Logout</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo SITEURL; ?>login.php">Login</a></li>
                        <li><a href="<?php echo SITEURL; ?>signup.php" class="btn-primary" style="padding: 5px 15px; color: white;">Sign Up</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
