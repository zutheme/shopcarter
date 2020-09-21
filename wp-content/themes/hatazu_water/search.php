<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hatazu_water
 */

get_header();
?>
 <div class="page-header">
    <div class="page-header__container container">
        <div class="page-header__breadcrumb">
            <nav aria-label="breadcrumb">
            	<?php custom_breadcrumbs(); ?>
            </nav>
        </div>
        <div class="page-header__title">
        <h1><?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'hatazu_water' ), '<span>' . get_search_query() . '</span>' );
			?></h1>
        </div>
    </div>
</div>
<div class="container">
      <div class="row">
      	 <div class="col-12 col-lg-8">
            <div class="block">
                <div class="posts-view">
                     <div class="posts-view__list posts-list posts-list--layout--list">
                        <div class="posts-list__body">
					<?php if ( have_posts() ) : ?>
					 <?php  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; ?>
					<?php
						/* Start the Loop */
						while ( have_posts() ) :
						the_post();
						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );
						endwhile; ?>
					 	</div>
		             </div>
		         <?php  if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
                <div class="posts-view__pagination">
                    <?php custom_pagination($wp_query->max_num_pages,"",$paged); ?>
                </div>   
            <?php endif; ?>
		          
			<?php //the_posts_navigation(); ?>
			<?php else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
			</div>
		</div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="block block-sidebar block-sidebar--position--end">
                <?php get_template_part('layouts/blog-sidebar'); ?>
            </div>
        </div>
    </div>
</div>
<?php
//get_sidebar();
get_footer();
