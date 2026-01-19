<?php include('partials-front/menu.php'); ?>

<?php 
    if(!isset($_SESSION['user'])) {
        header('location:'.SITEURL.'login.php');
    }
?>

<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">My Orders</h2>
        <br>

        <table class="tbl-full" style="background-color: white; border-radius: 10px; overflow: hidden; padding: 2%;">
            <tr style="background-color: black; color: white;">
                <th style="padding: 10px;">Order #</th>
                <th style="padding: 10px;">Date</th>
                <th style="padding: 10px;">Total</th>
                <th style="padding: 10px;">Status</th>
                <th style="padding: 10px;">Payment</th>
                <th style="padding: 10px;">Action</th>
            </tr>

            <?php 
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM tbl_order WHERE user_id=$user_id ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count > 0) {
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $order_number = $row['order_number'];
                        $order_date = $row['order_date'];
                        $total = $row['total'];
                        $status = $row['status'];
                        $payment_method = $row['payment_method'];

                        ?>
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $order_number; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $order_date; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">$<?php echo number_format($total, 2); ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                                <?php 
                                    if($status=="Ordered") {
                                        echo "<label style='color: blue;'>$status</label>";
                                    } elseif($status=="On Delivery") { // Legacy status support
                                        echo "<label style='color: orange;'>$status</label>"; 
                                    } elseif($status=="Out for Delivery") {
                                        echo "<label style='color: orange;'>$status</label>";
                                    } elseif($status=="Delivered") {
                                        echo "<label style='color: green;'>$status</label>";
                                    } elseif($status=="Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    } else {
                                        echo "<label style='color: black;'>$status</label>";
                                    }
                                ?>
                            </td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo $payment_method; ?></td>
                            <td style="padding: 10px; border-bottom: 1px solid #ddd;">
                                <a href="#" class="btn-primary" style="font-size: 0.8rem;">View Details</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6' class='error'>You have not placed any orders yet.</td></tr>";
                }
            ?>
        </table>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
