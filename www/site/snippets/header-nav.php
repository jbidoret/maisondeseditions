<nav role="navigation" id="nav">
    <ul class="menu">
        <?php foreach($pages->listed() as $p): ?>
        <li><a<?php e($p->isOpen(), ' class="active"') ?> href="<?php echo $p->url() ?>"><?php echo $p->title()->html() ?></a></li>
        <?php endforeach ?>
        <li class="cart-button-li">
        <?= snippet("shop-cart-button")?>
        </li>
    </ul>
</nav>
