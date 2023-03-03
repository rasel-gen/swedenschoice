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

    // wp_enqueue_style('blog-theme-css', get_stylesheet_directory_uri() . '/assets/css/style.css', array('blog-theme-css'), CHILD_THEME_SWEDNES_VERSION, 'all');

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

/** display cart items */
require('theme-parts/cart_items.php');


function my_price_filitering_widget_area()
{
    register_sidebar(array(
        'name'          => __('Price Filtering Widet', 'swednes'),
        'id'            => 'custom-price-filter-widget-area',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'my_price_filitering_widget_area');



//wish list
add_action('woocommerce_after_add_to_cart_button', 'my_add_to_wishlist_button');
function my_add_to_wishlist_button()
{
    echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}




//cart items

function cart_items()
{
    display_cart_items();
}

// Register the AJAX handler function with WordPress.
add_action('wp_ajax_cart_items', 'cart_items');
add_action('wp_ajax_nopriv_cart_items', 'cart_items');

add_action('wp_ajax_get_variation_sizes', 'get_variation_sizes');
add_action('wp_ajax_nopriv_get_variation_sizes', 'get_variation_sizes');
function get_variation_sizes()
{
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $color_value = isset($_POST['color_value']) ? sanitize_title($_POST['color_value']) : '';

    if ($product_id && $color_value) {
        $product = wc_get_product($product_id);
        $variations = $product->get_available_variations();

        $options = '';
        foreach ($variations as $variation) {
            if ($variation['attributes']['attribute_pa_color'] === $color_value) {
                $size_value = $variation['attributes']['attribute_pa_size'];
                $variation_id = $variation['variation_id'];
                $price = $variation['display_price'];
                if ($size_value) {
                    $options .= '<option data-price="' . $price . '" value="' . $variation_id . '">' . esc_html($size_value) . '</option>';
                } else {
                    $options .= '<option  data-price="' . $price . '" value="' . $variation_id . '">No sizes available</option>';
                }
            }
        }

        if (empty($options)) {
            $options = '<option value="">No sizes available</option>';
        }

        echo $options;
    }
    wp_die();
}
