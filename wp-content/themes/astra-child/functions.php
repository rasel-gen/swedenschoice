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

    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js.js', array('owl'), CHILD_THEME_SWEDNES_VERSION, 'all');

}

add_action('wp_enqueue_scripts', 'child_enqueue_styles', 15);


// custom logo
require('theme-functions/custom_logo.php');
require('woocommerce/product-filter.php');

// wocommerce support
add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');

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


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_single_product_summary', 'WC_Structured_Data::generate_product_data()', 60);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


//store the product last visited item
function set_last_visited_products()
{
    if (is_product()) {
        global $post;
        $last_visited_products = array();
        if (isset($_COOKIE['last_visited_products'])) {
            $last_visited_products = unserialize($_COOKIE['last_visited_products']);
        }
        if (!in_array($post->ID, $last_visited_products)) {
            array_unshift($last_visited_products, $post->ID);
            setcookie('last_visited_products', serialize($last_visited_products), time() + (86400 * 30), '/');
        }
    }
}

add_action('template_redirect', 'set_last_visited_products');

function display_last_visited_products()
{
    if (isset($_COOKIE['last_visited_products'])) {

        $last_visited_products = unserialize($_COOKIE['last_visited_products']);
        echo '<h6>Lastest Visited</h6>';
        global $product;
        $last_visited_products = array_slice($last_visited_products, 0, 3, true);
        foreach ($last_visited_products as $product_id) {
            $product = wc_get_product($product_id);

            ?>
            <a href="<?php echo get_permalink($product_id); ?>">
                <div class="lvp">
                    <div class="lvp_image">
                        <?php echo $product->get_image(); ?>
                    </div>
                    <div class="lvp_items">
                        <?php
                        $categories = get_the_terms($product->get_id(), 'product_cat');
                        if ($categories && !is_wp_error($categories)) {
                            echo '<div class="product-categories">';
                            foreach ($categories as $category) {
                                echo '<a href="' . get_term_link($category->slug, 'product_cat') . '">' . $category->name . '</a>';
                                if ($category !== end($categories)) {
                                    echo ', ';
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                        <?php echo '<h3>' . $product->get_title() . '</h3>'; ?>
                        <?php echo '<p>Price: ' . $product->get_price_html() . '</p>'; ?>
                    </div>
                    <div class="lvp_favorite">
                        <i class="fa fa-heart"></i>
                    </div>
                </div>
            </a>


            <?php
        }
    }
}

//store the product last visited item
function set_last_visited_products_all()
{
    if (is_product()) {
        global $post;
        $last_visited_products = array();
        if (isset($_COOKIE['last_visited_products'])) {
            $last_visited_products = unserialize($_COOKIE['last_visited_products']);
        }
        if (!in_array($post->ID, $last_visited_products)) {
            array_unshift($last_visited_products, $post->ID);
            setcookie('last_visited_products', serialize($last_visited_products), time() + (86400 * 30), '/');
        }
    }
}

add_action('template_redirect', 'set_last_visited_products_all');

function display_last_visited_products_all()
{
    if (isset($_COOKIE['last_visited_products'])) {
        global $product;

        $last_visited_products = unserialize($_COOKIE['last_visited_products']);

        foreach ($last_visited_products as $product_id) {
            $product = wc_get_product($product_id);

            ?>
            <a href="<?php echo get_permalink($product_id); ?>">
                <div class="lvp">
                    <div class="lvp_image">
                        <?php echo $product->get_image(); ?>
                    </div>
                    <div class="lvp_items">
                        <?php
                        $categories = get_the_terms($product->get_id(), 'product_cat');
                        if ($categories && !is_wp_error($categories)) {
                            echo '<div class="product-categories">';
                            foreach ($categories as $category) {
                                echo '<a href="' . get_term_link($category->slug, 'product_cat') . '">' . $category->name . '</a>';
                                if ($category !== end($categories)) {
                                    echo ', ';
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                        <?php echo '<h3>' . $product->get_title() . '</h3>'; ?>
                        <?php echo '<p>Price: ' . $product->get_price_html() . '</p>'; ?>
                    </div>
                    <div class="lvp_favorite">
                        <i class="fa fa-heart"></i>
                    </div>
                </div>
            </a>


            <?php
        }
    }
}



// end last visited items

//    register custom post for delivery charge
// Register custom post type
add_action( 'init', 'register_delivery_charge_custom_post_type' );
function register_delivery_charge_custom_post_type() {
    $labels = array(
        'name'               => _x( 'Delivery Charges', 'textdomain' ),
        'singular_name'      => _x( 'Delivery Charge', 'textdomain' ),
        'menu_name'          => _x( 'Delivery Charge', 'textdomain' ),
        'name_admin_bar'     => _x( 'Delivery Charge', 'textdomain' ),
        'add_new'            => _x( 'Add New', 'textdomain' ),
        'add_new_item'       => __( 'Add New Delivery Charge', 'textdomain' ),
        'new_item'           => __( 'New Delivery Charge', 'textdomain' ),
        'edit_item'          => __( 'Edit Delivery Charge', 'textdomain' ),
        'view_item'          => __( 'View Delivery Charge', 'textdomain' ),
        'all_items'          => __( 'All Delivery Charges', 'textdomain' ),
        'search_items'       => __( 'Search Delivery Charges', 'textdomain' ),
        'parent_item_colon'  => __( 'Parent Delivery Charges:', 'textdomain' ),
        'not_found'          => __( 'No delivery charges found.', 'textdomain' ),
        'not_found_in_trash' => __( 'No delivery charges found in Trash.', 'textdomain' )
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'delivery-charges' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );
    register_post_type( 'delivery_charge', $args );
}



