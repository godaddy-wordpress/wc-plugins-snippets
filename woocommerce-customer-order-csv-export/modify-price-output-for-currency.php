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

	$decimals           = (int) get_option( 'woocommerce_price_num_decimals', 2 );
	$decimal_separator  = get_option( 'woocommerce_price_decimal_sep', '.' );
	$thousand_separator = get_option( 'woocommerce_price_thousand_sep', ',' );

	$price_columns = array(
		'shipping_total',
		'shipping_tax_total',
		'fee_total',
		'fee_tax_total',
		'tax_total',
		'discount_total',
		'order_total',
		'refunded_total',
	);

	if ( sv_wc_csv_export_is_one_row( $generator ) ) {

		foreach ( $order_data as $line => $data ) {

			foreach ( $price_columns as $column_key ) {
				$order_data[ $line ][ $column_key ] = number_format( $order_data[ $line ][ $column_key ], $decimals, $decimal_separator, $thousand_separator );
			}
		}

	} else {

		// localize price for pricing cell in the row
		foreach ( $price_columns as $column_key ) {

			$order_data[ $column_key ] = number_format( $order_data[ $column_key ], $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row', 'sv_wc_csv_export_localize_price_columns', 10, 3 );


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


/**
 * Uses the WooCommerce currency display settings to format CSV price values instead of machine-readable values
 *
 * @param array $item_data the data "items" columns in the CSV Export file
 * @return array - updated item data
 */
function sv_wc_csv_export_localize_price_items_columns( $item_data ) {

	$decimals           = (int) get_option( 'woocommerce_price_num_decimals', 2 );
	$decimal_separator  = get_option( 'woocommerce_price_decimal_sep', '.' );
	$thousand_separator = get_option( 'woocommerce_price_thousand_sep', ',' );

	$price_data = array(
		'subtotal',
		'subtotal_tax',
		'total',
		'total_tax',
		'refunded',
	);

	// localize price for each piece of price data
	foreach ( $price_data as $data_key ) {

		if ( isset( $item_data[ $data_key ] ) ) {
			$item_data[ $data_key ] = number_format( $item_data[ $data_key ], $decimals, $decimal_separator, $thousand_separator );
		}
	}

	return $item_data;
}
add_filter( 'wc_customer_order_csv_export_order_line_item',     'sv_wc_csv_export_localize_price_items_columns' );
add_filter( 'wc_customer_order_csv_export_order_shipping_item', 'sv_wc_csv_export_localize_price_items_columns' );
add_filter( 'wc_customer_order_csv_export_order_fee_item',      'sv_wc_csv_export_localize_price_items_columns' );
add_filter( 'wc_customer_order_csv_export_order_tax_item',      'sv_wc_csv_export_localize_price_items_columns' );
