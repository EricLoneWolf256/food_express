<?php 
    include('config/constants.php');

    echo "<h2>Driver Portal DB Migration</h2>";

    // Create tbl_driver
    $sql = "CREATE TABLE IF NOT EXISTS tbl_driver (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        username VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        email VARCHAR(150) NOT NULL,
        created_at DATETIME NOT NULL
    )";

    if(mysqli_query($conn, $sql)) {
        echo "Table tbl_driver created successfully or already exists.<br>";
    } else {
        echo "Error creating tbl_driver: " . mysqli_error($conn) . "<br>";
    }

?>
