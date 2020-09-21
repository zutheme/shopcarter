<?php
// Our video post type function
function create_video_post_type() {
	register_post_type( 'video',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'video' ),
				'singular_name' => __( 'videos' )
			),
			'public' => true,
			'menu_icon' => 'dashicons-id-alt',
			'has_archive' => true,
			'rewrite' => array('slug' => 'video'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_video_post_type' );

/*
* Creating a function to create our CPT
*/

function video_post_type() {
// Set UI labels for video Post Type
	$labels = array(
		'name'                => _x( 'video', 'Post Type General Name', 'hatazu' ),
		'singular_name'       => _x( 'videos', 'Post Type Singular Name', 'hatazu' ),
		'menu_name'           => __( 'video', 'hatazu' ),
		'parent_item_colon'   => __( 'Parent videos', 'hatazu' ),
		'all_items'           => __( 'All video', 'hatazu' ),
		'view_item'           => __( 'View videos', 'hatazu' ),
		'add_new_item'        => __( 'Add New videos', 'hatazu' ),
		'add_new'             => __( 'Add New', 'hatazu' ),
		'edit_item'           => __( 'Edit videos', 'hatazu' ),
		'update_item'         => __( 'Update videos', 'hatazu' ),
		'search_items'        => __( 'Search videos', 'hatazu' ),
		'not_found'           => __( 'Not Found', 'hatazu' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'hatazu' ),
	);
	
// Set other options for video Post Type
	
	$args = array(
		'label'               => __( 'video', 'hatazu' ),
		'description'         => __( 'videos news and reviews', 'hatazu' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		//'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'video-fields', ),
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or video taxonomy. 
		//'taxonomies' => array( 'post_tag', 'category'), 
		'taxonomies' => array( 'post_tag'), 
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your video Post Type
	register_post_type( 'video', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'video_post_type', 0 );


/* Create blog Type Taxonomy */
if (!function_exists('create_depart_video_taxonomy')) {
    function create_depart_video_taxonomy()
    {
        $depart_video_labels = array(
            'name' => __( 'depart_video', 'hatazu' ),
            'singular_name' => __( 'depart_video', 'hatazu' ),
            'search_items' =>  __( 'Search depart_videos', 'hatazu' ),
            'popular_items' => __( 'Popular depart_videos', 'hatazu' ),
            'all_items' => __( 'All depart_videos', 'hatazu' ),
            'parent_item' => __( 'Parent depart_video', 'hatazu' ),
            'parent_item_colon' => __( 'Parent depart_video:', 'hatazu' ),
            'edit_item' => __( 'Edit department video', 'hatazu' ),
            'update_item' => __( 'Update department video', 'hatazu' ),
            'add_new_item' => __( 'Add New department video', 'hatazu' ),
            'new_item_name' => __( 'New department video Name', 'hatazu' ),
            'separate_items_with_commas' => __( 'Separate depart_videos with commas', 'hatazu' ),
            'add_or_remove_items' => __( 'Add or remove depart_videos', 'hatazu' ),
            'choose_from_most_used' => __( 'Choose from the most used depart_videos', 'hatazu' ),
            'menu_name' => __( 'depart_videos', 'hatazu' )
        );

        register_taxonomy(
            'depart_video',
            array( 'video' ),
            array(
                'hierarchical' => true,
                'labels' => $depart_video_labels,
                'show_ui' => true,
                'query_var' => true,
                'with_front' => true,
                'rewrite' => array('slug' => __('depart_video', 'hatazu'))
            )
        );
    }
}
 add_action('init', 'create_depart_video_taxonomy', 0);


function taxonomy_slug_video_rewrite($wp_rewrite) {
    $rules = array();
    // get all video taxonomies
    $taxonomies = get_taxonomies(array('_builtin' => false), 'objects');
    // get all video post types
    $post_types = get_post_types(array('public' => true, '_builtin' => false), 'objects');
    
    foreach ($post_types as $post_type) {
        foreach ($taxonomies as $taxonomy) {
	    
            // go through all post types which this taxonomy is assigned to
            foreach ($taxonomy->object_type as $object_type) {
                
                // check if taxonomy is registered for this video type
                if ($object_type == $post_type->rewrite['slug']) {
		    
                    // get category objects
                    $terms = get_categories(array('type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));
		    
                    // make rules
                    foreach ($terms as $term) {
                        $rules[$object_type . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
                    }
                }
            }
        }
    }
    // merge with global rules
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'taxonomy_slug_video_rewrite');
/*
 * Adds a meta box to the post editing screen
 */
function prfx_field_meta_video_meta() {

    add_meta_box( 'prfx_meta', __( 'Field Box Title', 'prfx-textdomain' ), 'prfx_field_meta_video_callback', 'video','normal', 'high');

}

add_action( 'add_meta_boxes', 'prfx_field_meta_video_meta');

/*

 * Outputs the content of the meta box

 */

function prfx_field_meta_video_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
    $prfx_stored_meta = get_post_meta( $post->ID ); ?>
    <p>
        <label for="id-youtube" class="prfx-row-title"><?php _e( 'id youtube', 'prfx-textdomain' )?></label>
        <input type="text" name="id-youtube" id="id-youtube" value="<?php if ( isset ( $prfx_stored_meta['id-youtube'] ) ) echo $prfx_stored_meta['id-youtube'][0]; ?>" />
    </p>

    <?php

}
/*
 * Saves the custom meta input
 */
function prfx_field_meta_video_save( $post_id ) {
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    // Checks for input and sanitizes/saves if needed 
    $post_type = get_post_type($post_id);
    if ( "video" != $post_type ) return;   
    if( isset( $_POST['id-youtube'] ) ) {
        update_post_meta( $post_id, 'id-youtube', $_POST[ 'id-youtube' ] );    
    }  
    //update_post_meta( $post_id, 'meta-test',"sql=".$sql.",");
    //update_post_meta( $post_id, 'meta-test',"sql=".$sql);
}
add_action( 'save_post', 'prfx_field_meta_video_save' );

