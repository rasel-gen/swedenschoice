<?php


function display_cart_items()
{
    $cart_items = WC()->cart->get_cart();
    if ($cart_items) {

        echo '<h6>Cart Items</h6>';
        global $product;


        foreach ($cart_items as $cart_item_key => $cart_item) {
            $product = $cart_item['data'];
            $product_name = $product->get_name();
            $product_price = $product->get_price();
            $product_quantity = $cart_item['quantity'];

?>
            <a href="<?php echo wc_get_cart_url(); ?>">
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
                        <?php echo '<p>Quantity: ' . $product_quantity . '</p>'; ?>
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


// end last cart items
