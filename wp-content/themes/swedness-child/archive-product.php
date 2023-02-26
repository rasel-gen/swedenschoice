<?php
/*
Template Name: Products Page
*/

get_header();

?>
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
                                    'hide_empty' => false,
                                    'pad_counts' => true,

                                )
                            );
                            foreach ($terms as $term):
                                // You can access the term's properties, such as its name, slug, and ID, like this:
                                $term_name = $term->name;
                                $term_slug = $term->slug;
                                $term_id = $term->term_id;
                                $term_count = $term->count;
                                // Do something with the term, such as displaying its name and link:
                                ?>
                                <ul>
                                    <li>
                                        <a data-taxonomy="<?php echo $term_name; ?>" class="product_filter"
                                           href="#"><?php echo $term_name; ?><span class="price_count">
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

                        <div class="filter">
                            <div class="price_filter">
                                <div class="filter_header">
                                    <a href="#">Price</a>
                                    <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
                                </div>
                                <div class="price_filter_dropdown">
                                    <?php if (is_active_sidebar('custom-price-filter-widget-area')) : ?>
                                        <div class="custom-price-filter-widget-area">
                                            <?php dynamic_sidebar('custom-price-filter-widget-area'); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="size_filter">
                                <div class="filter_header">
                                    <a href="#">Size</a>
                                    <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
                                </div>

                                <div class="size_filter_dropdown">
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

                                    // Loop through the attributes
                                    foreach ($attributes as $attribute) {
                                        $attribute_name = $attribute->name;
                                        $attribute_id = $attribute->term_id;

                                        ?>
                                        <a data-taxonomy="<?php echo $attribute_name; ?>" class="size_filter_attribute"
                                           href="javascript:void(0)"><?php echo $attribute_name; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="color_filter">
                                <div class="filter_header">
                                    <a href="#">Color</a>
                                    <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
                                </div>
                                <div class="color_filter_dropdown">
                                    <?php
                                    // Get all product attributes
                                    $attributes = get_terms(
                                        array(
                                            'taxonomy' => 'pa_color',
                                            'hide_empty' => false,
                                            'order' => 'ASC',
                                            'add_to_cart' => true,
                                        )
                                    );

                                    // Loop through the attributes
                                    foreach ($attributes as $attribute) {
                                        $attribute_name = $attribute->name;
                                        $attribute_id = $attribute->term_id;

                                        ?>
                                        <a data-taxonomy="<?php echo $attribute_name; ?>" class="color_filter_attribute"
                                           href="javascript:void(0)"><?php echo $attribute_name; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="brand_filter">
                                <div class="filter_header">
                                    <a href="javascript:void(0)">Brand</a>
                                    <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
                                </div>
                                <div class="brand_filter_dropdown">
                                    <div class="d-flex">
                                        <div class="brand_filter_left_side">
                                            <h5>Popular brands</h5>
                                            <div class="brand_filter_dropdown_items">
                                                <?php
                                                // Replace "parent_category_id" with the ID of the parent category you want to get subcategories for
                                                $parent_category_id = 85;

                                                // Get the subcategories of the parent category
                                                $subcategories = get_terms(
                                                    array(
                                                        'taxonomy' => 'product_cat',
                                                        'hide_empty' => false,
                                                        'parent' => $parent_category_id,
                                                        'add_to_cart' => true,
                                                    )
                                                );

                                                // Loop through the subcategories
                                                foreach ($subcategories as $subcategory) {
                                                    $subcategory_name = $subcategory->name;
                                                    $subcategory_id = $subcategory->term_id;
                                                    $taxonomy_name = $subcategory->slug;
                                                    $subcategory_image_id = get_term_meta($subcategory_id, 'thumbnail_id', true);
                                                    $subcategory_image_url = wp_get_attachment_image_url($subcategory_image_id, 'full');
                                                    ?>
                                                    <div class="items">
                                                        <img src="<?php echo $subcategory_image_url; ?>" alt="">
                                                        <a href="<?php echo esc_url(add_query_arg('category', $subcategory->name)); ?>"
                                                           data-taxonomy="<?php echo $taxonomy_name; ?>"
                                                           class="category_filter"><?php
                                                            echo $subcategory->name; ?></a>
                                                    </div>

                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="brand_filter_right_side">
                                            <div class="search_input">
                                                <input type="text" placeholder="Search" class="form-control"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="material_filter">
                                <div class="filter_header">
                                    <a href="#">Material</a>
                                    <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
                                </div>
                                <div class="material_filter_dropdown">
                                    <?php
                                    // Get all product attributes
                                    $attributes = get_terms(
                                        array(
                                            'taxonomy' => 'pa_material',
                                            'hide_empty' => false,
                                            'order_by' => 'ASC'
                                        )
                                    );

                                    // Loop through the attributes
                                    foreach ($attributes as $attribute) {
                                        $attribute_name = $attribute->name;
                                        $attribute_id = $attribute->term_id;

                                        ?>
                                        <a data-taxonomy="<?php echo $attribute_name; ?>" class="attribute_filter"
                                           href="#"><?php echo $attribute_name; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
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
                                while ($query->have_posts()):


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
                                                                        <img src="<?php echo $image_url[0]; ?>"
                                                                             width="<?php echo $image_url[1]; ?>"
                                                                             height="<?php echo $image_url[2]; ?>"
                                                                             alt="">
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
                                            <!-- <a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) ); ?>" class="my-custom-button">
                                                <i class="fa fa-light fa-heart"></i></a> -->
                                                <?php 
                                                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );

                                                ?>

                                            </div>
                                        </div>
                                        <div class="product_description">
                                            <div class="product_title">
                                                <h6>
                                                    <a href="<?php echo get_permalink($product_id); ?>"><?php
                                                        echo $product->get_title();
                                                        ?></a>
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

    <script>
        jQuery(document).ready(function ($) {
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

            // category filter
            $('.category_filter').click(function (event) {
                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    event.returnValue = false;
                }

                var selecetd_taxonomy = $(this).attr('data-taxonomy');
                var data = {
                    action: 'filter_products_by_category',
                    category: selecetd_taxonomy,
                };

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    beforeSend: function () {
                        $('.product_lists').html('<p>Loading...</p>');
                    },
                    success: function (response) {
                        $('.product_lists').html(response);
                        $(".brand_filter_dropdown").fadeOut();
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

            });

            // attribute filter
            $('.attribute_filter').click(function (event) {
                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    event.returnValue = false;
                }

                var selecetd_taxonomy = $(this).attr('data-taxonomy');

                var data = {
                    action: 'filter_products_by_attributes',
                    attribute: selecetd_taxonomy,
                };

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    beforeSend: function () {
                        $('.product_lists').html('<p>Loading...</p>');
                    },
                    success: function (response) {
                        $('.product_lists').html(response);
                        $(".material_filter_dropdown").fadeOut();
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

            });

            $(".color_filter").click(function () {
                $(".color_filter_dropdown").fadeIn();
            });
            $(".size_filter").click(function () {
                $(".size_filter_dropdown").fadeIn();
            });
            $(".material_filter").click(function () {
                $(".material_filter_dropdown").fadeIn();
            });
            $(".brand_filter").click(function () {
                $(".brand_filter_dropdown").fadeIn();
            });
            // color filter
            $('.color_filter_attribute').click(function (event) {
                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    event.returnValue = false;
                }

                var selecetd_taxonomy = $(this).attr('data-taxonomy');

                var data = {
                    action: 'filter_products_by_color',
                    color: selecetd_taxonomy,
                };

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    beforeSend: function () {
                        $('.product_lists').html('<p>Loading...</p>');
                    },
                    success: function (response) {
                        $('.product_lists').html(response);
                        $(".color_filter_dropdown").fadeOut();
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

            });

            // category filter
            $('.product_filter').click(function (event) {

                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    event.returnValue = false;
                }

                var selecetd_taxonomy = $(this).attr('data-taxonomy');
                console.log(selecetd_taxonomy);

                var data = {
                    action: 'filter_products_by_category',
                    category: selecetd_taxonomy,
                };

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    beforeSend: function () {
                        $('.product_lists').html('<p>Loading...</p>');
                    },
                    success: function (response) {
                        $('.product_lists').html(response);
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

            });

            // size filter
            $('.size_filter_attribute').click(function (event) {

                if (event.preventDefault) {
                    event.preventDefault();
                } else {
                    event.returnValue = false;
                }

                var selecetd_taxonomy = $(this).attr('data-taxonomy');
                console.log(selecetd_taxonomy);

                var data = {
                    action: 'filter_products_by_size',
                    size: selecetd_taxonomy,
                };

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    beforeSend: function () {
                        $('.product_lists').html('<p>Loading...</p>');
                    },
                    success: function (response) {
                        $('.product_lists').html(response);
                        $(".size_filter_dropdown").fadeOut();
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

            });


            $('.liked_button').on('click', function (e) {
                e.preventDefault();
                var product_id = $(this).data('product-id');
                var data = {
                    action: 'add_to_wishlist',
                    product_id: product_id
                };
                $.post(ajaxurl, data, function (response) {
                    console.log(response);
                });
            });


        });
    </script>
<?php
get_footer();