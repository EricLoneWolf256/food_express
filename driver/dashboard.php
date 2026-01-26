<?php include('partials/menu.php'); ?>

<?php 
    if(!isset($_SESSION['driver']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Driver Panel.</div>";
        header('location:'.SITEURL.'driver/index.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Driver Dashboard</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br>
        
        <div class="col-4 text-center">
            <h1>0</h1>
            <br />
            Assigned Orders
        </div>

        <div class="col-4 text-center">
            <h1>0</h1>
            <br />
            Delivered Orders
        </div>

        <div class="col-4 text-center">
            <h1>0</h1>
            <br />
            Pending Orders
        </div>

        <div class="clearfix"></div>

        <br><br>
        <h2>Recent Assigned Orders</h2>
        <br>
        <p>No orders assigned yet...</p>

    </div>
</div>

<?php include('partials/footer.php'); ?>
