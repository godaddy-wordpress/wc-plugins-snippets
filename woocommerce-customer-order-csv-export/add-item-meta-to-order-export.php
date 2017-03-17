<?php // only copy if needed

/**
 * Add line item meta to the Order CSV Export in Default format
 * Example: add weight to the item meta data
 */


/**
 * Add weight to line item data
 *
 * @param array $line_item the original line item data
 * @param array $item the item's order data
 * @param object $product the \WC_Product object for the line
 * @param object $order the \WC_Order object being exported
 * @return array the updated line item data
 */
function sv_wc_csv_export_add_weight_to_line_item( $line_item, $item, $product, $order ) {

	$new_item_data = array();

	foreach ( $line_item as $key => $data ) {

		$new_item_data[ $key ] = $data;

		if ( 'sku' === $key ) {
			$new_item_data['weight'] = wc_format_decimal( $product->get_weight(), 2 );
		}
	}

	return $new_item_data;
}
add_filter( 'wc_customer_order_csv_export_order_line_item', 'sv_wc_csv_export_add_weight_to_line_item', 10, 4 );


/**
 * Add `item_weight` column to the default and custom formats
 *
 * @param array $column_headers the original column headers
 * @param \WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column headers
 */
function sv_wc_csv_export_modify_column_headers_item_price( $column_headers, $csv_generator ) {

	$new_headers = array();

	if ( sv_wc_csv_export_is_one_row( $csv_generator ) ) {

		foreach( $column_headers as $key => $column ) {

			$new_headers[ $key ] = $column;

			// add the item_price after the SKU column
			if ( 'item_sku' === $key ) {
				$new_headers['item_weight'] = 'item_weight';
			}
		}

	} else {

		return $column_headers;
	}

	return $new_headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_modify_column_headers_item_price', 10, 2 );


/**
 * Add the item_weight column data for the Default - One Row per Item format
 *
 * @param array $order_data the original order data
 * @param array $item       the item for this row
 * @return array - the updated order data
 */
function sv_wc_csv_export_order_row_one_row_per_item_weight( $order_data, $item ) {

	$order_data['item_weight'] = $item['weight'];
	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row_one_row_per_item', 'sv_wc_csv_export_order_row_one_row_per_item_weight', 10, 2 );


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
