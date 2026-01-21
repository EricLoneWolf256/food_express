<?php include('partials-front/menu.php'); ?>
<style>
    .tbl-cart{
        width: 100%;
        border-collapse: collapse;
    }
    .tbl-cart th{
        border-bottom: 1px solid #ddd;
        padding: 1%;
        text-align: left;
    }
    .tbl-cart td{
        padding: 1%;
        color: black;
    }
</style>

    <section class="food-search">
        <div class="container">
            <br>
            <form action="" class="order">
                <table class="tbl-cart">
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>

                    <?php 
                        $grand_total = 0;
                        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $key => $values) {
                                $total = $values['price'] * $values['qty'];
                                $grand_total += $total;
                    ?>
                    <tr>
                        <td><?php echo $values['title']; ?></td>
                        <td>$<?php echo $values['price']; ?></td>
                        <td><?php echo $values['qty']; ?></td>
                        <td>$<?php echo number_format($total, 2); ?></td>
                        <td>
                            <a href="remove-cart-item.php?id=<?php echo $values['id']; ?>" class="btn-danger">Remove</a>
                        </td>
                    </tr>
                    <?php 
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Cart is Empty</td></tr>";
                        }
                    ?>

                    <tr>
                        <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                        <td><strong>$<?php echo number_format($grand_total, 2); ?></strong></td>
                        <td></td>
                    </tr>

                </table>

                <br><br>
                <div class="text-center">
                    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                        <a href="<?php echo SITEURL; ?>checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    <?php } ?>
                </div>

            </form>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
