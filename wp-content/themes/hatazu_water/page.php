<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </div>
    </div>
</div>
<?php if(is_checkout()){ ?>
<div class="checkout block">
<?php }
elseif(is_cart()){ ?>
<div class="cart block">
<?php }else if(is_account_page()){ ?>
<div class="block">
<?php }else { ?>
<div class="block">
    <div class="container">
        <div class="row">
<?php } 
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content', get_post_type() );
	//get_template_part( 'template-parts/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
?>
<?php if(is_checkout()){ ?>
    </div>
</div>
<?php }
elseif(is_cart()){ ?>
    </div>
</div>
<?php } else { ?>
        </div>
    </div>
</div>
<?php } ?>
<?php
get_footer();
