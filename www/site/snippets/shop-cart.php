<?php
    use Wagnerwagner\Merx\Merx;
?>
<?php if ($productList): ?>

    <div class="cart" >
        <div class="cart__update-overlay"></div>
        <div class="cart__error-overlay" hidden></div>

        <table class="cart-table">
            <thead>
                <tr>
                    <th class="cart-table__article"><?= t('cart.Article') ?></th>
                    <th><?= t('cart.UnitPrice') ?></th>
                    <th><?= t('cart.Quantity') ?></th>
                    <th><?= t('cart.Amount') ?></th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($productList as $item): ?>
                    <?php $is_shipping = $item['id'] == "shop/shipping"; ?>
                    <?php if ($itemPage = page($item['id']) ) :?>

                    <tr class="cart-item" id="<?= $itemPage->id() ?>" data-slug="<?= $itemPage->slug() ?>">
                        <th class="cart-table__article">
                            <div>
                                <strong><?= $itemPage->title(); ?></strong>
                            </div>
                        </th>
                        <td>
                        <span class="cart-item__pu <?php e($is_shipping, 'shipping-amount') ?>"><?= Merx::formatPrice($item['price']) ?></span>
                        </td>
                        <td>
                            <?php if($is_shipping):?>
                                <span hidden class="cart-item__quantity"><?= $item['quantity'] ?></span>
                            <?php else: ?>
                                <button name="decrease">−</button>
                                <button name="increase">+</button>
                                <span class="cart-item__quantity"><?= $item['quantity'] ?></span>                                
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="cart-item__sum  <?php e($is_shipping, 'shipping-amount') ?>"><?= Merx::formatPrice($item['sum']) ?></span>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" class="cart-table__tax">
                    <?= t('cart.TaxLabel') ?>
                </td>
                <th class="cart__tax">
                    <?= Merx::formatPrice($productList->getTax()) ?>
                </th>
            </tr>
            <tr>
                <th colspan="3" class="cart-table__total">
                    <?= t('cart.Total') ?>
                </th>
                <th class="cart__sum">
                    <?= Merx::formatPrice($productList->getSum()) ?>
                </th>
            </tr>
        </tfoot>
    </table>
</div>

<div class="checkout-buttons">
    <button type="button" id="checkout-back-button" data-back_href="<?= page("shop")->url() ?>"><?= t("Retour") ?></button>
    <button type="button" id="checkout-frwd-button"><?= t("checkout.gotoCheckout") ?></button>
</div>

<?php endif; ?>
