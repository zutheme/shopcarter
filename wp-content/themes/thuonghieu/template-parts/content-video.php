<?php
/**

 * Template part for displaying posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package eleaning

 */
?>
<?php
  $id_post = get_the_ID();
  $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), 'full', false );
  $idyoutube = get_post_meta( $id_post, 'id-youtube', true );
   if(!$thumbnail){
     //$rand = rand(0,4);
    //$_thumbnail = no_thumbnail_url."no-thumbnail".$rand.".jpg";
    $_thumbnail ='https://img.youtube.com/vi/'.$idyoutube.'/0.jpg';
  }else{
    $_thumbnail = $thumbnail[0];
  }
  
if ( is_single() ) :
  wpb_set_post_views($id_post);  
?>
<section class="newsWrap stagger-up">
    <div class="container">
       <?php custom_breadcrumbs();?>
        <div class="infoNews">
            <h2><?php the_title(); ?></h2>
        </div>
        <div class="content">
          <div id="video-container" class="video-container">
            <div id="player"></div> 
          </div>
             <?php //the_content(); ?>
          <?php 
              echo "<script>var playsingle = [];</script>";                
              if( isset($idyoutube) ) {
                      echo "<script>".
                         "playsingle.push('".$idyoutube."');";
                      echo "</script>";
                  }
            ?>
        </div>
        <!-- <div class="sharePost">

            <p>Chia s&#7867;:</p>
            <a class="fb" href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a class="gp" href="#" target="_blank"><i class="fab fa-google-plus-g"></i></a>
            
        </div> -->
    </div>
</section>

<?php else : ?>
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
<?php endif;?>         

