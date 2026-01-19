<?php include('partials-front/menu.php'); ?>

    <section class="food-search text-center">
        <div class="container">
            <?php 
                $search = isset($_POST['search']) ? $_POST['search'] : '';
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>
        </div>
    </section>

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                if(isset($_SESSION['add-to-cart']))
                {
                    echo $_SESSION['add-to-cart'];
                    unset($_SESSION['add-to-cart']);
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
