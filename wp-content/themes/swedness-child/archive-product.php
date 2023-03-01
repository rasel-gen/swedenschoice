<?php
/*
Template Name: Products Page
*/

get_header();

?>
<div class="wrapper">
    <div class="container">
        <div class="product_page">
            <div class="container">
                <div class="product_page_element">
                    <div class="col-lg-3">
                        <h4>Browse Products</h4>
                        <div class="product_categories">
                            <?php
                            $terms = get_terms(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'hide_empty' => true,
                                    'pad_counts' => true,

                                )
                            );
                            foreach ($terms as $term) :
                                // You can access the term's properties, such as its name, slug, and ID, like this:
                                $term_name = $term->name;
                                $term_slug = $term->slug;
                                $term_id = $term->term_id;
                                $term_count = $term->count;
                                // Do something with the term, such as displaying its name and link:
                            ?>
                                <ul>
                                    <li>
                                        <a href="<?php echo get_term_link($term); ?>"><?php echo $term_name; ?><span class="price_count">
                                                <?php echo $term_count; ?>
                                            </span> </a>

                                    </li>
                                </ul>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-9">


                        <!-- filters start -->
                        <?php require_once('theme-parts/filters.php'); ?>
                        <!-- filters end -->
                        <?php


                        $category = get_queried_object();
                        $category_slug = $category->slug ?: null;


                        if ($category_slug) {
                            // Query the products by category
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => -1,
                                'product_cat' => $category_slug,
                            );
                        } else if (isset($_GET['min_price']) && isset($_GET['max_price']) && is_numeric($_GET['min_price']) && is_numeric($_GET['max_price'])) {

                            $min_price = intval($_GET['min_price']);
                            $max_price = intval($_GET['max_price']);

                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key' => '_price',
                                        'value' => array($min_price, $max_price),
                                        'compare' => 'BETWEEN',
                                        'type' => 'NUMERIC'
                                    )
                                )
                            );
                        } else if (isset($_GET['max_price'])) {
                            $max_price = intval($_GET['max_price']);
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 10,
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key' => '_price',
                                        'value' => $max_price,
                                        'type' => 'numeric',
                                        'compare' => '<=',
                                    ),
                                )
                            );
                        } else {
                            $args = array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                            );
                        }

                        ?>

                        <div class="product_lists">
                            <?php
                            $query = new WP_Query($args);
                            if ($query->have_posts()) {
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
                                wp_reset_postdata();
                            } else {
                                ?>
                                <h4>No Product Found</h4>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- custom script -->
<?php require_once('theme-functions/custom_scripts.php'); ?>
<?php
get_footer();
