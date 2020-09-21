<?php
/* Create blog Type Taxonomy */
if (!function_exists('create_product_brand_taxonomy')) {
    function create_product_brand_taxonomy()
    {
        $product_brand_labels = array(
            'name' => __( 'product_brand', 'hatazu' ),
            'singular_name' => __( 'product_brand', 'hatazu' ),
            'search_items' =>  __( 'Search product_brands', 'hatazu' ),
            'popular_items' => __( 'Popular product_brands', 'hatazu' ),
            'all_items' => __( 'All product_brands', 'hatazu' ),
            'parent_item' => __( 'Parent product_brand', 'hatazu' ),
            'parent_item_colon' => __( 'Parent product_brand:', 'hatazu' ),
            'edit_item' => __( 'Edit product_brand', 'hatazu' ),
            'update_item' => __( 'Update product_brand', 'hatazu' ),
            'add_new_item' => __( 'Add New product_brand', 'hatazu' ),
            'new_item_name' => __( 'New product_brand Name', 'hatazu' ),
            'separate_items_with_commas' => __( 'Separate product_brands with commas', 'hatazu' ),
            'add_or_remove_items' => __( 'Add or remove product_brands', 'hatazu' ),
            'choose_from_most_used' => __( 'Choose from the most used product_brands', 'hatazu' ),
            'menu_name' => __( 'Brand', 'hatazu' )
        );

        register_taxonomy(
            'product_brand',
            array( 'product' ),
            array(
                'hierarchical' => true,
                'labels' => $product_brand_labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('product_brand', 'hatazu'))
            )
        );
    }
}

add_action('init', 'create_product_brand_taxonomy', 0);
?>