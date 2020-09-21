<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit; ?>
<?php do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="cart__table cart-table">
		<thead class="cart-table__head">
			<tr class="cart-table__row">
				<th  class="cart-table__column cart-table__column--remove">&nbsp;</th>
				<th class="cart-table__column cart-table__column--image">&nbsp;</th>
				<th  class="cart-table__column cart-table__column--product"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="cart-table__column cart-table__column--price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="cart-table__column cart-table__column--quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="cart-table__column cart-table__column--total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody class="cart-table__body">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				//var_dump($_product);
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );	
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					 <tr class="cart-table__row">

						<td class="cart-table__column cart-table__column--remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>

						 <td class="cart-table__column cart-table__column--image">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$attachment_first[0] = get_post_thumbnail_id( $_product->id );
    					$attachment = wp_get_attachment_image_src( $attachment_first[0], 'full' );
						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else { 
							//printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $attachment[0] ); // PHPCS: XSS ok.
							?>
							 <div class="product-image"><a href="<?php echo $product_permalink; ?>" class="product-image__body"><img class="product-image__img" src="<?php echo $attachment[0]; ?>" alt=""></a>
                     		</div>
						<?php }
						?>
						
						</td>

						<td class="cart-table__column cart-table__column--product">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						//var_dump($cart_item);
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
						</td>
						<td class="cart-table__column cart-table__column--price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
						<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>

						<td class="cart-table__column cart-table__column--quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
									'classes' =>'form-control input-number__input',
								),
								$_product,
								false
							);
						}
						?>
						<div class="input-number">
							<?php
							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>
						</div>
						</td>

						<td class="cart-table__column cart-table__column--total" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
	<!-- <div class="cart__actions">
            <form class="cart__coupon-form">
               <label for="input-coupon-code" class="sr-only">Password</label>
               <input type="text" class="form-control" id="input-coupon-code" placeholder="Coupon Code">
               <button type="submit" class="btn btn-primary">Apply Coupon</button>
            </form>
            <div class="cart__buttons">
               <a href="index-1.html" class="btn btn-light">Continue Shopping</a>
               <a href="" class="btn btn-primary cart__update-button">Update Cart</a>
            </div>
         </div> -->
	<div class="cart__actions">
		<div class="cart__coupon-form">
		<?php if ( wc_coupons_enabled() ) { ?>
			
				<label for="input-coupon-code" class="sr-only"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
				<input type="text" name="coupon_code" class="form-control" id="input-coupon-code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
				<button type="submit" class="btn btn-primary" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
				<?php do_action( 'woocommerce_cart_coupon' ); ?>
			
		<?php } ?>
		</div>
		<div class="cart__buttons">
	       <a href="<?php bloginfo('url'); ?>" class="btn btn-light">Continue Shopping</a>
	       <!-- <a href="" class="btn btn-primary cart__update-button">Update Cart</a> -->
	       <button type="submit" class="btn btn-primary cart__update-button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
	    </div>
		<?php do_action( 'woocommerce_cart_actions' ); ?>
		<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
	</div>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
<div class="row justify-content-end pt-5">
    <div class="col-12 col-md-7 col-lg-6 col-xl-5">
       <div class="card">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
