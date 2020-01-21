<?php use Wagnerwagner\Merx; ?>
<?php use Kirby\Http\Url; ?>
<?php snippet('header') ?>

<main class="m-invoice gimmewhitespace">

    
    <div class="details ">
        <p class="invoice-header__infos">
            <?= t("Merci de votre commande.<br>Nous la traiterons dans les meilleurs délais.") ?>
        </p>
    </div>

    <div class="m-invoice__container">

        <div class="invoice-section">
            <h2><?= t('invoice.Invoice') ?></h2>
            <div>
                # <?= $page->invoiceNumber() ?><br>
                <?= $page->invoiceDate()->toDate('d.m.Y') ?><br>
            </div>
        </div>

        <?php if($page->invoiceDate()->toInt() + 60 * 30 > time()): ?>
            <div class="confirmation">
                <?= Str::replace($site->thankYouText()->kt(), '{{ email }}', $page->email()) ?>
            </div>
        <?php endif; ?>

        <?php snippet('shop-invoice-header'); ?>

        <div class="invoice-section">
            <h2><?= t('Preview') ?></h2>
            <?php snippet('product-list', ['productList' => $page->cart()]) ?>
        </div>

        <?php snippet('shop-shipping-info') ?>

        <?php snippet('shop-paying-info') ?>
  </div>

  <div class="m-invoice__buttons">
    <button type="button" class="button" onclick="window.print()">
      <?= t('Print invoice') ?>
    </button>
  </div>

  <div class="invoice-footer">
    <div>
      <?= $site->seller()->kt() ?>
    </div>
    <div>
      <p><?= t('Account holder') ?>: <?= $site->accountHolder() ?><br>
      <?= t('IBAN') ?>: <?= formatIBAN($site->iban()) ?>
    </p>
    </div>
  </div>

</main>

<?php snippet('footer') ?>
