<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Driver</h1>
        <br><br>

        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_driver WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if($res==true)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                }
                else
                {
                    $_SESSION['user-not-found'] = "<div class='error'>Driver Not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-driver.php');
                }
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $phone; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Driver" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        $sql = "UPDATE tbl_driver SET
        full_name = '$full_name',
        username = '$username',
        email = '$email',
        phone = '$phone'
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = "<div class='success'>Driver Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-driver.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to Update Driver.</div>";
            header('location:'.SITEURL.'admin/manage-driver.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>
