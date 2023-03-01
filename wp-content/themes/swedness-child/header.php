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
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.2/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <?php wp_head(); ?>
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?>>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <!-- website header -->
    <div class="web_header">
        <div class="container">
            <header>
                <div class="website_left">
                    <div class="res_menu">

                        <a href="javascript:void(0)" class="toggle-offcanvas-menu">

                            <span class="screen-reader-text"><?php esc_html_e('Toggle Menu', 'astra'); ?></span>

                            <svg width="20px" height="16px" fill="currentColor" viewBox="0 0 20 16">
                                <g id="Assets" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                    <g id="Icons" transform="translate(-242 -52)" fill-rule="nonzero" stroke="#0C1214">
                                        <g id="Icon/04-Menu/Menu" transform="translate(240 48)">
                                            <path d="M2.5 19.5h19m-19-7.497h19M2.5 4.5h19" id="🎨-Line-Weight" vector-effect="non-scaling-stroke"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="website_logo">
                        <?php
                        if (function_exists('the_custom_logo')) {
                            the_custom_logo();
                        }
                        ?>
                    </div>
                    <div class="website_search">
                        <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                            <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>">
                                <?php
                                esc_html_e('Search for:', 'woocommerce'); ?></label>
                            <i class="fa fa-search"></i>
                            <input type="search" id="woocommerce-product-search-field-<?php echo isset($index) ? absint($index) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__('Search products&hellip;', 'woocommerce'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                            <button hidden type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>" class="<?php echo esc_attr(wc_wp_theme_get_element_class_name('button')); ?>"><?php echo esc_html_x('Search', 'submit button', 'woocommerce'); ?></button>
                            <input type="hidden" name="post_type" value="product" />
                        </form>

                    </div>
                </div>
                <div class="website_right">
                    <div class="insta_followers">
                        <div class="icon">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </div>
                        <span>3.2M Followers</span>

                    </div>
                    <!--                <div class="country">-->
                    <!--                    <div class="icon">-->
                    <!--                        <i class="fas fa-flag" aria-hidden="true"></i>-->
                    <!--                    </div>-->
                    <!--                    <span>-->
                    <!--                        Country-->
                    <!--                    </span>-->
                    <!--                </div>-->
                    <div class="signin">
                        <div class="icon">
                            <span>
                                <svg width="1.7em" height="1.7em" fill="currentColor" viewBox="0 0 24 24" vector-effect="inherit">
                                    <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke="currentColor" vector-effect="inherit" d="M21.476 23.25a10.483 10.483 0 00-18.952 0M12 5.25c0 2.9-2.35 5.25-5.25 5.25a5.25 5.25 0 0010.5 0A5.25 5.25 0 0112 5.25zm5.836 13.777a14.576 14.576 0 003.391-1.007 1.5 1.5 0 00.763-1.961l-1.376-3.21a4.5 4.5 0 01-.364-1.773V9a8.25 8.25 0 10-16.5 0v2.076a4.5 4.5 0 01-.364 1.773l-1.376 3.21a1.5 1.5 0 00.763 1.961c1.085.472 2.224.81 3.391 1.007">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="auth_screen">
                            <?php
                            $my_account_url = wc_get_page_permalink('myaccount');
                            $signup_url = add_query_arg('register', 'true', $my_account_url);
                            $signin_url = add_query_arg('register', 'false', $my_account_url);

                            ?>
                            <a href="<?php echo esc_url($signin_url); ?>">Signin</a>
                            <a href="<?php echo esc_url($signup_url); ?>">Signup</a>
                        </div>
                    </div>
                    <div class="last_visited">
                        <div class="icon">
                            <span>
                                <svg width="1.7em" height="30px" fill="currentColor" viewBox="0 0 24 23">
                                    <g id="Lined-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Icon/eye" fill-rule="nonzero" stroke="currentColor">
                                            <path d="M12 23.25c6.213 0 11.25-5.037 11.25-11.25S18.213.75 12 .75.75 5.787.75 12 5.787 23.25 12 23.25zm0-15.478c-2.687-.044-5.467 1.778-7.214 3.643a1.051 1.051 0 000 1.439C6.5 14.68 9.264 16.543 12 16.5c2.736.044 5.5-1.819 7.216-3.645a1.05 1.05 0 000-1.439C17.467 9.55 14.687 7.728 12 7.772zm0 5.863a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" id="🎨-Line-Weight"></path>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="visited_item">
                            <div class="display_last_visited_products">
                                <?php
                                display_last_visited_products();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="favorite">
                        <div class="icon">
                            <a href="<?php echo home_url('/wishlist'); ?>"><i class="fa fa-light fa-heart"></i></a>
                        </div>
                    </div>
                    <div class="shopping_cart">
                        <div class="icon" id="my-cart-button">
                            <a href="<?php echo wc_get_cart_url(); ?>">
                                <i class="fa fa-light fa-bag-shopping"></i>
                                <?php echo sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count()), WC()->cart->get_cart_contents_count()); ?>
                            </a>
                        </div>
                        <div class="visited_item">
                            <div class="display_last_visited_products">
                                <?php
                                    display_cart_items();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </header>
            <!-- main menu -->
            <?php wp_nav_menu(array('theme_location' => 'header-menu', 'container_class' => 'main_menu')); ?>


        </div>
    </div>

    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu">
        <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>
    </div>