<?php snippet('header')?>
    <main class="main product-<?= $page->category() ?>" role="main">

        <?php snippet("shop-categories") ?>

        <div class="text">
			<h1 ><?= $page->title()->html() ?></h1>
        </div>
        
        <article class="product cf gimmewhitespace">
            <?php if ($page->hasImages()): ?>
                <div class="gallery ">
                    <div class="images slider ">
                    <?php foreach ($page->images() as $photo) : ?>	
                        <div class="item"><span></span><img src="<?= $photo->resize(1000, 600)->url() ?>"  alt="<?= $photo->title() ?>"/></div>
                    <?php endforeach ?>
                    </div>
                    <div class="tns-controls" aria-label="Carousel Navigation" tabindex="0"><button data-controls="prev" tabindex="-1" aria-controls="tns1" class="button">←</button><button class="button" data-controls="next" tabindex="-1" aria-controls="tns1">→</button></div>
                </div>
            <?php endif ?>
            <div class="description">
				
				<div class="variants">
                    <?php if($page->soldout()->bool()): ?>
                        <span class="soldout"><?= t('Sold Out') ?></span>
                    <?php else: ?>
                    <?php foreach($page->variants()->toStructure() as $variant): ?>
                    <div vocab="http://schema.org/" typeof="Product" class="variant">
                        <h3 property="name" content="<?php echo $page->title().' &ndash; '.$variant->title() ?>"><?php echo $variant->title() ?></h3>
                        <form class="form-buy" method="POST" action="<?= $site->url() ?>/shop-api/add-to-cart">
                            <input type="hidden" name="id" value="<?= $page->id() ?>">
                            <input type="hidden" name="variant" value="<?= $variant ?>">
                            <button type="submit" class="button"><?= t('Buy') ?></button>
                            <span class="price"><?= formatPrice($variant->price()->float()); ?></span>
                        </form>
                        <div property="description">
                            <?php e(trim($variant->description()) != '',$variant->description()->kirbytext()) ?>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <?php endif ?>
				</div>
				<div class="details">
                    <p>
                        <?= $page->authors()->kti() ?>
                    </p>
                    <div class="intro">
                        <?= $page->intro()->kt() ?>
                    </div>
                    
                    <?= $page->text()->kt() ?>
                </div>

			</div>
		
		</article>

    </main>
<?php snippet('footer')?>        