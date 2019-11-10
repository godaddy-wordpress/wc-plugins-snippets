<?php // only copy this line if needed

/**
 * Add `example` column header and remove the `billing_company` column
 *
 * @param array $column_headers the original column headers
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column headers
 */
function sv_wc_csv_export_modify_column_headers_example( $column_headers, $csv_generator ) {

	$column_headers['example'] = 'example';

	// remove the `billing_company` column
	unset( $column_headers['billing_company'] );

	return $column_headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_modify_column_headers_example', 10, 2 );


/**
 * Add `example` column data
 *
 * @param array $order_data the original column data
 * @param \WC_Order $order the order object
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column data
 */
function sv_wc_csv_export_modify_row_data_example( $order_data, $order, $csv_generator ) {

	$meta_key_example = is_callable( array( $order, 'get_meta' ) ) ? $order->get_meta( 'meta_key_example' ) : $order->meta_key_example;

	$custom_data = array(
		'example' => $meta_key_example,
	);

	return sv_wc_csv_export_add_custom_order_data( $order_data, $custom_data, $csv_generator );
}
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_modify_row_data_example', 10, 3 );


if ( ! function_exists( 'sv_wc_csv_export_add_custom_order_data' ) ) :

/**
 * Helper function to add custom order data to CSV Export order data
 *
 * @param array $order_data the original column data that may be in One Row per Item format
 * @param array $custom_data the custom column data being merged into the column data
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column data
 */
function sv_wc_csv_export_add_custom_order_data( $order_data, $custom_data, $csv_generator ) {

	$new_order_data   = array();

	if ( sv_wc_csv_export_is_one_row( $csv_generator ) ) {

		foreach ( $order_data as $data ) {
			$new_order_data[] = array_merge( (array) $data, $custom_data );
		}

	} else {
		$new_order_data = array_merge( $order_data, $custom_data );
	}

	return $new_order_data;
}

endif;


if ( ! function_exists( 'sv_wc_csv_export_is_one_row' ) ) :

/**
 * Helper function to check the export format
 *
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return bool - true if this is a one row per item format
 */
function sv_wc_csv_export_is_one_row( $csv_generator ) {

	$one_row_per_item = false;

	if ( version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ) {

		// pre 4.0 compatibility
		$one_row_per_item = ( 'default_one_row_per_item' === $csv_generator->order_format || 'legacy_one_row_per_item' === $csv_generator->order_format );

	} elseif ( isset( $csv_generator->format_definition ) ) {

		// post 4.0 (requires 4.0.3+)
		$one_row_per_item = 'item' === $csv_generator->format_definition['row_type'];
	}

	return $one_row_per_item;
}

endif;
