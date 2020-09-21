<?php
function prfx_field_custom_meta() {

    add_meta_box( 'prfx_meta', __( 'Custom field', 'prfx-textdomain' ), 'prfx_field_meta_callback', 'page','normal', 'high');
    add_meta_box( 'meta-box-id', __( 'Custom field', 'prfx-textdomain' ), 'prfx_field_meta_callback', 'post' );

}

add_action( 'add_meta_boxes', 'prfx_field_custom_meta');

/*

 * Outputs the content of the meta box

 */

function prfx_field_meta_callback( $post ) {
   
    //print_r($post);
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );

    $prfx_stored_meta = get_post_meta( $post->ID );

    ?>
   <!--  <p><?php //echo $post->ID.'-'.$slug_nation; ?></p> -->
    <?php $post_type = get_post_type($post->ID); 
    if ( "page" == $post_type ){ 
         if ( isset ( $prfx_stored_meta['slug-nation'] ) ) {
            $slug_nation = $prfx_stored_meta['slug-nation'][0];
         }
    ?>
    <p>
        <label  class="prfx-row-title"><?php _e( 'Chọn template quốc gia', 'prfx-textdomain' )?></label>
        <select name="slug-nation">
            <option value="duc" <?php echo $slug_nation == 'duc' ? 'selected':''; ?>>Đức</option>
            <option value="my" <?php echo $slug_nation == 'my' ? 'selected':''; ?>>Mỹ</option>
            <option value="tay-ban-nha" <?php echo $slug_nation == 'tay-ban-nha' ? 'selected':''; ?>>Tây ban nha</option>
            <option value="newzeland" <?php echo $slug_nation == 'newzeland' ? 'selected':''; ?>>Newzeland</option>
            <option value="uc" <?php echo $slug_nation == 'uc' ? 'selected':''; ?>>Úc</option>
            <option value="canada" <?php echo $slug_nation == 'canada' ? 'selected':''; ?>>Canada</option>
            <option value="han-quoc" <?php echo $slug_nation == 'han-quoc' ? 'selected':''; ?>>Hàn quốc</option>
            <option value="navy" <?php echo $slug_nation == 'navy' ? 'selected':''; ?> >Navy</option>
        </select>
    </p> 
    <?php
    }
     if ( "post" == $post_type ){
        if ( isset ( $prfx_stored_meta['link-custom'] ) ) {
            $link_custom = $prfx_stored_meta['link-custom'][0];
         } 
    ?>
    <p><label  class="prfx-row-title"><?php _e( 'Lien ket ngoai', 'prfx-textdomain' )?></label></p>
        <input type="text" style="width: 100%;" name="link-custom" value="<?php echo $link_custom; ?>">
    <p>
       <!--  <textarea class="control-form" name="link-custom" rows="4" cols="50"><?php echo $link_custom; ?></textarea> -->
    </p> 
    <?php
    }
}

/*

 * Saves the custom meta input

 */

function prfx_field_save($post_id) {
    //global $wp_query; 
    //$post_id = $wp_query->get_queried_object_id();

    $is_autosave = wp_is_post_autosave( $post_id );

    $is_revision = wp_is_post_revision( $post_id );

    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {

        return;

    }

    // Checks for input and sanitizes/saves if needed 

    $post_type = get_post_type($post_id);

    if ( "page" == $post_type ){

        if( isset( $_POST['slug-nation'] ) ) {

            update_post_meta( $post_id, 'slug-nation', $_POST[ 'slug-nation' ] );    

        } 
    } 

    if ( "post" == $post_type ){

        if( isset( $_POST['link-custom'] ) ) {

            update_post_meta( $post_id, 'link-custom', $_POST[ 'link-custom' ] );    

        } 
    } 

}

add_action( 'save_post', 'prfx_field_save' );