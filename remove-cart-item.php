<?php 
    include('config/constants.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $key => $values) {
                if($values['id'] == $id) {
                    unset($_SESSION['cart'][$key]);
                }
            }
            // Re-index array
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }

    header('location:'.SITEURL.'cart.php');
?>
