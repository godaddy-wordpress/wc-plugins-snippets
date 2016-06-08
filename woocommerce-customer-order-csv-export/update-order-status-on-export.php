<?php // only copy this line if needed

/**
 * Update an order's status to completed immediately after it's exported
 *
 * @param object $order the \WC_Order object
 * @param string $export_method the selected export method
 */
function sv_wc_csv_export_update_exported_order_status( $order, $export_method ) {

	// uncomment this to restrict the order status update to a specific export method
	//if ( 'ftp' !== $export_method ) {
	//	return;
	//}

	$order->update_status( 'completed' );
}
add_action( 'wc_customer_order_csv_export_order_exported', 'wc_csv_export_update_exported_order_status', 10, 2 );
