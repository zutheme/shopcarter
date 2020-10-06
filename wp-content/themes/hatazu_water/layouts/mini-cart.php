<div class="indicator indicator--trigger--click">
	<a href="javascript:void(0);" class="indicator__button">
        <span class="indicator__area">
            <svg width="20px" height="20px">
                <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#cart-20"></use>
            </svg>
            <span class="indicator__value item-cart"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </span>
    </a>
	<div class="indicator__dropdown">
		<div class="dropcart dropcart--style--dropdown">
			<div class="dropcart__body">
				<?php wc_get_template( 'cart/mini-cart.php' ); ?>
			</div>
		</div>
	</div>
</div>