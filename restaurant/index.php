<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Restaurant Dashboard</h1>
            <br><br>
            
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                // Get Restaurant ID
                $restaurant_id = $_SESSION['restaurant_id'];
            ?>
            <br><br>

            <div class="col-4 text-center">
                <?php 
                    //Sql Query 
                    $sql = "SELECT * FROM tbl_food WHERE restaurant_id=$restaurant_id";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br />
                My Foods
            </div>

            <div class="col-4 text-center">
                <?php 
                    // Count unique orders for this restaurant
                    $sql2 = "SELECT DISTINCT o.id FROM tbl_order o 
                             JOIN tbl_order_items oi ON o.id = oi.order_id 
                             JOIN tbl_food f ON oi.food_id = f.id
                             WHERE f.restaurant_id = $restaurant_id";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">
                <?php 
                    // Calculate Total Revenue (based on items sold by this restaurant)
                    // Only count if order is Delivered (optional, but typical)
                    // For now, let's count all valid orders
                    $sql3 = "SELECT SUM(oi.total) AS total_revenue FROM tbl_order_items oi 
                             JOIN tbl_food f ON oi.food_id = f.id
                             WHERE f.restaurant_id = $restaurant_id";
                    $res3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($res3);
                    $total_revenue = $row3['total_revenue'];
                    if($total_revenue == "") $total_revenue = 0;
                ?>
                <h1>$<?php echo constant('number_format') ? number_format($total_revenue, 2) : $total_revenue; ?></h1>
                <br />
                Total Revenue
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

<?php include('partials/footer.php'); ?>
