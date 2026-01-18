<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Food Express</title>
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
                    <li><a href="<?php echo SITEURL; ?>track-order.php">Track Order</a></li>
                    <li><a href="<?php echo SITEURL; ?>contact.php">Contact</a></li>
                    <li><a href="<?php echo SITEURL; ?>cart.php">Cart</a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center">Confirm Your Order</h2>

            <form action="" method="POST" class="order">
                
                <fieldset>
                    <legend>Order Summary</legend>
                    <div class="text-center">
                        <?php 
                            $grand_total = 0;
                            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                foreach($_SESSION['cart'] as $values) {
                                    $grand_total += ($values['price'] * $values['qty']);
                                    echo "<p>{$values['title']} x {$values['qty']}</p>";
                                }
                            }
                        ?>
                        <br>
                        <h3>Total: $<?php echo number_format($grand_total, 2); ?></h3>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Adnan Afzal" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@adnan.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Pay & Confirm" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                if(isset($_POST['submit']))
                {
                    if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
                    {
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];
                        $order_date = date("Y-m-d h:i:sa");
                        $status = "Ordered";

                        // Loop through cart and insert each item
                        foreach($_SESSION['cart'] as $values) {
                            $food = $values['title'];
                            $price = $values['price'];
                            $qty = $values['qty'];
                            $total = $price * $qty;

                            // Insert Order
                            $sql = "INSERT INTO tbl_order SET 
                                food = '$food',
                                price = $price,
                                qty = $qty,
                                total = $total,
                                order_date = '$order_date',
                                status = '$status',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                            ";

                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                        }

                        // Clear Cart
                        unset($_SESSION['cart']);

                        // Redirect
                        $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>

    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Your Name</a></p>
        </div>
    </section>
</body>
</html>
