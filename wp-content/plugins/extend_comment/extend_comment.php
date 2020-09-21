<?php

/*

Plugin Name: Extend Comment

Version: 1.0.6

Plugin URI: http://zutheme.com

Author: Hatazu

Author URI: http://zutheme.com

*/

// Add custom meta (ratings) fields to the default comment form

// Default comment form includes name, email address and website URL

// Default comment form elements are hidden when user is logged in
//include('action.php');
include( plugin_dir_path( __FILE__ ) . 'action.php');
include('better-comment.php');
include('comment_walker.php');

add_filter('comment_form_default_fields', 'custom_fields');

function custom_fields($fields) {
    $commenter = wp_get_current_commenter();
    //$req = get_option( 'require_name_email' );
    $req = 0;
    $aria_req = ( $req ? " aria-required='true'" : '' );
    //$req = 0;
    //$aria_req = "";
    $fields[ 'author' ] = '<p class="comment-form-author">'.

      '<label for="'.$req.'author">' . __( 'Name' ) . '</label>'.

      ( $req ? '<span class="required">*</span>' : '' ).

      '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .

      '" size="30" tabindex="1"' . $aria_req . ' /></p>';



    $fields[ 'email' ] = '<p class="comment-form-email">'.

      '<label for="email">' . __( 'Email' ) . '</label>'.

      ( $req ? '<span class="required">*</span>' : '' ).

      '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .

      '" size="30"  tabindex="2"' . $aria_req . ' /></p>';



    $fields[ 'url' ] = '<p class="comment-form-url">'.

     '<label for="url">' . __( 'Website' ) . '</label>'.

      '<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .

      '" size="30"  tabindex="3" /></p>';



    $fields[ 'phone' ] = '<p class="comment-form-phone">'.

      '<label for="phone">' . __( 'Phone' ) . '</label>'.

      '<input id="phone" name="phone" type="text" size="30"  tabindex="4" /></p>';

  return $fields;

}

// Add fields after default fields above the comment box, always visible
add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

function additional_fields () { 
   echo '<p class="comment-avatar">'.
  '<label>' . __( 'avatar' ) . '</label>'.
  '<input class="avatar_comment" name="avatar_comment" type="text" size="30"  tabindex="5" /></p>';
  echo '<p class="comment-form-rating">'.
  '<label for="rating">'. __('Rating') . '<span class="required">*</span></label>
  <span class="commentratingbox">';
    //Current rating scale is 1 to 5. If you want the scale to be 1 to 10, then set the value of $i to 10.
    for( $i=1; $i <= 5; $i++ )
    echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"/>'. $i .'</span>';
    echo'</span></p>';
}



//add_comment_meta($comment_id, $meta_key, $meta_value, $unique = false);

// Save the comment meta data along with comment



add_action( 'comment_post', 'save_comment_meta_data' );

function save_comment_meta_data( $comment_id ) {

  if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') )

  $phone = wp_filter_nohtml_kses($_POST['phone']);

  add_comment_meta( $comment_id, 'phone', $phone );

   if ( ( isset( $_POST['avatar_comment'] ) ) && ( $_POST['avatar_comment'] != '') )

   $title = wp_filter_nohtml_kses($_POST['avatar_comment']);

  add_comment_meta( $comment_id, 'avatar_comment', $title );

  if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') )

  $rating = wp_filter_nohtml_kses($_POST['rating']);

  add_comment_meta( $comment_id, 'rating', $rating );

}

// Add the filter to check whether the comment meta data has been filled
add_filter( 'preprocess_comment', 'verify_comment_meta_data' );

function verify_comment_meta_data( $commentdata ) {
  if (  isset( $_POST['rating'] ) ) {
  //wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
    return $commentdata;
  }
}
//get_comment_meta( $comment_id, $meta_key, $single = false )
// Add an edit option to comment editing screen  
add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
    add_meta_box( 'title', __( 'Comment Metadata - Extend Comment' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}

function extend_comment_meta_box ( $comment ) {
    $phone = get_comment_meta( $comment->comment_ID, 'phone', true );
    $url_avatar = get_comment_meta( $comment->comment_ID, 'avatar_comment', true );
    $rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false ); ?>
    <p>
        <label for="phone"><?php _e( 'Phone' ); ?></label>
        <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
    </p>
     <p>
      <label  class="prfx-row-title"><?php _e( 'File Upload', 'prfx-textdomain' )?></label>
      <input  type="hidden" class="avatar_comment" name="avatar_comment" value="<?php echo $url_avatar; ?>" />
      <input type="button" onclick="upload_avatar_comment(this);" name="btn_comment" class="button" value="<?php _e( 'Choose or Upload an Image', 'prfx-textdomain' )?>" />
      <br><img class="img_set_avatar" style="max-height: 100px; min-width: auto" src="<?php echo esc_attr($url_avatar); ?>">
    </p>
    <p>
      <label for="rating"><?php _e( 'Rating: ' ); ?></label>
      <span class="commentratingbox">
      <?php for( $i=1; $i <= 5; $i++ ) {
        echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"';
        if ( $rating == $i ) echo ' checked="checked"';
        echo ' />'. $i .' </span>';
        }   ?>
      </span>
    </p>
    <?php
}
// Update comment meta data from comment editing screen 
add_action( 'edit_comment', 'extend_comment_edit_metafields' );
function extend_comment_edit_metafields( $comment_id ) {
  if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;
  if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != ’) ) :
  $phone = wp_filter_nohtml_kses($_POST['phone']);
  update_comment_meta( $comment_id, 'phone', $phone );
  else :
  delete_comment_meta( $comment_id, 'phone');
  endif;
  if ( ( isset( $_POST['avatar_comment'] ) ) && ( $_POST['avatar_comment'] != ’) ):
  $title = wp_filter_nohtml_kses($_POST['avatar_comment']);
  update_comment_meta( $comment_id, 'avatar_comment', $title );
  else :
  delete_comment_meta( $comment_id, 'avatar_comment');
  endif;
  if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != ’) ):
  $rating = wp_filter_nohtml_kses($_POST['rating']);
  update_comment_meta( $comment_id, 'rating', $rating );
  else :
  delete_comment_meta( $comment_id, 'rating');
  endif;
}

add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
}
add_filter( 'comment_form_defaults', 'cd_pre_comment_text' );
/**
 * Change the text output that appears before the comment form
 * Note: Logged in user will not see this text.
 * 
 * @author Carrie Dils <http://www.carriedils.com>
 * @uses comment_notes_before <http://codex.wordpress.org/Function_Reference/comment_form>
 * 
 */
function cd_pre_comment_text( $arg ) {
  $arg['comment_notes_before'] = "";
  return $arg;
}
function my_remove_email_field_from_comment_form($fields) {
    if(isset($fields['email'])) unset($fields['email']);
    return $fields;
}

add_filter('comment_form_default_fields', 'my_remove_email_field_from_comment_form');

function hatazu_extend_comment_script() {
  global $post;
  if(!is_front_page()) {
    wp_enqueue_style('comment-css', plugin_dir_url(__FILE__) . 'css/comment.css',array(), '1.1.3', false);
    wp_enqueue_script('upload-avatar', plugin_dir_url(__FILE__) .'js/hatazu_upload_avartar_comment.js', array(), '0.1.5', true );
    wp_enqueue_script('extend-comment-js', plugin_dir_url(__FILE__) .'js/comment.js', array(), '1.2.4', true );
    wp_localize_script( 'extend-comment-js', 'ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php')));
  }
} 
add_action("wp_enqueue_scripts", "hatazu_extend_comment_script");


function hatazu_upload_avartar_comment_enqueue() {
    global $typenow;
        wp_enqueue_media();
        // Registers and enqueues the required javascript.
        wp_localize_script( 'hatazu_upload_avartar', 'meta_image',
            array(
                'title' => __( 'Choose or Upload an Image', 'prfx-textdomain' ),
                'button' => __( 'Use this image', 'prfx-textdomain' ),
            )
        );
        wp_enqueue_script( 'hatazu_upload_avatar' );
}
add_action( 'admin_enqueue_scripts', 'hatazu_upload_avartar_comment_enqueue');
function hatazu_upload_admin_script() {
    //wp_enqueue_style('comment-css', plugin_dir_url(__FILE__) . 'css/comment.css',array(), '0.7.8', false);
    wp_enqueue_script('hatazu_upload_avartar_comment', plugin_dir_url(__FILE__) .'js/hatazu_upload_avartar_comment.js', array(), '0.1.2', true );
} 
add_action("admin_enqueue_scripts", "hatazu_upload_admin_script");
//rating 
function wc_get_rating_html_custom( $rating, $count = 0 ) {
  $html = '';
  if ( 0 < $rating ) {
    /* translators: %s: rating */
    //$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );
    $html  = '<div class="rating"><div class="rating__body">' . wc_get_star_rating_html_custom( $rating, $count ) . '</div></div>';
  }
  return apply_filters( 'woocommerce_product_get_rating_html', $html, $rating, $count );
}
function wc_get_star_rating_html_custom( $rating, $count = 0 ) {
  //$html = '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
  $html = '';
  if ( 0 < $count ) {
    $ng = $rating%10;
    if($rating == $ng){
      $rating = $ng.'0';
    }else{
      if($ng < $rating && $rating <= ($ng + 0.5)){ $rating = ($ng + 0.5)*10; } else{ $rating = ($ng + 1).'0'; }
    }
    $html .= '<span class="rating-static rating-'.$rating.'"></span>';
  } else {
    /* translators: %s: rating */
    $ $html .= sprintf( _n( '%1$s', '<a href="#tab-reviews">' . esc_html( $count ) . 'Reviews</a><span>/</span>'));
  }
  return apply_filters( 'woocommerce_get_star_rating_html', $html, $rating, $count );
}
function show_star_rating( $rating ) {
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
  echo $html;
}

if(!function_exists('extend_form_comment')):
  function extend_form_comment(){ 
     if(!is_front_page()) {   ?>
   <div class="comments-container form-comment">
        <ul class="comments-list">
           <li> 
            <form class="frm-comment" id="frm-comment">
                <?php $ajax_nonce = wp_create_nonce( "my-special-string" ); ?>          
                <input type='hidden' class="my-special-string" name='my-special-string' value='<?php echo $ajax_nonce; ?>' />
                    <input type='hidden' class="comment_post_ID" name='comment_post_ID' value='<?php echo get_the_ID(); ?>' />
                    <input type='hidden' class="comment_parent" name='comment_parent' value='0' />
                    <div class="comment-main-level">
                        <!-- Avatar -->
                        <div class="comment-avatar"><img src="<?php echo  plugin_dir_url(__FILE__) .'image/guest1.png' ?>" alt=""></div>
                        <!-- Contenedor del Comentario -->
                        <div class="comment-box">
                            <div class="comment-head">
                                <h6 class="comment-name by-author"><a href="#">Bình luận</a></h6>
                                <!-- <span>Đánh giá</span> -->
                                 <span class="rating">
                                <span class="chk-rate">Đánh giá</span>&nbsp; 
                                  <?php for( $i=0; $i < 5; $i++ ) { ?>
                                     <span class="item">
                                       <input type="radio" name="rating" class="rate" value="<?php echo $i; ?>" />
                                       <label class="lb_radio"><span class="empty-star"></span></label><!-- fa fa-star -->
                                     </span>
                                    <?php } ?>
                                  </span> 
                            </div>
                            <div class="comment-content">
                                <textarea name="comment" class="cmt-content form-control" rows="4" aria-required="true"></textarea>
                            </div>
                            <button class="post-comment" type="button" onclick="post_comment(this);">Đăng</button>
                            <div class="comment-result">
                                <p><img class="loading" style="display:none;width:30px;" src="<?php echo  plugin_dir_url(__FILE__) .'image/loader.gif'; ?>"></p>
                            <span class="result"></span> 
                            </div>
                        </div>
                    </div>
                </form>
            </li>
    </ul>
  </div>
<?php }
}
endif;
function form_user_comment(){
if(is_home()||is_front_page()) return false;
global $post; 
if(is_singular() && comments_open( $post->ID )) {  ?>
<div class="modal-comment-form">
  <div class="modal-comment">
    <!-- Modal content -->
    <div class="modal-content-comment">   
        <form class="frm-comment body">
            <span class="close">&times;</span>
            <!-- <div class="row">  -->    
                    <div class="form-reg">
                        <p>Vòng lòng để lại thông tin để chúng tôi xác nhận</p>
                        <div class="input-group-comment">
                            <input type="text" class="form-control-comment fullname" name="fullname" placeholder="Họ và tên" required>
                        </div>
                        <div class="input-group-comment">
                            <input type="number" class="form-control-comment phone" name="phone" placeholder="Điện thoại" required>
                        </div>          
                        <div class="input-group-comment">
                            <input type="email" class="form-control-comment email" name="email" placeholder="E-mail (nếu có)">
                        </div>      
                      <div class="input-group-comment area-btn">
                            <a href="javascript:void(0)" class="btn btn-default btn-submit">Xác nhận</a>
                      </div>
                      <img class="loading" style="display:none;width:30px;" src="<?php echo plugin_dir_url(__FILE__); ?>image/loader.gif">
                      <span class="result"></span>      
                </div>
           <!--  </div> -->
        </form>     
    </div>
  </div>
</div>
<?php } 
} 

add_action( 'wp_footer', 'form_user_comment');
add_action( 'wp_footer', 'form_user_reply'); 

function form_user_reply(){ 
global $post;
if(is_home()||is_front_page()|| is_page() ) return false;
if(is_singular() && comments_open( $post->ID )) {   ?>
<div class="modal-comment-form modal-repply">
  <div class="modal-comment">
    <!-- Modal content -->
    <div class="modal-content-comment">   
        <form class="frm-comment body">
          <span class="close">&times;</span>
            <div class="form-reg">
                  <p>Phản hồi của bạn</p>
                <?php $ajax_nonce = wp_create_nonce( "my-special-string" ); ?>          
                <input type='hidden' class="my-special-string" name='my-special-string' value='<?php echo $ajax_nonce; ?>' />
                    <input type='hidden' class="comment_post_ID" name='comment_post_ID' value='<?php echo get_the_ID(); ?>' />
                    <input type='hidden' class="comment_parent" name='comment_parent' value='0' />
                    <div class="comment-main-level">
                        <div class="comment-box">
                            <div class="comment-content">
                                <textarea name="comment" class="cmt-content form-control" rows="4" aria-required="true"></textarea>
                            </div>
                            <button class="post-comment" type="button" onclick="post_comment(this);">Đăng</button>
                            <div class="comment-result">
                                <p><img class="loading" style="display:none;width:30px;" src="<?php echo  plugin_dir_url(__FILE__) .'image/loader.gif'; ?>"></p>
                            <span class="result"></span> 
                            </div>
                        </div>
                    </div>     
            </div>
        </form>     
    </div>
  </div>
</div>
<?php } 
} 
