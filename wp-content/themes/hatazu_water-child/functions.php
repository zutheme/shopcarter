<?php
function wpbdemo_custom_header_setup() { 

	add_theme_support( 'custom-header', array( 'default-image' => '%2$s/images/headers/circle-wpb.png' ) );

	register_default_headers( array(
	    'caramel' => array(
	        'url'           => '%2$s/images/headers/circle-wpb.png',
	        'thumbnail_url' => '%2$s/images/headers/circle-wpb-thumbnail.png',
	        'description'   => __( 'Caramel', 'Caramel header', 'twentythirteen' )
	    ),
	) );

} 
add_action( 'after_setup_theme', 'wpbdemo_custom_header_setup' );
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce');
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
?>