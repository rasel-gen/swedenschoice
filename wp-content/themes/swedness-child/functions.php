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


add_action('wp_enqueue_scripts', 'my_custom_theme_enqueue_scripts');
function my_custom_theme_enqueue_scripts()
{
    wp_enqueue_script('astra-widgets-script');
    wp_enqueue_style('astra-widgets-style');
}


add_filter('woocommerce_product_title', 'my_custom_product_title', 10, 1);
function my_custom_product_title($title)
{
    $max_length = 20; // set the maximum number of characters
    if (strlen($title) > $max_length) {
        $title = substr($title, 0, $max_length) . '...';
    }
    return $title;
}


/** custom logo */
require('theme-functions/custom_logo.php');

/** product filter */
require('theme-parts/product-filter.php');

/** last visited product store */
require('theme-parts/last_visited_products.php');

/** add theme supports */
require('theme-parts/theme_support.php');

/** add theme supports */
require('theme-parts/custom_page.php');



function my_price_filitering_widget_area() {
    register_sidebar( array(
        'name'          => __( 'Price Filtering Widet', 'swednes' ),
        'id'            => 'custom-price-filter-widget-area',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'my_price_filitering_widget_area' );



//wish list
add_action( 'woocommerce_after_add_to_cart_button', 'my_add_to_wishlist_button' );
function my_add_to_wishlist_button() {
   echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
}
