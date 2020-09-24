<?php $skip_hop_header_image = get_field('skip_hop_header_image','customizer'); 
    $skip_hop_header_right_image = get_field('skip_hop_header_right_image','customizer'); 
?>
<div class="skip-hop haloween-shop">
    <div class="container">
        <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 thumb-cate-left text-center">
                    <a href="<?php echo get_field('skip_hop_header_link','customizer'); ?>"><img src="<?php echo $skip_hop_header_image['url']; ?>"></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 thumb-cate-right text-center">
                    <a href="#"><img class="thumb" src="<?php echo $skip_hop_header_right_image['url']; ?>"></a>
                    <div class="desc-shop">
                       <?php 
                       $skip_hop_header_right_texts = get_field('skip_hop_header_right_text','customizer');
                            //var_dump($skip_hop_header_right_texts);
                            echo $skip_hop_header_right_texts; 
                       ?>
                        <a class="btn-shop" href="#">Mua sắm</a>
                    </div>
                </div>
        </div>
    </div>
</div>