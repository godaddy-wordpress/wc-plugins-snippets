<?php
/**
 * Removes any Cart Notices from the checkout page
 */
function sv_wc_cart_notices_remove_on_checkout() {

	if ( function_exists( 'wc_cart_notices' ) ) {
		remove_action( 'woocommerce_before_checkout_form', array( wc_cart_notices(), 'add_cart_notice' ) );
	}
}
add_action( 'init', 'sv_wc_cart_notices_remove_on_checkout' );
