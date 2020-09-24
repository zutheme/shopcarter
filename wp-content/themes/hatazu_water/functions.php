<?php
/**
 * hatazu_water functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hatazu_water
 */

if ( ! function_exists( 'hatazu_water_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hatazu_water_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on hatazu_water, use a find and replace
		 * to change 'hatazu_water' to the name of your theme in all the template files.
		 */
		
		load_theme_textdomain( 'hatazu_water', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hatazu_water' ),
			'footer-1' => esc_html__( 'footer 1', 'hatazu_water' ),
			'footer-2' => esc_html__( 'footer 2', 'hatazu_water' ),
			'footer-3' => esc_html__( 'footer 3', 'hatazu_water' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hatazu_water_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'hatazu_water_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hatazu_water_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hatazu_water_content_width', 640 );
}
add_action( 'after_setup_theme', 'hatazu_water_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hatazu_water_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hatazu_water' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'hatazu_water' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar social product', 'hatazu_water' ),
		'id'            => 'sidebar-social',
		'description'   => esc_html__( 'Add widgets here.', 'hatazu_water' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar archive product', 'hatazu_water' ),
		'id'            => 'sidebar-archive-product',
		'description'   => esc_html__( 'Add widgets here.', 'hatazu_water' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar subscriber', 'hatazu_water' ),
		'id'            => 'subscriber-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hatazu_water' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'hatazu_water_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hatazu_water_scripts() {
	//wp_enqueue_style( 'hatazu_water-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'hatazu_water-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'hatazu_water-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
//add_action( 'wp_enqueue_scripts', 'hatazu_water_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/breadcrumb.php';
require get_template_directory() . '/inc/custom_number_page.php';
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// function add_file_types_to_uploads($file_types){
// $new_filetypes = array();
// $new_filetypes['svg'] = 'image/svg+xml';
// $file_types = array_merge($file_types, $new_filetypes );
// return $file_types;
// }
// add_filter('upload_mimes', 'add_file_types_to_uploads');
/*woocommerce*/
require get_template_directory() . '/inc/action-woocommerce.php';
//require get_template_directory() . '/inc/brand-name.php';
//require get_template_directory() . '/inc/variation-simple-product.php';
//require get_template_directory() . '/inc/variation-product.php';
function load_scripts_custom() {
    global $post;
    //wp_enqueue_script('main-js', get_template_directory_uri() .'/js/main.js', array(), '0.3.5.9', true );
    wp_enqueue_style( 'custom-woo.css', get_template_directory_uri() . '/css/custom-woo.css',array(), '0.8.4.0', false);
 //    wp_enqueue_script('library-custom.js', get_template_directory_uri() . '/js/library-custom.js', array(), '0.0.6.5', true );
     wp_enqueue_script('library-api.js', get_template_directory_uri() . '/js/library-api.js', array(), '0.0.4.2', true );   
    if(is_front_page() || is_home()){
	// Static homepage
    	wp_enqueue_script('custom-htz_home.js', get_template_directory_uri() . '/js/custom-htz_home.js', array(), '0.1.0', true );
    }else{
    	wp_enqueue_script('custom-htz_single.js', get_template_directory_uri() . '/js/custom-htz_single.js', array(), '0.1.0.4', true );
    }
    if(is_page_template(array('page-home.php'))) {
    } 
    if(is_checkout()){
    	wp_enqueue_script('checkout.js', get_template_directory_uri() . '/js/checkout.js', array(), '0.1.6.9', true );
    }
    if(is_product_category()||is_shop()||is_archive()||is_search()){
    	wp_enqueue_script('pagination.js', get_template_directory_uri() . '/js/pagination.js', array(), '0.1.7', true );
    }
    
}
add_action('wp_enqueue_scripts', 'load_scripts_custom');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_navlink_carter.php');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_depart_link.php');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_mobile_link.php');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_sidebar.php');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_blog_sidebar.php');
require_once ( dirname( __FILE__ ) . '/menu-boot/wp_bootstrap_navwalker_footer.php');
//require_once ( dirname( __FILE__ ) . '/init-api.php');
add_filter( 'woocommerce_show_variation_price', '__return_true');

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 9;
  return $cols;
}
function ld_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'ld_custom_excerpt_length', 999 );
add_filter( 'woocommerce_api_check_authentication', function() { return new WP_User( 1 ); } );
/*setup dashboard*/
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
 	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
 
function custom_dashboard_help() {
 
// Content you want to show inside the widget
 
echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}

//  Include ACF   
// 1. customize ACF path
add_filter('acf/settings/path', 'willgroup_acf_settings_path');
function willgroup_acf_settings_path( $path ) {
	$path = get_stylesheet_directory() . '/inc/acf/';
	return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'willgroup_acf_settings_dir');
function willgroup_acf_settings_dir( $dir ) {
	$dir = get_stylesheet_directory_uri() . '/inc/acf/';
	return $dir;
}

// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/inc/acf/acf.php' );

require get_template_directory() . '/inc/customizer.php';  
