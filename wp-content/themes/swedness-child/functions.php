<?php
/**
 * Swednes Theme functions and definitions
 * @package Swednes
 * @since 1.0
 */

/**
 * Define Constants
 */
define('CHILD_THEME_SWEDNES_VERSION', '1.0');

/**
 * Enqueue styles
 */
function child_enqueue_styles()
{
    wp_enqueue_style('swednes-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SWEDNES_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 1);


add_action( 'wp_enqueue_scripts', 'my_custom_theme_enqueue_scripts' );
function my_custom_theme_enqueue_scripts() {
    wp_enqueue_script( 'astra-widgets-script' );
    wp_enqueue_style( 'astra-widgets-style' );
}



/** custom logo */
require('theme-functions/custom_logo.php');

/** product filte */
require('theme-parts/product-filter.php');

/** last visited product store */
require('theme-parts/last_visited_products.php');

/** add theme supports */
require('theme-parts/theme_support.php');


/**
 * Astra off canvas
 */
