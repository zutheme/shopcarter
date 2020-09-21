<?php

  $id_post = get_the_ID();

  $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), 'full', false );

   if(!$thumbnail){

     $rand = rand(0,4);

    $_thumbnail = get_template_directory()."/img/no-thumbnail".$rand.".jpg";

  }else{

    $_thumbnail = $thumbnail[0];

  }
//$banner_bg = get_template_directory_uri()."/images/background.jpg";
if ( is_single() ) :

  wpb_set_post_views($id_post);  
the_content();
?>

 

<?php else : 
      //var_dump($menu);
      if(isset($menu)&&!$menu){ ?>
        <li>
        <div class="itemNews">
            <div class="img">
                <div style="background: url('<?php echo $_thumbnail; ?>') center"></div>
                <img src="<?php echo $_thumbnail; ?>">
            </div>
            <div class="copy">
                <!-- <h4>Tin Công nghi&#7879;p</h4> -->
                <h3><?php the_title(); ?></h3>
                    <!-- <p>23-11-2019</p> -->
            </div>
            <a class="link" href="<?php the_permalink(); ?>"></a>
        </div>
      </li>
    <?php } ?> 

<?php endif;?>   