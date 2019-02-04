<?php // remove this line if not needed

/**
 * Allows you to display a message if product pickup is required. You can use 'allowed' or 'disallowed' instead
 * of 'required' for more flexibility in messaging.
 */
function sv_wc_local_pickup_plus_product_availability_heading( ) {
	global $product;

	// get the product availability
	$product_availability = wc_local_pickup_plus_get_product_availability( $product->get_id() );

	// if pickup is required, show a message
	if ( 'required' === $product_availability ) {
		echo '<h4>This product must be picked up.</h4>';
	}
}
add_filter( 'woocommerce_before_add_to_cart_button', 'sv_wc_local_pickup_plus_product_availability_heading', 4 );
