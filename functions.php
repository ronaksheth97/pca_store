<?php
function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );




/*All Child Theme Functions go here
-----------------------------------*/


// Hook in
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

/* Our hooked in function - $fields is passed via the filter
For info:
http://uploadwp.com/customizing-the-woocommerce-checkout-page/ 
*/
function custom_override_checkout_fields($fields){
	unset($fields['order']['order_comments']);
	unset($fields['billing']);
	//unset($fields['account']['account_password']);
	//unset($fields['billing']['billing_first_name']);
	//unset($fields['billing']['billing_last_name']);
	//unset($fields['billing']['billing_company']);
	//unset($fields['billing']['billing_address_1']);
	//unset($fields['billing']['billing_address_2']);

	return $fields;
}


/*
Add read_private_posts capability to subscriber
Note this is saves capability to the database
*/
	$role = get_role('subscriber');
	$role->add_cap('read_private_posts');
	$role->add_cap('read_private_pages');


// Edit WooCommerce dropdown menu item of shop page//
// Options: menu_order, popularity, rating, date, price, price-desc
 
function my_woocommerce_catalog_orderby( $orderby ) {
    unset($orderby["price"]);
    unset($orderby["price-desc"]);
    unset($orderby["rating"]);
    //unset($orderby[""]);
    return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20 );



?>