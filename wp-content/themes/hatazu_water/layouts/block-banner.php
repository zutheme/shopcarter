 <?php $banner_image = get_field('banner_image','customizer'); ?>
 <!-- .block-banner -->
<div class="custom-banner block-banner">
    <div class="container">
        <a href="" class="block-banner__body">
            <div class="block-banner__image block-banner__image--desktop" style="background-image: url('<?php echo $banner_image['url']; ?>')"></div>
            <div class="block-banner__image block-banner__image--mobile" style="background-image: url('<?php echo $banner_image['url']; ?>')"></div>
           <?php //echo get_field('banner_text','customizer');  ?>
           <!--  <div class="block-banner__button">
                <span class="btn btn-sm btn-primary">Đọc thêm</span>
            </div> -->
        </a>
    </div>
</div>
<!-- .block-banner / end -->