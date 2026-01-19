<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> 
</head>
<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section Ends -->

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <br><br>
            
            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Foods
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">
                <h1>$500.00</h1>
                <br />
                Revenue Generated
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>
</body>
</html>
