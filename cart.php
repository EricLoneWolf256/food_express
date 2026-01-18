<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - Food Express</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .tbl-cart{
            width: 100%;
            border-collapse: collapse;
        }
        .tbl-cart th{
            border-bottom: 1px solid white;
            padding: 1%;
            text-align: left;
        }
        .tbl-cart td{
            padding: 1%;
        }
    </style>
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
            <br>
            <form action="" class="order">
                <table class="tbl-cart">
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                        $grand_total = 0;
                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $key => $values) {
                                $total = $values['price'] * $values['qty'];
                                $grand_total += $total;
                    ?>
                    <tr>
                        <td><?php echo $values['title']; ?></td>
                        <td>$<?php echo $values['price']; ?></td>
                        <td><?php echo $values['qty']; ?></td>
                        <td>$<?php echo number_format($total, 2); ?></td>
                        <td>
                            <a href="remove-cart-item.php?id=<?php echo $values['id']; ?>" class="btn-danger">Remove</a>
                        </td>
                    </tr>
                    <?php 
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Cart is Empty</td></tr>";
                        }
                    ?>

                    <tr>
                        <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                        <td><strong>$<?php echo number_format($grand_total, 2); ?></strong></td>
                        <td></td>
                    </tr>

                </table>

                <br><br>
                <div class="text-center">
                    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                        <a href="<?php echo SITEURL; ?>checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    <?php } ?>
                </div>

            </form>
        </div>
    </section>

    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Your Name</a></p>
        </div>
    </section>
</body>
</html>
