<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
/**
 * @wordpress-plugin
 * Plugin Name:       hatazu subscriber Google Sheets
 * Plugin URI:        https://zucommerce.com
 * Description:       subscriber newsletter
 * Version:           0.0.1
 * Author:            hatazu
 * Author URI:         https://zucommerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       subsciber
 * Domain Path:       /languages
 * Requires at least: 4.9
 * Tested up to: 5.4
 * WC requires at least: 3.5
 * WC tested up to: 4.1
 */

add_action('admin_menu', 'htz_subscriber_menu_menu');
function htz_subscriber_menu_menu() {
    add_menu_page('menu subscriber Settings', 'option subscriber', 'administrator', 'subscriber-menu-settings', 'subscriber_menu_settings_page', 'dashicons-admin-generic');
}

function subscriber_menu_settings() {
    register_setting( 'subscriber-settings', 'keyapi_mailchimp' );
    register_setting( 'subscriber-settings', 'idlist_mailchimp' );
}

function subscriber_menu_settings_page() {
    include('subscriber-admin.php');
}
add_action( 'admin_init', 'subscriber_menu_settings' );


//add_action('admin_enqueue_scripts', 'admin_load_scripts_subscriber');
function hatazu_subscriber_custom() {
    global $post;
        wp_enqueue_style( 'htz_subscriber_style.css', plugin_dir_url(__FILE__) . 'css/htz_subscriber_style.css',array(), '0.0.4', true);
        wp_enqueue_script( 'htz_subscriber.js', plugin_dir_url(__FILE__) .'js/htz_subscriber.js', array(), '0.0.6.4', false );
       $data = array(
	                'upload_url' => admin_url('async-upload.php'),
	                'ajax_url'   => admin_url('admin-ajax.php'),
	                'nonce'      => wp_create_nonce('media-form')
	            );
	    wp_localize_script( 'htz_subscriber.js', 'htz_config', $data );
}
add_action('wp_enqueue_scripts', 'hatazu_subscriber_custom');
include("include/action.php");  
include("widget.php");
add_action('wp_ajax_send_mail_on_new_post', 'send_mail_on_new_post');
add_action('wp_ajax_nopriv_send_mail_on_new_post', 'send_mail_on_new_post');
//function send_mail_on_new_post( $post_id, $post  ) {
function send_mail_on_new_post() {
    wp_verify_nonce('media-form', 'security');
    if ( strpos($_SERVER['HTTP_REFERER'], 'edit-question') !== false ) {
        // your action or send mail goes here if the post is edited 
    } else {
            // send mail if the post is just published

            //$headers = 'From: "Your Site <noreply@zucommerce.com>'. "\r\n" . 'X-Mailer: PHP/' . phpversion();
            $headers = 'From: "Your Site <noreply@zucommerce.com>' . "\r\n" . 'Reply-To: noreply@zucommerce.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            $headers .= "Content-Transfer-Encoding: 8bit\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'BCC: kyduyenthuduc@gmail.com,duongvybi@gmail.com,hatazu@gmail.com';
            $to = 'noreply@zucommerce.com';
            $subject = 'New Post Published';
            $post_title = $post->post_title;
            $post_title = 'title test';
            $message = 'Hi, new post is published on your website: ' . $post_title;
            
            $mail = wp_mail($to, $subject, $message, $headers);
            if($mail){
                echo json_encode(array('email has sent'));
            }else{
                echo json_encode($mail_send->error);
            }
        }
        wp_die();
}
//add_action( 'publish_post', 'send_mail_on_new_post', 10, 3 );


