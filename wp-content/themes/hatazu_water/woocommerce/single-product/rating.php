<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating(); ?>
<div class="product__rating">
<?php if ( $rating_count > 0 ) : ?>
		<div class="product__rating-stars">
			<div class="rating__body">
				<?php echo show_star_rating_by_svg($average); // WPCS: XSS ok. ?>
			</div>
		</div>
		<?php if ( comments_open() ) : ?>
			<?php //phpcs:disable ?>
		<div class="product__rating-legend">
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a><span>/</span>
			<?php // phpcs:enable ?>
			<a href="#tab-reviews">Write A Review</a>
		</div>
		<?php endif ?>
<?php endif; ?>
	<!-- <div class="product__rating-stars">
	</div>
	<div class="product__rating-legend">
		<a href="">Write A Review</a>
	</div> -->
</div>
