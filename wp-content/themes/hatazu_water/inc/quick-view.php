<?php //quick view
 define("sprite", get_template_directory_uri()  . '/images/sprite.svg');
 $path_template = get_template_directory_uri();
 function wc_get_gallery_image_by_idproduct( $product_id ) {
    //global $product;
   //$product = new WC_product($product_id);
    $feature = '';
    $gallery_carousel = ''; 
    //use Automattic\WooCommerce\Client;
    $urlblog = get_bloginfo('url');
    $woocommerce = new Client(
        $urlblog,
        'ck_4884cc4eaa8d315117e3990bcf8c213e0a8a821a',
        'cs_89f9a54eebf5885bceb89289aa912c382be4c488',
        [
            'wp_api' => true,
            'version' => 'wc/v3',
            //'query_string_auth' => true
             // Force Basic Authentication as query string true and using under HTTPS
        ]
    );
    //use Automattic\WooCommerce\HttpClient\HttpClientException;

    try {
        // Array of response results.
        $results = $woocommerce->get('products/16');
        return $results;

    } catch (HttpClientException $e) {
        //echo '<pre><code>' . print_r( $e->getMessage(), true ) . '</code><pre>'; // Error message.
    }
      
       
   echo $html;
   wp_die();
 }
endif;
add_action( 'wp_ajax_quick_view', 'quick_view' );
add_action( 'wp_ajax_nopriv_quick_view', 'quick_view' );
?>