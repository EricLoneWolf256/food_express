<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Forgot Password</h2>
            <br>
            <?php 
                if(isset($_SESSION['forgot'])) {
                    echo $_SESSION['forgot'];
                    unset($_SESSION['forgot']);
                }
            ?>
            <br>
            
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Reset Password</legend>
                    <div class="order-label">Enter your Registered Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@adnan.com" class="input-responsive" required>

                    <input type="submit" name="submit" value="Reset Password" class="btn btn-primary">
                </fieldset>
            </form>

            <?php 
                if(isset($_POST['submit']))
                {
                    //1. Get Email
                    $email = mysqli_real_escape_string($conn, $_POST['email']);

                    //2. Check if email exists
                    $sql = "SELECT * FROM tbl_users WHERE email='$email'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        //Email Found
                        //Generate Token
                        $token = bin2hex(random_bytes(50));
                        //date_default_timezone_set('Asia/Kathmandu'); // Adjust if needed
                        //$expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
                        // Simplest DB compatible format:
                        $expiry = date("Y-m-d H:i:s", time() + 3600); // 1 hr expiry

                        //Save Token to DB
                        $sql2 = "UPDATE tbl_users SET 
                            reset_token='$token',
                            reset_expiry='$expiry'
                            WHERE email='$email'
                        ";
                        $res2 = mysqli_query($conn, $sql2);

                        if($res2==true)
                        {
                            // "Send" Email (Simulated)
                            $resetLink = SITEURL . "reset-password.php?token=" . $token;
                            $_SESSION['forgot'] = "<div class='success'>Reset Link Generated! <br> <a href='$resetLink' style='color: yellow;'>Click here to reset password (SIMULATION)</a></div>";
                            header('location:'.SITEURL.'forgot-password.php');
                        }
                        else
                        {
                            $_SESSION['forgot'] = "<div class='error'>Failed to generate token. Try again.</div>";
                            header('location:'.SITEURL.'forgot-password.php');
                        }
                    }
                    else
                    {
                        //Email not found
                        $_SESSION['forgot'] = "<div class='error'>Email not found.</div>";
                        header('location:'.SITEURL.'forgot-password.php');
                    }
                }
            ?>

        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
