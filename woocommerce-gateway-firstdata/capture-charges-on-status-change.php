<?php // only copy if needed!

/**
 * Automatically captures charge when moving to a "paid" order status.
 *
 * @param int $order_id ID of the order changing status
 */
function sv_wc_first_data_auto_capture_on_status_change( $order_id ) {

	$order = wc_get_order( $order_id );

	// only try to capture when changing to a "paid" status
	if ( function_exists( 'wc_first_data' ) && $order && $order->is_paid() ) {
		wc_first_data()->maybe_capture_charge( $order );
	}
}
add_action( 'woocommerce_order_status_changed', 'sv_wc_first_data_auto_capture_on_status_change', 11 );