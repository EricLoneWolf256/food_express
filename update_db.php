<?php
include('config/constants.php');

// 1. Create tbl_users
$sql1 = "CREATE TABLE IF NOT EXISTS tbl_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150),
    username VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    email VARCHAR(150),
    phone VARCHAR(20),
    address TEXT,
    created_date DATETIME
)";

$res1 = mysqli_query($conn, $sql1);
if($res1) echo "tbl_users created successfully.<br>";
else echo "Error creating tbl_users: " . mysqli_error($conn) . "<br>";

// 2. Create tbl_order_items
$sql2 = "CREATE TABLE IF NOT EXISTS tbl_order_items (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT UNSIGNED,
    food_id INT UNSIGNED,
    price DECIMAL(10,2),
    qty INT,
    total DECIMAL(10,2)
)";

$res2 = mysqli_query($conn, $sql2);
if($res2) echo "tbl_order_items created successfully.<br>";
else echo "Error creating tbl_order_items: " . mysqli_error($conn) . "<br>";

// 3. Alter tbl_order
$alter_queries = [
    "ALTER TABLE tbl_order ADD COLUMN user_id INT UNSIGNED AFTER id",
    "ALTER TABLE tbl_order ADD COLUMN order_number VARCHAR(50) AFTER id",
    "ALTER TABLE tbl_order ADD COLUMN payment_method VARCHAR(50) AFTER total",
    "ALTER TABLE tbl_order ADD COLUMN delivery_charge DECIMAL(10,2) DEFAULT 0.00 AFTER total"
];

foreach ($alter_queries as $q) {
    $res = mysqli_query($conn, $q);
    if($res) echo "Executed: $q <br>";
    else echo "Error (probably exists): " . mysqli_error($conn) . " for query: $q <br>";
}

?>
