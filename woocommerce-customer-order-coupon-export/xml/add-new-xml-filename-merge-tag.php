<?php // only copy if needed

/**
 * Adds an %%order_numbers%% merge tag for XML Export - order export file names
 *
 * REQUIRES v2.0+ or newer of XML Export
 *
 * @param array $variables the possible merge tag variables
 * @param array $ids the IDs (order or customer) in the export file
 * @param string $export_type the export type, either 'orders' or 'customers'
 * @return array - updated list of variables / merge tags
 */
function sv_wc_xml_export_filename_order_numbers( $variables, $ids, $export_type ) {

	// only add this merge tag for orders
	if ( 'orders' !== $export_type ) {
		return $variables;
	}

	$order_numbers = array();

	// get an array of order numbers based on our IDs
	foreach ( $ids as $id ) {

		$order           = wc_get_order( $id );
		$order_numbers[] = $order->get_order_number();
	}

	$variables['%%order_numbers%%'] = implode( '-', $order_numbers );
	return $variables;
}
add_filter( 'wc_customer_order_export_xml_filename_variables', 'sv_wc_xml_export_filename_order_numbers', 10, 3 );
