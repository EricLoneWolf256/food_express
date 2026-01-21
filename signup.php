<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Create an Account</h2>
            
            <br>
            <?php 
                if(isset($_SESSION['signup'])) {
                    echo $_SESSION['signup'];
                    unset($_SESSION['signup']);
                }
            ?>
            <br>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Personal Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Username</div>
                    <input type="text" name="username" placeholder="E.g. johndoe" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. john@example.com" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="phone" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <div class="order-label">Password</div>
                    <input type="password" name="password" placeholder="Password" class="input-responsive" required>

                    <input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
                    <br><br>
                    <p class="text-center">Already have an account? <a href="login.php" style="color: #ff6b81;">Login here</a></p>
                </fieldset>
            </form>

            <?php 
                if(isset($_POST['submit'])) {
                    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                    $address = mysqli_real_escape_string($conn, $_POST['address']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $created_date = date("Y-m-d H:i:s");

                    $sql = "INSERT INTO tbl_users SET 
                        full_name='$full_name',
                        username='$username',
                        email='$email',
                        phone='$phone',
                        address='$address',
                        password='$hashed_password',
                        created_date='$created_date'
                    ";

                    $res = mysqli_query($conn, $sql);

                    if($res==true) {
                        $_SESSION['signup'] = "<div class='success'>Registration Successful. Please Login.</div>";
                        header('location:'.SITEURL.'login.php');
                    } else {
                        $_SESSION['signup'] = "<div class='error'>Failed to Register. Username or Email may be taken.</div>";
                        header('location:'.SITEURL.'signup.php');
                    }
                }
            ?>

        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>
</body>
</html>
