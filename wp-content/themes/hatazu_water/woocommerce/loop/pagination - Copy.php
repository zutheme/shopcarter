<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>

<div class="products-view__pagination">
	<?php
	// echo paginate_links(
	// 	apply_filters(
	// 		'woocommerce_pagination_args',
	// 		array( // WPCS: XSS ok.
	// 			'base'      => $base,
	// 			'format'    => $format,
	// 			'add_args'  => false,
	// 			'current'   => max( 1, $current ),
	// 			'total'     => $total,
	// 			'prev_text' => '<svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px"><use xlink:href="'.get_template_directory_uri() .'/images/sprite.svg#arrow-rounded-left-8x13"></use></svg>',
	// 			'next_text' => '<svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px"><use xlink:href="'.get_template_directory_uri() .'/images/sprite.svg#arrow-rounded-right-8x13"></use></svg>',
	// 			'type'      => 'list',
	// 			'end_size'  => 3,
	// 			'mid_size'  => 3,
	// 		)
	// 	)
	// );
		$links = paginate_links( 
			array(
				  'prev_next'          => false,
				  'type'               => 'array',
				  'base'      => $base,
				  'format'    => $format,
				'add_args'  => false,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'end_size'  => 3,
				'mid_size'  => 3,
				'before_page_number' => '',
				'after_page_number' => '',
			)
		);

		if ( $links ) :

		    echo '<ul class="pagination justify-content-center">';

		    // get_previous_posts_link will return a string or void if no link is set.
		    if ( $prev_posts_link = get_previous_posts_link( __( '<svg class="page-link__arrow page-link__arrow--left" aria-hidden="true" width="8px" height="13px"><use xlink:href="'.get_template_directory_uri() .'/images/sprite.svg#arrow-rounded-left-8x13"></use></svg>' ) ) ) :
		        echo '<li class="page-item prev-list-item">';
		        echo $prev_posts_link;
		        echo '</li>';
		    endif;

		    echo '<li class="page-item">';
		    echo join( '</li><li class="page-item">', $links );
		    echo '</li>';

		    // get_next_posts_link will return a string or void if no link is set.
		    if ( $next_posts_link = get_next_posts_link( __('<svg class="page-link__arrow page-link__arrow--right" aria-hidden="true" width="8px" height="13px"><use xlink:href="'.get_template_directory_uri() .'/images/sprite.svg#arrow-rounded-right-8x13"></use></svg>') ) ) :
		        echo '<li class="page-item next-list-item">';
		        echo $next_posts_link;
		        echo '</li>';
		    endif;
		    echo '</ul>';
		endif;
	?>
</div>
