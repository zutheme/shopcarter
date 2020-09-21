<?php

/*

 * The template for displaying archive pages

 *

 * @link https://codex.wordpress.org/Template_Hierarchy

 *

 * @package onehealth

 */
get_header(); ?>
	<!-- Main start -->
   <!-- <div class="breadcrumb">
        <?php //custom_breadcrumbs();?>
    </div>
    
    <div class="title-vi">
        <h2 class="font-r"><?php //the_title(); ?></h2>
    </div> -->
    <ul class="newsList stagger-up">
    <?php
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			//get_template_part( 'template-parts/content',get_post_type());
      get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
      ?>
    </ul>
    <?php
      //the_posts_navigation();
      //BEGIN: Page Nav
       if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
       <div class="page">
       <div class="pages">
          <?php custom_pagination($wp_query->max_num_pages,"",$paged); ?>
       </div>
       </div>   
      <?php endif; 
      //the_posts_navigation();
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>        
<?php get_footer(); ?>

