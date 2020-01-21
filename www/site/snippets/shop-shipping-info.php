<div class="invoice-section">

    <h2><?= t('shipping.Shipping') ?></h2>

    <article>
        <?php if ($page->deliveryAddress()=="atTheWorkshop"): ?>
            <p><?= tt('shipping.atTheWorkshop', ['address' => page("a-propos")->address()->text() ]) ?></p>
        <?php else: ?>
            <?php if ($page->shipped()->isFalse() ): ?>
                <p><?= t('shipping.ShippedSoon') ?></p>
            <?php elseif ($shippingDate = $page->shippingDate()->toInt()): ?>
                <?php echo I18n::template('shipping.ShippedOn', null, [
                    'shippingDate' => date('d.m.Y', $shippingDate),
                    'shippingHour' => date('H:i', $shippingDate)
                ]); ?>
                <p></p>
            <?php else: ?>
                <p><?= t('shipping.Shipped') ?></p>
            <?php endif; ?>
            <h3><?= t('shipping.ShippingAddress') ?></h3>
            <p>
                <?php if ($page->deliveryAddress()=="useInvoiceAddressAsShippingAddress") : ?>
                    <?= $page->name() ?><br>
                    <?= $page->street() ?><br>
                    <?= $page->postalCode() ?> <?= $page->city() ?><br>
                    <?php e($page->state()->isNotEmpty(), $page->state() . "<br>") ?>
                    <?php
                        $field = $page->blueprint()->field('countryCode');
                        $countryCode = $page->countryCode()->value();
                        echo $field['options'][$countryCode] ?? $countryCode;
                    ?>
                <?php else: ?>
                    <?= $page->shippingAddressName() ?><br>
                    <?= $page->shippingAddressStreet() ?><br>
                    <?= $page->shippingAddressPostalCode() ?> <?= $page->shippingAddressCity() ?><br>
                    <?= $page->shippingAddressState() ?> <br>
                    <?= $page->shippingAddressCountry() ?>
                <?php endif; ?>
            </p>
        <?php endif; ?>




    </article>
</div>
