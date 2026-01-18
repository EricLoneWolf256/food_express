<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foods By Category - Food Express</title>
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
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>track-order.php">Track Order</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php">Cart</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-search text-center">
        <div class="container">
            <h2>Foods on <a href="#" class="text-white">"Category Name"</a></h2>
        </div>
    </section>

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                if(isset($_SESSION['add-to-cart']))
                {
                    echo $_SESSION['add-to-cart'];
                    unset($_SESSION['add-to-cart']);
                }
            ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="1">
                        <input type="hidden" name="title" value="Food Title">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="2">
                        <input type="hidden" name="title" value="Smoky Burger">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Nice Momo</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="3">
                        <input type="hidden" name="title" value="Nice Momo">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="4">
                        <input type="hidden" name="title" value="Food Title">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Your Name</a></p>
        </div>
    </section>
</body>
</html>
