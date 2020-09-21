<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="block order-success">
	<div class="container">
		<div class="order-success__body">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<div class="order-success__header">
			<svg class="order-success__icon" width="100" height="100">
				<use xlink:href="images/sprite.svg#check-100"></use>
			</svg>
			<h1 class="order-success__title"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you', 'woocommerce' ), $order );  ?></h1>
			 <div class="order-success__subtitle"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Your order has been received', 'woocommerce' ), $order );  ?></div> 
				<div class="order-success__actions">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-xs btn-secondary">Go To Homepage</a>
				</div>
			</div>
			<div class="order-success__meta">
				<ul class="order-success__meta-list">

					<li class="order-success__meta-item order">
						<span class="order-success__meta-title"><?php esc_html_e( 'Order number:', 'woocommerce' ); ?>:</span>
					 	<span class="order-success__meta-value"><?php echo $order->get_order_number(); ?></span>
					
					</li>

					<li class="order-success__meta-item date">
						<span class="order-success__meta-title"><?php esc_html_e( 'Date:', 'woocommerce' ); ?></span>
						<span class="order-success__meta-value"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
					</li>

					<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
						<li class="order-success__meta-item email">
							<span class="order-success__meta-title"><?php esc_html_e( 'Email:', 'woocommerce' ); ?></span>
							<span class="order-success__meta-value"><?php echo $order->get_billing_email(); ?></span>
						</li>
					<?php endif; ?>

					<li class="order-success__meta-item total">
						<span class="order-success__meta-title"><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
						<span class="order-success__meta-value"><?php echo $order->get_formatted_order_total(); ?></span>
					</li>

					<?php if ( $order->get_payment_method_title() ) : ?>
						<li class="woocommerce-order-overview__payment-method method">
							<span class="order-success__meta-title"><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></span>
							<span class="order-success__meta-value"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
						</li>
					<?php endif; ?>

				</ul>
			</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>
		</div>
	</div>
</div>
