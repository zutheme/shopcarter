<?php
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce');
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// function mytheme_add_woocommerce_support() {
//     add_theme_support( 'woocommerce', array(
//         'thumbnail_image_width' => 150,
//         'single_image_width'    => 300,

//         'product_grid'          => array(
//             'default_rows'    => 3,
//             'min_rows'        => 2,
//             'max_rows'        => 8,
//             'default_columns' => 4,
//             'min_columns'     => 2,
//             'max_columns'     => 5,
//         ),
//     ) );
// }
// add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

//add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
//add_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
// only copy opening php tag if needed

// Removes cart notices from the checkout page
function sv_remove_cart_notice_on_checkout() {
  if ( function_exists( 'wc_cart_notices' ) ) {
    remove_action( 'woocommerce_before_checkout_form', array( wc_cart_notices(), 'add_cart_notice' ) );
  }
}
//add_action( 'init', 'sv_remove_cart_notice_on_checkout' );
add_filter( 'wc_add_to_cart_message_html', '__return_false' );

add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );
/**
* Remove WooCommerce Generator tag, styles, and scripts from all areas other than store
* Tested and works with WooCommerce 2.0+
*/
function child_manage_woocommerce_styles() {
  remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
    //if ( is_woocommerce() || is_page('store') || is_shop() || is_product_category() || is_product() || is_cart() || is_checkout() || is_front_page() || is_home() ) {
    wp_dequeue_style( 'woocommerce_frontend_styles' );
    wp_dequeue_style( 'woocommerce_fancybox_styles' );
    wp_dequeue_style( 'woocommerce_chosen_styles' );
    wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
    wp_dequeue_script( 'wc_price_slider' );
    wp_dequeue_script( 'wc-single-product' );
    wp_dequeue_script( 'wc-add-to-cart' );
    wp_dequeue_script( 'wc-cart-fragments' );
    wp_dequeue_script( 'wc-checkout' );
    wp_dequeue_script( 'wc-add-to-cart-variation' );
    wp_dequeue_script( 'wc-single-product' );
    wp_dequeue_script( 'wc-cart' );
    wp_dequeue_script( 'wc-chosen' );
    wp_dequeue_script( 'woocommerce' );
    wp_dequeue_script( 'prettyPhoto' );
    wp_dequeue_script( 'prettyPhoto-init' );
    wp_dequeue_script( 'jquery-blockui' );
    wp_dequeue_script( 'jquery-placeholder' );
    wp_dequeue_script( 'fancybox' );
    wp_dequeue_script( 'jqueryui' );
//}
}


remove_theme_support( 'wc-product-gallery-zoom' );
remove_theme_support( 'wc-product-gallery-lightbox' );
remove_theme_support( 'wc-product-gallery-slider' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
/* Opening div for our content wrapper
 */
/** Global ****************************************************************/
 
if ( ! function_exists( 'woocommerce_output_content_wrapper' ) ) {
 
    /**
     * Output the start of the page wrapper.
     *
     * @access public
     * @return void
     */
    function woocommerce_output_content_wrapper() {
        echo '<div class="block">'
			.'<div class="container">';
    }
}
if ( ! function_exists( 'woocommerce_output_content_wrapper_end' ) ) {
 
    /**
     * Output the end of the page wrapper.
     *
     * @access public
     * @return void
     */
    function woocommerce_output_content_wrapper_end() {
        echo '</div></div>';
    }
}
// Note:
// 1) Overwriting shop/wrapper-end.php and shop/wrapper-start.php was not enough, because those actions calling these templates are not working for some reason
// 2) See <em><u>hidden link</u></em>
// 3) See 
add_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 20 );
add_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 20 );

/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            //'delimiter'   => ' &#47; ',
            'delimiter'   => '',
            'wrap_before' => '<div class="page-header__breadcrumb"><nav aria-label="breadcrumb"><ol class="breadcrumb">',
            'wrap_after'  => '</ol></nav></div>',
            'before'      => '<li class="breadcrumb-item">',
            'after'       => '<svg class="breadcrumb-arrow" width="6px" height="9px">
                                        <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#arrow-rounded-right-6x9"></use>
                                    </svg></li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}
// add_action( 'woocommerce_after_main_content', 'woocommerce_output_page_title', 20 );
// function woocommerce_output_page_title()
// {
//   if ( apply_filters( 'woocommerce_show_page_title', true ) ) : 
//    echo '<h1>'.woocommerce_page_title().'</h1>';
//   endif; 
// }
// Add our custom function
//function my_function_before_single_product() {
    //echo '<h2>Everything is 50% off today!</h2>';
//}

// Add the action
//add_action( 'woocommerce_before_single_product', 'my_function_before_single_product', 11 );
// remove the action 
//remove_action( 'woocommerce_before_single_product', 'action_woocommerce_before_single_product', 10, 2 
//remove default style woocomerce
/**
 * Set WooCommerce image dimensions upon theme activation
 */
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
    return $enqueue_styles;
}
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'layout_standard_begin', 10 ); 
function layout_standard_begin(){
     echo '<div class="product product--layout--standard" data-layout="standard"><div class="product__content">';
}
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );
//do_action( 'woocommerce_before_single_product', $wc_print_notices, $int ); 
// define the woocommerce_before_single_product callback 
// function action_woocommerce_before_single_product(  ) { 
    
//     echo 'notice';
// }; 
         
// add the action 
//add_action( 'woocommerce_before_single_product', 'action_woocommerce_before_single_product', 10, 2 ); 
// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20, 2 );
// add_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 ); 
// function woocommerce_show_product_images(){
//      echo 'images';
// }
function wc_get_gallery_image_with_custom_html( $attachment_id, $main_image = false ) {
    global $post, $woocommerce, $product; 
    //$imageTitle         = '<span>' . esc_html( get_the_title($attachment_id) ) . '</span>';
    $feature = '';
    $gallery_carousel = ''; 
     if (has_post_thumbnail()) { 
 
              $image_title = esc_attr(get_the_title(get_post_thumbnail_id())); 
              $image_link = wp_get_attachment_url(get_post_thumbnail_id()); 
              //$image = get_the_post_thumbnail($post->ID, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array( 
                  //'title' => $image_title 
                //)); 
              $feature_src = get_the_post_thumbnail_url($post->ID,'full'); 
              $feature .= '<div class="product-image product-image--location--gallery">
                    <a href="'.$feature_src.'" data-width="700" data-height="700" class="product-image__body" target="_blank"><img class="product-image__img" src="'.$feature_src.'" alt=""></a></div>';
                $gallery_carousel .= '<a href="'.$feature_src.'" class="product-image product-gallery__carousel-item">';
                $gallery_carousel .= '<div class="product-image__body"><img class="product-image__img product-gallery__carousel-image" src="'.$feature_src.'" alt="">';
                $gallery_carousel .='</div></a>';
              $attachment_count = count($product->get_gallery_image_ids()); 
 
              if ($attachment_count > 0) { 
                  $gallery = '[product-gallery]'; 
              } else { 
                  $gallery = ''; 
              } 
              /** 
               * From product-thumbnails.php 
               */ 
              $attachment_ids = $product->get_gallery_image_ids(); 
                //var_dump($attachment_ids);
              $loop = 0; 
              //$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 ); 
              
              foreach ($attachment_ids as $attachment_id) { 
                  
                  $classes[] = 'image-' . $attachment_id; 
 
                  $image_link = wp_get_attachment_url($attachment_id); 
 
                  //if (!$image_link) 
                      //continue; 
                  // modified image size to shop_single from thumbnail 
                  //$image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_single')); 
                  $image_class = esc_attr(implode(' ', $classes)); 
                  $image_title = esc_attr(get_the_title($attachment_id)); 
                  $image_attributes = wp_get_attachment_image_src($attachment_id,'full');

                   $feature .= '<div class="product-image product-image--location--gallery">
                    <a href="'.$image_attributes[0].'" data-width="700" data-height="700" class="product-image__body" target="_blank"><img class="product-image__img" src="'.$image_attributes[0].'" alt=""></a></div>';

                $gallery_carousel .= '<a href="'.$image_attributes[0].'" class="product-image product-gallery__carousel-item">';
                $gallery_carousel .= '<div class="product-image__body"><img class="product-image__img product-gallery__carousel-image" src="'.$image_attributes[0].'" alt=""></div></a>';
                  $loop++; 
              } 
          } else { 
 
              echo apply_filters('woocommerce_single_product_image_html', sprintf('<img src="%s" alt="Placeholder" />', wc_placeholder_img_src()), $post->ID); 
          }
          $html ='<div class="product-gallery__featured">';
          $html .='<button class="product-gallery__zoom">
          <svg width="24px" height="24px"><use xlink:href="'.get_template_directory_uri()  . '/images/sprite.svg#zoom-in-24"></use></svg></button>';
          $html .='<div class="owl-carousel" id="product-image">';
          $html .= $feature;
          $html .='</div></div>';

          $html .='<div class="product-gallery__carousel">';
          $html .='<div class="owl-carousel" id="product-carousel">';
          $html .= $gallery_carousel;
          $html .='</div></div>'; 
    return $html; 
}
//define the woocommerce_product_thumbnails callback 
function action_woocommerce_product_thumbnails() { 
    //echo 'thumnail'.$product->ID.'<br>';
}; 
         
// add the action 
//add_action( 'woocommerce_product_thumbnails', 'action_woocommerce_product_thumbnails', 10, 0 );
//remove_action( 'woocommerce_product_thumbnails', 'action_woocommerce_product_thumbnails', 10, 0 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_show_product_thumbnails', 5 );
//remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
//add_filter( 'woocommerce_product_get_gallery_image_ids', 'filter_gallery', 10, 2 );
function filter_gallery( $ids, $product ){
    // remove image attachment id=99 from all galleries
   $html ='';
        echo $html;
}
// add_action( 'woocommerce_before_single_product_summary', 'custom_show_product_images', 20);
// function custom_show_product_images() {
//   echo 'images';
// } 
//info product reorder
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 30 );
//woocommerce_template_single_title
add_action( 'woocommerce_single_product_summary', 'product__info_begin',4);
function product__info_begin() {
    echo '<div class="product__info">';
}
add_action( 'woocommerce_single_product_summary', 'product__info_end',30);
function product__info_end() {
    echo '</div>';
}
add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
    // Change In Stock Text
    if ( $_product->is_in_stock() ) {
        $availability['availability'] = __('Available!', 'woocommerce');
    }
    // Change Out of Stock Text
    if ( ! $_product->is_in_stock() ) {
        $availability['availability'] = __('Sold Out', 'woocommerce');
    }
    return $availability;
}
add_action( 'woocommerce_single_product_summary', 'product__sidebar_begin',30);
function product__sidebar_begin() {
    echo '<div class="product__sidebar">';
}
add_action( 'woocommerce_single_product_summary', 'product__availability',30);
function product__availability() {
    global $product;
    echo '<div class="product__availability">Availability: <span class="text-success">'. wc_get_stock_html( $product ).'</span></div>';
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30 );
// add_filter( 'woocommerce_get_price_html', 'wpa83367_price_html', 100, 2 );
// function wpa83367_price_html( $price, $product ){
//     return 'Was:' . str_replace( '<ins>', ' Now:<ins>', $price );
// }

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );


//add_action( 'woocommerce_single_product_summary', 'mytheme_display_woo_custom_fields', 30 );
//add_action( 'woocommerce_single_product_summary', 'fn_single_add_to_cart', 30 );
// function fn_single_add_to_cart(){
//     global $product;
//       if ( $product->is_sold_individually() ) {
//         $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
//       } else {
//         $product_quantity = woocommerce_quantity_input(
//           array(
//             //'input_name'   => "",
//             //'input_value'  => $cart_item['quantity'],
//             'max_value'    => $product->get_max_purchase_quantity(),
//             'min_value'    => '0',
//             'product_name' => $product->get_name(),
//             'classes' =>'form-control input-number__input',
//           ),
//           $product,
//           false
//         );
//       }
//       echo '<div class="input-number product__quantity">';
//       echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity); // PHPCS: XSS ok.
//       echo '</div>';      
// }
add_action( 'woocommerce_after_quantity_input_field', 'fn_single_add_sub');
function fn_single_add_sub(){
  echo '<div class="input-number__add"></div>
            <div class="input-number__sub"></div>';
}
add_action( 'woocommerce_single_product_summary', 'product__sidebar_end',40);
function product__sidebar_end() {
    echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'layout_standard_end',60);
function layout_standard_end() {
    echo '</div></div>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_before_shop_loop_item', 'quickview',10);
function quickview() {
  global $product;
    echo '<button class="product-card__quickview" type="button" data-product_id="'.$product->get_id().'">
              <svg width="16px" height="16px">
                  <use xlink:href="'.get_template_directory_uri()  . '/images/sprite.svg#quickview-16"></use>
              </svg>
              <span class="fake-svg-icon"></span>
          </button>';
}
//add_filter( 'woocommerce_sale_flash', 'woocommerce_custom_badge', 10, 3 );
//add_action('init', function(){
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
//}

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
}

if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {   
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog' ) {
        global $post, $woocommerce;
        $permalink =  get_permalink( $post->ID );
        $output = '<div class="product-card__image product-image">';
        if ( has_post_thumbnail() ) {
            $feature_src = get_the_post_thumbnail_url($post->ID,'full');                
            //$output .= get_the_post_thumbnail( $post->ID, $size );
            $output .= '<a class="product-image__body" href="'.$permalink.'"><img class="product-image__img" src="'.$feature_src.'"/></a>';
        } else {
             $output .= wc_placeholder_img( $size );
             // Or alternatively setting yours width and height shop_catalog dimensions.
             // $output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="300px" height="300px" />';
        }                       
        $output .= '</div>';
        return $output;
    }
}
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action( 'woocommerce_shop_loop_item_title', 'product_card_info_begin',10);
function product_card_info_begin() {
    echo '<div class="product-card__info">';
}
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title',10);
function woocommerce_template_loop_product_title() { 
    global $post;
    echo '<div class="product-card__name"><a href="'.get_permalink( $post->ID ).'">'.get_the_title().'</a></div>'; 
}
add_action( 'woocommerce_shop_loop_item_title', 'product_card__rating',10);
//spec
//add_action( 'woocommerce_shop_loop_item_title', 'product_card_rating_end',10);
// function product_card_rating_end() { 
//        echo '</div>'; 
// } 
add_action( 'woocommerce_shop_loop_item_title', 'features_list',10); 
function features_list(){
  global $product;
  if(!is_product()){
    do_action( 'woocommerce_product_additional_information', $product );
  }
}
add_action( 'woocommerce_shop_loop_item_title', 'product_card_info_end',10);
function product_card_info_end() {
    echo '</div>';
}
function product_card__rating(){
  global $product;
  $rating_count = $product->get_rating_count();
  $review_count = $product->get_review_count();
  $average      = $product->get_average_rating(); 
  $html = '<div class="product-card__rating">
                     <div class="product-card__rating-stars">
                        <div class="rating">
                           <div class="rating__body">';
  $html .= show_star_rating_by_svg($average);

  $html .=                  '</div></div>';
  $html .=             '</div>';
  $html .=        '<div class="product-card__rating-legend"> '.sprintf( __( '%s review', 'woocommerce' ), $review_count ).' </div>';
  $html .=         '</div>';
  
  echo $html;
}
function show_star_rating_return( $rating ) {
  //$html = '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
  $html = '';
  if ( 0 < $rating ) {
    $ng = $rating%10;
    if($rating == $ng){
      $rating = $ng.'0';
    }else{
      if($ng < $rating && $rating <= ($ng + 0.5)){ $rating = ($ng + 0.5)*10; } else{ $rating = ($ng + 1).'0'; }
    }
    $html .= '<span class="rating-static rating-'.$rating.'"></span>';
  } else {
    /* translators: %s: rating */
    $html .= '<span class="rating-static rating-0"></span>';
  }
  return $html;
}
function show_star_rating_by_svg( $rating ) {
  //$html = '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
  $_html = '';
  
    for ($i = 0; $i < 5; $i++) {
      if($i < $rating ){
        $_html .= '<svg class="rating__star rating__star--active" width="13px" height="12px">';
        $_html .= '  <g class="rating__fill">';
        $_html .= '      <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#star-normal"></use>';
        $_html .= '  </g>';
        $_html .= '  <g class="rating__stroke">';
        $_html .= '      <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#star-normal-stroke"></use>';
        $_html .= '  </g>';
        $_html .= '</svg>';
        $_html .= '<div class="rating__star rating__star--only-edge rating__star--active">';
        $_html .= '  <div class="rating__fill">';
        $_html .= '      <div class="fake-svg-icon"></div>';
        $_html .= '  </div>';
        $_html .= '  <div class="rating__stroke">';
        $_html .= '      <div class="fake-svg-icon"></div>';
        $_html .= '  </div>';
        $_html .= '</div>';
        }else{
        $_html .= '<svg class="rating__star" width="13px" height="12px">';
        $_html .= '  <g class="rating__fill">';
        $_html .= '      <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#star-normal"></use>';
        $_html .= '  </g>';
        $_html .= '  <g class="rating__stroke">';
        $_html .= '      <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#star-normal-stroke"></use>';
        $_html .= '  </g>';
        $_html .= '</svg>';
        $_html .= '<div class="rating__star rating__star--only-edge">';
        $_html .= '  <div class="rating__fill">';
        $_html .= '      <div class="fake-svg-icon"></div>';
        $_html .= '  </div>';
        $_html .= '  <div class="rating__stroke">';
        $_html .= '      <div class="fake-svg-icon"></div>';
        $_html .= '  </div>';
        $_html .= '</div>';   
      }       
  }         
  return $_html;
}
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating',5);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart',10);
add_action( 'woocommerce_after_shop_loop_item_title', 'product_card__actions_begin',10);
function product_card__actions_begin() {
    echo '<div class="product-card__actions">';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'product_meta_availability',10);
function product_meta_availability() {
    global $product;
    echo '<div class="product-card__availability">Availability: <span class="text-success">';
    echo wc_get_stock_html( $product ); 
    echo '</span></div>';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'product_card__prices',10);
function product_card__prices() {
    global $product;
    $price_html = $product->get_price_html();
    echo '<div class="product-card__prices">'.$price_html.'</div>';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'product_card__buttons_begin',10);
function product_card__buttons_begin() {
    echo '<div class="product-card__buttons">';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'cart_primary',10);
function cart_primary(){
  woocommerce_template_loop_add_to_cart(array('class'=>'btn btn-primary product-card__addtocart') );
}
add_action( 'woocommerce_after_shop_loop_item_title', 'cart_second',10);
function cart_second(){
  woocommerce_template_loop_add_to_cart(array('class'=>'btn btn-secondary product-card__addtocart product-card__addtocart--list') );
}
add_action( 'woocommerce_after_shop_loop_item_title', 'whist_btn_light',10);
function whist_btn_light(){
  echo '<button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__wishlist" type="button">
        <svg width="16px" height="16px">
            <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#wishlist-16"></use>
        </svg>
        <span class="fake-svg-icon fake-svg-icon--wishlist-16"></span>
    </button>
    <button class="btn btn-light btn-svg-icon btn-svg-icon--fake-svg product-card__compare" type="button">
        <svg width="16px" height="16px">
            <use xlink:href="'.get_template_directory_uri().'/images/sprite.svg#compare-16"></use>
        </svg>
        <span class="fake-svg-icon fake-svg-icon--compare-16"></span>
    </button>';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'product_card__buttons_end',10);
function product_card__buttons_end() {
    echo '</div>';
}
//add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price',10);
add_action( 'woocommerce_after_shop_loop_item_title', 'product_card__actions_end',10);
function product_card__actions_end() {
    echo '</div>';
}

//cart
remove_action( 'woocommerce_before_cart', 'action_woocommerce_before_cart', 10, 1 );
remove_action( 'woocommerce_before_cart', 'woocommerce_output_all_notices', 10 );
//checkout
//add_filter( 'woocommerce_checkout_coupon_message', 'bbloomer_have_coupon_message');
// function bbloomer_have_coupon_message() {
// return '<i class="fa fa-ticket" aria-hidden="true"></i>'.esc_html__( 'Have a coupon?', 'woocommerce' ).' <a href="#" class="showcoupon">'. esc_html__( 'Click here to enter your code', 'woocommerce' ) .'</a>';
// }

add_filter( 'wc_add_to_cart_message_html', '__return_null' );

// add_action( 'woocommerce_before_checkout_form', 'begin_checkout');
// function begin_checkout() {
//     echo '<div class="checkout block">
//     <div class="container">
//          <div class="row">';
// }
// add_action( 'woocommerce_after_checkout_form', 'end_checkout');
// function end_checkout() {
//     echo '</div></div></div>';
//}
add_filter( 'woocommerce_checkout_fields', 'misha_remove_fields', 9999 );
 
function misha_remove_fields( $woo_checkout_fields_array ) {
  // she wanted me to leave these fields in checkout
  // unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
  // unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
  // unset( $woo_checkout_fields_array['billing']['billing_phone'] );
  // unset( $woo_checkout_fields_array['billing']['billing_email'] );
  // unset( $woo_checkout_fields_array['order']['order_comments'] ); // remove order notes
  // and to remove the billing fields below
  unset( $woo_checkout_fields_array['billing']['billing_company'] ); // remove company field
  unset( $woo_checkout_fields_array['billing']['billing_country'] );
  unset( $woo_checkout_fields_array['billing']['billing_address_1'] );
  unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
  //unset( $woo_checkout_fields_array['billing']['billing_city'] );
  //unset( $woo_checkout_fields_array['billing']['billing_state'] ); // remove state field
  unset( $woo_checkout_fields_array['billing']['billing_postcode'] ); // remove zip code field
  return $woo_checkout_fields_array;
}


add_filter( 'woocommerce_checkout_fields' , 'misha_not_required_fields', 9999 );
function misha_not_required_fields( $f ) {
  unset( $f['billing']['billing_last_name']['required'] ); // that's it
  unset( $f['billing']['billing_email']['required'] );
  // the same way you can make any field required, example:
  // $f['billing']['billing_company']['required'] = true;
  return $f;
}

function change_woocommerce_field_markup($field, $key, $args, $value) {
   //$field = '<div class="form-row">'.$field.'</div>';
   if($key === 'billing_first_name'){
      $field = '<div class="form-row">'.$field;
   }
   else if ($key === 'billing_last_name'){
      $field = $field.'</div>';
   }
    return $field;
} 

add_filter("woocommerce_form_field_text","change_woocommerce_field_markup", 10, 4);

include("custom-field-woocommerce.php");


add_filter( 'gettext', 'bbloomer_translate_woocommerce_strings', 999, 3 );
  
function bbloomer_translate_woocommerce_strings( $translated, $untranslated, $domain ) {
 
   if ( ! is_admin() && 'woocommerce' === $domain ) {
      switch ( $translated) {
         case 'Thank you' :
            $translated = 'Cảm ơn';
            break;
         case 'Your order has been received' :
            $translated = 'Đơn hàng của bạn đã tiếp nhận';
            break;
         case 'select options' :
            $translated = 'Tùy chọn';
            break;
          case 'Navigation' :
             $translated = 'Điều hướng';
            break;
           case 'Order History' :
             $translated = 'Lịch sự đơn hàng';
            break;
      }
 
   }   
  
   return $translated;
 
}
remove_action( 'woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10 );

remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 ); 
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

function my_woocommerce_widget_shopping_view_cart() {
     echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="btn btn-secondary">' . esc_html__( 'View cart', 'woocommerce' ) . '</a>';
}

add_action( 'woocommerce_widget_shopping_cart_buttons', 'my_woocommerce_widget_shopping_view_cart', 20 );

function my_woocommerce_widget_shopping_cart_proceed_to_checkout() {
     echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn btn-primary">' . esc_html__( 'Checkout', 'woocommerce' ) . '</a>';
}

add_action( 'woocommerce_widget_shopping_cart_buttons', 'my_woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

//archive

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/*extend plugin*/
add_action( 'woocommerce_before_add_to_cart_quantity', 'wp_echo_qty_front_add_cart' );
function wp_echo_qty_front_add_cart() {
 echo '<div class="product__actions-item">
               <div class="input-number product__quantity">'; 
}
add_action( 'woocommerce_after_add_to_cart_quantity', 'wp_echo_qty_after_add_cart' );
function wp_echo_qty_after_add_cart() {
 echo '</div></div>'; 
}

add_action( 'woocommerce_before_add_to_cart_button', 'wp_echo_qty_front_cart_button' );
function wp_echo_qty_front_cart_button() {
 echo '<div class="form-group product__option">
      <label class="product__option-label" for="product-quantity">Quantity</label>
         <div class="product__actions">'; 
}
add_action( 'woocommerce_after_add_to_cart_button', 'wp_echo_qty_after_cart_button' );
function wp_echo_qty_after_cart_button() {
 echo '</div></div>'; 
}
//share social
//include('share-social.php');
// define the woocommerce_share callback 
// function action_woocommerce_share( $jetpack_woocommerce_social_share_icons, $int ) { 
    
// }; 
function box_share_social() { 
    global $post, $product;   
    if( is_product()) {
      // Get current page URL 
          //$url = urlencode(get_permalink());
          //$url = get_permalink();
          $link = get_the_permalink();
          $link = str_replace(':', '%3A', $link);
          $link = str_replace('/', '%2F', $link);
          $socialTitle = str_replace( ' ', '%20', get_the_title());
          // Get Post Thumbnail for pinterest
          //$socialThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $id_post ), 'medium' );
          // Construct sharing URL without using any script
          $scriptsocial ='<div class="product__footer">';
          $scriptsocial .='<div class="product__tags tags">';
          $scriptsocial .= wc_get_product_tag_list( $product->get_id(), '', '<div class="tags__list">' . _n( 'Tag:', '', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); 
          $scriptsocial .='</div>';
          $scriptsocial .='<div class="product__share-links share-links">';
          $scriptsocial .='<ul class="share-links__list">';
          $scriptsocial .='<li class="fb-like" data-href="'.$link.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></li>';
          $scriptsocial .='<li class="zalo-share-button" data-href="'.$link.'" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></li>';
                   
          $scriptsocial .='</ul>';
          $scriptsocial .='</div>';
          $scriptsocial .='</div>';
          echo $scriptsocial;
      }
  } 
function sidebar_social(){
   global $post, $product;
  ?>
  <div class="product__footer">
    <div class="product__tags tags">
      <?php echo  wc_get_product_tag_list( $product->get_id(), '', '<div class="tags__list">' . _n( '', '', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>
    </div>
    <div class="product__share-links share-links">
      <?php dynamic_sidebar( 'sidebar-social' ); ?>
  </div>
</div>
<?php
}    
// add the action 
add_action( 'woocommerce_share', 'sidebar_social', 10, 2 );
//archive

/*thumnail cart*/
