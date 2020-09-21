<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hatazu_water
 */
$id_post = get_the_ID();
  $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($id_post), 'full', false );
  if($thumbnail){
     $_thumbnail = $thumbnail[0];
  }else{
    $_thumbnail = get_template_directory().'/images/posts/post-10.jpg';
  }
  $category = get_the_category($id_post);
  $link = get_category_link( $category[0]->term_id );
?>
<div class="posts-list__item">
    <div class="post-card post-card--layout--list post-card--size--nl">
        <div class="post-card__image">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo $_thumbnail; ?>" alt="">
            </a>
        </div>
        <div class="post-card__info">
            <div class="post-card__category">
                <a href="<?php echo $link; ?>"><?php echo $category[0]->cat_name; ?></a>
            </div>
            <div class="post-card__name">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
            <div class="post-card__date"><?php echo get_the_date( 'F j' ); ?></div>
            <div class="post-card__content">
               <?php the_excerpt(); ?>
            </div>
            <div class="post-card__read-more">
                <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-sm">Read More</a>
            </div>
        </div>
    </div>
</div>

