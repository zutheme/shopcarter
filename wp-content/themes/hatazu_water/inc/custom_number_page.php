<?php
if ( ! function_exists( 'custom_pagination' ) ) :
function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'list',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);
  if ($paginate_links) {
      //echo "<span class='page-numbers page-num'>Trang " . $paged . " trong " . $numpages . "</span> ";
      echo $paginate_links;
  }

}
endif;

function my_cptui_change_posts_per_page( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
       return;
    }
    //if ( is_post_type_archive( 'product' )||$query->is_tax('taxonomy-department') ) {
    //if ( is_post_type_archive( 'product' )||$query->is_tax('taxonomy-department') ) {
       $query->set( 'posts_per_page', 8 );
    //}
    return $query;
}
add_filter( 'pre_get_posts', 'my_cptui_change_posts_per_page' );