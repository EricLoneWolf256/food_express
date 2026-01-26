<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>My Orders</h1>
        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Order #</th>
                <th>Total</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Action</th>
            </tr>

            <?php 
                $restaurant_id = $_SESSION['restaurant_id'];

                // Get orders that comprise items from this restaurant
                // Note: DISTINCT is important if one order has multiple items from same restaurant
                // We rely on tbl_order_items having 'restaurant_id' which we added in migration
                
                $sql = "SELECT DISTINCT o.* FROM tbl_order o 
                        JOIN tbl_order_items oi ON o.id = oi.order_id 
                        WHERE oi.restaurant_id=$restaurant_id 
                        ORDER BY o.id DESC";

                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $order_number = isset($row['order_number']) ? $row['order_number'] : "N/A";
                        $total = $row['total'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $order_number; ?></td>
                            <td>$<?php echo $total; ?></td>
                            <td>
                                <?php 
                                    if($status=="Ordered") {
                                        echo "<label>$status</label>";
                                    } elseif($status=="On Delivery") {
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
                            <td><?php echo $customer_name; ?> <br> (<?php echo $customer_contact; ?>)</td>
                            <td>
                                <a href="#" class="btn-secondary">View Details</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='6' class='error'>Orders not Available</td></tr>";
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
