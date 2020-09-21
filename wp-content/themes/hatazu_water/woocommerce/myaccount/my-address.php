<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}


?>
<div class="col-12 col-lg-9 mt-4 mt-lg-0">
     <div class="addresses-list">
<!-- <p>
	<?php //echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p> -->
	<a href="" class="addresses-list__item addresses-list__item--new">
        <div class="addresses-list__plus"></div>
        <div class="btn btn-secondary btn-sm"><?php esc_html_e( 'Add New', 'woocommerce' ); ?></div>
    </a>
    <div class="addresses-list__divider"></div>
<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<!-- <div class="addresses"> -->
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : 
	$address = wc_get_account_formatted_address( $name );
	?>
		<!-- <h3><?php //echo esc_html( $address_title ); ?></h3> -->
	<div class="addresses-list__item card address-card">
	    <div class="address-card__badge"><?php echo $name; ?></div>
	    <div class="address-card__body">
	        <div class="address-card__name"><?php echo get_user_meta( $customer_id, $name . '_first_name', true).' '.get_user_meta( $customer_id, $name . '_last_name', true);?></div>
	        <div class="address-card__row">
	            <?php
	            echo get_user_meta( $customer_id, $name . '_address_1', true );	           
				//echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
				?>
	        </div>
	        <?php if(get_user_meta( $customer_id, $name . '_phone', true)) { ?>
	        <div class="address-card__row">
	            <div class="address-card__row-title"><?php esc_html_e( 'Phone Number', 'woocommerce' ); ?></div>
	            <div class="address-card__row-content"><?php echo get_user_meta( $customer_id, $name . '_phone', true);?></div>
	        </div>
	        <?php } ?>
	        <?php if(get_user_meta( $customer_id, $name . '_email', true)) { ?>
	        <div class="address-card__row">
	            <div class="address-card__row-title"><?php esc_html_e( 'Email address', 'woocommerce' ); ?></div>
	            <div class="address-card__row-content"><?php echo get_user_meta( $customer_id, $name . '_email', true);?></div>
	        </div>
	        <?php } ?>
	        <div class="address-card__footer">
	        	<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>&nbsp;&nbsp;
	            <a href=""><?php esc_html_e( 'Remove', 'woocommerce' ); ?></a>
	        </div>
	    </div>
	</div>
	<div class="addresses-list__divider"></div>
<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<!-- </div> -->
	<?php
endif; ?>
	</div>
</div>
