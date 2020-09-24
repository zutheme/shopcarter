<?php
/**
 *  Template Name: Home
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
get_template_part('layouts/block-slide');
get_template_part('layouts/block-feature-carter');
get_template_part('layouts/block-banner');
get_template_part('layouts/block-haloween');
get_template_part('layouts/block-match');
//get_template_part('layouts/block-slide-middle');
get_template_part('layouts/block-feature-middle');
get_template_part('layouts/block-skip-hop');
get_template_part('layouts/block-response');
get_template_part('layouts/block-products-carousel-top');
get_template_part('layouts/block-products-carousel-bottom');
get_footer(); 