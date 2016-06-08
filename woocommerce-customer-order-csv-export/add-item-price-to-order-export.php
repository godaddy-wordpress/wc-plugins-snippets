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

	$line_item['price'] = $product->get_price();

	return $line_item;
}
add_filter( 'wc_customer_order_csv_export_order_line_item', 'sv_wc_csv_export_order_line_item_price', 10, 3 );


/**
 * Add `item_price` column to the Default - One Row per Item export format
 *
 * @param array  $column_headers the original column headers
 * @param WC_Customer_Order_CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column headers
 */
function sv_wc_csv_export_modify_column_headers_item_price( $column_headers, $csv_generator ) {

	if ( 'default_one_row_per_item' === $csv_generator->order_format ) {

		$new_headers = array(
			'item_price' => 'item_price',
		);

		$column_headers = array_merge( $column_headers, $new_headers );
	}

	return $column_headers;
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

	$order_data['item_price'] = $item['price'];

	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row_one_row_per_item', 'sv_wc_csv_export_order_row_one_row_per_item_price', 10, 2 );
