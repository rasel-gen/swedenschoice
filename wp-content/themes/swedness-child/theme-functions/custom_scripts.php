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
                    const swiper = new Swiper('.swiper', {
                        // Optional parameters
                        direction: 'horizontal',
                        loop: true,
                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                    $(document).trigger('yith_wcwl_init');
                    $('.product_colors_all').click(function() {

                        var product_id = $(this).data('product-id');
                        var size_select = $('#size-select_' + product_id);
                        var color_value = $(this).data('color');
                        $(this).toggleClass('colors_border');

                        console.log(product_id);
                        if (color_value.length) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                data: {
                                    action: 'get_variation_sizes',
                                    product_id: product_id,
                                    color_value: color_value,
                                },
                                success: function(response) {
                                    console.log(response);
                                    size_select.html(response);
                                },
                            });

                            size_select.trigger('change');

                        } else {
                            size_select.html('<option value="">Select a size</option>');
                        }
                    });
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
                    const swiper = new Swiper('.swiper', {
                        // Optional parameters
                        direction: 'horizontal',
                        loop: true,
                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                    $(document).trigger('yith_wcwl_init');
                    $('.product_colors_all').click(function() {

                        var product_id = $(this).data('product-id');
                        var size_select = $('#size-select_' + product_id);
                        var color_value = $(this).data('color');
                        $(this).toggleClass('colors_border');

                        console.log(product_id);
                        if (color_value.length) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                data: {
                                    action: 'get_variation_sizes',
                                    product_id: product_id,
                                    color_value: color_value,
                                },
                                success: function(response) {
                                    console.log(response);
                                    size_select.html(response);
                                },
                            });

                            size_select.trigger('change');

                        } else {
                            size_select.html('<option value="">Select a size</option>');
                        }
                    });
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
                    const swiper = new Swiper('.swiper', {
                        // Optional parameters
                        direction: 'horizontal',
                        loop: true,
                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                    $(document).trigger('yith_wcwl_init');
                    $('.product_colors_all').click(function() {

                        var product_id = $(this).data('product-id');
                        var size_select = $('#size-select_' + product_id);
                        var color_value = $(this).data('color');
                        $(this).toggleClass('colors_border');

                        console.log(product_id);
                        if (color_value.length) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                data: {
                                    action: 'get_variation_sizes',
                                    product_id: product_id,
                                    color_value: color_value,
                                },
                                success: function(response) {
                                    console.log(response);
                                    size_select.html(response);
                                },
                            });

                            size_select.trigger('change');

                        } else {
                            size_select.html('<option value="">Select a size</option>');
                        }
                    });
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });

        // size filter
        // $('.size_filter_attribute').click(function(event) {

        //     if (event.preventDefault) {
        //         event.preventDefault();
        //     } else {
        //         event.returnValue = false;
        //     }

        //     var selecetd_taxonomy = $(this).attr('data-taxonomy');

        //     $(this).toggleClass('attr');

        //     var data = {
        //         action: 'filter_products_by_size',
        //         size: selecetd_taxonomy,
        //     };

        //     $.ajax({
        //         type: 'POST',
        //         url: ajaxurl,
        //         data: data,
        //         beforeSend: function() {
        //             $('.product_lists').html('<p>Loading...</p>');
        //         },
        //         success: function(response) {
        //             $('.product_lists').html(response);
        //         },
        //         error: function() {
        //             $('.product_lists').html('<p>Something went wrong.</p>');
        //         }
        //     });

        // });


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
                    $(".sort_filter_dropdown").fadeOut();

                    const swiper = new Swiper('.swiper', {
                        // Optional parameters
                        direction: 'horizontal',
                        loop: true,
                        // Navigation arrows
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                    $(document).trigger('yith_wcwl_init');
                    $('.product_colors_all').click(function() {

                        var product_id = $(this).data('product-id');
                        var size_select = $('#size-select_' + product_id);
                        var color_value = $(this).data('color');
                        $(this).toggleClass('colors_border');

                        console.log(product_id);
                        if (color_value.length) {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                data: {
                                    action: 'get_variation_sizes',
                                    product_id: product_id,
                                    color_value: color_value,
                                },
                                success: function(response) {
                                    console.log(response);
                                    size_select.html(response);
                                },
                            });

                            size_select.trigger('change');

                        } else {
                            size_select.html('<option value="">Select a size</option>');
                        }
                    });
                },
                error: function() {
                    $('.product_lists').html('<p>Something went wrong.</p>');
                }
            });

        });


        jQuery(function($) {
            $('#size-filter-form input').on('change', function(event) {
                event.preventDefault();
                var data = $('#size-filter-form').serialize();;
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: data + '&action=custom_search_filter',
                    beforeSend: function() {
                        // Show loading spinner
                    },
                    success: function(response) {
                        $('.product_lists').html(response);
                        const swiper = new Swiper('.swiper', {
                            // Optional parameters
                            direction: 'horizontal',
                            loop: true,
                            // Navigation arrows
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        });
                        $(document).trigger('yith_wcwl_init');
                        $('.product_colors_all').click(function() {
                            var product_id = $(this).data('product-id');
                            var size_select = $('#size-select_' + product_id);
                            var color_value = $(this).data('color');
                            $(this).toggleClass('colors_border');

                            console.log(product_id);
                            if (color_value.length) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    data: {
                                        action: 'get_variation_sizes',
                                        product_id: product_id,
                                        color_value: color_value,
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        size_select.html(response);
                                    },
                                });

                                size_select.trigger('change');

                            } else {
                                size_select.html('<option value="">Select a size</option>');
                            }
                        });
                    },
                    complete: function() {
                        // Hide loading spinner
                    }
                });
            });

            $(".filter_reset .close").on('click', function() {
                $(".size_filter_dropdown").hide();
            });
        });


        jQuery(function($) {
            $('#color-filter-form input').on('change', function(event) {
                event.preventDefault();
                var data = $('#color-filter-form').serialize();
                console.log(data);
                $(this).prev().toggle({
                    "border": "2px solid"
                });
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: data + '&action=custom_search_filter',
                    beforeSend: function() {
                        // Show loading spinner
                    },
                    success: function(response) {
                        $('.product_lists').html(response);
                        const swiper = new Swiper('.swiper', {
                            // Optional parameters
                            direction: 'horizontal',
                            loop: true,
                            // Navigation arrows
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        });
                        $(document).trigger('yith_wcwl_init');

                        $('.product_colors_all').click(function() {
                            var product_id = $(this).data('product-id');
                            var size_select = $('#size-select_' + product_id);
                            var color_value = $(this).data('color');
                            $(this).toggleClass('colors_border');

                            console.log(product_id);
                            if (color_value.length) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    data: {
                                        action: 'get_variation_sizes',
                                        product_id: product_id,
                                        color_value: color_value,
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        size_select.html(response);
                                    },
                                });

                                size_select.trigger('change');

                            } else {
                                size_select.html('<option value="">Select a size</option>');
                            }
                        });
                    },
                    complete: function() {
                        // Hide loading spinner
                    }
                });
            });

            $(".filter_reset .close").on('click', function() {
                $(".color_filter_dropdown").hide();
            });
        });


        jQuery(function($) {
            $('#material-filter-form input').on('change', function(event) {
                event.preventDefault();
                var data = $('#material-filter-form').serialize();;
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: data + '&action=custom_search_filter',
                    beforeSend: function() {
                        // Show loading spinner
                    },
                    success: function(response) {
                        $('.product_lists').html(response);
                        const swiper = new Swiper('.swiper', {
                            // Optional parameters
                            direction: 'horizontal',
                            loop: true,
                            // Navigation arrows
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        });
                        $(document).trigger('yith_wcwl_init');

                        $('.product_colors_all').click(function() {
                            var product_id = $(this).data('product-id');
                            var size_select = $('#size-select_' + product_id);
                            var color_value = $(this).data('color');
                            $(this).toggleClass('colors_border');

                            console.log(product_id);
                            if (color_value.length) {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    data: {
                                        action: 'get_variation_sizes',
                                        product_id: product_id,
                                        color_value: color_value,
                                    },
                                    success: function(response) {
                                        console.log(response);
                                        size_select.html(response);
                                    },
                                });

                                size_select.trigger('change');

                            } else {
                                size_select.html('<option value="">Select a size</option>');
                            }
                        });
                    },
                    complete: function() {
                        // Hide loading spinner
                    }
                });
            });

            $(".filter_reset .close").on('click', function() {
                $(".color_filter_dropdown").hide();
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

        jQuery(document).ready(function($) {
            // Listen for the click event of the reset button
            $('.reset_button').click(function(e) {
                // Prevent the default button click behavior
                e.preventDefault();
                // Reset the filter parameters by reloading the current page
                window.location.href = window.location.origin + window.location.pathname;
            });
        });


    });
</script>