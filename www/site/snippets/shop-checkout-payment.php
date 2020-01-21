<div class="flex">

    <article class="form-checkout--payment-selection">
        <h2><?= t('Payment') ?></h2>

        <?php foreach($site->paymentMethods()->toStructure() as $paymentMethod): ?>
        <p class="radiofield">
            <label for="<?= $paymentMethod->value() ?>">
                <input type="radio" name="paymentMethod" id="<?= $paymentMethod->value() ?>" value="<?= $paymentMethod->value() ?>" required data-submit-text="<?= $paymentMethod->buttonText() ?>">
                <span><?= $paymentMethod->text() ?></span>
            </label>
        </p>
        <?php endforeach; ?>

    </article>

    <article class="form-checkout--payment-confirmation">

        <input type="hidden" name="stripePublishableKey" value="<?= option('ww.merx.production') === true ? option('ww.merx.stripe.live.publishable_key') : option('ww.merx.stripe.test.publishable_key') ?>">

        <div class="is-full is-required" hidden data-payment-method="credit-card-sca">
            <h2><?= t('Card') ?></h2>
            <div id="stripe-card"></div>
            <div class="mention" ><?php echo tt('checkout.stripe.mention', ["url" => "https://stripe.com"]) ?></div>
        </div>

        <div class="is-full is-required" hidden data-payment-method="sepa-debit">
            <h2><?= t('SEPA') ?></h2>
            <div id="stripe-sepa-debit"></div>
            <small><?= $site->ibanInfo() ?></small>
            <div class="error" role="alert"></div>
        </div>
    </article>

</div>


<div class="checkout-buttons form-checkout__submit">
    <label>
        <input type="checkbox" name="legal" required>
        <span>
            <?php echo I18n::template('legal.accept', null, [
                'legalurl' => page('cg')->url()
            ]); ?>
        </span>
    </label>
    <div class="error" role="alert"></div>
    <button type="submit" class="button"><?= t('Buy') ?></button>

    <div class="loading paypal" id="loading">
        <?= t("checkout.loading.paypal") ?>
    </div>
    <div class="loading credit-card-sca" id="loading">
        <?= t("checkout.loading.card") ?>
    </div>
</div>