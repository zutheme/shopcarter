 <?php
 //global $product;
 //$product = new WC_product(17);
  $feature = '';
  $gallery_carousel = ''; 
   
  //$product->get_image_id();
  
  
   //  $image_title = ''; 
   //  $image_link = ''; 
   // if ( has_post_thumbnail( $product->id ) ) {
   //        $attachment_ids_gale[0] = get_post_thumbnail_id( $product->id );
   //        $attachment_gale = wp_get_attachment_image_src($attachment_ids_gale[0], 'full' );    
   //        echo  $attachment_gale[0];
   //    } 
      //$attachment_ids = $product->get_gallery_image_ids();  
      //$attachment_count = count($product->get_gallery_image_ids()); 
      //echo '<br>attachment'.$attachment_count.'';
   // Get all orders      

//print_r($woocommerce->get('products/30'));
use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://localhost/water1',
    'ck_4884cc4eaa8d315117e3990bcf8c213e0a8a821a',
    'cs_89f9a54eebf5885bceb89289aa912c382be4c488',
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        //'query_string_auth' => true
         // Force Basic Authentication as query string true and using under HTTPS
    ]
);
use Automattic\WooCommerce\HttpClient\HttpClientException;

try {
    // Array of response results.
    $results = $woocommerce->get('products/16');
    var_dump($results);

} catch (HttpClientException $e) {
    echo '<pre><code>' . print_r( $e->getMessage(), true ) . '</code><pre>'; // Error message.
}
?>