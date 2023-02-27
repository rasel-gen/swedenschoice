<script>
    jQuery(document).ready(function($) {
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

        // category filter
        $('.category_filter').click(function(event) {
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
            $(this).toggleClass('attr');
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function() {
                    $('.product_lists').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.product_lists').html(response);
                    $(".brand_filter_dropdown").fadeOut();
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });

        // attribute filter
        $('.attribute_filter').click(function(event) {
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }

            var selecetd_taxonomy = $(this).attr('data-taxonomy');
            $(this).toggleClass('attr');
            var data = {
                action: 'filter_products_by_attributes',
                attribute: selecetd_taxonomy,
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function() {
                    $('.product_lists').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.product_lists').html(response);
                    $(".material_filter_dropdown").fadeOut();
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });

        $(".color_filter").click(function() {
            $(".color_filter_dropdown").fadeIn();
        });
        $(".size_filter").click(function() {
            $(".size_filter_dropdown").fadeIn();
        });
        $(".material_filter").click(function() {
            $(".material_filter_dropdown").fadeIn();
        });
        $(".brand_filter").click(function() {
            $(".brand_filter_dropdown").fadeIn();
        });
        // color filter
        $('.color_filter_attribute').click(function(event) {
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }

            var selecetd_taxonomy = $(this).attr('data-taxonomy');
            $(this).toggleClass('attr');
            var data = {
                action: 'filter_products_by_color',
                color: selecetd_taxonomy,
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function() {
                    $('.product_lists').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.product_lists').html(response);
                    $(".color_filter_dropdown").fadeOut();
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });

        // category filter
        $('.product_filter').click(function(event) {

            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
            $(this).toggleClass('attr');
            var selecetd_taxonomy = $(this).attr('data-taxonomy');
            var data = {
                action: 'filter_products_by_category',
                category: selecetd_taxonomy,
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function() {
                    $('.product_lists').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.product_lists').html(response);
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });

        // size filter
        $('.size_filter_attribute').click(function(event) {

            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }

            var selecetd_taxonomy = $(this).attr('data-taxonomy');

            $(this).toggleClass('attr');

            var data = {
                action: 'filter_products_by_size',
                size: selecetd_taxonomy,
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function() {
                    $('.product_lists').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.product_lists').html(response);
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });


        // attribute filter
        $('.sort_attribute_filter').click(function(event) {
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }

            var selecetd_taxonomy = $(this).attr('data-taxonomy');
            $(this).toggleClass('attr');

            var data = {
                action: 'filter_by_sorting',
                sorting_type: selecetd_taxonomy,
            };

            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: data,
                beforeSend: function() {
                    $('.product_lists').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.product_lists').html(response);
                    $(".material_filter_dropdown").fadeOut();
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });



        $('.liked_button').on('click', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var data = {
                action: 'add_to_wishlist',
                product_id: product_id
            };
            $.post(ajaxurl, data, function(response) {
                console.log(response);
            });
        });


    });
</script>