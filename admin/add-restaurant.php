<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Restaurant</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Restaurant Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" placeholder="Email" required>
                    </td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="text" name="phone" placeholder="Phone Number" required>
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <textarea name="address" cols="30" rows="5" placeholder="Address" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Password" required>
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Restaurant" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    if(isset($_POST['submit']))
    {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']); 
        $active = $_POST['active'];

        // Encrypt Password
        $password = md5($password);

        $sql = "INSERT INTO tbl_restaurant SET 
            title='$title',
            email='$email',
            phone='$phone',
            address='$address',
            username='$username',
            password='$password',
            active='$active'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Restaurant Added Successfully.</div>";
            header("location:".SITEURL.'admin/manage-restaurant.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Restaurant.</div>";
            header("location:".SITEURL.'admin/add-restaurant.php');
        }

    }
?>
