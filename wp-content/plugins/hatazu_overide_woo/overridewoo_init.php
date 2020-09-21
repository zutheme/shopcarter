<?php  defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
/* Plugin Name: hatazu override woocommerce
 * Plugin URI: http://hatazu.com
 * Description: overridewoo form hatazu.
 * Version: 1.0.5
 * Author: hatazu
 * Author URI: http://hatazu.com
 * License: GPL2
 */
add_action('admin_menu', 'overridewoo_menu');
function overridewoo_menu() {
    add_menu_page('overridewoo Settings', 'overridewoo', 'administrator', 'overridewoo-settings', 'overridewoo_menu_settings_page', 'dashicons-admin-generic');
}
function overridewoo_menu_settings_page() {
    //include('overridewoo_admin.php');
}
function overridewoo_menu_settings() {
    //register_setting( 'overridewoo-link-settings-group', 'overridewoo-option' );
}
add_action( 'admin_init', 'overridewoo_menu_settings' );




