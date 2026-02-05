<?php 
    include('config/constants.php');

    echo "<h1>Database Migration: Driver Assignment</h1>";

    // 1. Add driver_id to tbl_order
    $sql = "SHOW COLUMNS FROM tbl_order LIKE 'driver_id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) == 0) {
        $sql_alter = "ALTER TABLE tbl_order ADD COLUMN driver_id INT DEFAULT 0";
        $res_alter = mysqli_query($conn, $sql_alter);
        if($res_alter) {
            echo "<p style='color: green;'>Added 'driver_id' column to 'tbl_order'.</p>";
        } else {
            echo "<p style='color: red;'>Failed to add 'driver_id': " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color: orange;'>Column 'driver_id' already exists in 'tbl_order'.</p>";
    }

    // 2. Add driver_id to tbl_driver (Wait, tbl_driver struct?)
    // tbl_driver was verified in signup.php (full_name, email, phone, username, password)
    // No changes needed there.

    echo "<p>Migration Check Complete.</p>";
?>
