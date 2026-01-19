<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>

            <br /><br /><br />

            <?php 
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Order #</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Customer</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    //Get all the orders from database
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // DIsplay the Latest Order at First
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count the Rows
                    $count = mysqli_num_rows($res);

                    $sn = 1; //Create a Serial Number and set its initail value as 1

                    if($count>0)
                    {
                        //Order Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the order details
                            $id = $row['id'];
                            $order_number = isset($row['order_number']) ? $row['order_number'] : "N/A";
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $payment_method = isset($row['payment_method']) ? $row['payment_method'] : "N/A";
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $order_number; ?></td>
                                    <td>$<?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        <?php 
                                            // Ordered, On Delivery, Delivered, Cancelled
                                            if($status=="Ordered") {
                                                echo "<label>$status</label>";
                                            } elseif($status=="On Delivery") {
                                                echo "<label style='color: orange;'>$status</label>";
                                            } elseif($status=="Out for Delivery") {
                                                echo "<label style='color: orange;'>$status</label>";
                                            } elseif($status=="Delivered") {
                                                echo "<label style='color: green;'>$status</label>";
                                            } elseif($status=="Cancelled") {
                                                echo "<label style='color: red;'>$status</label>";
                                            } else {
                                                echo "<label>$status</label>";
                                            }
                                        ?>
                                    </td>
                                    
                                    <td><?php echo $payment_method; ?></td>
                                    <td><?php echo $customer_name; ?> <br> (<?php echo $customer_contact; ?>)</td>
                                    
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>

                            <?php

                        }
                    }
                    else
                    {
                        //Order not Available
                        echo "<tr><td colspan='8' class='error'>Orders not Available</td></tr>";
                    }
                ?>
             
            </table>

        </div>
    </div>

<?php include('partials/footer.php'); ?>
