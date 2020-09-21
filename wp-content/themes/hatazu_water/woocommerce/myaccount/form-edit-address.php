<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>
<div class="card">
	<form method="post">
		<div class="card-header">
            <h5><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h5>
        </div>
        <div class="card-divider"></div>
		<div class="card-body">
            <div class="row no-gutters">
                <div class="col-12 col-lg-10 col-xl-8">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>
		
				<?php
				//var_dump($address);
				foreach ( $address as $key => $field ) {
					//echo $key.':'.$field['value'].'<br>';
					//woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
					custom_woocommerce_form_field_plugin( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ));
				}
				?>
			

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

					<div class="form-group mt-3 mb-0">
						<button type="submit" class="button btn btn-primary" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
						<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
						<input type="hidden" name="action" value="edit_address" />
					</div>
		
				</div>
			</div>
		</div>
	</form>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
