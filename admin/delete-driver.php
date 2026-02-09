<?php 
    include('../config/constants.php');

    $id = $_GET['id'];

    if($id)
    {
        $sql = "DELETE FROM tbl_driver WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Driver Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-driver.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Driver.</div>";
            header('location:'.SITEURL.'admin/manage-driver.php');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-driver.php');
    }
?>
