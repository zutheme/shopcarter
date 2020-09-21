 <!-- .block-slideshow -->
<div class="block-slideshow block-slideshow--layout--full block">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block-slideshow__body">
                    <div class="owl-carousel">
                    <?php $count = 0; ?>
                     <?php $slider = get_field('slider','customizer');
                     //var_dump($slider);
                    if ($slider) :?>
                    <?php foreach ($slider as $value) :?>
                        <!-- SLIDE #1 -->
                     <a class="block-slideshow__slide" href="<?php echo $value['link_slider'];  ?>">
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('<?php echo $value['image_slider']['url'] ;?>')"></div>
                            <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('<?php echo $value['image_slider']['url'] ;?>')"></div>
                           <!--  <div class="block-slideshow__slide-content">
                                <?php  //echo $value['tex1_slider'];  ?>
                                <div class="block-slideshow__slide-button">
                                   <span class="btn btn-primary btn-lg">Đọc thêm</span> 
                                </div>
                            </div> -->
                        </a>
                    <!-- END SLIDE #1 -->   
                     <?php $count++; ?>  
                    <?php endforeach;?>           
                    <?php endif;?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .block-slideshow / end -->