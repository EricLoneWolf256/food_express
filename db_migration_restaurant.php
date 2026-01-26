<?php 
    include('config/constants.php');

    echo "<h2>Restaurant Portal DB Migration</h2>";

    // 1. Update tbl_restaurant
    // Add username, password, address if they don't exist
    $sql1 = "ALTER TABLE tbl_restaurant 
             ADD COLUMN username VARCHAR(100) NOT NULL AFTER title,
             ADD COLUMN password VARCHAR(255) NOT NULL AFTER username,
             ADD COLUMN address TEXT NOT NULL AFTER email";
    
    // We use a try-catch pattern or check if columns exist, but specific ALTER syntax is easier here for "Add if not exists" in some SQL versions.
    // Standard MySQL will error if exists. Let's just try running it.
    if(mysqli_query($conn, $sql1)) {
        echo "Updated tbl_restaurant (added username, password, address).<br>";
    } else {
        echo "tbl_restaurant update skipped or failed (cols might exist): " . mysqli_error($conn) . "<br>";
    }

    // 2. Update tbl_food
    // Add restaurant_id
    $sql2 = "ALTER TABLE tbl_food ADD COLUMN restaurant_id INT UNSIGNED NOT NULL DEFAULT 0 AFTER id";
    if(mysqli_query($conn, $sql2)) {
        echo "Updated tbl_food (added restaurant_id).<br>";
    } else {
        echo "tbl_food update skipped or failed: " . mysqli_error($conn) . "<br>";
    }

    // 3. Update tbl_order_items (Optional but good for multi-vendor filtering)
    // Check if tbl_order_items exists first (checkout.php mentions inserting into it)
    $sql3 = "ALTER TABLE tbl_order_items ADD COLUMN restaurant_id INT UNSIGNED NOT NULL DEFAULT 0 AFTER order_id";
    if(mysqli_query($conn, $sql3)) {
        echo "Updated tbl_order_items (added restaurant_id).<br>";
    } else {
        echo "tbl_order_items update skipped or failed: " . mysqli_error($conn) . "<br>";
    }

?>
