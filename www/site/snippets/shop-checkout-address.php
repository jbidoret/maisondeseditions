<div class="flex">
    <article class="form-checkout--contact">
        <h2><?= t('Contact') ?></h2>
        <div class="form-checkout__section">
            <?php snippet('shop-label', ['fieldId' => 'email', 'label' => t("E-Mail"), 'autocomplete' => 'email']); ?>
        </div>
    </article>

    <article class="form-checkout--address">
        <h2><?= t('Billing address') ?></h2>
        <div class="form-checkout__section">
            <?php snippet('shop-label', ['fieldId' => 'name', 'label' => t("name"), 'autocomplete' => 'name']); ?>
            <?php snippet('shop-label', ['fieldId' => 'street', 'label' => t("street"), 'class' => 'is-full', 'autocomplete' => 'street-address']); ?>
            <?php snippet('shop-label', ['fieldId' => 'postalCode', 'label' => t("postalCode"), 'class' => 'is-1-3', 'autocomplete' => 'postal-code']); ?>
            <?php snippet('shop-label', ['fieldId' => 'city', 'label' => t("city"), 'class' => 'is-2-3', 'autocomplete' => 'address-level2']); ?>
            <?php snippet('shop-label', ['fieldId' => 'state', 'label' => t("state"), 'class' => 'is-1-2', 'autocomplete' => 'address-level1']); ?>
            <?php snippet('shop-label', ['fieldId' => 'countryCode', 'label' => t("country"), 'class' => 'is-1-2', 'autocomplete' => 'country', 'help' => t("Des frais de port supplémentaires peuvent être facturés pour les destinations hors France et hors UE.")]); ?>
        </div>
    </article>
</div>

<div class="checkout-buttons">
    <button type="button" id="checkout-delivery-button"><?= t("suivant") ?></button>
</div>