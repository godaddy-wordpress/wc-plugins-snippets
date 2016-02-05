<?php 
/**
 * Show PayPal Express buttons at the top of checkout
 * Instead of with payment methods
 */
function sv_wc_paypal_express_buttons_atcheckout_top() {

	if ( function_exists( 'wc_paypal_express' ) ) {
		wc_paypal_express()->render_express_checkout_button();
 	}
 	
}
add_action( 'woocommerce_checkout_before_customer_details', 'sv_wc_paypal_express_buttons_atcheckout_top' );