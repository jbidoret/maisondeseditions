<div id="album" >
    <?php foreach($page->images()->sortBy('sort', 'asc') as $image): ?>
    <figure>
        <?php 
            $bigimage = $image->resize(800, 1600);
            $smallimage = $image->resize(1600, 300);
        ?>
        <a  
            data-size="<?php echo $bigimage->width() ?>x<?php echo $bigimage->height() ?>" 
            data-title="<?php echo $image->title() ?>" 
            href="<?php echo $bigimage->url() ?>" >
                <img 
                    width="<?php echo $smallimage->width() ?>" 
                    height="<?php echo $smallimage->height() ?>" 
                    itemprop="thumbnail" 
                    alt="<?php echo $image->title() ?>" 
                    data-title="<?php echo $image->title()->html() ?>" 
                    src="<?= $image->url() ?>"
                    srcset="<?= $image->srcset("default") ?>"
                    >
        </a>
    </figure>
    <?php endforeach ?>
</div>


<script>
//Justify Gallery
const justify_scale = screen.height * 0.2;

let items = document.querySelectorAll('#album figure');

Array.prototype.forEach.call(items, item => {
    
    let image = item.querySelector('img');
    
    image.onload = () => {
        let ratio = image.width / image.height;
        item.style.width = justify_scale * ratio + 'px';
        item.style.flexGrow = ratio;
    }
    
})

</script>