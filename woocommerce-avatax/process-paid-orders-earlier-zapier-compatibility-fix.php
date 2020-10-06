<?php // only copy this line if needed

/**
 * Calculate order taxes and send to AvaTax at an earlier priority to address a
 * compatibility issue with the WooCommerce Zapier Integration.
 *
 * This code ensures that orders sent with Zapier integration have taxes calculated.
 */
function sv_wc_avatax_process_paid_orders_earlier() {

	if ( ! function_exists( 'wc_avatax' ) ) {
		return;
	}

	$order_handler = wc_avatax()->get_order_handler();

	// remove default AvaTax actions
	remove_action( 'woocommerce_payment_complete',                   array( $order_handler, 'process_paid_order' ) );
	remove_action( 'woocommerce_order_status_on-hold_to_processing', array( $order_handler, 'process_paid_order' ) );
	remove_action( 'woocommerce_order_status_on-hold_to_completed',  array( $order_handler, 'process_paid_order' ) );
	remove_action( 'woocommerce_order_status_failed_to_processing',  array( $order_handler, 'process_paid_order' ) );
	remove_action( 'woocommerce_order_status_failed_to_completed',   array( $order_handler, 'process_paid_order' ) );

	// re-add the actions, changing the priority so they'll run earlier
	add_action( 'woocommerce_payment_complete',                   array( $order_handler, 'process_paid_order' ), 8 );
	add_action( 'woocommerce_order_status_on-hold_to_processing', array( $order_handler, 'process_paid_order' ), 8 );
	add_action( 'woocommerce_order_status_on-hold_to_completed',  array( $order_handler, 'process_paid_order' ), 8 );
	add_action( 'woocommerce_order_status_failed_to_processing',  array( $order_handler, 'process_paid_order' ), 8 );
	add_action( 'woocommerce_order_status_failed_to_completed',   array( $order_handler, 'process_paid_order' ), 8 );
}
add_action( 'init', 'sv_wc_avatax_process_paid_orders_earlier' );
