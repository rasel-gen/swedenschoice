<?php 

get_header(); ?>

    <div id="my-cart-list" style="display: none;">
        <?php echo do_shortcode('[woocommerce_cart]'); ?>
    </div>
<?php 

get_footer();
?>