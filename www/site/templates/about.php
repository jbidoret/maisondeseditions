<?php snippet('header') ?>

  	<main class="main" role="main">
	
    	<div class="text">
	        <h1><?php echo $page->subtitle()->or($page->title()) ?></h1>
	        <?php echo $page->text()->kt() ?>
			    

		</div>			
  	</main>


<?php snippet('footer') ?>