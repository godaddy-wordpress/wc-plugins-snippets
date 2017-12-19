<?php // only copy if needed


/**
 * Maybe capture an order via AuthNet on status change to processing or completed.
 *
 * @param int $order_id the order ID, unused
 * @param \WC_Order $order order object
 */
function sv_wc_authorize_net_cim_maybe_process_capture( $order_id, $order ) {

	// quick check
	if ( ! $order instanceof WC_Order || ! function_exists( 'wc_authorize_net_cim' ) ) {
		return;
	}

	wc_authorize_net_cim()->maybe_capture_charge( $order );
}
add_action( 'woocommerce_order_status_processing', 'sv_wc_authorize_net_cim_maybe_process_capture', 10, 2 );
add_action( 'woocommerce_order_status_completed',  'sv_wc_authorize_net_cim_maybe_process_capture', 10, 2 );
