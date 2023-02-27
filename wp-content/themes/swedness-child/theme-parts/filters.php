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
                <a data-taxonomy="<?php echo $attribute_name; ?>" class="size_filter_attribute" href="javascript:void(0)"><?php echo $attribute_name; ?></a>
            <?php
            }
            ?>
            <div class="filter_reset">
                <a href="javascript:void(0)">Reset Filter</a>
                <a href="javascript:void(0)">Close</a>
            </div>

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
                <a data-taxonomy="<?php echo $attribute_name; ?>" class="color_filter_attribute" href="javascript:void(0)"><?php echo $attribute_name; ?></a>
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
                                <a href="<?php echo esc_url(add_query_arg('category', $subcategory->name)); ?>" data-taxonomy="<?php echo $taxonomy_name; ?>" class="category_filter"><?php
                                                                                                                                                                                        echo $subcategory->name; ?></a>
                            </div>

                        <?php } ?>
                    </div>
                </div>
                <div class="brand_filter_right_side">
                    <div class="search_input">
                        <input type="text" placeholder="Search" class="form-control" />

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
                <a data-taxonomy="<?php echo $attribute_name; ?>" class="attribute_filter" href="#"><?php echo $attribute_name; ?></a>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="sort_filter">
        <div class="filter_header">
            <a href="#">Popularity</a>
            <span> <i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span>
        </div>
        <div class="sort_filter_dropdown">
            <a data-taxonomy="popularity" class="sort_attribute_filter" href="#">Popularity</a>
            <a data-taxonomy="a-z" class="sort_attribute_filter" href="#">Names A-Z</a>
            <a data-taxonomy="z-a" class="sort_attribute_filter" href="#">Names Z-A</a>
            <a data-taxonomy="lowest" class="sort_attribute_filter" href="#">Lowest Price</a>
            <a data-taxonomy="highest" class="sort_attribute_filter" href="#">Highest Price</a>
        </div>
    </div>
</div>