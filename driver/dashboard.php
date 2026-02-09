<?php include('partials/menu.php'); ?>

<?php 
    if(!isset($_SESSION['driver']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Driver Panel.</div>";
        header('location:'.SITEURL.'driver/index.php');
    }
    
    // Always fetch fresh details from DB to ensure accuracy
    $username = $_SESSION['driver'];
    $sql_d = "SELECT id, full_name FROM tbl_driver WHERE username='$username'";
    $res_d = mysqli_query($conn, $sql_d);
    
    if($res_d && mysqli_num_rows($res_d) > 0) {
        $row_d = mysqli_fetch_assoc($res_d);
        $driver_id = $row_d['id'];
        $driver_name = $row_d['full_name'];
        
        // Update Session
        $_SESSION['driver_id'] = $driver_id;
    } else {
        // Driver not found in DB? Security risk. Logout.
        header('location:'.SITEURL.'driver/logout.php');
        die();
    }
?>

<div class="main-content dashboard-wrapper">
    <div class="container">
        <h1 class="dashboard-title">Welcome, <?php echo $driver_name; ?>!</h1>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        
        <div class="dashboard-stats">
            <?php 
                // Assigned
                $sql = "SELECT * FROM tbl_order WHERE driver_id=$driver_id";
                $res = mysqli_query($conn, $sql);
                $count_assigned = mysqli_num_rows($res);
            ?>
            <div class="stat-card assigned">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-info">
                    <h1><?php echo $count_assigned; ?></h1>
                    <span>Assigned Orders</span>
                </div>
            </div>

            <?php 
                // Delivered
                $sql2 = "SELECT * FROM tbl_order WHERE driver_id=$driver_id AND status='Delivered'";
                $res2 = mysqli_query($conn, $sql2);
                $count_delivered = mysqli_num_rows($res2);
            ?>
            <div class="stat-card delivered">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h1><?php echo $count_delivered; ?></h1>
                    <span>Delivered Orders</span>
                </div>
            </div>

            <?php 
                // Pending (Not Delivered and Not Cancelled)
                $sql3 = "SELECT * FROM tbl_order WHERE driver_id=$driver_id AND status!='Delivered' AND status!='Cancelled'";
                $res3 = mysqli_query($conn, $sql3);
                $count_pending = mysqli_num_rows($res3);
            ?>
            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h1><?php echo $count_pending; ?></h1>
                    <span>Pending Orders</span>
                </div>
            </div>
        </div>

        <h2 class="section-title">Recent Assigned Orders</h2>
        <div class="table-container">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Status</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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
                                
                                $status_class = '';
                                if($status == 'Delivered') $status_class = 'delivered';
                                elseif($status == 'Ordered' || $status == 'Pending') $status_class = 'pending';
                                elseif($status == 'Cancelled') $status_class = 'cancelled';
                                elseif($status == 'On Delivery') $status_class = 'on-delivery';
                                ?>
                                <tr>
                                    <td>#<?php echo $order_number; ?></td>
                                    <td><span class="status-badge <?php echo $status_class; ?>"><?php echo $status; ?></span></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><a href="<?php echo SITEURL; ?>driver/update-order.php?id=<?php echo $id; ?>" class="btn-sm btn-primary">Update</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No orders assigned.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php include('partials/footer.php'); ?>
