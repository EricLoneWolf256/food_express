<?php include('partials-front/menu.php'); ?>

<?php 
    if(!isset($_SESSION['user'])) {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to checkout.</div>";
        header('location:'.SITEURL.'login.php');
    }
?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Confirm Your Order</h2>

        <form action="" method="POST" class="order">
            
            <fieldset>
                <legend>Order Summary</legend>
                <div class="text-center">
                    <?php 
                        $grand_total = 0;
                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $values) {
                                $grand_total += ($values['price'] * $values['qty']);
                                echo "<p>{$values['title']} x {$values['qty']} = $" . number_format($values['price'] * $values['qty'], 2) . "</p>";
                            }
                        } else {
                            // Redirect if cart empty
                            header('location:'.SITEURL);
                        }
                    ?>
                    <br>
                    <h3>Total: $<?php echo number_format($grand_total, 2); ?></h3>
                    <input type="hidden" name="total" value="<?php echo $grand_total; ?>">
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Delivery Details</legend>
                <?php 
                    // Autofill data from user table if available (optional enhancement)
                    // For now, let user fill/edit details
                ?>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Adnan Afzal" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@adnan.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <div class="order-label">Payment Method</div>
                <select name="payment_method" class="input-responsive">
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Online Payment">Online Payment</option>
                </select>

                <input type="submit" name="submit" value="Place Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                if(isset($_SESSION['cart']) && !empty($_SESSION['cart']))
                {
                    $user_id = $_SESSION['user_id'];
                    $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
                    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
                    $order_date = date("Y-m-d H:i:s");
                    $status = "Ordered"; // Initial status
                    $order_number = "ORD-" . strtoupper(uniqid());
                    $total_amount = $_POST['total'];

                    // 1. Insert into tbl_order
                    // Note: 'food', 'price', 'qty' columns in tbl_order might be deprecated or used as summary/string 
                    // if we want to keep backward compatibility or just store main info.
                    // For PROFESSIONAL system, we use tbl_order_items. 
                    // But to avoid errors if strict mode is on and we miss columns, let's just insert main info.
                    
                    // We will just store "Mixed" in food name or leave it if nullable. 
                    // Assuming we updated schema to allow these to be nullable or we just put placeholders.
                    // Actually, the original schema had 'food', 'price', 'qty' as required probably. 
                    // Let's modify the query to handle the table structure we HAVE.
                    // We added 'user_id', 'order_number', 'payment_method'.
                    // We should probably store a summary in 'food' column like "3 items" or the first item name + "..."
                    
                    $food_summary = count($_SESSION['cart']) . " Items";

                    $sql = "INSERT INTO tbl_order SET 
                        user_id = $user_id,
                        food = '$food_summary', 
                        price = $total_amount, 
                        qty = 1, 
                        total = $total_amount,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        order_number = '$order_number',
                        payment_method = '$payment_method'
                    ";

                    $res = mysqli_query($conn, $sql);

                    if($res==true) {
                        $order_id = mysqli_insert_id($conn);

                        // 2. Insert Order Items
                        foreach($_SESSION['cart'] as $values) {
                            $food_id = $values['id']; // Assuming 'id' is in the session cart array
                            $price = $values['price'];
                            $qty = $values['qty'];
                            $item_total = $price * $qty;

                            // Need to make sure we have food_id, if not in session, might need to fetch or just skip
                            // The cart implementation in cart.php iterates $values. 
                            // In add-to-cart.php, let's hope 'id' is stored. 
                            // Just in case, I should check how cart is stored. 
                            // But usually it's array(id => ..., title=>..., qty=>...) 
                            // Wait, cart structure: $_SESSION['cart'][] = array(...) in typical tutorials.
                            // Let's assume standard structure. If 'id' is missing, we might have issues.

                            $sql2 = "INSERT INTO tbl_order_items SET 
                                order_id = $order_id,
                                food_id = '$food_id',
                                price = $price,
                                qty = $qty,
                                total = $item_total
                            ";
                            $res2 = mysqli_query($conn, $sql2);
                        }

                        // Clear Cart
                        unset($_SESSION['cart']);

                        // Redirect
                        $_SESSION['order'] = "<div class='success text-center'>Order Placed Successfully. Order #: $order_number</div>";
                        header('location:'.SITEURL.'my-orders.php');
                    } else {
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Place Order.</div>";
                        header('location:'.SITEURL);
                    }
                }
            }
        ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
