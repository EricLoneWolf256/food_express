<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Driver Sign Up</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['signup']))
            {
                echo $_SESSION['signup'];
                unset($_SESSION['signup']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name" required>
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" placeholder="Enter Your Email" required>
                    </td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="text" name="phone" placeholder="Enter Your Phone" required>
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Sign Up" class="btn-primary">
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
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "INSERT INTO tbl_driver SET
            full_name='$full_name',
            email='$email',
            phone='$phone',
            username='$username',
            password='$password',
            created_at=NOW()
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res==true)
        {
            $_SESSION['signup'] = "<div class='success'>Driver Registered Successfully.</div>";
            // Auto login or redirect to login? Let's redirect to login for now.
            header('location:'.SITEURL.'driver/index.php');
        }
        else
        {
            $_SESSION['signup'] = "<div class='error'>Failed to Register Driver.</div>";
            header('location:'.SITEURL.'driver/signup.php');
        }
    }
?>
