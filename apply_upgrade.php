<?php
// Include constants for DB connection
include('config/constants.php');

echo "<h1>Starting Database Upgrade...</h1>";

// Read SQL file
$sql = file_get_contents('upgrade_v2.sql');

if (!$sql) {
    die("Error: Could not read upgrade_v2.sql");
}

// Execute Multi Query
if (mysqli_multi_query($conn, $sql)) {
    do {
        // Store first result set
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($conn));
    
    echo "<h2 style='color: green;'>Upgrade Successful!</h2>";
    echo "<p>Added tables: tbl_restaurant, tbl_rider, tbl_order_items, tbl_reviews</p>";
    echo "<p>Updated tables: tbl_food, tbl_order, tbl_users</p>";
} else {
    echo "<h2 style='color: red;'>Upgrade Failed</h2>";
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
