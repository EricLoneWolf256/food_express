<?php include('partials/menu.php'); ?>

<?php 
    if(!isset($_SESSION['driver']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Driver Panel.</div>";
        header('location:'.SITEURL.'driver/index.php');
    }
    
    // Always fetch fresh details from DB to ensure accuracy (Session Fix)
    $username = $_SESSION['driver'];
    $sql_d = "SELECT id FROM tbl_driver WHERE username='$username'";
    $res_d = mysqli_query($conn, $sql_d);
    
    if($res_d && mysqli_num_rows($res_d) > 0) {
        $row_d = mysqli_fetch_assoc($res_d);
        $driver_id = $row_d['id'];
        $_SESSION['driver_id'] = $driver_id;
    } else {
        header('location:'.SITEURL.'driver/logout.php');
        die();
    }
?>

<div class="main-content dashboard-wrapper">
    <div class="container">
        <h1 class="dashboard-title">My Assigned Orders</h1>
        
        <?php 
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <div class="table-container">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th width="30%">Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
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
                            
                            $status_class = '';
                            if($status == 'Delivered') $status_class = 'delivered';
                            elseif($status == 'Ordered' || $status == 'Pending') $status_class = 'pending';
                            elseif($status == 'Cancelled') $status_class = 'cancelled';
                            elseif($status == 'On Delivery') $status_class = 'on-delivery';
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td>#<?php echo $order_number; ?></td>
                                <td>
                                    <strong><?php echo $customer_name; ?></strong><br>
                                    <small class="text-muted"><?php echo $customer_contact; ?></small>
                                </td>
                                <td><?php echo $customer_address; ?></td>
                                <td><span class="status-badge <?php echo $status_class; ?>"><?php echo $status; ?></span></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>driver/update-order.php?id=<?php echo $id; ?>" class="btn-sm btn-primary">Update Status</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No Orders Assigned Yet.</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
