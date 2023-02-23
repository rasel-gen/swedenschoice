<?php
/**
 * Template Name: Swedness Login
 */

get_header();

do_action( 'woocommerce_before_customer_login_form' );
?>
    <div class="woocommerce custom_login">
        <div class="text-center">
            <h4>Sigin to your account</h4>
        </div>

        <div class="customer-login-form">
            <?php wc_get_template( 'myaccount/form-login.php' ); ?>
        </div>
    </div>

<?php
do_action( 'woocommerce_after_customer_login_form' );

get_footer();
?>