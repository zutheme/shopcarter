<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
if(is_product()){ ?>
<div class="spec__section">
	<h4 class="spec__section-title">General</h4>
    <?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
		<div class="spec__row item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<div class="spec__name"><?php echo wp_kses_post( $product_attribute['label'] ); ?></div>
			<div class="spec__value"><?php echo wp_kses_post( $product_attribute['value'] ); ?></div>
		</div>
	<?php endforeach; ?>
</div>
<?php } else { ?>
	<ul class="product-card__features-list">
    <?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
		<li class="item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<?php echo wp_kses_post($product_attribute['label']); ?> : <?php echo wp_kses_post(strip_tags($product_attribute['value'])); 
			?>
		</li>
	<?php endforeach; ?>
	</ul>
<?php } ?>