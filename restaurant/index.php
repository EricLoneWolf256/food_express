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
                    //Sql Query to get orders related to this restaurant
                    // Since tbl_order doesn't inherently have restaurant_id unless we join or use the new item table logic.
                    // For now, let's query tbl_order_items if we updated it, or tbl_food join.
                    // Simplified: count orders where they have items.
                    // OR if we added restaurant_id to tbl_order (which might be complex if one order has multiple restaurants).
                    // Let's assume for now we count items sold.
                    
                    $sql2 = "SELECT * FROM tbl_food WHERE restaurant_id=$restaurant_id AND active='Yes'"; // Placeholder for Orders
                    // Better: Count distinct orders from order_items
                    // But first let's just show Foods and maybe Total Revenue from their items.
                    
                    // Let's try to allow them to manage FOODS first. Orders logic is complex without proper multi-vendor structure.
                    // I will just show "My Foods" and "Revenue" based on their items in tbl_order_items (if populated)
                    
                    $count2 = 0; // Placeholder
                ?>
                <h1><?php echo $count2; ?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">
                <h1>$0.00</h1>
                <br />
                Pending Revenue
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

<?php include('partials/footer.php'); ?>
