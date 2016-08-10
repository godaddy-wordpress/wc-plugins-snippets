<?php // only copy this line if needed

/**
 * Show the product price in the Default - One Row per Item order export format
 * Adds a column for item price
 */


/**
 * Add the product price to the individual line item entry
 *
 * @param array      $line_item    the original line item data
 * @param array      $item         WC order item data
 * @param WC_Product $product      the product
 * @return array updated line item data
 */
function sv_wc_csv_export_order_line_item_price( $line_item, $item, $product ) {

	$new_line_item = array();

	foreach( $line_item as $key => $data ) {

		$new_line_item[ $key ] = $data;

		// add this in the JSON / pipe-format after the SKU
		if ( 'sku' === $key ) {
			$new_line_item['price'] = wc_format_decimal( $product->get_price(), 2 );
		}
	}

	return $new_line_item;
}
add_filter( 'wc_customer_order_csv_export_order_line_item', 'sv_wc_csv_export_order_line_item_price', 10, 3 );


/**
 * Add `item_price` column to the Default - One Row per Item export format
 *
 * @param array  $column_headers the original column headers
 * @param WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column headers
 */
function sv_wc_csv_export_modify_column_headers_item_price( $column_headers, $csv_generator ) {

	$export_format = version_compare( wc_customer_order_csv_export()->get_version(), '4.0.0', '<' ) ? $csv_generator->order_format : $csv_generator->export_format;

	$new_headers = array();

	if ( 'default_one_row_per_item' === $export_format ) {

		foreach( $column_headers as $key => $column ) {

			$new_headers[ $key ] = $column;

			// add the item_price after the SKU column
			if ( 'item_sku' === $key ) {
				$new_headers['item_price'] = 'item_price';
			}
		}

	} else {
		return $column_headers;
	}

	return $new_headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_modify_column_headers_item_price', 10, 2 );


/**
 * Add the item_price column data for the Default - One Row per Item format
 *
 * @param array $order_data the original order data
 * @param array $item       the item for this row
 * @return array the updated order data
 */
function sv_wc_csv_export_order_row_one_row_per_item_price( $order_data, $item ) {

	$order_data['item_price'] = wc_format_decimal( $item['price'], 2 );

	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row_one_row_per_item', 'sv_wc_csv_export_order_row_one_row_per_item_price', 10, 2 );
