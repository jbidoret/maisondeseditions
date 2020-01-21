<div class="flex">

    <article class="form-checkout--delivery">
        <h2><?= t('Delivery mode') ?></h2>
        <p class="radiofield">
            <label for="useInvoiceAddressAsShippingAddress">
                <input
                    id="useInvoiceAddressAsShippingAddress"
                    type="radio" name="deliveryAddress" checked value="useInvoiceAddressAsShippingAddress">
                <span><?= t('delivery.billingaddress') ?></span>
            </label>
        </p>
        <p class="radiofield">
            <label for="atTheWorkshop">
                <input
                    id="atTheWorkshop"
                    type="radio" name="deliveryAddress" value="atTheWorkshop">
                <span><?= t('delivery.workshop') ?></span>
            </label>
        </p>
        <p class="radiofield">
            <label for="useAnotherShippingAddress">
                <input
                    id="useAnotherShippingAddress"
                    type="radio" name="deliveryAddress" value="useAnotherShippingAddress">
                <span><?= t('delivery.shippingaddress') ?></span>
            </label>
        </p>
    </article>
    <article class="form-checkout--shipping-address">
        <div id="shipping-address" class="form-checkout__section hidden" >
            <?php snippet('shop-label', ['fieldId' => 'shippingAddressName', 'label' => t("name"), 'autocomplete' => 'shipping name']); ?>
            <?php snippet('shop-label', ['fieldId' => 'shippingAddressStreet', 'label' => t("street"), 'class' => 'is-full', 'autocomplete' => 'shipping street-address']); ?>
            <?php snippet('shop-label', ['fieldId' => 'shippingAddressPostalCode', 'label' => t("postalCode"), 'class' => 'is-1-3', 'autocomplete' => 'shipping postal-code']); ?>
            <?php snippet('shop-label', ['fieldId' => 'shippingAddressCity', 'label' => t("city"), 'class' => 'is-2-3', 'autocomplete' => 'shipping address-level2']); ?>
            <?php snippet('shop-label', ['fieldId' => 'shippingAddressState', 'label' => t("state"), 'class' => 'is-1-2', 'autocomplete' => 'shipping address-level1']); ?>
            <?php snippet('shop-label', ['fieldId' => 'shippingAddressCountryCode', 'label' => t("country"), 'class' => 'is-1-2', 'autocomplete' => 'shipping country']); ?>
        </div>
    </article>
</div>

<div class="checkout-buttons">
    <!-- <button type="submit" id="checkout-shipping-button"><?= t("Compute shipping") ?></button> -->
    <button type="submit" id="checkout-payment-button"><?= t("suivant") ?></button>
</div>