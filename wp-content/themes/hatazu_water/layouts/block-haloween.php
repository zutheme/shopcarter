<div class="haloween-shop">
    <div class="container">
        <div class="row">
            <div class="col-12 head-shop text-center">
                <?php echo get_field('haloween_header','customizer'); ?>
                <div class="menu-list">
                    <ul>
                        <?php $haloween_header_menu = get_field('haloween_header_menu','customizer');
                        if ($haloween_header_menu) :?>
                        <?php foreach ($haloween_header_menu as $value) :?>
                         <li><a href="<?php  echo $value['haloween_header_link'];  ?>"><?php  echo $value['haloween_header_text'];  ?></a></li>
                        <?php endforeach;?>           
                        <?php endif;?> 
                    </ul>
                </div>
            </div>
            <div class="col-12 head-haloween text-center">
                <?php echo get_field('litte_header','customizer'); ?>
            </div>
             <?php $litte_header_menu = get_field('litte_header_menu','customizer');
                if ($litte_header_menu) :?>
                <?php foreach ($litte_header_menu as $value) :?>
                 <div class="col-4 thumb-cate text-center">
                    <a href="<?php echo $value['litte_header_link']; ?>"><img src="<?php echo $value['litte_header_image']['url']; ?>"></a>
                    <div class="menu-cate">
                        <h3><?php echo $value['litte_header_text']; ?></h3>
                        <div class="cate">
                            <ul>
                                <li><a href="<?php echo $value['litte_header_link1']; ?>"><?php echo $value['litte_header_text1']; ?></a></li>
                                <li><a href="<?php echo $value['litte_header_link2']; ?>"><?php echo $value['litte_header_text2']; ?></a></li>
                            </ul>
                        </div>
                    </div> 
                </div>
                <?php endforeach;?>           
            <?php endif;?> 
        </div>
    </div>
</div>