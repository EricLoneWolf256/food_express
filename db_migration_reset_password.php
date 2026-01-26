<?php 
    include('config/constants.php');

    // Add reset_token column
    $sql1 = "ALTER TABLE tbl_users ADD COLUMN reset_token VARCHAR(255) NULL";
    $res1 = mysqli_query($conn, $sql1);

    if($res1) {
        echo "Added reset_token column.<br>";
    } else {
        echo "Error adding reset_token (might already exist): " . mysqli_error($conn) . "<br>";
    }

    // Add reset_expiry column
    $sql2 = "ALTER TABLE tbl_users ADD COLUMN reset_expiry DATETIME NULL";
    $res2 = mysqli_query($conn, $sql2);

    if($res2) {
        echo "Added reset_expiry column.<br>";
    } else {
        echo "Error adding reset_expiry (might already exist): " . mysqli_error($conn) . "<br>";
    }
?>
