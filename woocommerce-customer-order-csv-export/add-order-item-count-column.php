<?php // only copy this line if needed

/**
 * Add `item_count` column header
 *
 * @param array $column_headers the original column headers
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
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
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_add_item_count_column', 10, 2 );


/**
 * Add `item_count` column data
 *
 * @param array $order_data the original column data
 * @param \WC_Order $order the order object
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column data
 */
function sv_wc_csv_export_add_item_count_data( $order_data, $order, $csv_generator ) {

	$export_format = version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ? $csv_generator->order_format : $csv_generator->export_format;

	$custom_data = array(
		'item_count' => $order->get_item_count(),
	);

	$new_order_data = array();

	if ( 'default_one_row_per_item' === $export_format || 'legacy_one_row_per_item' === $export_format ) {

		foreach ( $order_data as $data ) {
			$new_order_data[] = array_merge( (array) $data, $custom_data );
		}

	} else {

		$new_order_data = array_merge( $order_data, $custom_data );
	}

	return $new_order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_add_item_count_data', 10, 3 );
