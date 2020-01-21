<?php use Wagnerwagner\Merx\Merx; ?>
<?php if ($productList): ?>
<div class="cart">
    <table class="cart-table">
        <thead>
            <tr>
                <th class="cart-table__article"><?= t('product.Article') ?></th>
                <th><?= t('product.UnitPrice') ?></th>
                <th><?= t('product.Quantity') ?></th>
                <th><?= t('product.Amount') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productList as $item): ?>
                <?php $itemPage = page($item['id']); ?>
                <tr class="cart-item">
                    <th class="cart-table__article">
                        <strong><?= $item['title'] ?></strong>
                        <?php if ($item['giftto']): ?>
                            <p><?= t("gift_to") ?> : <?= $item['giftto'] ?></p>
                        <?php endif; ?>
                        <?php if ($item['giftfrom']): ?>
                            <p><?= t("gift_from") ?> : <?= $item['giftfrom'] ?></p>
                        <?php endif; ?>
                    </th>
                    <td>
                        <?= Merx::formatPrice($item['price']) ?>
                    </td>
                    <td>
                        <span class="cart-item__quantity"><?= $item['quantity'] ?></span>
                    </td>
                    <td>
                        <?= Merx::formatPrice($item['sum']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="cart-table__tax">
                    <?= t('product.TaxLabel') ?>
                </td>
                <th class="cart__tax">
                    <?= formatPrice($productList->getTax()) ?>
                </th>
            </tr>
            <tr>
                <th colspan="3" class="cart-table__total">
                    <?= t('product.Total') ?>
                </th>
                <th class="cart__sum">
                    <?= formatPrice($productList->getSum()) ?>
                </th>
            </tr>
        </tfoot>
    </table>
</div>
<?php endif; ?>
