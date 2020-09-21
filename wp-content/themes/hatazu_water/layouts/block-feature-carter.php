<!-- .block-features -->
<div class="block block-features block-features--layout--boxed">
    <div class="container">
        <div class="block-features__list">
             <?php $count = 0; ?>
             <?php $featured_block = get_field('featured_block','customizer');
            if ($featured_block) :?>
            <?php foreach ($featured_block as $value) :?>
            <?php if ($count > 0) { ?> 
            <div class="block-features__divider"></div>
            <?php } ?>
            <div class="block-features__item">
                <div class="block-features__content">
                    <div class="block-features__title"><a href="<?php  echo $value['featured_block_link'];  ?>"><?php  echo $value['featured_block_text'];  ?></a></div>
                   <!--  <div class="block-features__subtitle">Call us anytime</div> -->
                </div>
            </div>
             <?php $count++; ?>  
            <?php endforeach;?>           
            <?php endif;?>  
           
        </div>
    </div>
</div>
<!-- .block-features / end -->