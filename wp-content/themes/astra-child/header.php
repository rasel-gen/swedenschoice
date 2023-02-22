<?php
/**
 * The header for Astra Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>

<head>
    <?php astra_head_top(); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!-- <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" /> -->

    <?php wp_head(); ?>

</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>

    <!-- website header -->
    <div class="web_header">
        <header>
            <div class="website_left">
                <div class="website_logo">
                    <?php
                    if (function_exists('the_custom_logo')) {
                        the_custom_logo();
                    }
                    ?>
                </div>
                <div class="website_search">
                    <form role="search" method="get" class="woocommerce-product-search"
                        action="<?php echo esc_url(home_url('/')); ?>">
                        <label class="screen-reader-text"
                            for="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>"><?php
                                   esc_html_e('Search for:', 'woocommerce'); ?></label>
                        <input type="search"
                            id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>"
                            class="search-field"
                            placeholder="<?php echo esc_attr__('Search products&hellip;', 'woocommerce'); ?>"
                            value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit"
                            value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>"
                            class="<?php echo esc_attr(wc_wp_theme_get_element_class_name('button')); ?>"><?php echo esc_html_x('Search', 'submit button', 'woocommerce'); ?></button>
                        <input type="hidden" name="post_type" value="product" />
                    </form>

                </div>
            </div>
            <div class="website_right">
                <div class="insta_followers">
                    <span><i class="fab fa-instagram" aria-hidden="true"></i> 3.2M Followers</span>
                </div>
                <div class="country">
                    <span>
                        <i class="fas fa-flag" aria-hidden="true"></i> Country
                    </span>
                </div>
                <div class="signin">
                    <span>
                        <svg width="1.7em" height="1.7em" fill="currentColor" viewBox="0 0 24 24"
                            vector-effect="inherit">
                            <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor"
                                vector-effect="inherit"
                                d="M21.476 23.25a10.483 10.483 0 00-18.952 0M12 5.25c0 2.9-2.35 5.25-5.25 5.25a5.25 5.25 0 0010.5 0A5.25 5.25 0 0112 5.25zm5.836 13.777a14.576 14.576 0 003.391-1.007 1.5 1.5 0 00.763-1.961l-1.376-3.21a4.5 4.5 0 01-.364-1.773V9a8.25 8.25 0 10-16.5 0v2.076a4.5 4.5 0 01-.364 1.773l-1.376 3.21a1.5 1.5 0 00.763 1.961c1.085.472 2.224.81 3.391 1.007">
                            </path>
                        </svg>
                    </span>
                </div>
                <div class="last_visited">
                    <span>
                        <svg width="1.7em" height="1.7em" fill="currentColor" viewBox="0 0 24 24">
                            <g id="Lined-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                stroke-linecap="round" stroke-linejoin="round">
                                <g id="Icon/eye" fill-rule="nonzero" stroke="currentColor">
                                    <path
                                        d="M12 23.25c6.213 0 11.25-5.037 11.25-11.25S18.213.75 12 .75.75 5.787.75 12 5.787 23.25 12 23.25zm0-15.478c-2.687-.044-5.467 1.778-7.214 3.643a1.051 1.051 0 000 1.439C6.5 14.68 9.264 16.543 12 16.5c2.736.044 5.5-1.819 7.216-3.645a1.05 1.05 0 000-1.439C17.467 9.55 14.687 7.728 12 7.772zm0 5.863a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                                        id="🎨-Line-Weight"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                </div>
                <div class="favorite">
                    <span>
                        <svg width="1.7em" height="1.7em" fill="inherit" viewBox="0 0 24 21" stroke="inherit">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.008 1C9.034 1 11.04 1.458 12 3.51 13.106 1.458 15.01 1 17.015 1 19.022 1 23 2.39 23 7.437c0 1.992-1.296 4.452-3.242 6.561-2.984 3.236-7.145 5.804-7.758 5.804-.675 0-3.112-1.776-7.312-5.326C2.229 12.039 1 9.693 1 7.436 1 2.41 5.002 1 7.008 1z">
                            </path>
                        </svg>
                    </span>
                </div>
                <div class="cart">
                    <span>
                        <svg width="1.2em" height="1.2em" fill="inherit" viewBox="0 0 22 22">
                            <path
                                d="M17.304 6.5H4.691a1.5 1.5 0 00-1.436 1.413l-2 11.842A1.533 1.533 0 002.692 21.5h16.611a1.533 1.533 0 001.437-1.745l-2-11.842A1.5 1.5 0 0017.304 6.5zm-2.621-2.943A3.763 3.763 0 0010.998.5a3.764 3.764 0 00-3.682 3.038"
                                stroke="inherit" fill="none" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
            </div>

        </header>
        <!-- main menu -->
        <?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'main_menu')); ?>
    </div>