<?php // only copy if needed

/**
 * Update the valid statuses for exporting Shipwire orders
 *
 * @param array $statuses the valid order statuses for export (without wc- prefix)
 * @return array the updated statuses
 */
function sv_wc_shipwire_valid_order_statuses_for_export( $statuses ) {

	// you could add multiple statuses as needed, such as custom order statuses, for export
	$statuses[] = 'completed';
	return $statuses;
}
add_filter( 'wc_shipwire_valid_order_statuses_for_export', 'sv_wc_shipwire_valid_order_statuses_for_export' );