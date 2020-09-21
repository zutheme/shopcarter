<?php

// Add your own Consumer Secret here	
$store_url = home_url(); 
// Add the home URL to the store you want to connect to here	
// Initialize the class	
//$wc_api = new WC_API_Client( $consumer_key, $consumer_secret, $store_url );
//require __DIR__ . '/vendor/autoload.php';
require get_template_directory_uri().'/vendor/autoload.php';
use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    $store_url,
    'ck_4884cc4eaa8d315117e3990bcf8c213e0a8a821a',
    'cs_89f9a54eebf5885bceb89289aa912c382be4c488',
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'query_string_auth' => true // Force Basic Authentication as query string true and using under HTTPS
    ]
);