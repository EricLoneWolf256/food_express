<?php include('partials/menu.php'); ?>

<div class="login-container" style="background-color: #f1f2f6; min-height: 80vh; display: flex; justify-content: center; align-items: center;">
    <div class="login-card" style="background-color: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center;">
        <h1 class="text-center" style="margin-bottom: 20px; color: #2d3436;">Driver Login</h1>
        
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        <br>

        <form action="" method="POST">
            <div style="margin-bottom: 15px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Username</label>
                <input type="text" name="username" placeholder="Enter Username" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px; text-align: left;">
                <label style="display: block; margin-bottom: 5px; color: #636e72;">Password</label>
                <input type="password" name="password" placeholder="Enter Password" required class="input-responsive" style="width: 100%; padding: 10px; border: 1px solid #dfe6e9; border-radius: 5px;">
            </div>

            <input type="submit" name="submit" value="Login" class="btn-primary" style="width: 100%; padding: 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background 0.3s;">
        </form>
        
        <br>
        <p class="text-center" style="color: #636e72;">Don't have an account? <a href="signup.php" style="color: #ff6b81; text-decoration: none;">Sign Up</a></p>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    if(isset($_POST['submit']))
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM tbl_driver WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['driver'] = $username;

            header('location:'.SITEURL.'driver/dashboard.php');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            header('location:'.SITEURL.'driver/index.php');
        }
    }
?>
