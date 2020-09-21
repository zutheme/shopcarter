<?php

function htz_image_avatar(){
    //check_ajax_referer('ajax_file_nonce', 'security');
    //wp_verify_nonce( 'ajax_file_nonce', 'security');
    wp_verify_nonce('media-form', 'security');
    $input = json_decode(file_get_contents('php://input'),true);
	$base64_string = $input['file'];
    $result = processfile($base64_string);
    $picture_id = $result[0];
    $user_id = get_current_user_id();
    wc_cus_save_profile_pic($picture_id, $user_id);
    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_htz_image_avatar', 'htz_image_avatar');
// not logged in users might need love too
add_action('wp_ajax_nopriv_htz_image_avatar', 'htz_image_avatar');
/**
 * Function wc_cus_save_profile_pic
 *
 */
function wc_cus_save_profile_pic($picture_id, $user_id){
    update_user_meta( $user_id, 'profile_pic', $picture_id );
}


// =========================================================================
/**
 * Function wc_cus_upload_picture
 *
 */
function wc_cus_upload_picture( $foto ) {

    $wordpress_upload_dir = wp_upload_dir();
    // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
    // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
    $i = 1; // number of tries when the file with the same name is already exists

    $profilepicture = $foto;
    $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
    $new_file_mime = mime_content_type( $profilepicture['tmp_name'] );
    
    $log = new WC_Logger();     
    
    if( empty( $profilepicture ) )
    $log->add('custom_profile_picture','File is not selected.');    

    if( $profilepicture['error'] )
    $log->add('custom_profile_picture',$profilepicture['error']);   
    

    if( $profilepicture['size'] > wp_max_upload_size() )
    $log->add('custom_profile_picture','It is too large than expected.');   
    

    if( !in_array( $new_file_mime, get_allowed_mime_types() ))
    $log->add('custom_profile_picture','WordPress doesn\'t allow this type of uploads.' );      

    while( file_exists( $new_file_path ) ) {
        $i++;
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
    }

    // looks like everything is OK
    if( move_uploaded_file( $profilepicture['tmp_name'], $new_file_path ) ) {
    

    $upload_id = wp_insert_attachment( array(
        'guid'           => $new_file_path, 
        'post_mime_type' => $new_file_mime,
        'post_title'     => preg_replace( '/\.[^.]+$/', '', $profilepicture['name'] ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    ), $new_file_path );
    //Upload Files to WordPress Uploads Folder
    if ( ! function_exists( 'wp_handle_upload' ) )
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
    // wp_generate_attachment_metadata() won't work if you do not include this file
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Generate and save the attachment metas into the database
    wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
    return $upload_id;
    }
}


// =========================================================================
/**
 * Function wc_cus_change_avatar
 *
 */
add_filter( 'get_avatar' , 'wc_cus_change_avatar' , 1 , 5 );
function wc_cus_change_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    //$user = false;
    //$user = wp_get_current_user();
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );   
    }

    if ( $user && is_object( $user ) ) {
        $picture_id = get_user_meta($user->data->ID,'profile_pic');
        if(! empty($picture_id)){
            $avatar = wp_get_attachment_url( $picture_id[0] );
            //$avatar = "<img id='image' alt='{$alt}' src='{$avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
        }
    }
    return $avatar;
}
function processfile($base64_string){
        $_idfile = 0;
        $upload_id = 0;
        $wordpress_upload_dir = wp_upload_dir();
        $new_file_path ='';
        $relative_path ='';
        if($base64_string!=""){
                $orfilename = "";
                $data = explode( ',', $base64_string );
                $mimeString = $data[0];
                $mimeString = explode( ':', $mimeString);
                $mimeString = explode( ';', $mimeString[1]);
                $extension =  explode( '/', $mimeString[0]);
                $data1 = $data[1];
                $decoded = base64_decode($data1);   
                $typefile = $extension[1];
                $filename = date('Ymd').'_'.time().'_'.uniqid().'.'.$typefile;
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $filename;
                $relative_path = $wordpress_upload_dir['url'] . '/' . $filename;
                $i = 0;
                 while( file_exists( $new_file_path ) ) {
                $i++;
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $filename;
                $relative_path = $wordpress_upload_dir['url'] . '/' . $i . '_' . $filename;
                }   
                file_put_contents( $new_file_path , $decoded);
        }
        if($new_file_path){
            $upload_id = wp_insert_attachment( array(
            'guid'           => $new_file_path, 
            'post_mime_type' => $typefile,
            'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
            ), $new_file_path );
            //Upload Files to WordPress Uploads Folder
            if ( ! function_exists( 'wp_handle_upload' ) )
              require_once( ABSPATH . 'wp-admin/includes/file.php' );
            // wp_generate_attachment_metadata() won't work if you do not include this file
            require_once( ABSPATH . 'wp-admin/includes/image.php' );

            // Generate and save the attachment metas into the database
            wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
            
        }
        return array($upload_id,$relative_path);
}
/*custom woocommnerce field*/
function custom_woocommerce_form_field_plugin( $key, $args, $value = null ) {
    $defaults = array(
        'type'              => 'text',
        'label'             => '',
        'description'       => '',
        'placeholder'       => '',
        'maxlength'         => false,
        'required'          => false,
        'autocomplete'      => false,
        'id'                => $key,
        'class'             => array(),
        'label_class'       => array(),
        'input_class'       => array(),
        'return'            => false,
        'options'           => array(),
        'custom_attributes' => array(),
        'validate'          => array(),
        'default'           => '',
        'autofocus'         => '',
        'priority'          => '',
    );
    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'custom_woocommerce_form_field_args', $args, $key, $value );
    if ( $args['required'] ) {
        $args['class'][] = 'validate-required';
        $required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
    } else {
        $required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
    }
    if ( is_string( $args['label_class'] ) ) {
        $args['label_class'] = array( $args['label_class'] );
    }
    if ( is_null( $value ) ) {
        $value = $args['default'];
    }
    // Custom attribute handling.
    $custom_attributes         = array();
    $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );
    if ( $args['maxlength'] ) {
        $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
    }
    if ( ! empty( $args['autocomplete'] ) ) {
        $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
    }
    if ( true === $args['autofocus'] ) {
        $args['custom_attributes']['autofocus'] = 'autofocus';
    }
    if ( $args['description'] ) {
        $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
    }
    if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
        foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
            $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
        }
    }
    if ( ! empty( $args['validate'] ) ) {
        foreach ( $args['validate'] as $validate ) {
            $args['class'][] = 'validate-' . $validate;
        }
    }
    $field           = '';
    $label_id        = $args['id'];
    $sort            = $args['priority'] ? $args['priority'] : '';
   $formrow_bg = '';$formrow_end = ''; $col ='';
   if($key == 'billing_first_name'||$key=='shipping_first_name'){
        $formrow_bg = '<div class="form-row">';
        $col ='col-md-6';
   }elseif($key == 'billing_last_name'||$key=='shipping_last_name'){
        $col ='col-md-6';
        $formrow_end = '</div>';
   }
    $field_container = $formrow_bg.'<div class="form-group '.$col.' %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</div>'.$formrow_end;
    switch ( $args['type'] ) {
        case 'country':
            $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();
            if ( 1 === count( $countries ) ) {
                $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';
                $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';
            } else {
                $field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '><option value="">' . esc_html__( 'Select a country&hellip;', 'woocommerce' ) . '</option>';
                foreach ( $countries as $ckey => $cvalue ) {
                    $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                }
                $field .= '</select>';
                $field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country', 'woocommerce' ) . '">' . esc_html__( 'Update country', 'woocommerce' ) . '</button></noscript>';
            }
            break;
        case 'state':
            /* Get country this state field is representing */
            $for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
            $states      = WC()->countries->get_states( $for_country );
            if ( is_array( $states ) && empty( $states ) ) {
                $field_container = '<div class="form-row %1$s" id="%2$s" style="display: none">%3$s</div>';
                $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" />';
            } elseif ( ! is_null( $for_country ) && is_array( $states ) ) {
                $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                        <option value="">' . esc_html__( 'Select a state&hellip;', 'woocommerce' ) . '</option>';
                foreach ( $states as $ckey => $cvalue ) {
                    $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                }
                $field .= '</select>';
            } else {
                $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
            }
            break;
        case 'textarea':
            $field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';
            break;
        case 'checkbox':
            $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
                        <input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';
            break;
        case 'text':
        case 'password':
        case 'datetime':
        case 'datetime-local':
        case 'date':
        case 'month':
        case 'time':
        case 'week':
        case 'number':
        case 'email':
        case 'url':
        case 'tel':
            $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';
            break;
        case 'select':
            $field   = '';
            $options = '';
            if ( ! empty( $args['options'] ) ) {
                foreach ( $args['options'] as $option_key => $option_text ) {
                    if ( '' === $option_key ) {
                        // If we have a blank option, select2 needs a placeholder.
                        if ( empty( $args['placeholder'] ) ) {
                            $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
                        }
                        $custom_attributes[] = 'data-allow_clear="true"';
                    }
                    $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
                }
                $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                            ' . $options . '
                        </select>';
            }
            break;
        case 'radio':
            $label_id = current( array_keys( $args['options'] ) );
            if ( ! empty( $args['options'] ) ) {
                foreach ( $args['options'] as $option_key => $option_text ) {
                    $field .= '<input type="radio" class="input-radio form-control' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
                    $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
                }
            }
            break;
    }
    if ( ! empty( $field ) ) {
        $field_html = '';
        if ( $args['label'] && 'checkbox' !== $args['type'] ) {
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
        }
        $field_html .= $field;
        if ( $args['description'] ) {
            $field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
        }
        //$field_html .= '</span>';
        $container_class = esc_attr( implode( ' ', $args['class'] ) );
        $container_id    = esc_attr( $args['id'] ) . '_field';
        $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
    }
    /**
         * Filter by type.
         */
    $field = apply_filters( 'custom_woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );
    /**
         * General filter on form fields.
         *
         * @since 3.4.0
         */
    $field = apply_filters( 'custom_woocommerce_form_field', $field, $key, $args, $value );
    if ( $args['return'] ) {
        return $field;
    } else {
        echo $field; // WPCS: XSS ok.
    }
}
?>