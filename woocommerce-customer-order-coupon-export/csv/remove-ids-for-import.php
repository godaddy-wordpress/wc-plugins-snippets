<?php // only copy this line if needed
/**
 * This code snippet removes any identifiers from Customer/Order/Coupon Export export
 * data to allow for more seamless imports with Customer/Order/Coupon CSV Import
 * Suite especially when importing on separate sites or staging sites where the
 * data has diverged from the live site.
 *
 * Requirements:
 * - the export site's products must have SKUs set up and the same SKUs must exist in the import site
 */


/**
 * Adjust the column headers to remove order and customer ID columns and add the
 * `customer_user` column
 *
 * @param array $column_headers the original column headers
 * @param \CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column headers
 */
function sv_wc_csv_export_remove_id_headers_for_import( $column_headers, $csv_generator ) {

	// remove the `order_id` column
	unset( $column_headers['order_id'] );

	// add the customer_user column
	if ( isset( $column_headers['customer_id'] ) ) {

		$new_headers = array();

		// add the customer_user column before the customer_id column
		foreach ( $column_headers as $key => $name ) {

			if ( 'customer_id' === $key ) {
				$new_headers['customer_user'] = 'customer_user';
			}

			$new_headers[ $key ] = $name;
		}

		$column_headers = $new_headers;

	} else {
		$column_headers['customer_user'] = 'customer_user';
	}

	// remove customer ID column
	unset( $column_headers['customer_id'] );

	return $column_headers;
}
add_filter( 'wc_customer_order_export_csv_order_headers', 'sv_wc_csv_export_remove_id_headers_for_import', 10, 2 );
add_filter( 'wc_customer_order_export_csv_customer_headers', 'sv_wc_csv_export_remove_id_headers_for_import', 10, 2 );


/**
 * Removes any identifying data from the CSV export. This removes the order ID,
 * customer ID, product IDs, and all order item IDs.
 *
 * @param array $export_data the original export data for orders as well as line, shipping, fee, tax, coupon, and refund items.
 * @return array the updated export data
 */
function sv_wc_csv_export_remove_ids_for_import( $export_data ) {

	// remove order IDs
	unset( $export_data['order_id'] );

	// remove customer IDs
	unset( $export_data['customer_id'] );

	// remove product IDs
	unset( $export_data['product_id'] );

	// remove item line, shipping, fee, coupon, refund item ids
	unset( $export_data['id'] );

	return $export_data;
}
add_filter( 'wc_customer_order_export_csv_order_row',           'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_order_line_item',     'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_order_shipping_item', 'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_order_fee_item',      'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_order_tax_item',      'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_order_coupon_item',   'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_order_refund_data',   'sv_wc_csv_export_remove_ids_for_import', 100 );
add_filter( 'wc_customer_order_export_csv_customer_row',        'sv_wc_csv_export_remove_ids_for_import', 100 );


/**
 * Ensures that the `customer_user` column exports the username (defaults to 0 for guests).
 *
 * @param array $order_data the original column data
 * @param \WC_Order $order the order object
 * @param \CSV_Export_Generator $csv_generator the generator instance
 * @return array the updated column data
 */
function sv_wc_csv_export_convert_customer_id_to_username( $order_data, $order, $csv_generator ) {

	$user_id = $order->get_user_id();
	$user    = get_userdata( $user_id );

	$custom_data = array(
		'customer_user' => $user instanceof WP_User ? $user->user_login : $user_id,
	);

	return sv_wc_csv_export_add_custom_order_data( $order_data, $custom_data, $csv_generator );
}
add_filter( 'wc_customer_order_export_csv_order_row', 'sv_wc_csv_export_convert_customer_id_to_username', 50, 3 );


if ( ! function_exists( 'sv_wc_csv_export_add_custom_order_data' ) ) :

/**
 * Helper function to add custom order data to CSV Export order data
 *
 * @param array $order_data the original column data that may be in One Row per Item format
 * @param array $custom_data the custom column data being merged into the column data
 * @param \CSV_Export_Generator $csv_generator the generator instance
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
