<?php // only copy this line if needed

/**
 * Add `item_count` column header
 *
 * @param array $column_headers the original column headers
 * @param \CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column headers
 */
function sv_wc_csv_export_add_item_count_column( $column_headers, $csv_generator ) {

	$new_columns = array();

	foreach ( $column_headers as $id => $header )  {

		$new_columns[ $id ] = $header;

		// insert the item_count column after the order status
		if ( 'status' === $id ) {
			$new_columns['item_count'] = 'item_count';
		}
	}

	return $new_columns;
}
add_filter( 'wc_customer_order_export_csv_order_headers', 'sv_wc_csv_export_add_item_count_column', 10, 2 );


/**
 * Add `item_count` column data
 *
 * @param array $order_data the original column data
 * @param \WC_Order $order the order object
 * @param \CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column data
 */
function sv_wc_csv_export_add_item_count_data( $order_data, $order, $csv_generator ) {

	$new_order_data   = array();
	$one_row_per_item = false;

	$custom_data = array(
		'item_count' => $order->get_item_count(),
	);

	if ( version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ) {
		// pre 4.0 compatibility
		$one_row_per_item = ( 'default_one_row_per_item' === $csv_generator->order_format || 'legacy_one_row_per_item' === $csv_generator->order_format );
	} elseif ( isset( $csv_generator->format_definition ) ) {
		// post 4.0 (requires 4.0.3+)
		$one_row_per_item = 'item' === $csv_generator->format_definition['row_type'];
	}

	if ( $one_row_per_item ) {

		foreach ( $order_data as $data ) {
			$new_order_data[] = array_merge( (array) $data, $custom_data );
		}

	} else {
		$new_order_data = array_merge( $order_data, $custom_data );
	}

	return $new_order_data;
}
add_filter( 'wc_customer_order_export_csv_order_row', 'sv_wc_csv_export_add_item_count_data', 10, 3 );
