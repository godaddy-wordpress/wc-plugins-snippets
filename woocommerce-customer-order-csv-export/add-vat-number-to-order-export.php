<?php // only copy this line if needed

/**
 * Add `vat_number` column header
 *
 * @param array $column_headers the original column headers
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column headers
 */
function sv_wc_csv_export_modify_column_headers_vat_number( $column_headers, $csv_generator ) {

	$column_headers['vat_number'] = 'vat_number';

	return $column_headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_modify_column_headers_vat_number', 10, 2 );


/**
 * Add `vat_number` column data
 *
 * this function searches for a VAT number order meta key used by the more
 * popular Tax/VAT plugins
 *
 * @param array $order_data the original column data
 * @param \WC_Order $order the order object
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column data
 */
function sv_wc_csv_export_modify_row_data_vat_number( $order_data, $order, $csv_generator ) {

	$vat_number = '';

	// find VAT number if one exists for the order
	$vat_number_meta_keys = array(
		'_vat_number',				 // EU VAT number
		'VAT Number',				 // Legacy EU VAT number
		'vat_number',                // Taxamo
		'_billing_wc_avatax_vat_id', // AvaTax
	);

	foreach ( $vat_number_meta_keys as $meta_key ) {

		if ( metadata_exists( 'post', $order->id, $meta_key ) ) {
			$vat_number = get_post_meta( $order->id, $meta_key, true );
			break;
		}
	}

	$custom_data = array(
		'vat_number' => $vat_number,
	);

	$new_order_data = array();

	$export_format = version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ? $csv_generator->order_format : $csv_generator->export_format;

	if ( 'default_one_row_per_item' === $export_format || 'legacy_one_row_per_item' === $export_format ) {

		foreach ( $order_data as $data ) {
			$new_order_data[] = array_merge( (array) $data, $custom_data );
		}

	} else {

		$new_order_data = array_merge( $order_data, $custom_data );
	}

	return $new_order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_modify_row_data_vat_number', 10, 3 );
