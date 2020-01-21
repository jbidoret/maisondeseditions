<?php snippet('header') ?>

    <main class="m-cart gimmewhitespace">

        <div id="emptycart" class="paragraphs-1">
            <p class="underlink"><?= tt('checkout.emptycart', ['url' => page("shop")->url()]) ?></p>
        </div>


        <section id="checkout" class="checkout-step visible">

            <?php snippet('shop-cart', ['productList' => merx()->cart()]) ?>
            <div class="shop-cart-mention mention">
                <span class="i">→</span> Les frais de port et d’emballage sont calculés au moment de choisir les modalités de livraison.
            </div>
            <div class="checkout-buttons">
                <a class="blackbutton" href="<?= page("shop")->url() ?>"><?= t("continuer vos achats") ?></a>
                <a class="blackbutton" href="<?= page("checkout")->url() ?>"><?= t("checkout.gotoCheckout") ?></a>                
            </div>
        </section>

    </main>

<?php snippet('footer') ?>
