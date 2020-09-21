<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>
<?php if ( ! WC()->cart->is_empty() ) : ?>
	
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' ); ?>
		<div class="dropcart__products-list">
		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				$id = $_product->get_id();
				$attachment_first[0] = get_post_thumbnail_id( $id );
				$src = wp_get_attachment_image_src( $attachment_first[0], 'thumbnail' );
				?>
				<div class="dropcart__product">
					
					<div class="product-image dropcart__product-image">
						<?php if ( empty( $product_permalink ) ) : ?>
						<?php echo $thumbnail . $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php else : ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>" class="product-image__body"><img class="product-image__img" src="<?php echo $src[0]; ?>" alt=""></a>
						<?php endif; ?>
					</div>
					<div class="dropcart__product-info">
						<div class="dropcart__product-name">
							<a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $product_name; ?></a>
						</div>
						<?php
						echo wc_get_formatted_cart_item_data( $cart_item );
						 ?>
						
						<div class="dropcart__product-meta">	
							<span class="dropcart__product-quantity"><?php echo $cart_item['quantity']; ?></span> × <span class="dropcart__product-price"><?php echo $product_price; ?></span>
						</div>
					</div>
						<?php
					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'woocommerce_cart_item_remove_link',
						sprintf(
							'<a href="%s" class="dropcart__product-remove btn btn-light btn-sm btn-svg-icon" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="10px" height="10px"><use xlink:href="'.get_template_directory_uri() .'/images/sprite.svg#cross-10"></use></svg></a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							esc_attr__( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						),
						$cart_item_key
					);
					?>
					
				</div>
				<?php
			}
		} ?>
		</div>
		 <?php do_action( 'woocommerce_mini_cart_contents' );
		?>
	
		<div class="dropcart__totals">
			<table>
				<tr>
					<th><?php echo esc_html__( 'Subtotal', 'woocommerce' ); ?></th>
					<td><?php echo WC()->cart->get_cart_subtotal(); ?></td>
				</tr>
			</table>
			
					<?php
					/**
					 * Hook: woocommerce_widget_shopping_cart_total.
					 *
					 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
					 */
					do_action( 'woocommerce_widget_shopping_cart_total' );
					?>
			
		</div>
	
		
		<div class="dropcart__buttons">
			<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

			<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>

			<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
			<!-- <a class="btn btn-secondary" href="cart.html">View Cart</a>
		 	<a class="btn btn-primary" href="checkout.html">Checkout</a> -->
		</div>
			

		<?php else : ?>
			<div class="block-empty__body">
                <div class="block-empty__message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></div>
                <div class="block-empty__actions">
                    <a class="btn btn-primary btn-sm" href="">Continue</a>
                </div>
            </div>
			<!-- <p class="woocommerce-mini-cart__empty-message"><?php //esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p> -->

		<?php endif; ?>

	<?php do_action( 'woocommerce_after_mini_cart' ); ?>

