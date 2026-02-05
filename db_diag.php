<?php 
    include('config/constants.php');
    echo "<h1>Table Diagnostics</h1>";

    function showColumns($conn, $table) {
        echo "<h3>$table</h3>";
        $sql = "SHOW COLUMNS FROM $table";
        $res = mysqli_query($conn, $sql);
        if($res) {
            while($row = mysqli_fetch_assoc($res)) {
                echo $row['Field'] . " - " . $row['Type'] . "<br>";
            }
        } else {
            echo "Table not found or error: " . mysqli_error($conn);
        }
    }

    showColumns($conn, 'tbl_food');
    showColumns($conn, 'tbl_order_items');
?>
