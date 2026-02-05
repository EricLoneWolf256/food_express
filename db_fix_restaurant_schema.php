<?php 
    include('config/constants.php');

    echo "<h1>Checking tbl_restaurant Schema</h1>";

    function checkAndAddColumn($conn, $table, $column, $definition) {
        $sql = "SHOW COLUMNS FROM $table LIKE '$column'";
        $res = mysqli_query($conn, $sql);
        if(mysqli_num_rows($res) == 0) {
            $sql_alter = "ALTER TABLE $table ADD COLUMN $column $definition";
            if(mysqli_query($conn, $sql_alter)) {
                echo "<p style='color: green;'>Added column '$column'.</p>";
            } else {
                echo "<p style='color: red;'>Failed to add '$column': " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<p style='color: blue;'>Column '$column' already exists.</p>";
        }
    }

    checkAndAddColumn($conn, 'tbl_restaurant', 'username', 'VARCHAR(100) NOT NULL');
    checkAndAddColumn($conn, 'tbl_restaurant', 'password', 'VARCHAR(255) NOT NULL');
    checkAndAddColumn($conn, 'tbl_restaurant', 'address', 'TEXT NOT NULL');
    checkAndAddColumn($conn, 'tbl_restaurant', 'phone', 'VARCHAR(20) NOT NULL');
    checkAndAddColumn($conn, 'tbl_restaurant', 'email', 'VARCHAR(150) NOT NULL');

    echo "<p>Done.</p>";
?>
