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
                                    <?php if ( is_active_widget( false, false, 'astra_price_filter', true ) ) : ?>
                                        <div class="widget widget_price_filter">
                                            <?php the_widget( 'Astra_Price_Filter_Widget' ); ?>
                                        </div>
                                    <?php endif; ?>

                                    <a href="#">Price</a>
                                    <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
                                </div>
                                <div class="price_filter_dropdown">
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
                                           href="#"><?php echo $attribute_name; ?></a>
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
                                           href="#"><?php echo $attribute_name; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="brand_filter">
                                <div class="filter_header">
                                    <a href="#">Brand</a>
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
                        $category_name = $category->name;

                        //                    if ($category_name) {
                        //                        $args['tax_query'] = array(
                        //                            array(
                        //                                'taxonomy' => 'product_cat',
                        //                                'field' => 'slug',
                        //                                'terms' => $category_name,
                        //                            ),
                        //                        );
                        //                    }

                        $args = array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                        );

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

                                    ?>
                                    <div class="products">

                                        <div class="product_image">
                                            <a href="<?php echo get_permalink($product_id); ?>">
                                                <?php echo the_post_thumbnail(); ?></a>
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
                                        </div>
                                        <div class="product_description">
                                            <div class="product_title">
                                                <h6>
                                                    <a href="<?php echo get_permalink($product_id); ?>"><?php echo the_title(); ?></a>
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
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

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
                    },
                    error: function () {
                        $('.product_lists').html('<p>Something went wrong.</p>');
                    }
                });

            });
        });
    </script>
<?php
get_footer();