<?php
/**
 * Checkout terms and conditions area.
 *
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( apply_filters( 'woocommerce_checkout_show_terms', true ) && function_exists( 'wc_terms_and_conditions_checkbox_enabled' ) ) {
	do_action( 'woocommerce_checkout_before_terms_and_conditions' );

	?>
	<div class="checkout__agree form-group">
        <div class="form-check">
		<?php
		/**
		 * Terms and conditions hook used to inject content.
		 *
		 * @since 3.4.0.
		 * @hooked wc_checkout_privacy_policy_text() Shows custom privacy policy text. Priority 20.
		 * @hooked wc_terms_and_conditions_page_content() Shows t&c page content. Priority 30.
		 */
		do_action( 'woocommerce_checkout_terms_and_conditions' );
		?>

		<?php if ( wc_terms_and_conditions_checkbox_enabled() ) : ?>
			<span class="form-check-input input-check">
              <span class="input-check__body">
                 <input class="input-check__input" type="checkbox" id="checkout-terms">
                 <input type="checkbox" class="input-check__input" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); // WPCS: input var ok, csrf ok. ?> id="terms" />
                 <span class="input-check__box"></span>
                  <svg class="input-check__icon" width="9px" height="7px">
                 <use xlink:href="<?php echo get_template_directory_uri(); ?>/images/sprite.svg#check-9x7">
                 </use>
                 </svg>
               </span>
           </span>
           <label class="form-check-label" for="checkout-terms"><?php wc_terms_and_conditions_checkbox_text(); ?></label>
           <input type="hidden" name="terms-field" value="1" />
			
		<?php endif; ?>
		</div>
	</div>
	<?php

	do_action( 'woocommerce_checkout_after_terms_and_conditions' );
}
