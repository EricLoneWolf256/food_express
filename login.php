<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Login to your Account</h2>
            
            <br>
            <?php 
                if(isset($_SESSION['signup'])) {
                    echo $_SESSION['signup'];
                    unset($_SESSION['signup']);
                }
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Login Details</legend>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Email" class="input-responsive" required>

                    <div class="order-label">Password</div>
                    <input type="password" name="password" placeholder="Enter Password" class="input-responsive" required>

                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
                    <br><br>
                    <p class="text-center">Don't have an account? <a href="signup.php" style="color: #ff6b81;">Sign Up here</a></p>
                </fieldset>
            </form>

            <?php 
                if(isset($_POST['submit'])) {
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                    $sql = "SELECT * FROM tbl_users WHERE email='$email'";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count==1) {
                        $row = mysqli_fetch_assoc($res);
                        $db_password = $row['password'];

                        if(password_verify($password, $db_password)) {
                            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
                            $_SESSION['user'] = $row['username']; // Keep username for session continuity
                            $_SESSION['user_id'] = $row['id'];
                            
                            // Check if cart is not empty, redirect to checkout
                            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                header('location:'.SITEURL.'checkout.php');
                            } else {
                                header('location:'.SITEURL);
                            }
                        } else {
                            $_SESSION['login'] = "<div class='error'>Email or Password did not match.</div>";
                            header('location:'.SITEURL.'login.php');
                        }
                    } else {
                        $_SESSION['login'] = "<div class='error'>Email or Password did not match.</div>";
                        header('location:'.SITEURL.'login.php');
                    }
                }
            ?>

        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>
</body>
</html>
