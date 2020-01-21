<?php snippet('header') ?>

  <main class="main" role="main">

    <div class="text">
        <?php if($page->depth()>2): ?>
        <h3>
            <a href="<?php echo $page->parent()->url() ?>">
                 ← <?php echo $page->parent()->title() ?><br>
            </a>
        </h3>
        <?php endif; ?>
        
        <h1>
            <?php echo $page->title() ?>
        </h1>
        <h2>↘ <?php echo $page->subtitle() ?></h2>
        <div class="intro"><?php echo $page->intro()->kirbytext() ?></div>
        <?php echo $page->text()->kirbytext() ?>
    </div>
    
    <?php if ($page->hasListedChildren()) :?>
        <ul class="list gimmewhitespace">
        <?php foreach($page->children()->listed() as $event): ?>    
            <li>
                <a class="title" href="<?php echo $event->url() ?>">
                    <strong><?php echo $event->title()->html() ?></strong>
                    <span>↘ <?php echo $event->subtitle()->html() ?></span>
                </a>
            </li>      
        <?php endforeach ?>
    </ul>
    <?php endif; ?>
    <?php if ($page->hasImages()) :?>
        <h2 class="gimmewhitespace">+</h2>
        <?php snippet('gallery.justified') ?>
    <?php endif; ?>

  </main>

<?php snippet('footer') ?>