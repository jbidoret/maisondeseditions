<?php snippet('header')?>

  <main class="main" role="main">

    <?php snippet("shop-categories") ?>
    <div class="products grid">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>
    <?php foreach ($page->children()->listed() as $product): ?>
        <div class="product grid-item size-<?= $product->size() ?> <?= $product->category() ?> color-<?php 
                $items = ['pink', 'grey', 'blue', 'yellow', 'purple'];
                echo $items[array_rand($items)]; ?>">
                
			<a href="<?= $product->url() ?>" vocab="http://schema.org" typeof="Product">
			
				<?php 
					$image = $product->cover();
					if($product->size() == 'double'){ 
                        $thumb = $image->resize(700);
                    } else {
                        $thumb = $image->resize(350);
                    }
                ?>
				<img property="image" content="<?= $thumb->url() ?>" src="<?= $thumb->url() ?>" alt="<?= $product->title() ?>">
				<h3>
					<span>
                        <strong><?= $product->title()->html() ?></strong>
					   <?php if( $product->authors() ): ?>
						<span>
						<?= $product->authors()->html() ?>
                        </span>
					   <?php endif; ?>
					</span>
				</h3>
			</a>		
		</div>
    <?php endforeach;?>
    </div>

</main>
<?php snippet('footer')?>