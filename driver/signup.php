<?php 
    ob_start();
    include('partials/menu.php'); 
?>

<div class="login-container" style="background-color: #f1f2f6; min-height: 80vh; display: flex; justify-content: center; align-items: center; padding: 20px;">
    <div class="login-card" style="background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 500px; text-align: center;">
        <h1 class="text-center" style="margin-bottom: 20px; color: #2d3436;">Driver Sign Up</h1>

        <?php 
            if(isset($_SESSION['signup']))
            {
                echo $_SESSION['signup'];
                unset($_SESSION['signup']);
            }
        ?>
        <br>

        <form action="" method="POST">
            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Full Name</label>
                <input type="text" name="full_name" placeholder="Enter Your Full Name" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Email</label>
                <input type="email" name="email" placeholder="Enter Your Email" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Phone Number</label>
                <input type="text" name="phone" placeholder="Enter Your Phone Number" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Username</label>
                <input type="text" name="username" placeholder="Choose a Username" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Password</label>
                <input type="password" name="password" placeholder="Create a Password" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <input type="submit" name="submit" value="Sign Up" class="btn-primary" style="width: 100%; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background 0.3s; margin-bottom: 10px;">
        </form>
        
        <p class="text-center" style="color: #636e72;">Already have an account? <a href="index.php" style="color: #ff6b81; text-decoration: none;">Login Here</a></p>
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
