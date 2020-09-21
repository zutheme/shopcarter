<?php  defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
/* Plugin Name: hatazu gallery variation product
 * Plugin URI: http://hatazu.com
 * Description:  hatazu gallery variation product.
 * Version: 0.0.3
 * Author: hatazu
 * Author URI: http://hatazu.com
 * License: GPL2
 */
/*
 * Add our Custom Fields to variable products
 */
add_action('admin_menu', 'htz_option_gallery');
function htz_option_gallery() {
    add_menu_page('menu gallery Settings', 'option gallery', 'administrator', 'gallery-menu-settings', 'htz_option_gallery_page', 'dashicons-admin-generic');
}

function htz_variable_gallery() {
    register_setting( 'htz_variable_gallery', 'option' );
}

function htz_option_gallery_page() {
    include('gallery-option-admin.php');
}
add_action( 'admin_init', 'htz_variable_gallery' );

add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );
add_filter( 'woocommerce_available_variation', 'load_variation_settings_fields' );

function variation_settings_fields( $loop, $variation_data, $variation ) {
    ?>
    
    <div class="list-gallery">
    
    <div class="form-row form-row-full">
        <div class="related_pages">     
            <div class="right_container">
                 <ul class="ul-gallery form-row form-row-full"> 
                <?php
                     $listimage = get_post_meta( $variation->ID, 'gallery', true );
                    if( $listimage ){
                        $arr_data = json_decode($listimage, true);
                        if($arr_data){
                             foreach ($arr_data as $key => $value) { 
                                  ?>
                                   <li class="image page_item"><img src="<?php echo $value; ?>"><ul class="actions"><li><a href="javascript:void(0);" onclick="delete_gallery_variation_product(this)" class="delete">delete</a></li></ul></li>
                                    <?php
                             }
                        }
                     }
                    ?> 
                    <div class="droppable-helper"></div>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="form-row form-row-full">
       <input type="button" onclick="upload_variation_product(this);" name="btn_variation" class="button" value="<?php _e( 'Add image', 'prfx-textdomain' )?>" /> 
        <input type="button" onclick="save_gallery_variation_product(this);" name="btn_save_variation" class="button" value="<?php _e( 'Save change', 'prfx-textdomain' )?>" />
        <input type="hidden" class="hidden_variation_id" name="hidden_variation_id" value="<?php echo $variation->ID; ?>" />
    </div>
    </div>
<?php
}
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
include( MY_PLUGIN_PATH . 'include/action.php');

function load_variation_settings_fields( $variation ) {     
    $variation['gallery'] = get_post_meta( $variation[ 'variation_id' ], 'gallery', true );
    return $variation;
}


function hatazu_upload_variation_admin_script() {
    
    wp_enqueue_style('variation-style', plugin_dir_url(__FILE__) . 'css/variation-style.css',array(), '0.0.1.7', false);
    wp_enqueue_script('drop-drag-admin-script', plugin_dir_url(__FILE__) . 'js/admin-related-pages-scripts.js', array('jquery','jquery-ui-droppable','jquery-ui-draggable', 'jquery-ui-sortable'),'0.0.5.2', true);
    wp_enqueue_script('hatazu_upload_variation', plugin_dir_url(__FILE__) .'js/hatazu_images_gallery.js', array(), '0.2.8.3', true );
    
        wp_localize_script( 'hatazu_upload_variation', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php'),'security'=>wp_create_nonce('my-gallery')));
} 
add_action("admin_enqueue_scripts", "hatazu_upload_variation_admin_script");


if(!function_exists('frontfooter')):
    function frontfooter(){ ?>
        <div class="htz-popup-processing" style="display: none; position: fixed; z-index: 99999;left: 0;top: 0%;width: 100%; height: 100%; overflow: auto;background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4); ">
        <div class="processing" style="position:relative;background-color: rgba(255,255,255,0.1);width: 250px;height: 250px;margin-top:15%; margin-left: auto;margin-right: auto;text-align: center;z-index: 99999;">
            <p><img class="loading" style=" position: absolute;top: 11%;left: 11%;display: block;width: 200px; height: 200px;margin-left: auto;margin-right: auto;" src="<?php bloginfo('template_directory');?>/images/loading.gif"></p>
            <p class="result"></p>
        </div>
    </div>
    <?php }
endif;
add_action('admin_footer', 'frontfooter');
function hatazu_overridewoo_custom() {
    global $post;
    if( is_product() ) {
        wp_enqueue_script( 'custom-woo.js', plugin_dir_url(__FILE__) .'js/custom-woo.js', array(), '0.0.9.6', true );
    }
}
add_action('wp_enqueue_scripts', 'hatazu_overridewoo_custom'); 

function variation_radio_buttons($html, $args) {
  $args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
        'options'          => false,
        'attribute'        => false,
        'product'          => false,
        'selected'         => false,
        'name'             => '',
        'id'               => '',
        'class'            => '',
        'show_option_none' => __('Choose an option', 'woocommerce'),
    ));
 
  if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
    $selected_key     = 'attribute_'.sanitize_title($args['attribute']);
    $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
  }
 
  $options               = $args['options'];
  $product               = $args['product'];
  $attribute             = $args['attribute'];
  $name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
  $id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
  $class                 = $args['class'];
  $show_option_none      = (bool)$args['show_option_none'];
  $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');
  $variations_attr = $args['variations_attr'];
  $json_variation = json_decode($variations_attr);

  if(empty($options) && !empty($product) && !empty($attribute)) {
    $attributes = $product->get_variation_attributes();
    $options    = $attributes[$attribute];
  }
  $radios = '';
  if(!empty($options)) {
    if($product && taxonomy_exists($attribute)) {
      $terms = wc_get_product_terms($product->get_id(), $attribute, array(
        'fields' => 'all',
      )); 
      $variation_id = 0;
      $color = '#fff';
      foreach($terms as $term) {
        if(in_array($term->slug, $options, true)) {
           if($attribute == 'pa_color') {
            foreach ($json_variation as $key => $value) {
                  //attribute_pa_color
                  $_cmpname = 'attribute_'.sanitize_title($attribute);
                    foreach ($value->attributes as $key1 => $value1) {
                        if($key1 == $_cmpname && $value1 == $term->slug){
                            $variation_id = $value->variation_id;
                            //$color = get_post_meta( $variation_id, 'radio_color', true );
                        }
                    }
              }
            $color = get_term_meta($term->term_id, 'custom_field_taxonomy', true);
            $class = 'class="input-radio-color__item input-radio-color__item--white" style="color:'.$color.';" data-toggle="tooltip" title="'.$term->name.'"';
            $radios .= '<label '.$class.'><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).' variation_id="'.$variation_id.'" term_id="'.$term->term_id.'"><span></span></label>';
          }else{
            $radios .= '<label '.$class.'><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).' variation_id="'.$variation_id.'" term_id="'.$term->term_id.'"><span>'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'</span></label>';
          }
        
        }
      }
    } else {
      foreach($options as $option) {
        $checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
        $radios    .= '<label><input type="radio" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'><span>'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</span></label>';
       
      }
    }
  }
 
 return $radios;
}
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
function custom_variation_price( $price, $product ) {
    $available_variations = $product->get_available_variations();
    $selectedPrice = '';
    $dump = '';
    foreach ( $available_variations as $variation ){
        $isDefVariation = false;
        foreach($product->get_default_attributes() as $key=>$val){
            if($variation['attributes']['attribute_'.$key]==$val){
                $isDefVariation=true;
            }   
        }
        if($isDefVariation){
            $price = $variation['display_price'];         
        }
    }
    $selectedPrice = wc_price($price);
    return $selectedPrice . $dump;
}
