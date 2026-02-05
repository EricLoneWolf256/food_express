<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper" style="width: 50%; margin: 0 auto; padding: 2%;">
        <h1>Update Order Status</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id AND driver_id=".$_SESSION['driver_id']; 
                // Security check: ensure this order belongs to this driver
                
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1) {
                    $row = mysqli_fetch_assoc($res);
                    $status = $row['status'];
                    $order_number = isset($row['order_number']) ? $row['order_number'] : $id;
                } else {
                    echo "<div class='error'>Order not found or not assigned to you.</div>";
                    // header('location:'.SITEURL.'driver/my-orders.php');
                    die();
                }
            } else {
                header('location:'.SITEURL.'driver/my-orders.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Order #:</td>
                    <td><b><?php echo $order_number; ?></b></td>
                </tr>
                <tr>
                    <td>Current Status:</td>
                    <td><b><?php echo $status; ?></b></td>
                </tr>
                <tr>
                    <td>New Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Out for Delivery"){echo "selected";} ?> value="Out for Delivery">Out for Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled (Issue)</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Status" class="btn-primary" style="margin-top: 10px; cursor: pointer;">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $sql2 = "UPDATE tbl_order SET status='$status' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if($res2==true) {
                    $_SESSION['update'] = "<div class='success'>Order Status Updated.</div>";
                    header('location:'.SITEURL.'driver/my-orders.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Status.</div>";
                    header('location:'.SITEURL.'driver/my-orders.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
