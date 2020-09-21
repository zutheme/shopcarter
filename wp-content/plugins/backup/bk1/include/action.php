<?php
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
function woocommerce_ajax_add_to_cart() {
	global $woocommerce;
 //check_ajax_referer( 'wp_client', 'security' );
  wp_verify_nonce( 'wp_client','security');
   $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
   $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
   $variation_id = absint($_POST['variation_id']);
   $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
   $product_status = get_post_status($product_id);
   //echo json_encode(array('product_id'=>$product_id));
    //wp_die();
	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
	    do_action('woocommerce_ajax_added_to_cart', $product_id);
	    if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
	        wc_add_to_cart_message(array($product_id => $quantity), true);
	    }
	    WC_AJAX :: get_refreshed_fragments();
	} else {
	    $data = array('error' => true,'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
	    echo wp_send_json($data);
	}
	//echo $woocommerce->cart->get_cart_total();
	echo wc_get_template( 'cart/mini-cart.php' );
    wp_die();
} 
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	echo $woocommerce->cart->cart_contents_count;
	$fragments['itemcart'] = ob_get_clean();
	return $fragments;
}
// if(!function_exists('process_archive')):
// 	function process_archive(){
// 			 //check_ajax_referer( 'my-special-string', 'security' );
// 			 wp_verify_nonce( 'process_archive','security');
// 			 $comment_post_ID = htmlspecialchars(stripslashes(trim($_POST['comment_post_ID'])));
			 
//             echo json_encode(array('comment_id'=>$comment_id));
//             wp_die();
// 	}
// endif;
// add_action( 'wp_ajax_process_archive', 'process_archive' );
// add_action( 'wp_ajax_nopriv_process_archive', 'process_archive' );
