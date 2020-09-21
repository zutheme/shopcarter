<?php  
/* Plugin Name: hatazu backup attribute sidebar
 * Plugin URI: http://hatazu.com
 * Description:  hatazu backup attribute sidebar
 * Version: 0.1.2
 * Author: hatazu
 * Author URI: http://hatazu.com
 * License: GPL2
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
add_action('admin_menu', 'htz_attribute_menu_menu');
function htz_attribute_menu_menu() {
    add_menu_page('menu attribute Settings', 'option attribute', 'administrator', 'attribute-menu-settings', 'attribute_menu_settings_page', 'dashicons-admin-generic');
}

function attribute_menu_settings() {
    register_setting( 'htzattribute-option', 'htzClientKey' );
    register_setting( 'htzattribute-option', 'htzClientSecret' );
}

function attribute_menu_settings_page() {
    include('attribute-menu-admin.php');
}
add_action( 'admin_init', 'attribute_menu_settings' );
include_once "attribute_menu_box.php";
include("widget.php");
//add_action('admin_enqueue_scripts', 'admin_load_scripts_attribute');
function enqueue_related_pages_scripts_and_styles(){
    wp_enqueue_style('admin-attribute-styles.css',  plugin_dir_url(__FILE__) . 'css/admin-attribute-styles.css',array(), '0.0.0.2', false);
    //wp_enqueue_script('releated-pages-admin-script', plugin_dir_url(__FILE__) . 'js/admin-related-pages-scripts.js', array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'),'0.0.0.2', true);
}
add_action('admin_enqueue_scripts','enqueue_related_pages_scripts_and_styles');
function hatazu_client_api_script() {
        //if(is_product_category()||is_shop()){
            //wp_enqueue_script( 'client_api_script.js', plugin_dir_url(__FILE__) .'js/client_api_script.js', array(), '0.2.3.5', true );
        //}
        wp_localize_script( 'client_api_script.js', 'htzwpApi', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_client' ),
            'tmp_dir' => get_template_directory_uri(),
            'url_blog' => home_url(),
            'htzClientKey' => get_option('htzClientKey'), 
            'htzClientSecret' => get_option('htzClientSecret'),
            'arr_attribute' => wc_get_attribute_taxonomies(),
            'ajax_url' => admin_url( 'admin-ajax.php'),
        ));
        wp_enqueue_script('library-custom.js', plugin_dir_url(__FILE__) . 'js/library-custom.js', array(), '0.0.6.8', true );
        wp_localize_script( 'library-custom.js', 'wpApiSettings', array(
            'root' => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ),
            'tmp_dir' => get_template_directory_uri(),
            'url_blog' => home_url(),
            'htzClientKey' => get_option('htzClientKey'), 
            'htzClientSecret' => get_option('htzClientSecret'),
            'arr_attribute' => wc_get_attribute_taxonomies(),
            'ajax_url' => admin_url( 'admin-ajax.php'),
        ) );
}
add_action('wp_enqueue_scripts', 'hatazu_client_api_script');  
//Product Cat creation page
include_once "attribute_menu_box.php";
include_once "taxonomy-add-field.php";
include("include/action.php");
//include_once "filter_product.php";
?>