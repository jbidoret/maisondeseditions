<?php snippet('header') ?>

  <main class="main" role="main">

    
    <ul class="list gimmewhitespace">
        <?php foreach($page->children()->listed() as $event): ?>    
            <li>
                <a class="title" href="<?php echo $event->url() ?>">
                    <strong><?php echo $event->title()->html() ?></strong>
                    <?php if ($event->subtitle() != ''): ?>
                        <span>↘ <?php echo $event->subtitle()->html() ?></span>
                    <?php endif ?>
                </a>
            </li>      
        <?php endforeach ?>
    </ul>

  </main>

<?php snippet('footer') ?>