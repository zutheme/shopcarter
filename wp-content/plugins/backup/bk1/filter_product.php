<?php
function woo_products_by_attributes_sidebar() {
  global $woocommerce, $woocommerce_loop;
	$attribute = 'color';
	$values     = '';
	$per_page  = '12';
	$columns   = '4';
  	$orderby  = 'title';
  	$order     = 'desc';
	// Default ordering args
	$ordering_args = $woocommerce->query->get_catalog_ordering_args( $orderby, $order );
	
	// Define Query Arguments
	$args = array( 
				'post_type'				=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'orderby' 				=> $ordering_args['orderby'],
				'order' 				=> $ordering_args['order'],
				'posts_per_page' 		=> $per_page,
				'meta_query' 			=> array(
					array(
				        'key' => '_price',
				        'value' => array(50, 100),
				        'compare' => 'BETWEEN',
				        'type' => 'NUMERIC'
				        ),
				),
				'tax_query' => array(
			        'relation' => 'AND',
			        array(
			            'taxonomy'      => 'product_cat',
			            'field' => 'term_id', //This is optional, as it defaults to 'term_id'
			            'terms'         => array(26),
			            'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
			        ),
			        array(
			            'taxonomy'         => 'pa_color',
			            'field'            => 'term_id',
			            'terms'            => array('36'),
			            'include_children' => false,
			            //'field' 		=> 'slug',
						//'operator' 		=> 'IN'
			        ),
			        array(
			            'taxonomy'         => 'pa_size',
			            'field'            => 'term_id',
			            'terms'            => array('25'),
			            'include_children' => false
			        )
			    )
			);
	
	ob_start();
	
	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php endif;

	wp_reset_postdata();

	return '<div class="woocommerce">' . ob_get_clean() . '</div>';
 
}
