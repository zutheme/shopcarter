<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="block post post--layout--classic">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				//the_post_navigation();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
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
get_footer();
