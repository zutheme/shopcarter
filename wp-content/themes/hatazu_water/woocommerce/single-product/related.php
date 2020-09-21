<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<!-- .block-products-carousel -->
<div class="block block-products-carousel" data-layout="grid-5" data-mobile-grid-columns="2">
   <div class="container">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
		<div class="block-header">
	         <h3 class="block-header__title"><?php echo esc_html( $heading ); ?></h3>
	         <div class="block-header__divider"></div>
	         <div class="block-header__arrows-list">
	            <button class="block-header__arrow block-header__arrow--left" type="button">
	               <svg width="7px" height="11px">
	               <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-left-7x11">
	               </use>
	               </svg>
	            </button>
	             <button class="block-header__arrow block-header__arrow--right" type="button">
	               <svg width="7px" height="11px">
	                  <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#arrow-rounded-right-7x11"></use>
	               </svg>
	            </button>
	         </div>
	      </div>
			<!-- <h2><?php //echo esc_html( $heading ); ?></h2> -->
		<?php endif; ?>
		<div class="block-products-carousel__slider">
			<div class="block-products-carousel__preloader"></div>
				<div class="owl-carousel">
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
					?>
					<div class="block-products-carousel__column">
     					<div class="block-products-carousel__cell">
						<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>
					</div>
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
			</div>	
		</div>
	</div>
</div>
	<?php
endif;

wp_reset_postdata();
