<?php // only copy this line if needed!


/**
 * Removes any Cart Notices from the cart page, leaving them only at checkout.
 */
function sv_wc_cart_notices_remove_on_cart() {

	if ( function_exists( 'wc_cart_notices' ) ) {
		remove_action( 'woocommerce_before_cart_contents', array( wc_cart_notices(), 'add_cart_notice' ) );
	}
}
add_action( 'init', 'sv_wc_cart_notices_remove_on_cart' );