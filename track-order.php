<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Track Your Order</h2>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Order Tracking</legend>
                    <div class="order-label">Enter Order ID</div>
                    <input type="text" name="order_id" placeholder="E.g. 1" class="input-responsive" required>

                    <input type="submit" name="submit" value="Track Order" class="btn btn-primary">
                </fieldset>
            </form>

            <?php 
                if(isset($_POST['submit']))
                {
                    $order_id = $_POST['order_id'];
                    // SQL to check order status would go here
                    // For now, static mock response
                    echo "<br><div class='text-center text-white'><h3>Order #$order_id Status: <span style='color: yellow;'>On Delivery</span></h3></div>";
                }
            ?>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
