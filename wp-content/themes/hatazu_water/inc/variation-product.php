<?php
/*
 * Add our Custom Fields to variable products
 */
function mytheme_woo_add_custom_variation_fields( $loop, $variation_data, $variation ) {

	echo '<div class="options_group form-row form-row-full">';

 	// Text Field
	woocommerce_wp_text_input(
		array(
			'id'          => '_variable_text_field[' . $variation->ID . ']',
			'label'       => __( 'My Text Field', 'woocommerce' ),
			'placeholder' => '',
			'desc_tip'    => true,
			'description' => __( "Here's some really helpful tooltip text.", "woocommerce" ),
			'value' => get_post_meta( $variation->ID, '_variable_text_field', true )
		)
 	);

	// Add extra custom fields here as necessary...

	echo '</div>';

}
// Variations tab
//add_action( 'woocommerce_variation_options', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After variation Enabled/Downloadable/Virtual/Manage Stock checkboxes
//add_action( 'woocommerce_variation_options_pricing', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After Price fields
//add_action( 'woocommerce_variation_options_inventory', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After Manage Stock fields
//add_action( 'woocommerce_variation_options_dimensions', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After Weight/Dimension fields
//add_action( 'woocommerce_variation_options_tax', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After Shipping/Tax Class fields
//add_action( 'woocommerce_variation_options_download', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After Download fields
add_action( 'woocommerce_product_after_variable_attributes', 'mytheme_woo_add_custom_variation_fields', 10, 3 ); // After all Variation fields

/*
 * Save our variable product fields
 */
function mytheme_woo_add_custom_variation_fields_save( $post_id ){

 	// Text Field
 	$woocommerce_text_field = $_POST['_variable_text_field'][ $post_id ];
	update_post_meta( $post_id, '_variable_text_field', esc_attr( $woocommerce_text_field ) );

}
add_action( 'woocommerce_save_product_variation', 'mytheme_woo_add_custom_variation_fields_save', 10, 2 );

/*
 * Display our example custom field above the summary on the Single Product Page
 */
// function mytheme_display_woo_custom_fields() {
// 	global $post;

// 	$ourTextField = get_post_meta( $post->ID, '_text_field', true );

// 	if ( !empty( $ourTextField ) ) {
// 		echo '<div>Our Text Field: ' . $ourTextField . '</div>';
// 	}
// }
// add_action( 'woocommerce_single_product_summary', 'mytheme_display_woo_custom_fields', 15 );
?>