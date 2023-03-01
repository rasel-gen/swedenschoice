<?php

/** product filter by cateogry */
add_action('wp_ajax_filter_products_by_category', 'filter_products_by_category');
add_action('wp_ajax_nopriv_filter_products_by_category', 'filter_products_by_category');

//filter by category
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
            while ($query->have_posts()) :
                $query->the_post();
                global $product;
                $product = wc_get_product(get_the_ID());
                $attributes = $product->get_attributes();

                $regular_price = $product->get_regular_price();
                $sale_price = $product->get_sale_price();

                if ($sale_price) {
                    $discount = get_discount_percentage($regular_price, $sale_price);
                    $discount = '<span class="onsale">' . esc_html__($discount, 'woocommerce') . '</span>';
                } else {
                    $discount = 0;
                }
                // Display the product information here
?>
                <div class="products">
                    <div class="product_image">
                        <?php
                        $product_id = get_the_ID();
                        $product_gallery_images = get_post_meta($product_id, '_product_image_gallery', true);
                        $attachment_ids = $product->get_gallery_image_ids();
                        if ($discount) {
                            echo $discount;
                        }
                        ?>
                        <a href="<?php echo get_permalink($product_id); ?>">
                            <!-- Slider main container -->
                            <div class="swiper">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <?php
                                    if ($attachment_ids) {
                                        foreach ($attachment_ids as $attachment_id) {
                                            $image_url = wp_get_attachment_image_src($attachment_id, 'full');
                                            $thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                                    ?>
                                            <div class="swiper-slide">
                                                <a href="<?php echo get_permalink($product_id); ?>">
                                                    <img src="<?php echo $image_url[0]; ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>" alt="">
                                                </a>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <!-- Slides -->
                                </div>
                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </a>
                        <div class="variations">
                            <div class="product_variations">
                                <div class="sizes">
                                    <?php
                                    if ($product->is_type('variable')) {
                                        $variations = $product->get_available_variations();
                                        $sizes = array();
                                        foreach ($variations as $variation) {
                                            $size = $variation['attributes']['attribute_pa_size'];
                                            if (!in_array($size, $sizes)) {
                                                $sizes[] = $size;
                                            }
                                        }
                                        if (!empty($sizes)) {
                                            echo '<select>';
                                            foreach ($sizes as $size) {
                                                echo '<option>' . ucfirst($size) . '</option>';
                                            }
                                            echo '</select>';
                                        }
                                    } else {
                                    ?>
                                        <p>No Choice</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="quick_shop">
                                    <a href="<?php echo get_permalink($product_id); ?>">View Product</a>
                                </div>
                            </div>
                        </div>
                        <div class="liked_button" product-data="<?php echo $product_id; ?>">
                            <i class="fa fa-light fa-heart"></i>
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




// Ajax filter products by attributes
add_action('wp_ajax_custom_search_filter', 'custom_search_filter_ajax');
add_action('wp_ajax_nopriv_custom_search_filter', 'custom_search_filter_ajax');
function custom_search_filter_ajax()
{
    $search_terms = $_POST['terms'];
    $taxonomy = $_POST['taxonomy'];
    $category_id = $_POST['category_id'];
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'name',
                'terms' => $search_terms
            )
        ),
        // 'meta_query' => array(
        //     array(
        //         'key' => 'pa_size',
        //         'value' => 'your-size-value',
        //         'compare' => 'IN',
        //     )),
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) :
            $query->the_post();
            global $product;

            ?>
            <div class="products">

                <div class="product_image">

                    <?php
                    $product_id = get_the_ID();
                    $product_gallery_images = get_post_meta($product_id, '_product_image_gallery', true);
                    $attachment_ids = $product->get_gallery_image_ids();
                    if ($discount) {
                        echo $discount;
                    }
                    ?>
                    <a href="<?php echo get_permalink($product_id); ?>">
                        <!-- Slider main container -->
                        <div class="swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <?php
                                if ($attachment_ids) {
                                    foreach ($attachment_ids as $attachment_id) {
                                        $image_url = wp_get_attachment_image_src($attachment_id, 'full');
                                        $thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                                ?>
                                        <div class="swiper-slide">
                                            <a href="<?php echo get_permalink($product_id); ?>">
                                                <img src="<?php echo $image_url[0]; ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>" alt="">
                                            </a>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <!-- Slides -->
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </a>
                    <div class="variations">
                        <div class="product_variations">
                            <div class="sizes">
                                <?php
                                if ($product->is_type('variable')) {
                                    $variations = $product->get_available_variations();
                                    $sizes = array();
                                    foreach ($variations as $variation) {
                                        $size = $variation['attributes']['attribute_pa_size'];
                                        if (!in_array($size, $sizes)) {
                                            $sizes[] = $size;
                                        }
                                    }
                                    if (!empty($sizes)) {
                                        echo '<select>';
                                        foreach ($sizes as $size) {
                                            echo '<option>' . ucfirst($size) . '</option>';
                                        }
                                        echo '</select>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="quick_shop">
                                <a href="<?php echo get_permalink($product_id); ?>">View
                                    Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="liked_button" product-data="<?php echo $product_id; ?>">
                        <!-- <a href="<?php echo esc_url(add_query_arg('add_to_wishlist', $product_id)); ?>" class="my-custom-button">
                <i class="fa fa-light fa-heart"></i></a> -->
                        <?php
                        echo do_shortcode('[yith_wcwl_add_to_wishlist]');

                        ?>

                    </div>
                </div>
                <div class="product_description">
                    <div class="product_title">
                        <h6>
                            <a href="<?php echo get_permalink($product_id); ?>"><?php echo $product->get_title(); ?></a>
                        </h6>
                        <div class="product_attributes">
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
                        </div>
                        <div class="product_colors">
                            <?php
                            $product = wc_get_product($product_id);

                            // Get the available color attributes for the product
                            $color_attributes = $product->get_attribute('pa_color');
                            // Convert the color attributes string to an array
                            $color_attributes_array = explode(',', $color_attributes);
                            foreach ($color_attributes_array as $color_attribute) {

                            ?>
                                <div class="colors" style="width: 11px; height: 11px; background: <?php echo $color_attribute;  ?>;border-radius: 50%">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
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
    } else {
        default_products();
    }
}





/** product filter by size */
add_action('wp_ajax_filter_by_sorting', 'filter_by_sorting');
add_action('wp_ajax_nopriv_filter_by_sorting', 'filter_by_sorting');
function filter_by_sorting()
{
    if (isset($_POST['sorting_type']) && !empty($_POST['sorting_type'])) {


        if ($_POST['sorting_type'] === 'a-z') {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            );
        } else if ($_POST['sorting_type'] === 'z-a') {

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'DESC',
            );
        } else if ($_POST['sorting_type'] === 'lowest') {

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => 'price',
                'order' => 'DESC',
            );
        } else if ($_POST['sorting_type'] === 'highest') {

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'orderby' => 'price',
                'order' => 'ASC',
            );
        } else {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
            );
        }



        $query = new WP_Query($args);


        if ($query->have_posts()) {
            while ($query->have_posts()) :
                $query->the_post();
                global $product;

            ?>
                <div class="products">
                    <div class="product_image">
                        <?php echo astra_get_post_thumbnail(); ?>
                        <div class="variations">
                            <div class="product_variations">
                                <div class="sizes">
                                    <?php
                                    if ($product->is_type('variable')) {
                                        $variations = $product->get_available_variations();
                                        $sizes = array();
                                        foreach ($variations as $variation) {
                                            $size = $variation['attributes']['attribute_pa_size'];
                                            if (!in_array($size, $sizes)) {
                                                $sizes[] = $size;
                                            }
                                        }
                                        if (!empty($sizes)) {
                                            echo '<select>';
                                            foreach ($sizes as $size) {
                                                echo '<option>' . ucfirst($size) . '</option>';
                                            }
                                            echo '</select>';
                                        }
                                    }

                                    ?>
                                </div>
                                <div class="quick_shop">
                                    <a href="<?php echo get_permalink($product_id); ?>">View Product</a>
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
                                echo $product->get_price_html();
                                ?>
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


//show the default products
function default_products()
{
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);

    while ($query->have_posts()) :


        $query->the_post();
        // Display the product information here
        global $product;

        $product = wc_get_product(get_the_ID());
        $attributes = $product->get_attributes();

        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();

        if ($sale_price) {
            $discount = get_discount_percentage($regular_price, $sale_price);
            $discount = '<span class="onsale">' . esc_html__($discount, 'woocommerce') . '</span>';
        } else {
            $discount = 0;
        }

        ?>
        <div class="products">

            <div class="product_image">

                <?php
                $product_id = get_the_ID();
                $product_gallery_images = get_post_meta($product_id, '_product_image_gallery', true);
                $attachment_ids = $product->get_gallery_image_ids();
                if ($discount) {
                    echo $discount;
                }
                ?>
                <a href="<?php echo get_permalink($product_id); ?>">
                    <!-- Slider main container -->
                    <div class="swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php
                            if ($attachment_ids) {
                                foreach ($attachment_ids as $attachment_id) {
                                    $image_url = wp_get_attachment_image_src($attachment_id, 'full');
                                    $thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
                            ?>
                                    <div class="swiper-slide">
                                        <a href="<?php echo get_permalink($product_id); ?>">
                                            <img src="<?php echo $image_url[0]; ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>" alt="">
                                        </a>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <!-- Slides -->
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </a>
                <div class="variations">
                    <div class="product_variations">
                        <div class="sizes">
                            <?php
                            if ($product->is_type('variable')) {
                                $variations = $product->get_available_variations();
                                $sizes = array();
                                foreach ($variations as $variation) {
                                    $size = $variation['attributes']['attribute_pa_size'];
                                    if (!in_array($size, $sizes)) {
                                        $sizes[] = $size;
                                    }
                                }
                                if (!empty($sizes)) {
                                    echo '<select>';
                                    foreach ($sizes as $size) {
                                        echo '<option>' . ucfirst($size) . '</option>';
                                    }
                                    echo '</select>';
                                }
                            }
                            ?>
                        </div>
                        <div class="quick_shop">
                            <a href="<?php echo get_permalink($product_id); ?>">View
                                Product</a>
                        </div>
                    </div>
                </div>
                <div class="liked_button" product-data="<?php echo $product_id; ?>">
                    <!-- <a href="<?php echo esc_url(add_query_arg('add_to_wishlist', $product_id)); ?>" class="my-custom-button">
                        <i class="fa fa-light fa-heart"></i></a> -->
                    <?php
                    echo do_shortcode('[yith_wcwl_add_to_wishlist]');

                    ?>

                </div>
            </div>
            <div class="product_description">
                <div class="product_title">
                    <h6>
                        <a href="<?php echo get_permalink($product_id); ?>"><?php echo $product->get_title(); ?></a>
                    </h6>
                    <div class="product_attributes">
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
                    </div>
                    <div class="product_colors">
                        <?php
                        $product = wc_get_product($product_id);

                        // Get the available color attributes for the product
                        $color_attributes = $product->get_attribute('pa_color');
                        // Convert the color attributes string to an array
                        $color_attributes_array = explode(',', $color_attributes);
                        foreach ($color_attributes_array as $color_attribute) {

                        ?>
                            <div class="colors" style="width: 11px; height: 11px; background: <?php echo $color_attribute;  ?>;border-radius: 50%">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
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
}
