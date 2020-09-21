<?php
/**
 * Output a single payment method
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment-method.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if($loop == 0 ){
	$active = 'payment-methods__item--active';
}else{
	$active = '';
}

?>
<li class="payment-methods__item <?php echo $active; ?> wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
  <label class="payment-methods__item-header">
     <span class="payment-methods__item-radio input-radio">
        <span class="input-radio__body">
          <input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="input-radio__input" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
        	<span class="input-radio__circle"></span>
        </span>
     </span>
     <span class="payment-methods__item-title">
     	<?php echo $gateway->get_title(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?> <?php echo $gateway->get_icon(); /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></span>
  </label>
	
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment-methods__item-container payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
			<div class="payment-methods__item-description text-muted">
				<?php $gateway->payment_fields(); ?>
			</div>
		</div>
	<?php endif; ?>
</li>
