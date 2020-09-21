<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}
?>
<div class="row checkout-login" style="display: none;">
<div class="col-md-6 d-flex flex-column">
<div class="card flex-grow-1 mb-md-0">
	<div class="card-body">
	<!-- <a class="close" href="#">&times;</a> -->
	<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

		<div class="form-group">
			<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="text" class="input-text form-control" name="username" autocomplete="username" />
		</div>
		<div class="form-group">
			<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input class="input-text form-control" type="password" name="password"  autocomplete="current-password" />
			<small class="form-text text-muted">
               <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
            </small>
		</div>
		
		<?php do_action( 'woocommerce_login_form' ); ?>
		<div class="form-group">
            <div class="form-check">
                <span class="form-check-input input-check">
                    <span class="input-check__body">
                        <input class="input-check__input" type="checkbox" name="rememberme" id="rememberme" value="forever">
                        <span class="input-check__box"></span>
                        <svg class="input-check__icon" width="9px" height="7px">
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprite.svg#check-9x7"></use>
                        </svg>
                    </span>
                </span>
                <label class="form-check-label" for="login-remember"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></label>
            </div>
        </div>
        <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />
        <button type="submit" class="btn btn-primary mt-4" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
		<?php do_action( 'woocommerce_login_form_end' ); ?>
	</form>
	</div>
</div>
</div>
</div>
<!-- <div class="row"> -->
<?php //wc_get_template( 'myaccount/form-login.php' ); ?>
<!-- </div> -->
