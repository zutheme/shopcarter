<?php 
/*
 * Plugin Name: hatazu register form

 * Plugin URI: http://zutheme.com

 * Description: hatazu register form

 * Version: 1.0.3

 * Author: hatazu

 * Author URI: http://zutheme.com

 * License: GPL2

 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
add_action('admin_menu', 'htz_reg_form_menu');
function htz_reg_form_menu() {
    add_menu_page('menu reg_form Settings', 'option reg_form', 'administrator', 'reg_form-settings', 'reg_form_settings_page', 'dashicons-admin-generic');
}

function reg_form_settings() {
    register_setting( 'reg_form-settings', 'option-reg' );
}

function reg_form_settings_page() {
    include('reg-form-admin.php');
}
add_action( 'admin_init', 'reg_form_settings' );
//define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include('include/action.php');
include('reg_form_box.php');
//include("widget.php");
//add_action('admin_enqueue_scripts', 'admin_load_scripts_share');
function hatazu_reg_form_script() {
	 global $wp;
    $request = explode( '/', $wp->request );

    // If NOT in My account dashboard page
    if(is_account_page()){
    //if( end($request) == 'my-account' && is_account_page()){ 
    	 wp_enqueue_style( 'cropper.min.css', plugin_dir_url(__FILE__) . 'dashboard/vendors/cropper/dist/cropper.min.css',array(), '0.0.2', false);
    	 wp_enqueue_style( 'custom-cropper.css', plugin_dir_url(__FILE__) . 'css/custom-cropper.css',array(), '0.0.5', false);
    	 //wp_enqueue_script('moment.min.js', plugin_dir_url( __FILE__ ) . 'dashboard/vendors/moment/min/moment.min.js', array(), '0.0.1', true);
    	 wp_enqueue_script('custom.js', plugin_dir_url( __FILE__ ) . 'dashboard/build/js/custom.js', array(), '0.3.0.5', true);
	     wp_enqueue_script('cropper.min.js', plugin_dir_url( __FILE__ ) . 'dashboard/vendors/cropper/dist/cropper.min.js', array(), '0.0.3', true);
	    wp_enqueue_script('uploadmultifile.js', plugin_dir_url( __FILE__ ) . 'js/uploadmultifile.js', array(), '0.0.6.9', true);
	    //array('jquery','jquery-form')
	    $data = array(
	                'upload_url' => admin_url('async-upload.php'),
	                'ajax_url'   => admin_url('admin-ajax.php'),
	                'nonce'      => wp_create_nonce('media-form')
	            );
	    wp_localize_script( 'uploadmultifile.js', 'htz_config', $data );
    } 
}
add_action('wp_enqueue_scripts', 'hatazu_reg_form_script');
//add_action('init', ' hatazu_reg_form_script');

// $user_id = wc_create_new_customer( $email, $username, $password );
// update_user_meta( $user_id, "billing_first_name", 'God' );
// update_user_meta( $user_id, "billing_last_name", 'Almighty' );
//remove_action('woocommerce_cart_is_empty',' wc_empty_cart_message');
// add_filter( 'wc_empty_cart_message', 'custom_wc_empty_cart_message' );

// =========================================================================
/**
 * Function wc_cus_cpp_form
 *
 */

add_action( 'woocommerce_after_edit_account_form', 'box_cropper' );

// function reg_form_subscriber_to_uploads() {
//     $subscriber = get_role('subscriber');

//     if ( ! $subscriber->has_cap('upload_files') ) {
//         $subscriber->add_cap('upload_files');
//     }
// }
// add_action('admin_init', 'reg_form_subscriber_to_uploads');

// =========================================================================

/*dashboard*/
add_action('woocommerce_account_dashboard', 'dashboard__begin');
add_action('woocommerce_account_dashboard', 'dashboard__profile');
add_action('woocommerce_account_dashboard', 'dashboard__address');
add_action('woocommerce_account_dashboard', 'dashboard__orders');
add_action('woocommerce_after_my_account', 'dashboard__end');
//address
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '/login' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}?>