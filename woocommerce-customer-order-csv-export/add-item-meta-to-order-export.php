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

	$line_item['weight'] = $product->get_weight();

	return $line_item;
}
add_filter( 'wc_customer_order_csv_export_order_line_item', 'sv_wc_csv_export_add_weight_to_line_item', 10, 4 );


/**
 * Add weight as line item meta in CSV export CSV Import format
 *
 * @param array $order_data the original order data
 * @param object $order the WC_Order object exported
 * @return array the updated order data
 */
function sv_wc_csv_export_add_weight_to_csv_export_import_format( $order_data, $order ) {

	$count = 1;

	// add line items
	foreach ( $order->get_items() as $item ) {

		$product = $order->get_product_from_item( $item );

		if ( ! is_object( $product ) ) {
			$product = new WC_Product( 0 );
		}

		if ( $weight = $product->get_weight() ) {
			$order_data[ "order_item_{$count}" ] .= '|weight: ' . $weight;
		}

		$count++;
	}

	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_add_weight_to_csv_export_import_format', 20, 2 );
