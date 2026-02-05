<?php include('partials/menu.php'); ?>

<?php 
    if(!isset($_SESSION['driver']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Driver Panel.</div>";
        header('location:'.SITEURL.'driver/index.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Driver Dashboard</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br>
        
        <div class="col-4 text-center">
            <?php 
                $driver_id = $_SESSION['driver_id'];
                // Assigned
                $sql = "SELECT * FROM tbl_order WHERE driver_id=$driver_id";
                $res = mysqli_query($conn, $sql);
                $count_assigned = mysqli_num_rows($res);
            ?>
            <h1><?php echo $count_assigned; ?></h1>
            <br />
            Assigned Orders
        </div>

        <div class="col-4 text-center">
            <?php 
                // Delivered
                $sql2 = "SELECT * FROM tbl_order WHERE driver_id=$driver_id AND status='Delivered'";
                $res2 = mysqli_query($conn, $sql2);
                $count_delivered = mysqli_num_rows($res2);
            ?>
            <h1><?php echo $count_delivered; ?></h1>
            <br />
            Delivered Orders
        </div>

        <div class="col-4 text-center">
            <?php 
                // Pending (Not Delivered and Not Cancelled)
                $sql3 = "SELECT * FROM tbl_order WHERE driver_id=$driver_id AND status!='Delivered' AND status!='Cancelled'";
                $res3 = mysqli_query($conn, $sql3);
                $count_pending = mysqli_num_rows($res3);
            ?>
            <h1><?php echo $count_pending; ?></h1>
            <br />
            Pending Orders
        </div>

        <div class="clearfix"></div>

        <br><br>
        <h2>Recent Assigned Orders</h2>
        <br>
        <table class="tbl-full">
            <tr>
                <th>Order #</th>
                <th>Status</th>
                <th>Customer</th>
                <th>Action</th>
            </tr>
            <?php 
                // Available latest 5
                $sql4 = "SELECT * FROM tbl_order WHERE driver_id=$driver_id ORDER BY id DESC LIMIT 5";
                $res4 = mysqli_query($conn, $sql4);
                if(mysqli_num_rows($res4)>0) {
                    while($row=mysqli_fetch_assoc($res4)) {
                        $id = $row['id'];
                        $order_number = isset($row['order_number']) ? $row['order_number'] : $id;
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        ?>
                        <tr>
                            <td><?php echo $order_number; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><a href="<?php echo SITEURL; ?>driver/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='error'>No orders assigned.</td></tr>";
                }
            ?>
        </table>

    </div>
</div>

<?php include('partials/footer.php'); ?>
