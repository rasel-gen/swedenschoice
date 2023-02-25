<?php

// wocommerce support
add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');

//menu
function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Main Menu'),
            'extra-menu' => __('Extra Menu'),
            'footer-menu-1' => __('Footer Shopping'),
            'footer-menu-2' => __('Footer my page'),
            'footer-menu-3' => __('Footer Social Shopping'),
            'footer-menu-4' => __('Footer Customer Care'),
            'footer-menu-4' => __('Footer About Swednes'),
        ),

    );
}

add_action('init', 'register_my_menus');


// add to cart
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}


/**
 * Automatically add product to cart on visit
 */
add_action('template_redirect', 'add_product_to_cart');
function add_product_to_cart()
{
    if (!is_admin()) {
        $product_id = 64; //replace with your own product id
        $found = false;
        //check if product already in cart
        if (sizeof(WC()->cart->get_cart()) > 0) {
            foreach (WC()->cart->get_cart() as $cart_item_key => $values) {
                $_product = $values['data'];
                if ($_product->get_id() == $product_id)
                    $found = true;
            }
            // if product not found, add it
            if (!$found)
                WC()->cart->add_to_cart($product_id);
        } else {
            // if no products in cart, add it
            WC()->cart->add_to_cart($product_id);
        }
    }
}

/** get product discount */
function get_discount_percentage($price, $sale_price) {
    if ( $price && $sale_price ) {
        $discount = round( ( $price - $sale_price ) / $price * 100 );
        return '-'.$discount.'%';
    }
}

