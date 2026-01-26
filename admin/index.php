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
                <?php 
                    //Sql Query 
                    $sql = "SELECT * FROM tbl_category";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count Rows
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">
                <?php 
                    //Sql Query 
                    $sql2 = "SELECT * FROM tbl_food";
                    //Execute Query
                    $res2 = mysqli_query($conn, $sql2);
                    //Count Rows
                    $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                <br />
                Foods
            </div>

            <div class="col-4 text-center">
                <?php 
                    //Sql Query 
                    $sql3 = "SELECT * FROM tbl_order";
                    //Execute Query
                    $res3 = mysqli_query($conn, $sql3);
                    //Count Rows
                    $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">
                <?php 
                    //Create SQL Query to Get Total Revenue Generated
                    //Aggregate Function in SQL
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                    //Execute the Query
                    $res4 = mysqli_query($conn, $sql4);

                    //Get the VAlue
                    $row4 = mysqli_fetch_assoc($res4);
                    
                    //GEt the Total Rev
                    $total_revenue = $row4['Total'];

                ?>
                <h1>$<?php echo number_format($total_revenue ?? 0, 2); ?></h1>
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
