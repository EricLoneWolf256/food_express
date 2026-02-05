<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper" style="padding: 2% 0;">
        <h1>My Assigned Orders</h1>
        <br /><br />

        <?php 
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br>

        <table class="tbl-full" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid black; text-align: left;">
                    <th style="padding: 10px;">S.N.</th>
                    <th style="padding: 10px;">Order #</th>
                    <th style="padding: 10px;">Customer</th>
                    <th style="padding: 10px;">Address</th>
                    <th style="padding: 10px;">Status</th>
                    <th style="padding: 10px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $driver_id = $_SESSION['driver_id']; 
                // Display latest assignments first
                $sql = "SELECT * FROM tbl_order WHERE driver_id=$driver_id ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if($count > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $order_number = isset($row['order_number']) ? $row['order_number'] : $id;
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_address = $row['customer_address'];
                        $status = $row['status'];
                        ?>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 10px;"><?php echo $sn++; ?>. </td>
                            <td style="padding: 10px;"><?php echo $order_number; ?></td>
                            <td style="padding: 10px;"><?php echo $customer_name; ?> <br> <small>(<?php echo $customer_contact; ?>)</small></td>
                            <td style="padding: 10px;"><?php echo $customer_address; ?></td>
                            <td style="padding: 10px;">
                                <?php 
                                    if($status=="Ordered") {
                                        echo "<label style='color: blue;'>$status</label>";
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
                            <td style="padding: 10px;">
                                <a href="<?php echo SITEURL; ?>driver/update-order.php?id=<?php echo $id; ?>" class="btn-secondary" style="padding: 5px 10px; background-color: #7bed9f; color: black; text-decoration: none; border-radius: 5px;">Update Status</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='error' style='padding: 20px; text-align: center;'>No Orders Assigned Yet.</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
