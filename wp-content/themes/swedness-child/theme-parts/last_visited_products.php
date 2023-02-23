<?php
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
