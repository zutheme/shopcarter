<?php
/**
 *  Template Name: Home sale
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eleaning
 */
get_header();
get_template_part('layouts/slider-show');
get_template_part('layouts/block-feature');
get_template_part('layouts/block-products-carousel');
//get_template_part('layouts/test-attachment');
get_footer(); 