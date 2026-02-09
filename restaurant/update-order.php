<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $driver_id = isset($row['driver_id']) ? $row['driver_id'] : 0;
                    $order_number = isset($row['order_number']) ? $row['order_number'] : "N/A";
                    $total = $row['total'];
                }
                else
                {
                    header('location:'.SITEURL.'restaurant/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'restaurant/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Order #</td>
                    <td><b> <?php echo $order_number; ?> </b></td>
                </tr>

                <tr>
                    <td>Total Price</td>
                    <td><b> $ <?php echo $total; ?> </b></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered (Pending)</option>
                            <option <?php if($status=="Confirmed"){echo "selected";} ?> value="Confirmed">Confirmed</option>
                            <option <?php if($status=="Preparing"){echo "selected";} ?> value="Preparing">Preparing</option>
                            <option <?php if($status=="Out for Delivery"){echo "selected";} ?> value="Out for Delivery">Out for Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Assign Driver: </td>
                    <td>
                        <select name="driver_id">
                            <option value="0">None</option>
                            <?php 
                                // Fetch Drivers
                                $sql_drivers = "SELECT * FROM tbl_driver";
                                $res_drivers = mysqli_query($conn, $sql_drivers);
                                if(mysqli_num_rows($res_drivers) > 0) {
                                    while($driver = mysqli_fetch_assoc($res_drivers)) {
                                        $d_id = $driver['id'];
                                        $d_name = $driver['full_name'];
                                        $selected = ($d_id == $driver_id) ? "selected" : "";
                                        echo "<option value='$d_id' $selected>$d_name</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><?php echo $customer_name; ?></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><?php echo $customer_contact; ?></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><?php echo $customer_address; ?></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $status = $_POST['status'];
                $driver_id = $_POST['driver_id'];

                $sql2 = "UPDATE tbl_order SET 
                    status = '$status',
                    driver_id = $driver_id
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'restaurant/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'restaurant/manage-order.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
