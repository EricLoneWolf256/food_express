<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Assign Driver to Order</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $order_number = isset($row['order_number']) ? $row['order_number'] : $id;
                    $driver_id = $row['driver_id'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Order #</td>
                    <td><b> <?php echo $order_number; ?> </b></td>
                </tr>

                <tr>
                    <td>Select Driver: </td>
                    <td>
                        <select name="driver_id">
                            <option value="0">Select Driver</option>
                            <?php 
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
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Assign Driver" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $driver_id = $_POST['driver_id'];

                $sql2 = "UPDATE tbl_order SET 
                    driver_id = $driver_id
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    // Get Driver Name for feedback
                    $sql_name = "SELECT full_name FROM tbl_driver WHERE id=$driver_id";
                    $res_name = mysqli_query($conn, $sql_name);
                    $driver_name = ($res_name && mysqli_num_rows($res_name) > 0) ? mysqli_fetch_assoc($res_name)['full_name'] : "Driver";

                    $_SESSION['update'] = "<div class='success'>Assigned to <b>$driver_name</b> Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Assign Driver.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
