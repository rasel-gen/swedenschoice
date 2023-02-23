<?php
//    register custom post for delivery charge
// Register custom post type
add_action( 'init', 'register_delivery_charge_custom_post_type' );
function register_delivery_charge_custom_post_type() {
$labels = array(
'name'               => _x( 'Delivery Charges', 'textdomain' ),
'singular_name'      => _x( 'Delivery Charge', 'textdomain' ),
'menu_name'          => _x( 'Delivery Charge', 'textdomain' ),
'name_admin_bar'     => _x( 'Delivery Charge', 'textdomain' ),
'add_new'            => _x( 'Add New', 'textdomain' ),
'add_new_item'       => __( 'Add New Delivery Charge', 'textdomain' ),
'new_item'           => __( 'New Delivery Charge', 'textdomain' ),
'edit_item'          => __( 'Edit Delivery Charge', 'textdomain' ),
'view_item'          => __( 'View Delivery Charge', 'textdomain' ),
'all_items'          => __( 'All Delivery Charges', 'textdomain' ),
'search_items'       => __( 'Search Delivery Charges', 'textdomain' ),
'parent_item_colon'  => __( 'Parent Delivery Charges:', 'textdomain' ),
'not_found'          => __( 'No delivery charges found.', 'textdomain' ),
'not_found_in_trash' => __( 'No delivery charges found in Trash.', 'textdomain' )
);
$args = array(
'labels'             => $labels,
'public'             => true,
'publicly_queryable' => true,
'show_ui'            => true,
'show_in_menu'       => true,
'query_var'          => true,
'rewrite'            => array( 'slug' => 'delivery-charges' ),
'capability_type'    => 'post',
'has_archive'        => true,
'hierarchical'       => false,
'menu_position'      => 20,
'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
);
register_post_type( 'delivery_charge', $args );
}
