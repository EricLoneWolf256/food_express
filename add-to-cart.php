<?php 
    include('config/constants.php');

    if(isset($_POST['add_to_cart'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $qty = 1; // Default quantity

        // Check if cart exists
        if(isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], "id");
            if(!in_array($id, $item_array_id)) {
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'id' => $id,
                    'title' => $title,
                    'price' => $price,
                    'qty' => $qty
                );
                $_SESSION['cart'][$count] = $item_array;
            } else {
                // Item already exists, maybe increase qty? For now, just notify
                // echo "<script>alert('Item Already Added')</script>";
            }
        } else {
            $item_array = array(
                'id' => $id,
                'title' => $title,
                'price' => $price,
                'qty' => $qty
            );
            $_SESSION['cart'][0] = $item_array;
        }
        
        //Set Session Message
        $_SESSION['add-to-cart'] = "<div class='success text-center'>Item Added to Cart Successfully.</div>";

        // Redirect back
        header('location:' . $_SERVER['HTTP_REFERER']);
    } else {
        // Fallback
         header('location:'.SITEURL);
    }
?>
