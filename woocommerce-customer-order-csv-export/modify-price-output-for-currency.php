<?php // only copy if needed

/**
 * Uses the WooCommerce currency display settings to format CSV price values instead of machine-readable values
 *
 * @param array $order_data the data for the export row
 * @param \WC_Order $order
 * @param \WC_Customer_Order_CSV_Export_Generator $generator
 * @return array - updated row data
 */
function sv_wc_csv_export_localize_price_columns( $order_data, $order, $generator ) {

	$decimals           = wc_get_price_decimals();
	$decimal_separator  = wc_get_price_decimal_separator();
	$thousand_separator = wc_get_price_thousand_separator();

	list( $fee_total, $fee_tax_total ) = sv_wc_calculate_fee_total( $order );

	$price_columns = array(
		'shipping_total'     => $order->get_shipping_total(),
		'shipping_tax_total' => $order->get_shipping_tax(),
		'fee_total'          => $fee_total,
		'fee_tax_total'      => $fee_tax_total,
		'tax_total'          => $order->get_total_tax(),
		'discount_total'     => $order->get_total_discount(),
		'order_total'        => $order->get_total(),
		'refunded_total'     => $order->get_total_refunded(),
	);

	if ( sv_wc_csv_export_is_one_row( $generator ) ) {

		foreach ( $order_data as $line => $data ) {

			foreach ( $price_columns as $column_key => $column_value ) {
				$order_data[ $line ][ $column_key ] = number_format( $column_value, $decimals, $decimal_separator, $thousand_separator );
			}
		}

	} else {

		// localize price for pricing cell in the row
		foreach ( $price_columns as $column_key => $column_value ) {

			$order_data[ $column_key ] = number_format( $column_value, $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_localize_price_columns', 10, 3 );


/**
 * Uses the WooCommerce currency display settings to format CSV item price values
 * instead of machine-readable values
 *
 * @param array $item_data the data "items" columns in the CSV Export file
 * @param \WC_Order_Item $item the order item object
 * @param \WC_Product $product the product object (unsued)
 * @param \WC_Order $order the order object
 * @return array the updated item data
 */
function sv_wc_csv_export_localize_price_items_columns_line_item( $item_data, $item, $product, $order ) {

	$decimals           = wc_get_price_decimals();
	$decimal_separator  = wc_get_price_decimal_separator();
	$thousand_separator = wc_get_price_thousand_separator();

	$price_data = array(
		'subtotal'     => $order->get_line_subtotal( $item ),
		'subtotal_tax' => $item['line_subtotal_tax'],
		'total'        => $order->get_line_total( $item ),
		'total_tax'    => $order->get_line_tax( $item ),
		'refunded'     => $order->get_total_refunded_for_item( $item->get_id() ),
	);

	// localize price for each piece of price data
	foreach ( $price_data as $data_key => $data_value ) {

		if ( isset( $item_data[ $data_key ] ) ) {
			$item_data[ $data_key ] = number_format( $data_value, $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $item_data;
}
add_filter( 'wc_customer_order_csv_export_order_line_item', 'sv_wc_csv_export_localize_price_items_columns_line_item', 10, 4 );

/**
 * Uses the WooCommerce currency display settings to format CSV fee price values
 * instead of machine-readable values
 *
 * @param array $item_data the fee item data
 * @param \WC_Order_Item_Fee $fee the fee item object
 * @param \WC_Order $order the order object
 * @return array the updated fee item data
 */
function sv_wc_csv_export_localize_price_items_columns_fee_item( $item_data, $fee, $order ) {

	$decimals           = wc_get_price_decimals();
	$decimal_separator  = wc_get_price_decimal_separator();
	$thousand_separator = wc_get_price_thousand_separator();

	$price_data = array(
		'total'        => $order->get_line_total( $fee ),
		'total_tax'    => $order->get_line_tax( $fee ),
	);

	// localize price for each piece of price data
	foreach ( $price_data as $data_key => $data_value ) {

		if ( isset( $item_data[ $data_key ] ) ) {
			$item_data[ $data_key ] = number_format( $data_value, $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $item_data;
}
add_filter( 'wc_customer_order_csv_export_order_fee_item',  'sv_wc_csv_export_localize_price_items_columns_fee_item', 10, 3 );


/**
 * Uses the WooCommerce currency display settings to format CSV shipping price
 * values instead of machine-readable values
 *
 * @param array $item_data the shipping item data
 * @param \WC_Order_Item_Shipping $shipping the shipping item object
 * @return array the updated shipping item data
 */
function sv_wc_csv_export_localize_price_items_columns_shipping_item( $item_data, $shipping ) {

	$decimals           = wc_get_price_decimals();
	$decimal_separator  = wc_get_price_decimal_separator();
	$thousand_separator = wc_get_price_thousand_separator();

	$price_data = array(
		'total' => $shipping->get_total(),
	);

	// localize price for each piece of price data
	foreach ( $price_data as $data_key => $data_value ) {

		if ( isset( $item_data[ $data_key ] ) ) {
			$item_data[ $data_key ] = number_format( $data_value, $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $item_data;
}
add_filter( 'wc_customer_order_csv_export_order_shipping_item', 'sv_wc_csv_export_localize_price_items_columns_shipping_item', 10, 2 );


/**
 * Uses the WooCommerce currency display settings to format CSV tax price values
 * instead of machine-readable values
 *
 * @param array $item_data the tax item data
 * @param \WC_Order_Item_Tax $tax the tax item object
 * @return array the updated tax item data
 */
function sv_wc_csv_export_localize_price_items_columns_tax_item( $item_data, $tax ) {

	$decimals           = wc_get_price_decimals();
	$decimal_separator  = wc_get_price_decimal_separator();
	$thousand_separator = wc_get_price_thousand_separator();

	$price_data = array(
		'total' => $tax->amount,
	);

	// localize price for each piece of price data
	foreach ( $price_data as $data_key => $data_value ) {

		if ( isset( $item_data[ $data_key ] ) ) {
			$item_data[ $data_key ] = number_format( $data_value, $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $item_data;
}
add_filter( 'wc_customer_order_csv_export_order_tax_item', 'sv_wc_csv_export_localize_price_items_columns_tax_item', 10, 2 );


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


if ( ! function_exists( 'sv_wc_calculate_fee_total' ) ) :

/**
 * Helper function to calculate the fee total and fee tax total
 *
 * @param \WC_Order $order the order object
 * @return array the fee tax and total tuple
 */
function sv_wc_calculate_fee_total( $order ) {

	$fee_total     = 0;
	$fee_tax_total = 0;

	foreach ( $order->get_fees() as $fee_item_id => $fee ) {

		$fee_total     += $fee['line_total'];
		$fee_tax_total += $fee['line_tax'];
	}

	return array( $fee_total, $fee_tax_total );
}

endif;
