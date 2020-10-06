<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hatazu_water
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> dir="ltr">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory');?>/images/favicon.png">
  <!-- fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/vendor/owl-carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/vendor/photoswipe/photoswipe.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/vendor/photoswipe/default-skin/default-skin.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/vendor/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/style.css?v=0.0.0.6">
  <!-- font - fontawesome -->
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/vendor/fontawesome/css/all.min.css">
  <!-- font - stroyka -->
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/fonts/stroyka/stroyka.css">
 <!--  <meta http-equiv="x-ua-compatible" content="ie=edge"> -->
  <!-- <link rel="stylesheet" href="<?php //bloginfo('template_directory');?>/css/custom-woo.css?v=0.8.0.7"> -->
 
  	<?php wp_head(); ?>
</head>

<body <?php //body_class(); ?>>
  <!-- site -->
<div class="site">
  <?php 
  get_template_part('layouts/menu-mobile-carter');
  get_template_part('layouts/menu-desktop-carter');
  //get_template_part('layouts/all-header');
  ?>
  <!-- site__body -->
<div class="site__body">
