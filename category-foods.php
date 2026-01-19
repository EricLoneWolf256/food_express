<?php include('partials-front/menu.php'); ?>

    <section class="food-search text-center">
        <div class="container">
            <h2>Foods on <a href="#" class="text-white">"Category Name"</a></h2>
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

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="1">
                        <input type="hidden" name="title" value="Food Title">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="2">
                        <input type="hidden" name="title" value="Smoky Burger">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Nice Momo</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="3">
                        <input type="hidden" name="title" value="Nice Momo">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                   <div style="width: 100px; height: 100px; background-color: #ddd; border-radius: 15px;"></div>
                </div>
                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>
                    <form action="<?php echo SITEURL; ?>add-to-cart.php" method="POST">
                        <input type="hidden" name="id" value="4">
                        <input type="hidden" name="title" value="Food Title">
                        <input type="hidden" name="price" value="2.3">
                        <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
