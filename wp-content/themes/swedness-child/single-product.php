<?php
get_header();
?>
<div class="container">
    <div class="single-product">
        <div class="breadcumb">
            <div class="woocommerce-breadcrumb">
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div>
    </div>
</div>
<div class="product_showcase">
    <div class="product_slider">
        <?php
        while (have_posts()) : the_post();
            global $product;
        ?>
            <?php
            $product_id = get_the_ID();
            $product_gallery_images = get_post_meta($product_id, '_product_image_gallery', true);

            ?>
            <div class="owl-carousel">
                <?php
                if ($product_gallery_images) {
                    $gallery_image_ids = explode(',', $product_gallery_images);
                    foreach ($gallery_image_ids as $image_id) {
                        echo wp_get_attachment_image($image_id, 'large');
                    }
                }
                ?>
            </div>

        <?php
        endwhile;
        ?>
    </div>
    <div class="product_information">
        <?php
        while (have_posts()) :
            the_post();
            global $product;

        ?>

            <h4><?php echo $product->get_name(); ?></h4>
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
            <!--            <small>--><?php //echo $product->get_product_attributes();
                                        ?><!--</small>-->
            <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>"> <?php echo $product->get_price_html(); ?></p>
            <?php
            $color_attributes = $product->get_attribute('pa_color');
            if ($color_attributes) :
            ?>
                <h6>Available colors</h6>
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
            <?php endif; ?>
            <?php
            // Get all product attributes
            $attributes = get_terms(
                array(
                    'taxonomy' => 'pa_size',
                    'hide_empty' => false,
                    'order_by' => 'ASC',
                    'add_to_cart' => true,
                )
            );
            ?>
            <div class="size_scale">
                <div class="customer_choice_size">
                    <?php
                    if ($product->is_type('variable')) { ?>
                        <select name="variation_id" id="variation_id">
                            <?php
                            foreach ($product->get_available_variations() as $variation) : ?>
                                <?php foreach ($variation['attributes'] as $attribute_name => $attribute_value) : ?>
                                    <option value="<?php echo esc_attr($variation['variation_id']); ?>"><?php echo esc_html(ucfirst($attribute_value)); ?></option>
                                <?php endforeach; ?>
                            <?php endforeach;

                            ?>
                        </select>

                    <?php
                    } else {
                    ?>
                        <p>No choice</p>
                    <?php
                    }
                    ?>
                </div>
                <div class="size_guide">
                    <svg width="1em" height="1em" fill="#FFFFFF" viewBox="0 0 24 24">
                        <path d="M17.292 1.207L1.206 17.293a1 1 0 000 1.415l4.087 4.086a1 1 0 001.414 0L22.793 6.708a1 1 0 000-1.415l-4.087-4.086a1 1 0 00-1.414 0zM4.015 14.486l2.5 2.5m-.5-4.5L8.03 14.47m.227-4.227l2.5 2.5m-.492-4.507l1.75 1.75M12.5 6L15 8.5M14.5 4l2.015 1.986" stroke="#0C1214" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>

            <div class="product_cart_button">
                <div class="customer_choice_size">
                    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
                </div>
                <div class="size_guide">
                    <i class="fa fa-heart"></i>
                </div>

            </div>
            <br>

            <?php
            // Query custom post type data
            $args = array(
                'post_type' => 'delivery_charge',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    // Display post content here

            ?>
                    <div class="delivery_charge">
                        <h5> <?php echo the_title(); ?></h5>
                        <?php echo the_content(); ?>
                    </div>
            <?php
                }
            }
            wp_reset_postdata();


            ?>
    </div>
    <div class="container">
        <div class="product_info">
            <div class="product_tab">
                <div class="tabs">
                    <button class="tab-button active" data-tab="product_description">Product Description</button>
                    <button class="tab-button" data-tab="product_material">Material</button>
                    <button class="tab-button" data-tab="product_delivery_return">Delivery & Returns</button>
                </div>
            </div>

            <div class="product_tab_content">
                <div class="tab-content active" id="product_description">
                    <?php the_content(); ?>
                </div>
                <div class="tab-content active" id="product_material">
                    <?php echo get_post_meta(get_the_ID(), 'delivery', true); ?>
                </div>
                <div class="tab-content" id="product_delivery_return">
                    <div class="pdr">
                        <div class="delivery">
                            <h6>Delivery</h6>
                            <?php echo get_post_meta(get_the_ID(), 'returns', true); ?>
                        </div>
                        <div class="returns">
                            <h6>Return</h6>
                            <?php echo get_post_meta(get_the_ID(), 'returns', true); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="related_products">
            <?php
            // Get the related products for the current product
            $related_products = wc_get_related_products(get_the_ID(), 4);

            // Display the related products as a grid
            if ($related_products) {
                echo '<div class="related-products">';
                echo '<h2>' . __('Related Products', 'woocommerce') . '</h2>';
                echo '<ul class="products">';
                foreach ($related_products as $related_product) {
                    $related_product_object = wc_get_product($related_product);
                    echo '<li>';
                    echo '<a href="' . esc_url(get_permalink($related_product)) . '">';
                    echo '<img src="' . esc_url($related_product_object->get_image()) . '">';
                    echo '<h3>' . esc_html($related_product_object->get_name()) . '</h3>';
                    echo '<span class="price">' . $related_product_object->get_price_html() . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
            ?>

        </div>
    </div>

<?php
        endwhile;
?>
</div>

<?php
get_footer();
?>