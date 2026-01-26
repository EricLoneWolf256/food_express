<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Set New Password</h2>
            <br>
            <?php 
                if(isset($_SESSION['reset'])) {
                    echo $_SESSION['reset'];
                    unset($_SESSION['reset']);
                }

                $token = "";
                if(isset($_GET['token'])) {
                    $token = mysqli_real_escape_string($conn, $_GET['token']);
                    
                    // Check if token matches and is not expired
                    $sql = "SELECT * FROM tbl_users WHERE reset_token='$token' AND reset_expiry > NOW()";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count == 1) {
                        // Token Valid
                        ?>
                        <form action="" method="POST" class="order">
                            <fieldset>
                                <legend>New Password</legend>
                                <div class="order-label">Enter New Password</div>
                                <input type="password" name="new_password" placeholder="New Password" class="input-responsive" required>

                                <div class="order-label">Confirm New Password</div>
                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="input-responsive" required>
                                
                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                <input type="submit" name="submit" value="Change Password" class="btn btn-primary">
                            </fieldset>
                        </form>
                        <?php
                    } else {
                        echo "<div class='error text-center'>Invalid or Expired Token. <br><a href='".SITEURL."forgot-password.php'>Request a new one</a></div>";
                    }
                } else {
                    echo "<div class='error text-center'>Token not provided.</div>";
                }
            ?>
            
            <?php 
                if(isset($_POST['submit']))
                {
                    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
                    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
                    $token = mysqli_real_escape_string($conn, $_POST['token']);

                    if($new_password == $confirm_password) {
                        // Hash Password
                        // Assuming simple md5 or password_hash. login.php used password_verify, so it's password_hash
                        $hash_password = password_hash($new_password, PASSWORD_DEFAULT);

                        // Update DB
                        $sql2 = "UPDATE tbl_users SET 
                            password='$hash_password',
                            reset_token=NULL,
                            reset_expiry=NULL
                            WHERE reset_token='$token'
                        ";
                        $res2 = mysqli_query($conn, $sql2);

                        if($res2) {
                            $_SESSION['login'] = "<div class='success'>Password Changed Successfully. Please Login.</div>";
                            header('location:'.SITEURL.'login.php');
                        } else {
                            $_SESSION['reset'] = "<div class='error'>Failed to update password. Try again.</div>";
                            header('location:'.SITEURL.'reset-password.php?token='.$token);
                        }
                    } else {
                        $_SESSION['reset'] = "<div class='error'>Passwords do not match.</div>";
                        header('location:'.SITEURL.'reset-password.php?token='.$token);
                    }
                }
            ?>

        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
