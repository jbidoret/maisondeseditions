<?php snippet('header') ?>

    <main class="m-checkout gimmewhitespace">

        
        <?php if ($message = merx()->getMessage()): ?>
            <div class="error error--message">
                <strong><?= $message ?></strong><br>
            </div>
        <?php endif; ?>

        <div id="emptycart" class="paragraphs-1">
            <p class="underlink"><?= tt('checkout.emptycart', ['url' => page("shop")->url()]) ?></p>
        </div>

        <form class="form-checkout" method="post" action="shop-api/submit">
            
            <section id="cart" class="checkout-step visible ">
                <?php snippet('shop-cart', ['productList' => merx()->cart()]) ?>
            </section>

            <section id="address" class="checkout-step  ">
                <?php snippet("shop-checkout-address") ?>
            </section>

            <section id="delivery" class="checkout-step ">
                <?php snippet("shop-checkout-delivery") ?>
            </section>

            <section id="payment" class="checkout-step ">
                <?php snippet("shop-checkout-payment") ?>
            </section>
        </form>

        <script src="https://js.stripe.com/v3/"></script>

        <section hidden id="cg" >
            <div class="text">
                <?= page('cg')->text()->kt() ?>
            </div>
        </section>


    </main>

<?php snippet('footer') ?>
