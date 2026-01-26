<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Track Your Order</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Order Tracking</legend>
                    <div class="order-label">Enter Order ID</div>
                    <input type="text" name="order_id" placeholder="E.g. 1" class="input-responsive" required>

                    <input type="submit" name="submit" value="Track Order" class="btn btn-primary">
                </fieldset>
            </form>

            <?php 
                if(isset($_POST['submit']))
                {
                    //Get the Order ID
                    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

                    //SQL Query to get the order details
                    $sql = "SELECT * FROM tbl_order WHERE id=$order_id";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count Rows
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //Detail Availble
                        $row = mysqli_fetch_assoc($res);

                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $total = $row['total'];
                        $customer_name = $row['customer_name'];

                        ?>
                        <div class="order-details text-center text-white">
                            <h3>Order #<?php echo $order_id; ?> Details</h3>
                            <br>
                            <p><strong>Customer:</strong> <?php echo $customer_name; ?></p>
                            <p><strong>Date:</strong> <?php echo $order_date; ?></p>
                            <p><strong>Total Amount:</strong> $<?php echo $total; ?></p>
                            <p><strong>Current Status:</strong> 
                                <?php 
                                    if($status=="Ordered") {
                                        echo "<label style='color: white;'>$status</label>";
                                    } elseif($status=="On Delivery") {
                                        echo "<label style='color: yellow;'>$status</label>";
                                    } elseif($status=="Delivered") {
                                        echo "<label style='color: #2ed573;'>$status</label>";
                                    } elseif($status=="Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    } else {
                                        echo "<label style='color: white;'>$status</label>";
                                    }
                                ?>
                            </p>
                        </div>
                        <?php
                    }
                    else
                    {
                        //Order not Available
                        echo "<div class='error text-center'>Order Not Found. Please check your Order ID.</div>";
                    }
                }
            ?>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
