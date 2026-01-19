<?php include('partials-front/menu.php'); ?>

    <section class="food-search">
        <div class="container">
            <h2 class="text-center text-white">Contact Us</h2>
            <form action="" class="order">
                <fieldset>
                    <legend>Contact Form</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Adnan Afzal" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@adnan.com" class="input-responsive" required>

                    <div class="order-label">Message</div>
                    <textarea name="message" rows="10" placeholder="E.g. Hi, I would like to..." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Send Message" class="btn btn-primary">
                </fieldset>
            </form>
        </div>
    </section>

<?php include('partials-front/footer.php'); ?>
