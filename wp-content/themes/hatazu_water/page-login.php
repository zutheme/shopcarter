<?php
/**
 *  Template Name: Login Form
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eleaning
 */
get_header();?>
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
<div class="block">
    <div class="container">
        <div class="row">
		<?php wc_get_template( 'myaccount/form-login.php' ); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?> 