<?php

/** product filter by cateogry */
add_action('wp_ajax_filter_products_by_category', 'filter_products_by_category');
add_action('wp_ajax_nopriv_filter_products_by_category', 'filter_products_by_category');
function filter_products_by_category()
{
    if (isset($_POST['category']) && !empty($_POST['category'])) {

        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $_POST['category'],
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()):
                $query->the_post();
                global $product;
                // Display the product information here
                ?>
                <div class="products">
                    <div class="product_image">
                        <?php echo astra_get_post_thumbnail(); ?>
                        <div class="variations">
                            <div class="product_variations">
                                <div class="sizes">
                                    <select name="" id="">
                                        <option value="">Select Size</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Pink">Pink</option>
                                    </select>
                                </div>
                                <div class="quick_shop">
                                    <a href="<?php echo get_permalink($product_id); ?>">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_description">
                        <div class="product_title">
                            <h6>
                                <?php echo the_title(); ?>
                            </h6>
                        </div>
                        <div class="product_price">
                            <h5>
                                <?php
                                echo $product->get_price_html(); ?>
                            </h5>
                        </div>
                    </div>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        }
        die();
    }

}

/** product filter by material */
add_action('wp_ajax_filter_products_by_attributes', 'filter_products_by_attributes');
add_action('wp_ajax_nopriv_filter_products_by_attributes', 'filter_products_by_attributes');
function filter_products_by_attributes()
{
    if (isset($_POST['attribute']) && !empty($_POST['attribute'])) {


        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'pa_material',
                    // replace with the name of the attribute you want to query
                    'field' => 'slug',
                    // you can use 'term_id', 'name', or 'slug'
                    'terms' => $_POST['attribute'] // replace with the attribute value you want to query
                )
            )
        );


        $query = new WP_Query($args);



        if ($query->have_posts()) {
            while ($query->have_posts()):
                $query->the_post();
                global $product;
                ?>
                <div class="products">
                    <div class="product_image">
                        <?php echo astra_get_post_thumbnail(); ?>
                        <div class="variations">
                            <div class="product_variations">
                                <div class="sizes">
                                    <select name="" id="">
                                        <option value="">Select Size</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Pink">Pink</option>
                                    </select>
                                </div>
                                <div class="quick_shop">
                                    <a href="<?php echo get_permalink($product_id); ?>">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_description">
                        <div class="product_title">
                            <h6>
                                <?php echo the_title(); ?>
                            </h6>
                        </div>
                        <div class="product_price">
                            <h5>
                                <?php
                                echo $product->get_price_html(); ?>
                            </h5>
                        </div>
                    </div>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        }
        die();
    }

}


/** product filter by material */
add_action('wp_ajax_filter_products_by_color', 'filter_products_by_color');
add_action('wp_ajax_nopriv_filter_products_by_color', 'filter_products_by_color');
function filter_products_by_color()
{
    if (isset($_POST['color']) && !empty($_POST['color'])) {


        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'pa_color',
                    // replace with the name of the attribute you want to query
                    'field' => 'slug',
                    // you can use 'term_id', 'name', or 'slug'
                    'terms' => $_POST['color'] // replace with the attribute value you want to query
                )
            )
        );


        $query = new WP_Query($args);



        if ($query->have_posts()) {
            while ($query->have_posts()):
                $query->the_post();
                global $product;
                ?>
                <div class="products">
                    <div class="product_image">
                        <?php echo astra_get_post_thumbnail(); ?>
                        <div class="variations">
                            <div class="product_variations">
                                <div class="sizes">
                                    <select name="" id="">
                                        <option value="">Select Size</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Pink">Pink</option>
                                    </select>
                                </div>
                                <div class="quick_shop">
                                    <a href="<?php echo get_permalink($product_id); ?>">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product_description">
                        <div class="product_title">
                            <h6>
                                <?php echo the_title(); ?>
                            </h6>
                        </div>
                        <div class="product_price">
                            <h5>
                                <?php
                                echo $product->get_price_html(); ?>
                            </h5>
                        </div>
                    </div>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
        }
        die();
    }

}


// product price
add_action( 'woocommerce_before_shop_loop', 'custom_price_filter', 30 );
function custom_price_filter() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        woocommerce_price_filter();
    }
}
