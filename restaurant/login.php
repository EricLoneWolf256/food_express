<?php 
    include('../config/constants.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Login - Food Express</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        .login {
            width: 30%;
            border: 1px solid grey;
            margin: 10% auto;
            padding: 2%;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #ff4757;
            border-color: #ff4757;
        }
        .btn-primary:hover {
            background-color: #ff6b81;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Restaurant Login</h1>
        <br><br>

        <?php 
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

        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Restaurant Username" required><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password" required><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = md5($_POST['password']); // Using md5 for consistency with Admin, consider upgrading to password_hash later

                $sql = "SELECT * FROM tbl_restaurant WHERE username='$username' AND password='$password' AND active='Yes'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1) {
                    $row = mysqli_fetch_assoc($res);
                    $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
                    $_SESSION['restaurant_user'] = $username;
                    $_SESSION['restaurant_id'] = $row['id']; // Important for filtering data

                    header('location:'.SITEURL.'restaurant/');
                } else {
                    $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match (or account inactive).</div>";
                    header('location:'.SITEURL.'restaurant/login.php');
                }
            }
        ?>

        <p class="text-center">Created By - <a href="#">Food Express</a></p>
    </div>
</body>
</html>
