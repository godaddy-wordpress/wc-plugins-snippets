<?php // only copy this line if needed

/**
 * Dequeues the plugin's payment form except on the checkout page or Add Payment Method page.
 */
add_action( 'wp_enqueue_scripts', function() {
	
	// check to ensure that this does not occur on Checkout page or Add Payment Method page
	if ( ! is_checkout() && ! is_add_payment_method_page() ) {
		
		// remove payment form JS
		wp_dequeue_script( 'wc-elavon-payment-form' );
	}
	
}, 20 );
