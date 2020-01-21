<div class="invoice-section">
    <h2><?= t('paying.Payment') ?></h2>
    <article>
        <p>
            <?php echo I18n::template('paying.method', null, [
                'paymentMethod' => strtolower($page->paymentMethodString())
            ]); ?>.
            <?php if ($page->payed()->isTrue()): ?>
                <?= t('paying.PaymentDone') ?>
            <?php elseif ($payedDate = $page->payedDate()->toDate()): ?>
                <br>
                <?php echo I18n::template('paying.DateAndHours', null, [
                    'paymentDate' => date('d.m.Y', $payedDate),
                    'paymentHour' => date('H:i', $payedDate)
                ]); ?>
            <?php else: ?>
                <?= t('paying.PaymentNotDone') ?>
            <?php endif; ?>
            <?php if ((string)$page->paymentMethod() === 'invoice' && $page->paymentComplete()->isFalse()): ?>
                <br>
                <?php echo I18n::template('paying.PleasePay', null, [
                    'paymentSum' => $page->formattedSum()
                ]); ?>
            <?php endif; ?>
        </p>

        <?php if ((string)$page->paymentMethod() === 'invoice'): ?>
        <table>
            <tr>
                <th><?= t('paying.Dest') ?></th>
                <td><?= $site->accountHolder() ?></td>
            </tr>
            <tr>
            <th><?= t('paying.IBAN') ?></th>
                <td><?= formatIBAN($site->iban()) ?></td>
            </tr>
            <tr>
            <th><?= t('paying.Amount') ?></th>
                <td><?= $page->formattedSum() ?></td>
            </tr>
            <tr>
            <th><?= t('paying.InvoiceNumber') ?></th>
                <td><?= $page->invoiceNumber() ?></td>
            </tr>
        </table>
        <?php endif; ?>
    </article>
</div>
