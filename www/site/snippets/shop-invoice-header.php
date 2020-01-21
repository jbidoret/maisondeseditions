<header class="invoice-header invoice-section">
    <!-- <h2><?= t('invoice.customer') ?></h2> -->
    <div class="invoice-header__contact">
        <p>
            <?= $page->name() ?><br>
            <?= $page->street() ?><br>
            <?= $page->postalCode() ?> <?= $page->city() ?><br>
            <?php e($page->state()->isNotEmpty(), $page->state() . "<br>") ?>
            <?php
                $field = $page->blueprint()->field('countryCode');
                $countryCode = $page->countryCode()->value();
                echo $field['options'][$countryCode] ?? $countryCode;
            ?>
            <br>
            <?= $page->email() ?>
        </p>
    </div>
</header>
