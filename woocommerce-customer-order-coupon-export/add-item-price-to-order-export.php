<?php // only copy this line if needed

/**
 * Show the product price in the default order export formats
 * Adds individual item_price to line item meta, and optionally, adds a new column
 * for item price to One Row per Item formats
 */


/**
 * Step 1. Add the product price to the individual line item entry
 *
 * @param array      $line_item    the original line item data
 * @param array      $item         WC order item data
 * @param WC_Product $product      the product
 * @return array updated line item data
 */
function sv_wc_csv_export_order_line_item_price( $line_item, $item, $product ) {

	$new_line_item = array();

	foreach ( $line_item as $key => $data ) {

		$new_line_item[ $key ] = $data;

		// get price of item paid
		if ( $item->get_quantity() > 0 ) {

			$price = $item->get_subtotal() / $item->get_quantity();

		} else {
			// this should never happen ¯\_(ツ)_/¯

			$price = $product instanceof WC_Product ? $product->get_price() : 0;
		}


		// add this in the JSON / pipe-format after the SKU
		if ( 'sku' === $key ) {
			$new_line_item['price'] = wc_format_decimal( $price, 2 );
		}
	}

	return $new_line_item;
}
add_filter( 'wc_customer_order_export_csv_order_line_item', 'sv_wc_csv_export_order_line_item_price', 10, 3 );


/**
 * (optional) Step 2. Add `item_price` column to "one row per item" export formats
 *
 * @param array $column_headers the original column headers
 * @param CSV_Export_Generator $csv_generator the generator instance
 * @return array - the updated column headers
 */
function sv_wc_csv_export_modify_column_headers_item_price( $column_headers, $csv_generator ) {

	// check export format
	if ( sv_wc_csv_export_is_one_row( $csv_generator ) ) {

		// add after 'item_sku' column if it exists
		if ( isset( $column_headers['item_sku'] ) ) {

			$new_headers = array();

			foreach ( $column_headers as $key => $column ) {

				$new_headers[ $key ] = $column;

				// add the item_price after the SKU column
				if ( 'item_sku' === $key ) {
					$new_headers['item_price'] = 'item_price';
				}
			}

			$column_headers = $new_headers;

		// otherwise add column to the end of the headers array
		} else {
			$column_headers['item_price'] = 'item_price';
		}
	}

	return $column_headers;
}
add_filter( 'wc_customer_order_export_csv_order_headers', 'sv_wc_csv_export_modify_column_headers_item_price', 10, 2 );


/**
 * (optional) Step 3. Add the item_price column data for the Default - One Row per Item format
 *
 * @param array $order_data the original order data
 * @param array $item       the item for this row
 * @return array the updated order data
 */
function sv_wc_csv_export_order_row_one_row_per_item_price( $order_data, $item ) {

	$order_data['item_price'] = wc_format_decimal( $item['price'], 2 );

	return $order_data;
}
add_filter( 'wc_customer_order_export_csv_order_row_one_row_per_item', 'sv_wc_csv_export_order_row_one_row_per_item_price', 10, 2 );


if ( ! function_exists( 'sv_wc_csv_export_is_one_row' ) ) :

/**
 * Helper function to check the export format
 *
 * @param \CSV_Export_Generator $csv_generator the generator instance
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
