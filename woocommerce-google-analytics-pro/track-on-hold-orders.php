<?php // only copy this line if needed

/**
 * Marks on-hold orders as a paid status, so that the `completed_purchase` event can track them
 */
function sv_wc_google_analytics_pro_woocommerce_order_is_paid_statuses( $paid_statuses ) {

	$paid_statuses[] = 'on-hold';

	return $paid_statuses;
}

/**
 * Ensures orders marked as On-hold are also tracked as purchases
 */
function sv_wc_google_analytics_pro_track_on_hold_orders() {

	// check if Google Analytics Pro is active
	if ( ! function_exists( 'wc_google_analytics_pro' ) ) {
		return;
	}

	add_filter( 'woocommerce_order_is_paid_statuses', 'sv_wc_google_analytics_pro_woocommerce_order_is_paid_statuses' );
	add_action( 'woocommerce_order_status_on-hold', array( wc_google_analytics_pro()->get_integration(), 'completed_purchase' ) );
}
add_action( 'init', 'sv_wc_google_analytics_pro_track_on_hold_orders' );
