<?php
/**
 * Swednes Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
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
	wp_enqueue_style('swednes-css', get_stylesheet_directory_uri() . '/assets/css/swedness.css', array('swedness-theme'), CHILD_THEME_SWEDNES_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);



// custom logo
require('theme-functions/custom_logo.php');
require('woocommerce/product-filter.php');

// wocommerce support
add_theme_support( 'woocommerce' );


function register_my_menus() {
	register_nav_menus(
	  array(
		'header-menu' => __( 'Main Menu' ),
		'extra-menu' => __( 'Extra Menu' )
	  )
	);
  }
  add_action( 'init', 'register_my_menus' );