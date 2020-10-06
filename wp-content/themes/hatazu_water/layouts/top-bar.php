 
 <div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
             <?php $count = 0; ?>
                     <?php $menu_top = get_field('menu_top','customizer');
                    if ($menu_top) :?>
                    <?php foreach ($menu_top as $value) :?>
                        <div class="topbar__item topbar__item--link">
                            <a class="topbar-link" href="<?php  echo $value['link_menu_top'];  ?>"><?php  echo $value['text_menu_top'];  ?></a>
                        </div>
                    <!-- END SLIDE #1 -->   
                     <?php $count++; ?>  
                    <?php endforeach;?>           
                    <?php endif;?>  
            
           
            <div class="topbar__spring"></div>
            <div class="topbar__phone">
                <a href="tel:0907373875"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?php echo get_field('header_phone1','customizer'); ?></a>
            </div>
             <div class="topbar__phone">
                <a href="tel:0907373875"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<?php echo get_field('header_phone2','customizer'); ?></a>
            </div>
        </div>
    </div>
</div>