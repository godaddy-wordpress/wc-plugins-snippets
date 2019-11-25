<?php // only copy this line if needed

/**
 * Modify the order export column headers to seperate coupons into multiple columns
 *
 * @param array $column_headers column headers in column_key => column_name format
 * @param \WC_Customer_Order_CSV_Export_Generator the generator instance
 * @return array modified column headers
 */
function sv_csv_export_multi_column_coupons_order_headers( $column_headers, $generator ) {


	if ( in_array( $generator->export_format, array( 'default', 'default_one_row_per_item' ) ) ) {

		// unset 'coupons' header
		unset( $column_headers['coupon_items'] );

		// add coupon headers
		for ( $i = 1; $i <= sv_get_max_coupon_items( $generator->ids ); $i++ ) {

			$column_headers[ "coupon_{$i}_name" ]        = "coupon_{$i}_name";
			$column_headers[ "coupon_{$i}_description" ] = "coupon_{$i}_description";
			$column_headers[ "coupon_{$i}_amount" ]      = "coupon_{$i}_amount";
		}
	}

	return $column_headers;
}
add_filter( 'wc_customer_order_export_csv_order_headers', 'sv_csv_export_multi_column_coupons_order_headers', 10, 2 );

/**
 * Modify the order export row to seperate coupons into multiple columns
 *
 * @param array $order_data an array of order data for the given order
 * @param WC_Order $order the WC_Order object
 * @return array modified order data
 */
function sv_csv_export_multi_column_coupons_order_row( $order_data, $order, $generator ) {

	if ( in_array( $generator->export_format, array( 'default', 'default_one_row_per_item' ) ) ) {

		// unset 'coupons' order data
		unset( $order_data['coupon_items'] );

		$count = 1;
		// add coupon items

		foreach ( $order->get_items( 'coupon' ) as $_ => $coupon_item ) {

			$coupon = new WC_Coupon( $coupon_item['name'] );
			$coupon_post = get_post( $coupon->id );
			$order_data[ "coupon_{$count}_name" ]        = $coupon_item['name'];
			$order_data[ "coupon_{$count}_description" ] = $coupon_post->post_excerpt;
			$order_data[ "coupon_{$count}_amount" ]      = wc_format_decimal( $coupon_item['discount_amount'], 2 );
			$count++;
		}
	}

	return $order_data;
}
add_filter( 'wc_customer_order_export_csv_order_row', 'sv_csv_export_multi_column_coupons_order_row', 10, 3 );

/**
 * Get the maximum number of coupon items for the given set of order IDs in order
 * to generate the proper number of order coupon item columns
 *
 * @param array $order_ids
 * @return int maximum coupon items in the list of orders
 */
function sv_get_max_coupon_items( $order_ids ) {

	$max_coupon_items = 0;

	foreach ( $order_ids as $order_id ) {

		$order = new WC_Order( $order_id );
		$line_items_count = count( $order->get_items( 'coupon' ) );

		if ( $line_items_count >= $max_coupon_items ) {
			$max_coupon_items = $line_items_count;
		}
	}

	return $max_coupon_items;
}
