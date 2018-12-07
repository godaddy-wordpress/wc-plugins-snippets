<?php // only copy this line if needed

/**
 * Ensures orders marked as On-hold are also tracked as purchases
 */
function sv_wc_google_analytics_pro_track_on_hold_orders() {

	// check if Google Analytics Pro is active
	if ( ! function_exists( 'wc_google_analytics_pro' ) ) {
		return;
	}

	add_action( 'woocommerce_order_status_on-hold', array( wc_google_analytics_pro()->get_integration(), 'completed_purchase' ) );
}
add_action( 'init', 'sv_wc_google_analytics_pro_track_on_hold_orders' );
