<?php $shop_url = page('shop')->url(); ?>
<ul class="submenu gimmewhitespace filters-button-group button-group">
    <li><a href="<?= $shop_url?>#" data-filter="*" class="<?php e($page->category()->isNotEmpty(), "", "is-checked") ?>">Tout</a></li>
    <li><a href="<?= $shop_url?>#multiples" data-filter=".multiples">Multiples</a></li>
    <li><a href="<?= $shop_url?>#posters" data-filter=".posters">Posters</a></li>
    <li><a href="<?= $shop_url?>#papers" data-filter=".papers">Papiers</a></li>
</ul>