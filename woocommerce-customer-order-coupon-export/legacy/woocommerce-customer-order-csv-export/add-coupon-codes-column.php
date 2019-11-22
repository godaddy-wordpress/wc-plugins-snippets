<?php // only copy if needed!

/**
 * Adds a dedicated `coupon_codes` column that outputs only the coupon code(s) used as an
 *  alternative to the `coupon_lines` column.
 *
 * If the order had multiple coupons, they will be pipe-delimited: code1|code2|etc
 */


/**
 * Add `coupon_codes` column header
 *
 * @param array $column_headers the original column headers
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column headers
 */
function sv_wc_csv_export_add_coupon_codes_column( $column_headers, $csv_generator ) {

	$new_columns = array();

	foreach ( $column_headers as $id => $header )  {

		$new_columns[ $id ] = $header;

		if ( 'order_total' === $id ) {
			$new_columns['coupon_codes'] = 'coupon_codes';
		}
	}

	return $new_columns;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_add_coupon_codes_column', 10, 2 );


/**
 * Add `coupon_codes` column data
 *
 * @param array $order_data the original column data
 * @param \WC_Order $order the order object
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column data
 */
function sv_wc_csv_export_add_coupon_codes_data( $order_data, $order, $csv_generator ) {

	$new_order_data   = array();
	$one_row_per_item = false;
	$coupons          = array();
	$coupon_lines     = $order->get_items( 'coupon' );

	foreach( $coupon_lines as $coupon ) {
		$coupons[] = sanitize_text_field( $coupon['name'] );
	}

	$custom_data = array(
		'coupon_codes' => implode( '|', $coupons ),
	);

	if ( version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ) {
		$one_row_per_item = ( 'default_one_row_per_item' === $csv_generator->order_format || 'legacy_one_row_per_item' === $csv_generator->order_format );
	} elseif ( isset( $csv_generator->format_definition ) ) {
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
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_add_coupon_codes_data', 10, 3 );