<?php 
if(!function_exists('update_gallery')):
	function update_gallery(){
			 //check_ajax_referer( 'my-special-string', 'security' );
			 wp_verify_nonce( 'my-gallery','security');
			 //$list_gallery = htmlspecialchars(stripslashes(trim($_POST['list-gallery'])));
			 //$wpdb->query($wpdb->prepare("UPDATE $table_name SET time='$current_timestamp' WHERE userid=$userid"));
			 $input = json_decode(file_get_contents('php://input'),true);
    		 $list_image = $input['list_image'];
    		 $variation_id = $input['variation_id'];  
			 update_post_meta($variation_id, "gallery",  $list_image);
             echo $list_image;
             wp_die();
	        }
endif;
add_action( 'wp_ajax_update_gallery', 'update_gallery' );
add_action( 'wp_ajax_nopriv_update_gallery', 'update_gallery' );
?>