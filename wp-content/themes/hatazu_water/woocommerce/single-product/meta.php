<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<ul class="product__meta">
	<li class="product__meta-availability">Availability: <span class="text-success"> <?php echo wc_get_stock_html( $product ); ?></span></li>
	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<li class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></li>

	<?php endif; ?>

	<?php //echo wc_get_product_category_list( $product->get_id(), ', ', '<li class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</li>' ); 
	$productBrandTerm = wp_get_post_terms( $product->get_id(), 'pa_brand', array("fields" => "all") );
	//$productBrandName = $productBrandTerm[0]->name;
	//echo '<li>Brand: <a href="">'.$productBrandName.'</a></li>';
	//$koostis = $product->get_attribute('pa_brand');
	//var_dump($koostis);
	?>

	<?php //echo wc_get_product_tag_list( $product->get_id(), ', ', '<li class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</li>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</ul>
