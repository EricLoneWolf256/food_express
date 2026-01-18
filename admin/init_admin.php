<?php 
    include('../config/constants.php'); 

    // Check if admin exists
    $sql = "SELECT * FROM tbl_admin WHERE username='admin'";
    $res = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($res) == 0) {
        // Insert Default Admin
        // Password is 'admin' -> MD5: 21232f297a57a5a743894a0e4a801fc3
        $sql2 = "INSERT INTO tbl_admin (full_name, username, password) VALUES ('Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3')";
        $res2 = mysqli_query($conn, $sql2);
        
        if($res2) {
            echo "Default Admin Created Successfully.";
        } else {
            echo "Failed to create admin: " . mysqli_error($conn);
        }
    } else {
        echo "Admin 'admin' already exists.";
    }
?>
