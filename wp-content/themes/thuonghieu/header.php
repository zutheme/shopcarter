<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thienkhue
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> xmlns="https://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Cache-control" content="public">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- Latest compiled and minified CSS -->
  <link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/images/favicon.png">
  <!-- new style -->
 
  
  <?php wp_head(); ?>
</head>

<body <?php //body_class(); ?>>
<header class="ctMenu">
            <nav>
              <?php

                 wp_nav_menu( array(

                      'theme_location'    => 'menu-1',

                      'menu'              => "menu-1",

                      'depth'             => 3,

                      'container'         => '',

                      'container_class'   => '',

                      'container_id'      => '',

                      'menu_id'           => 'nav',

                      'menu_class'        => '',

                      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',

                      'walker'            => new wp_bootstrap_navwalker(),

                  ) );

                ?>  

            </nav>
</header>