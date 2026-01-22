<?php
include('config/constants.php');
mysqli_report(MYSQLI_REPORT_OFF);

$tables = ['tbl_restaurant', 'tbl_rider', 'tbl_order_items', 'tbl_reviews', 'tbl_food', 'tbl_users'];

echo "--- VERIFICATION REPORT ---\n";
foreach ($tables as $table) {
    if ($conn->query("SELECT 1 FROM $table LIMIT 1")) {
        echo "[OK] $table exists (or empty)\n";
    } else {
        // If SELECT 1 fails, it might be empty or missing. Check error.
        if ($conn->errno == 1146) { // Table doesn't exist
            echo "[FAIL] $table MISSING\n";
        } else {
             echo "[OK] $table exists (Query error: " . $conn->error . ")\n";
        }
    }
}

// Check column
$res = $conn->query("SHOW COLUMNS FROM tbl_order LIKE 'restaurant_id'");
if ($res && $res->num_rows > 0) {
    echo "[OK] tbl_order has restaurant_id\n";
} else {
    echo "[FAIL] tbl_order MISSING restaurant_id\n";
}
echo "--- END REPORT ---\n";
?>
